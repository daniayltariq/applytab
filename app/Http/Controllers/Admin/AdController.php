<?php

namespace App\Http\Controllers\Admin;
use App\Models\Ad;
use App\Models\Site;

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

        $sites = Site::all();
        return view('backend.ads.form', compact('sites'));
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
            'ad_url'    => 'required|regex:/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/',
            'ad_image'  => $request->has('adId') ? 'nullable|mimes:jpeg,jpg,png,gif|max:10000' : 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'sites'     => 'required|array|exists:sites,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error','validation error!');
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
            $ad->image  = $filename ;
        }

        $ad->ad_url = $request->ad_url;
        $ad->save();

        $sites = $request->sites;


        if($sites){
            $ad->adSites()->attach($sites);
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
        $ad=ad::where('order_id',$id)->first();
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

        // Get all the available sites
        $sites = Site::all();

        // Extract the IDs of the selected sites into an array
        $selectedSites = $ad->adSites->pluck('id')->toArray();
        return view('backend.ads.form',compact('ad', 'sites', 'selectedSites'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad=ad::findOrFail($id);

        $ad->adSites()->detach();
        Storage::delete('public/ad_images/' . $ad->image);
        $ad->delete();
        return redirect()->back()->with("status", "Ad deleted successfully!");
    }
}
