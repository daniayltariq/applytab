<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InstitutionType;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advertisers = new Institution;

        $advertisers = $advertisers->when($request->query('search'),function($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('inst_name', 'LIKE', '%' . $request->query('search') . '%')
                        ->orWhere('acronym', 'LIKE', '%' . $request->query('search') . '%');
                });
            })->paginate(15);

        return view('backend.advertiser.list',compact('advertisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $types  = InstitutionType::all();
        return view('backend.advertiser.form', compact('types'));
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
            'name'  =>  'required|string',
            'type'      =>  'required|exists:institution_type,id',
            'acronym'   =>  'required|string|max:6',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error','validation error!');
        }

        if ($request->adv_id) {
            $inst = Institution::find($request->adv_id);
            $success = "Institution updated successfully!";
        } else {
            $inst = new Institution;
            $success = "Institution added successfully!";
        }

        $inst->inst_name = $request->name;
        $inst->inst_type_id = $request->type;
        $inst->acronym = $request->acronym;
        $inst->save();

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
        $inst = Institution::where('id',$id)->first();

        $stats = [
            'total_ads'=>$inst->ads->count(),
            'archived_ads'=>$inst->ads()->whereDate('ad_expiry','<=',now())->count(),
            'active_ads'=>$inst->ads()->whereDate('ad_expiry','>',now() )->where('status',1)->count(),
            'total_amount'=>$inst->ads()->sum('cost_per_click')
            /* 'clicks' => $inst->ads()->with(['ad_stats'=>function($q){
                            $q->where('type','click');
                        }])->get()->pluck('ad_stats')->flatten()->count() */
        ];

        $archived_ads=$inst->ads()->whereDate('ad_expiry','<=',now())->with('ad_stats')->get();
        $active_ads=$inst->ads()->whereDate('ad_expiry','>',now() )->with('ad_stats')->where('status',1)->get();

        // dd($archived_ads,$active_ads);
        return view('backend.advertiser.detail',compact('inst','stats','archived_ads','active_ads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $adv = Institution::find($id);
        if (!$adv) {
            abort(404);
        }

        $types  = InstitutionType::all();

        return view('backend.advertiser.form',compact('adv', 'types'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adv = Institution::findOrFail($id);
        $adv->delete();
        return redirect()->route('backend.advertiser.index')->with("status", "Advertiser deleted successfully!");
    }
}
