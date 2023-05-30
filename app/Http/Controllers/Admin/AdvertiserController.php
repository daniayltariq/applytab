<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Stats;
use Carbon\CarbonPeriod;
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
                        ->orWhere('keywords', 'LIKE', '%' . $request->query('search') . '%');
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
    public function adStatDetail(Request $request,$id)
    {
        $inst = Institution::where('id',$id)->first();

        $stats = [
            'total_ads'=>$inst->ads->count(),
            'archived_ads'=>$inst->ads()->whereDate('ad_expiry','<=',now())->count(),
            'active_ads'=>$inst->ads()->whereDate('ad_expiry','>',now() )->where('status',1)->count(),
            'total_amount'=>$inst->ads()->sum('cost_per_click'),
            'clicks' => $inst->ads()->with(['ad_stats'=>function($q){
                            $q->where('type','click');
                        }])->get()->pluck('ad_stats')->flatten()->count(),
            'views' => $inst->ads()->with(['ad_stats'=>function($q){
                            $q->where('type','view');
                        }])->get()->pluck('ad_stats')->flatten()->count()
        ];

        $stats['graph-max-y-axis'] = 100;

        $archived_ads=$inst->ads()->whereDate('ad_expiry','<=',now())->with('ad_stats')->get();
        $active_ads=$inst->ads()->whereDate('ad_expiry','>',now() )->with('ad_stats')->where('status',1)->get();

        $filter = [];
        if ($request->query('filter')) {
            if (str_contains($request->query('filter'), 'days')) {
                $days=explode("-",$request->query('filter'));
                $days=$days[0];
                // Get the current date
                $currentDate = Carbon::now();
                $filter = [];
                for ($i = 1; $i <= $days; $i++) {
                    $filter[] = $currentDate->subDay()->format('Y-m-d');
                }
                $filter=array_reverse($filter);
            } elseif($request->query('filter')=='this-month'){
                $period = CarbonPeriod::create(now()->startOfMonth(), now());
                foreach($period as $date)
                {
                  $filter[] = $date->format('Y-m-d');
                }
            } elseif($request->query('filter')=='last-month'){
                $period = CarbonPeriod::create(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth());
                foreach($period as $date)
                {
                  $filter[] = $date->format('Y-m-d');
                }
            }
            
        }else{
            // Get the current date
            $currentDate = Carbon::now();
            $filter = [];
            for ($i = 1; $i <= 7; $i++) {
                $filter[] = $currentDate->subDay()->format('Y-m-d');
            }
            $filter=array_reverse($filter);
        }
        // dd($filter);
        $monthlyStats = array_fill_keys($filter, ['impressions' => 0, 'clicks' => 0]);

        $graph = Stats::select('ad_id', 'type', DB::raw('DATE(created_at) as date'), DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'), DB::raw('SUM(CASE WHEN type = "view" THEN 1 ELSE 0 END) AS views'))
            ->whereIn('ad_id', $inst->ads()->pluck('id')->toArray())
            ->whereBetween('created_at', [$filter[0] . ' 00:00:00', end($filter) . ' 23:59:59']) // Add this line to filter by the selected dates
            ->groupBy('ad_id', 'type', 'date')
            ->get();
        // dd($graph);
        foreach ($graph as $stat) {
            $monthlyStats[$stat->date]['impressions'] += $stat->views;
            $monthlyStats[$stat->date]['clicks'] += $stat->clicks;

            $max = ($monthlyStats[$stat->date]['clicks'] > $monthlyStats[$stat->date]['impressions'] ? $monthlyStats[$stat->date]['clicks'] : $monthlyStats[$stat->date]['impressions']);
            $stats['graph-max-y-axis'] = $stats['graph-max-y-axis'] > $max ? $stats['graph-max-y-axis'] : $max;
        }

        foreach ($filter as $key => $f) {
            $filter[$key]=Carbon::parse($f)->format('M d');
        }
        // $monthlyStats = array_values($monthlyStats);
        // dd($stats['graph-max-y-axis']);
        return view('backend.advertiser.detail',compact('inst','stats','archived_ads','active_ads','monthlyStats','filter'));
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
