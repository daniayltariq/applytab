<?php

namespace App\Http\Controllers\Admin;
use App\Models\Ad;
use App\Models\Site;

use App\Models\Slot;

use App\Models\User;
use App\Models\Stats;
use App\Models\AdSites;
use App\Models\JobPost;
use App\Models\Category;
use App\Models\JobBudget;
use App\Models\Institution;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ContractProductCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ads = new Ad;

        $ads = $ads->when($request->query('search'),function($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('ad_url', 'LIKE', '%' . $request->query('search') . '%')
                    ->orWhereHas('adSites', function($q) use ($request){
                        $q->where('site_name', 'LIKE', '%' . $request->query('search') . '%');
                    });
                });
            })
            ->when($request->query('q')=='archived',function($q){
                $q->whereDate('ad_expiry','<=',now() );
            })
            ->when($request->query('q')=='active',function($q){
                $q->whereDate('ad_expiry','>',now() )->where('status',1);
            })->paginate(15);

        return view('backend.ads.list',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
        [
          "site_id" => "1",
          "slot_id" => "2"
        ],
        [
          "site_id" => "4",
          "slot_id" => "3"
        ],
        [
          "site_id" => "5",
          "slot_id" => "6"
        ]];
        $sites  = Site::all();
        $slots  = Slot::all();
        $institutes = Institution::all();
        $adv=null;
        if ($request->institute) {
            $adv = Institution::find($request->institute);
            if (!$adv) {
                abort(404);
            }
        }
        return view('backend.ads.form', compact('sites', 'slots', 'data','adv','institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'ad_url'                => 'required|regex:/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/',
            'ad_image'              => $request->has('adId') ? 'nullable|mimes:jpeg,jpg,png,gif|max:10000' : 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'ad_expiry'             =>'required|date|after_or_equal:today',
            'ad_limit'              =>'required|integer',
            'cost_per_click'        =>'required|integer',
            'adv_id'                =>'nullable|exists:institution_list,id',
            'site_data'             => 'required|array',
            'site_data.*.site_id'   => 'required|exists:sites,id',
            'site_data.*.ad_url'    => 'required|regex:/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/',
            'site_data.*.ad_limit'  => 'nullable|integer',
            // 'site_data.*.slot_id'   => 'required|exists:admanagement_slots,id',
        ], [
            'site_data.*.site_id.required' => 'Ad Site is required.',
            'adv_id.exists' => 'Advertiser is not valid.',
            // 'site_data.*.slot_id.required' => 'Ad Slot is required.',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error','validation error!')
                    ->with('site_data_error', $request->site_data);
        }

        if ($request->adId) {
            $ad = Ad::find($request->adId);
            $ad->adSites()->detach();

            $success = "Ad updated successfully!";
        } else {
            $ad = new Ad;
            $success = "Ad added successfully!";
        }

        if($request->hasFile('ad_image')) {
            $file = $request->file('ad_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/ad_images', $filename);
            $fullfilename = url('/').'/storage/ad_images/'.$filename;
            $ad->image  = $fullfilename ;
        }

        // $ad->ad_url = $request->ad_url;
        if ($request->adv_id) {
            $ad->institution_id = $request->adv_id;
        }
        $ad->ad_expiry = $request->ad_expiry;
        $ad->ad_limit = $request->ad_limit;
        $ad->cost_per_click = $request->cost_per_click;
        $ad->save();

        $sites = $request->site_data;


        if($sites){

            foreach ($request->site_data as $key => $site) {

                $adSite = new AdSites();

                $adSite->ad_id    = $ad->id;
                $adSite->site_id  = $site['site_id'];
                // $adSite->slot_id  = $site['slot_id'];
                $adSite->ad_url = $site['ad_url'];
                $adSite->ad_limit = $site['ad_limit'];
                // $adSite->ad_click_url = "https://applytab.com/".$ad->id."?sr=adtrack&site=".$site['site_id'];
                // $adSite->ad_pixel_url = "https://applytab.com/watch/".$ad->id."?sr=adtrack";
                $adSite->save();
            }
            // $ad->adSites()->attach($sites);
        }

        // // Create Notification
        // createNotification(
        //     "contract",
        //     $contract->emp_id,
        //     "Contract Created",
        //     "A new Contract has been created bearing id ".$contract->order_id,
        //     [
        //         "contract_id" => $contract->id,
        //     ]
        // );

        return redirect()->back()->with("status", $success);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function adStatDetail($id)
    {
        $ad = Ad::where('id',$id)->first();
        // $statdetails = Stats::select('ad_id','source','type',DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'),DB::raw('SUM(CASE WHEN type = "view" THEN 1 ELSE 0 END) AS views'))
        //                 ->where('adtrack',1)
        //                 ->whereHas('ad')
        //                 ->where('ad_id',$id)
        //                 ->groupBy('ad_id','source','type')
        //                 ->get()
        //                 ->groupBy('type');
        $statdetails=$ad->adSites->transform(function($site) use ($ad){
            return [
                "site"  =>  rtrim($site->site_name, "/"),
                "clicks" =>  $ad->ad_stats()->where('source','LIKE','%'.rtrim($site->site_name, "/").'%')->where('type','click')->count(),
                "views" =>  $ad->ad_stats()->where('source','LIKE','%'.rtrim($site->site_name, "/").'%')->where('type','view')->count()
            ];
        });

        $stats = [
            'clicks' => $ad->ad_stats()->where('type','click')->count(),
            'views' => $ad->ad_stats()->where('type','view')->count()
        ];

        // dd($stats);
        return view('backend.ads.detail',compact('ad','statdetails','stats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ad = Ad::find($id);
        if (!$ad) {
            abort(404);
        }

        $sites = Site::all();

        $slots  = Slot::all();

        $selectedSites = $ad->ad_sites->all();

        $selectedSites = collect($selectedSites)->map(function ($item) {
            return [
                'site_id' => $item->site_id,
                // 'slot_id' => $item->slot_id,
                'ad_url' => $item->ad_url,
                'ad_limit' => $item->ad_limit,
            ];
        })->toArray();

        $institutes = Institution::all();
        return view('backend.ads.form',compact('ad', 'sites', 'slots', 'selectedSites','institutes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function renew(Request $request,$id)
    {
        if ($request->isMethod('GET')) {
        
            $ad = Ad::find($id);
            if (!$ad) {
                abort(404);
            }
    
            $sites = Site::all();
    
            $slots  = Slot::all();
    
            $selectedSites = $ad->ad_sites->all();
    
            $selectedSites = collect($selectedSites)->map(function ($item) {
                return [
                    'site_id' => $item->site_id,
                    // 'slot_id' => $item->slot_id,
                    'ad_url' => $item->ad_url,
                    'ad_limit' => $item->ad_limit,
                ];
            })->toArray();
    
            return view('backend.ads.renew',compact('ad', 'sites', 'slots', 'selectedSites'));
        } elseif ($request->isMethod('POST')) {
            
            $validator = Validator::make($request->all(), [
                'ad_image'              => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
                'ad_expiry'             =>'required|date|after_or_equal:today',
                'ad_limit'             =>'required|integer',
                'cost_per_click'             =>'required|integer',
                'site_data'             => 'required|array',
                'site_data.*.site_id'   => 'required|exists:sites,id',
                'site_data.*.ad_url'   => 'required|regex:/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/',
                'site_data.*.ad_limit'   => 'nullable|integer',
            ], [
                'site_data.*.site_id.required' => 'Ad Site is required.',
            ]);
    
            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error','validation error!')
                        ->with('site_data_error', $request->site_data);
            }
    
            $old_ad = Ad::findOrFail($id);

            $ad = new Ad;
    
            if($request->hasFile('ad_image')) {
                $file = $request->file('ad_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/ad_images', $filename);
                $fullfilename = url('/').'/storage/ad_images/'.$filename;
                $ad->image  = $fullfilename ;
            }else{
                $ad->image  = $old_ad->image ;
            }
    
            $ad->ad_expiry = $request->ad_expiry;
            $ad->ad_limit = $request->ad_limit;
            $ad->cost_per_click = $request->cost_per_click;
            $ad->renew_from=$old_ad->id;
            $ad->save();
    
            $sites = $request->site_data;
    
    
            if($sites){
    
                foreach ($request->site_data as $key => $site) {
    
                    $adSite = new AdSites();
    
                    $adSite->ad_id    = $ad->id;
                    $adSite->site_id  = $site['site_id'];
                    $adSite->ad_url = $site['ad_url'];
                    $adSite->ad_limit = $site['ad_limit'];
                    $adSite->save();
                }
            }
    
            return redirect()->route('backend.adsListing',['q'=>'active'])->with("status", 'Ad has been renewed');
        }
    }

    /**
     * Update Status.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request){

        $ad = Ad::where('id',$request->query('ad'))->first();

        if($ad && in_array($request->query('status'),[0,1])){
            $ad->status = $request->query('status');
            $ad->save();
            return response()->json([
                'message' => 'Status Updated',
                'status' => 1
            ]);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'status' => 0
        ]);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function adStats()
    {
        $ads = Ad::all();
        return view('backend.ads.stats',compact('ads'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);

        $ad->adSites()->detach();
        Storage::delete('public/ad_images/' . $ad->image);
        $ad->delete();
        return redirect()->route('backend.adsListing')->with("status", "Ad deleted successfully!");
    }
}
