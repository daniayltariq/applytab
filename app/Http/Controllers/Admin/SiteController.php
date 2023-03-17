<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Models\Stats;
use App\Models\JobPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ContractProductCategory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startDate = Carbon::now()->startOfDay(); // set the default start date as today's start time
        $endDate = Carbon::now(); // set the default end date as now
        
        if (request()->query('f') == 'yesterday') {
            $startDate = Carbon::yesterday()->startOfDay();
            $endDate = Carbon::yesterday()->endOfDay();
        } elseif (request()->query('f') == 'last_week') {
            $startDate = Carbon::now()->subWeek()->startOfWeek();
            $endDate = Carbon::now()->subWeek()->endOfWeek();
        } elseif (request()->query('f') == 'this_week') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfDay();
        } elseif (request()->query('f') == 'this_month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfDay();
        } elseif (request()->query('f') == 'this_year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfDay();
        }

        $sites = Stats::whereNotNull('source')
                        ->when(request()->query('f'),function ($q) use ($startDate,$endDate) {
                            $q->whereBetween('created_at', [$startDate, $endDate]);
                        })
                        ->select('source', 
                                 DB::raw('COUNT(DISTINCT job_id) AS total_jobs'),
                                 DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'),
                                 DB::raw('SUM(CASE WHEN type = "view" THEN 1 ELSE 0 END) AS views')
                                )
                        ->groupBy('source')
                        ->get();
        
        // dd($sites);
        return view('backend.site.list',compact('sites'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobStats(Request $request)
    {
        $stats = Stats::select('job_id',DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'),DB::raw('SUM(CASE WHEN type = "view" THEN 1 ELSE 0 END) AS views'))
                        ->whereHas('job',function($query)use($request){
                            $query->when($request->query('search_text'),function($q)use($request){
                                    $search=$request->query('search_text');
                                    $q->where(function($q)use($search){
                                        $q->where('job_title','LIKE','%'.$search.'%')
                                            ->orWhereHas('institution',function($q)use($search){
                                                $q->where('inst_name','LIKE','%'.$search.'%');
                                            })
                                            // ->orWhereHas('city',function($q)use($search){
                                            //     $q->where('city_name','LIKE','%'.$search.'%');
                                            // })
                                            ->orWhereHas('country',function($q)use($search){
                                                $q->where('country_name','LIKE','%'.$search.'%');
                                            })
                                            /* ->orWhereHas('state',function($q)use($search){
                                                $q->where('state_name','LIKE','%'.$search.'%');
                                            })
                                            ->orWhereHas('type',function($q)use($search){
                                                $q->where('state_name','LIKE','%'.$search.'%');
                                            }) */
                                            ->orWhere('job_description','LIKE','%'.$search.'%')
                                            ->orWhere('institution_website','LIKE','%'.$search.'%')
                                            // ->orWhere('date_open','LIKE','%'.$search.'%')
                                            // ->orWhere('date_close','LIKE','%'.$search.'%')
                                            ;
                                    });
                                });
                        })
                        ->groupBy('job_id')
                        ->paginate(10);

        return view('backend.jobstats.list',compact('stats'));
    }
    public function jobStatDetail(Request $request , $jobid)
    {
        $jobid = Crypt::decrypt($jobid);
        // dd($jobid);
        $job=JobPost::where('id',$jobid)->first();
        $statdetails = Stats::select('job_id','source','type',DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'),DB::raw('SUM(CASE WHEN type = "view" THEN 1 ELSE 0 END) AS views'))
                        ->whereHas('job')
                        ->where('job_id',$jobid)
                        ->groupBy('job_id','source','type')
                        ->get()
                        ->groupBy('type');
        // dd($statdetails);
        $totalclicks = Stats::select(DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'))->where('job_id',$jobid)->first();
        
        return view('backend.jobstats.detail',compact('job','statdetails','totalclicks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        $job=JobPost::select('id','unique_id','job_title','institution_name','institution_city','post_date','app_deadline','job_description')
                    ->where('id',$id)
                    ->with('stats')->first();
        $stats=(clone $job)->stats->groupBy('source');

        return view('backend.contract.report',compact('job','stats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customers=User::customer()->get();
        
        $vendors=User::vendor()->get();

        $salesperson=User::salesperson()->get();

        $categories=Category::where('category_type','product')->get();
        return view('backend.contract.create',compact('customers','salesperson','vendors','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            "user_type" => ['required', 'in:customer,vendor'],
            "customer" => ['required_if:user_type,==,customer'],
            "vendor" => ['required_if:user_type,==,vendor'],
            "start_date" => ['required', 'date'],
            "end_date" => ['required', 'date','after:start_date'],
            "renewal_interval" => ['nullable', 'in:one_time,unlimited'],
            "renewal_reminder_date" => ['required', 'date','after:start_date','before:end_date'],
            "contract_value" =>['required', 'string'],
            "contract_file" => ['nullable', 'array'],
            "contract_file.*" => ['required', 'mimes:pdf'],
            "purchaser_id" => ['required_if:user_type,==,vendor'],
            "salesperson_id" => ['required_if:user_type,==,customer'],
        ];

        if ($request->user_type=='customer') {
            $rules = array_merge($rules, [
                "contract_type" => ['required', 'string'],
                "extension" => ['required', 'in:none,automatic'],
                "extension_period" => ['required', 'string'],
                "performance_delivery_degree" => ['required', 'string'],
                "performance_delivery_time" => ['required', 'string'],
                "performance_quality" => ['required', 'string'],
                "element_delivery_degree" => ['required', 'string'],
                "element_delivery_time" => ['required', 'string'],
                "element_quality" => ['required', 'string'],
                "delivery_instructions" => ['required', 'string'],
                "product_category" => ['required', 'array'],
                "product_category.*" => ['required', 'integer'],
                "status_meeting" => ['required', 'string'],
                "meeting_date" => ['required', 'date','after:start_date','before:end_date']
            ]);
        }
        
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            // dd(222);
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error','validation error');
        }
        // dd($request->all());
        $contract = new Contract;
        $contract->order_id = uniqid();
        $contract->user_type = $request->user_type;
        $contract->user_id = $request->input($request->user_type);
        $contract->association_id = $request->user_type== 'customer' ? $request->salesperson_id : $request->purchaser_id;
        $contract->start_date = $request->start_date;
        $contract->end_date = $request->end_date;
        $contract->renewal_date = $request->end_date;
        $contract->renewal_interval = $request->renewal_interval ?? null;
        $contract->renewal_reminder_date = $request->renewal_reminder_date;
        $contract->contract_value = $request->contract_value;

        $val__=str_replace(".","",$request->contract_value);
        $val__=str_replace(",",".",$val__);
        $contract->contract_value_usd = $val__;

        if ($request->user_type=='customer') {
            $contract->contract_type = $request->contract_type;
            $contract->extension = $request->extension;
            $contract->extension_period = $request->extension_period;
            $contract->performance_delivery_degree = $request->performance_delivery_degree;
            $contract->performance_delivery_time = $request->performance_delivery_time;
            $contract->performance_quality = $request->performance_quality;
            $contract->element_delivery_degree = $request->element_delivery_degree;
            $contract->element_delivery_time = $request->element_delivery_time;
            $contract->element_quality = $request->element_quality;
            $contract->delivery_instructions = $request->delivery_instructions;
            $contract->status_meeting = $request->status_meeting;
            $contract->meeting_date = $request->meeting_date;
        }
        $contract->emp_id = auth()->user()->id;
        $contract->save();

        if($request->product_category) {
            foreach ($request->product_category as $key => $pc) {
                ContractProductCategory::insert([
                    'contract_id'=>$contract->id, 'product_category_id'=> $pc
                ]);
            }
        }
        
        if($request->hasFile('contract_file')) {
            if (is_array($request->contract_file)) {
                $files = $request->file('contract_file');
                foreach ($files as $file) {
                    
                    $contract_media=new ContractMedia;
                    $contract_media->contract_id = $contract->id;
                    $contract_media->file = custom_file_upload($file,CONTRACT_FILE_PATH);
                    $contract_media->orig_name = $file->getClientOriginalName();
                    $contract_media->save();
                }
            }else{
                $file = $request->file('contract_file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('contract_files', $filename);

                $contract_media=new ContractMedia;
                $contract_media->contract_id = $contract->id;
                $contract_media->file = $path;
                $contract_media->save();
            }
            
        }

        $contract->save();

        // Create Notification
        createNotification(
            "contract",
            $contract->emp_id,
            "Contract Created",
            "A new Contract has been created bearing id ".$contract->order_id,
            [
                "contract_id" => $contract->id,
            ]
        );
        
        // Create log
        activity('contract')
            ->performedOn($contract)
            ->causedBy(auth()->user())
            ->withProperties(['contract_id' => $contract->id])
            ->log('Contract created by ' . auth()->user()->name);

        return redirect()->back()->with("status", "Contract has been Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract=Contract::where('order_id',$id)->first();
        return view('backend.contract.report',compact('contract'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function fieldUpdate(Request $request,$id)
    {
        $job=JobPost::where('id',$id)->first();
        if (request()->isMethod('get')) {
            
            if ($job) {
                $type=$request->type;

                $sites=Site::all();
                $view_data=view('backend.contract.component.modal',compact('job','type','sites'))->render();
                $res=array(
                    'status' => 'success',
                    'data' => $view_data
            
                );
                
            }else{
                $res=array(
                    'status' => 'error',
                    'message'=>"data not found"
            
                );
            }
    
            return Response::json($res);
        }
        else if (request()->isMethod('post')) {
            if ($request->type=='url') {
                $job->apply_details=$request->url;
                $job->save();
            } else {

                $validator = Validator::make($request->all(),[
                    "budget" => ['required', 'array'],
                    "budget.*.site_id" => ['required', 'distinct'],
                    "budget.*.budget" => ['required'],
                ],[
                    "budget.*.site_id.distinct"=>"The budget site_id field should be distinct"
                ],[
                   "budget.*.site_id"=>"Site",
                   "budget.*.budget"=>"Budget" 
                ]);
                
                if ($validator->fails()) {
                    return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error','validation error')
                            ->with('budget_error',$job->id);
                }
                foreach ($request->budget as $key => $job_budget) {
                    $budget=JobBudget::updateOrCreate([
                        'job_id' => $job->id,
                        'site_id' => $job_budget['site_id'],
                    ],[
                        'job_id' => $job->id,
                        'site_id' => $job_budget['site_id'],
                        'budget' => $job_budget['budget']
                    ]);
                    $budget->save();
                }
            }
        }
        return redirect()->back()->with("status", "Job updated.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $contract=Contract::where('order_id',$id)->first();
        $contract->status='COMPLETED';
        $contract->save();
        return redirect()->back()->with("status", "Contract status updated.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract=Contract::where('order_id',$id)->first();
        $customers=User::customer()->get();
        
        $vendors=User::vendor()->get();

        $salesperson=User::salesperson()->get();

        $categories=Category::where('category_type','product')->get();
        return view('backend.contract.edit',compact('contract','customers','salesperson','vendors','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $rules=[
            "user_type" => ['required', 'in:customer,vendor'],
            "customer" => ['required_if:user_type,==,customer'],
            "vendor" => ['required_if:user_type,==,vendor'],
            "start_date" => ['required', 'date'],
            "end_date" => ['required', 'date','after:start_date'],
            "renewal_interval" => ['nullable', 'in:one_time,unlimited'],
            "renewal_reminder_date" => ['required', 'date','after:start_date','before:end_date'],
            "contract_value" =>['required', 'string'],
            "contract_file" => ['nullable', 'array'],
            "contract_file.*" => ['required', 'mimes:pdf'],
            "purchaser_id" => ['required_if:user_type,==,vendor'],
            "salesperson_id" => ['required_if:user_type,==,customer'],
        ];

        if ($request->user_type=='customer') {
            $rules = array_merge($rules, [
                "contract_type" => ['required', 'string'],
                "extension" => ['required', 'in:none,automatic'],
                "extension_period" => ['required', 'string'],
                "performance_delivery_degree" => ['required', 'string'],
                "performance_delivery_time" => ['required', 'string'],
                "performance_quality" => ['required', 'string'],
                "element_delivery_degree" => ['required', 'string'],
                "element_delivery_time" => ['required', 'string'],
                "element_quality" => ['required', 'string'],
                "delivery_instructions" => ['required', 'string'],
                "product_category" => ['required', 'array'],
                "product_category.*" => ['required', 'integer'],
                "status_meeting" => ['required', 'string'],
                "meeting_date" => ['required', 'date','after:start_date','before:end_date']
            ]);
        }
        
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error','validation error');
        }
        // dd($request->all());
        $contract=Contract::findOrFail($id);
        $contract->user_type = $request->user_type;
        $contract->user_id = $request->input($request->user_type);
        $contract->association_id = $request->user_type== 'customer' ? $request->salesperson_id : $request->purchaser_id;
        $contract->start_date = $request->start_date;
        $contract->end_date = $request->end_date;
        $contract->renewal_date = $request->end_date;
        $contract->renewal_interval = $request->renewal_interval ?? null;
        $contract->renewal_reminder_date = $request->renewal_reminder_date;
        $contract->contract_value = $request->contract_value;

        $val__=str_replace(".","",$request->contract_value);
        $val__=str_replace(",",".",$val__);
        $contract->contract_value_usd = $val__;

        
        $contract->contract_type = $request->user_type== 'customer' ? $request->contract_type : null;
        $contract->extension = $request->user_type== 'customer' ? $request->extension : null;
        $contract->extension_period = $request->user_type== 'customer' ? $request->extension_period : null;
        $contract->performance_delivery_degree = $request->user_type== 'customer' ? $request->performance_delivery_degree : null;
        $contract->performance_delivery_time = $request->user_type== 'customer' ? $request->performance_delivery_time : null;
        $contract->performance_quality = $request->user_type== 'customer' ? $request->performance_quality : null;
        $contract->element_delivery_degree = $request->user_type== 'customer' ? $request->element_delivery_degree : null;
        $contract->element_delivery_time = $request->user_type== 'customer' ? $request->element_delivery_time : null;
        $contract->element_quality = $request->user_type== 'customer' ? $request->element_quality : null;
        $contract->delivery_instructions = $request->user_type== 'customer' ? $request->delivery_instructions : null;
        $contract->status_meeting = $request->user_type== 'customer' ? $request->status_meeting : null;
        $contract->meeting_date = $request->user_type== 'customer' ? $request->meeting_date : null;
        
        $contract->emp_id = auth()->user()->id;
        $contract->save();

        $contract->product_categories()->delete();
        if($request->product_category) {
            foreach ($request->product_category as $key => $pc) {
                ContractProductCategory::insert([
                    'contract_id'=>$contract->id, 'product_category_id'=> $pc
                ]);
            }
        }

        if($request->hasFile('contract_file')) {
            if (is_array($request->contract_file)) {
                $files = $request->file('contract_file');
                foreach ($files as $file) {
                    
                    $contract_media=new ContractMedia;
                    $contract_media->contract_id = $contract->id;
                    $contract_media->file = custom_file_upload($file,CONTRACT_FILE_PATH);
                    $contract_media->orig_name = $file->getClientOriginalName();
                    $contract_media->save();
                }
            }else{
                $file = $request->file('contract_file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('contract_files', $filename);

                $contract_media=new ContractMedia;
                $contract_media->contract_id = $contract->id;
                $contract_media->file = $path;
                $contract_media->save();
            }
            
        }

        $contract->save();

        // Create Notification
        createNotification(
            "contract",
            $contract->emp_id,
            "Contract Created",
            "Contract #".$contract->order_id." has been updated",
            [
                "contract_id" => $contract->id,
            ]
        );

        // Create Log
        activity('contract')
            ->performedOn($contract)
            ->causedBy(auth()->user())
            ->withProperties(['contract_id' => $contract->id])
            ->log('Contract updated by ' . auth()->user()->name);

        return redirect()->back()->with("status", "Contract has been Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract=Contract::findOrFail($id);

        // Create Notification
         createNotification(
            "contract",
            $contract->emp_id,
            "Contract Deleted",
            "Contract #".$contract->order_id." has been Deleted",
            [
                "contract_id" => $contract->id,
            ]
        );

        // Create Log
        activity('contract')
            ->performedOn($contract)
            ->causedBy(auth()->user())
            ->withProperties(['contract_id' => $contract->id])
            ->log('Contract deleted by ' . auth()->user()->name);
            
        $contract->delete();
        return redirect()->back();
    }
}
