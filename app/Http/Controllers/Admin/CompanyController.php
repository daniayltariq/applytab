<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\CarMake;

use App\Models\Service;
use App\Models\Category;
use App\Models\Nationality;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Models\CompanyService;
use App\Models\CompanyEmployee;
use App\Models\ServiceEmployee;
use App\Domain\Mail\InviteTalent;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Domain\Mail\DeactivateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Validator;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $companies=CompanyProfile::when($request->query('search_text'),function($q){
            $q->where('name','like','%'.request()->query('search_text').'%');
        })->withCount(['orders'=>function($q){
            $q->whereHas('order',function($q){
                $q->whereHas('statuss',function($q){
                    $q->where('status','completed');
                });
            });
        }])->get();
        
        if($request->has('search_text') && $request->query('search_text') ==""){
            Session::flash('error','Type something to search.');
        }
        if($companies->isEmpty()){
            Session::flash('error','No Data Found.');
        }
        return view('backend.company.list',compact('companies'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        //company profile
        $comp=CompanyProfile::create([
            // 'user_id'=>auth()->user()->id,
            'name' => $request->name,
            'email'=>$request->company_email,
            'contact'=> $request->contact,
            'location'=> $request->location,
            'city'=> $request->city,
            'state'=> $request->state,
            'country'=> $request->country,
        ]);

        if (isset($request->logo)) {
            
            $filename = custom_file_upload($request->logo,PROFILE_IMAGE_PATH);
            $comp->logo=$filename;
        }
        $comp->save();

        return redirect()->back()->with('success','Company Added.');
    }

    public function services(Request $request,$id)
    {
        $company=CompanyProfile::findOrFail($id);
        if (request()->isMethod('get')) {
            
            $employees=CompanyEmployee::where('company_id',$id)->get();
            $services=Category::where('category_type', 'service')->get();
            
            if ($request->query('q')=='create') {
                return view('backend.company.service.create',compact('employees','services','company'));
            } else {
                return view('backend.company.service.list',compact('company'));
            }
            
        } elseif (request()->isMethod('post')) {
            
            // company service
            $validator=Validator::make($request->all(),[
                'type'=> ['required','string'],
                'service'=>['required','string'],
                'price'=>['required','string'],
                'employees' => ['required','array'],
                'employees.*' => 'string|exists:company_employees,id',
                'shift'=>['required','string'],
                // 'duration'=>['required','string'],
                'description'=>['required','string'],
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $ser=new CompanyService;
            $ser->company_id=$id;
            $ser->type=$request->type;
            $ser->service= $request->service;
            $ser->price=$request->price;
            $ser->shift= $request->shift;
            // $ser->duration= $request->duration;
            $ser->description= $request->description;
            $ser->save();

            foreach ($request->employees as $key => $empl) {
                $se=new ServiceEmployee;
                $se->cs_id=$ser->id;
                $se->ce_id=$empl;
                $se->save();
            }

            return redirect()->back()->with('success','Service Added.');
            
        }
        
    }

    public function employees(Request $request,$id)
    {
        $company=CompanyProfile::findOrFail($id);
        if (request()->isMethod('get')) {
            $nationalities=Nationality::all();
            if ($request->query('q')=='create') {
                return view('backend.company.employee.create',compact('nationalities'));
            } else {
                return view('backend.company.employee.list',compact('company'));
            }
            
        } elseif (request()->isMethod('post')) {
            // dd($request->all());
            $validator=Validator::make($request->all(),[
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'date_of_birth' => 'required|date',
                'phone' => 'required|string|max:191',
                'profile_image' => 'nullable|image',
                'email' => 'required|email|unique:users,email',
                'gender'=>'required|in:male,female',
                'nationality' => 'required|string|max:191',
                'lang' => 'required|string|max:191',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $emp=new User;
            $emp->first_name=$request->first_name;
            $emp->last_name=$request->last_name;
            $emp->email=$request->email;
            $emp->date_of_birth=$request->date_of_birth;
            $emp->phone=$request->phone;
            $emp->gender=$request->gender;
            $emp->nationality=$request->nationality;
            $emp->lang=$request->lang;

            if($request->hasFile('profile_image')){
                
                $emp->profile_image = custom_file_upload($request->profile_image,USER_IMAGE_PATH_PUBLIC);
            }
            $emp->save();

            $ce=CompanyEmployee::insert([
                'company_id'=>$id,
                'user_id'=>$emp->id,
            ]);

            return redirect()->back()->with('success','Company Employee Added.');
        }
        
    }

    //update company employee
    public function updateEmployee(Request $request,$c_id,$ce_id)
    {
        $ce=CompanyEmployee::findOrFail($ce_id);
        if (request()->isMethod('get')) {
            $nationalities=Nationality::all();
            return view('backend.company.employee.create',compact('nationalities','ce'));
            
        } elseif (request()->isMethod('put')) {
            $validator=Validator::make($request->all(),[
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'date_of_birth' => 'required|date',
                'phone' => 'required|string|max:191|unique:users,phone,'.$ce->user_id,
                'profile_image' => 'nullable|image',
                'email' => 'required|email|unique:users,email,'.$ce->user->id,
                'gender'=>'required|in:male,female',
                'nationality' => 'required|string|max:191',
                'lang' => 'required|string|max:191',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $emp=$ce->user;
            $emp->first_name=$request->first_name;
            $emp->last_name=$request->last_name;
            $emp->email=$request->email;
            $emp->date_of_birth=$request->date_of_birth;
            $emp->phone=$request->phone;
            $emp->gender=$request->gender;
            $emp->nationality=$request->nationality;
            $emp->lang=$request->lang;

            if($request->hasFile('profile_image')){
                
                $emp->profile_image = custom_file_upload($request->profile_image,USER_IMAGE_PATH_PUBLIC);
            }
            $emp->save();

            return redirect()->back()->with('success','Company Employee Updated.');
        }
    }

    //update company service
    public function updateService(Request $request,$c_id,$cs_id)
    {
        $cs=CompanyService::findOrFail($cs_id);
        if (request()->isMethod('get')) {
            $services=Category::where('category_type', 'service')->get();
            $employees=CompanyEmployee::where('company_id',$c_id)->get();
            return view('backend.company.service.create',compact('services','employees','cs'));
            
        } elseif (request()->isMethod('put')) {
            
            $validator=Validator::make($request->all(),[
                'type'=> ['required','string'],
                'service'=>['required','string'],
                'price'=>['required','string'],
                'employees' => ['required','array'],
                'employees.*' => 'string|exists:company_employees,id',
                'shift'=>['required','string'],
                // 'duration'=>['required','string'],
                'description'=>['required','string'],
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $cs->type=$request->type;
            $cs->service= $request->service;
            $cs->price=$request->price;
            $cs->shift= $request->shift;
            // $cs->duration= $request->duration;
            $cs->description= $request->description;
            $cs->save();

            foreach ($request->employees as $key => $empl) {
                $se=ServiceEmployee::where('cs_id',$cs->id)->whereNotIn('ce_id',$request->employees)->delete();
                $se=ServiceEmployee::updateOrCreate(
                    ['cs_id'=>$cs->id,'ce_id'=>$empl],
                    ['cs_id'=>$cs->id,'ce_id'=>$empl]
                );
            }

            return redirect()->back()->with('success','Service Updated.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return company profile
        $company=CompanyProfile::findOrFail($id);
        $services=CompanyService::where('company_id',$id)->get()->groupBy('type');
        
        $employees=CompanyEmployee::where('company_id',$id)->get();
        return view('backend.company.profile',compact('company','services','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $company=CompanyProfile::findOrFail($id);
        if (request()->isMethod('get')) {
            return view('backend.company.create',compact('company'));
            
        } elseif (request()->isMethod('put')) {
            $validator=Validator::make($request->all(),[
                'name' => ['required','string'],
                'company_email'=>['required','email:filter'],
                'contact'=>['required','string'],
                'location'=>['required','string'],
                'city'=>['required','string'],
                'state'=>['required','string'],
                'country'=>['required','string'],
                'logo'=>['nullable','image'],
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $company->name= $request->name;
            $company->email=$request->company_email;
            $company->contact= $request->contact;
            $company->location= $request->location;
            $company->city= $request->city;
            $company->state= $request->state;
            $company->country= $request->country;

            if (isset($request->logo)) {
                
                $filename = custom_file_upload($request->logo,PROFILE_IMAGE_PATH);
                $company->logo=$filename;
            }
            $company->save();

            return redirect()->back()->with('status','Company Updated.');
        }
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
        
    }

    //delete function for employee
    public function deleteEmployee($c_id,$ce_id)
    {
        $ce=CompanyEmployee::findOrFail($ce_id);
        $ce->user->delete();
        $ce->delete();
        return redirect()->back()->with('success' ,'Employee Deleted.');
    }

    //delete function for service
    public function deleteService($id,$service_id)
    {
        $ser=CompanyService::findOrFail($service_id);
        $ser->delete();
        return redirect()->route('backend.company.services',$id)->with('success','Service Deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=CompanyProfile::findOrFail($id);
        
        $company->delete();
        return redirect()->back();
    }

}
