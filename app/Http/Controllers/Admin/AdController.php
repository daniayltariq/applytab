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

        if ($request->query('search')) {
            $ads = $ads->where(function ($q) use ($request) {
                $q->where('ad_url', 'LIKE', '%' . $request->query('search') . '%')
                ->orWhereHas('adSites', function($q) use ($request){
                    $q->where('site_name', 'LIKE', '%' . $request->query('search') . '%');
                });
            });
        }

        $ads = $ads->paginate(15);

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
        return view('backend.ads.form', compact('sites', 'slots', 'data'));
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
            'ad_url'                => 'required|regex:/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/',
            'ad_image'              => $request->has('adId') ? 'nullable|mimes:jpeg,jpg,png,gif|max:10000' : 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'ad_expiry'             =>'required|date|after_or_equal:today',
            'ad_limit'             =>'required|integer',
            'site_data'             => 'required|array',
            'site_data.*.site_id'   => 'required|exists:sites,id',
            'site_data.*.slot_id'   => 'required|exists:admanagement_slots,id',
        ], [
            'site_data.*.site_id.required' => 'Ad Site is required.',
            'site_data.*.slot_id.required' => 'Ad Slot is required.',
        ]);

        if ($validator->fails()) {
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

        $site=Site::where('id',$id)->first();
        $ad->ad_url = $request->ad_url;
        $ad->ad_expiry = $request->ad_expiry;
        $ad->ad_limit = $request->ad_limit;
        $ad->save();

        $sites = $request->site_data;


        if($sites){

            foreach ($request->site_data as $key => $site) {

                $adSite = new AdSites();

                $adSite->ad_id    = $ad->id;
                $adSite->site_id  = $site['site_id'];
                $adSite->slot_id  = $site['slot_id'];
                $ad->ad_click_url = "https://applytab.com/".$ad->id."?sr=ad_track&site=".$site['site_id'];
                $ad->ad_pixel_url = "https://applytab.com/watch/".$ad->id."?sr=ad_track";
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
    public function show($id)
    {
        $ad = Ad::where('order_id',$id)->first();
        return view('backend.ad.report',compact('ad'));
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
                'slot_id' => $item->slot_id,
            ];
        })->toArray();

        return view('backend.ads.form',compact('ad', 'sites', 'slots', 'selectedSites'));
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
