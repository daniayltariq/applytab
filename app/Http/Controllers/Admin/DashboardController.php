<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Models\Stats;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
  	public function index(Request $request) 
  	{
		$ads=Ad::count();
        $sites  = Site::count();

		$clicks=Stats::where('adtrack', '1')->where('type', 'click')->count();
		$views=Stats::where('adtrack', '1')->where('type', 'view')->count();

		$data=[
			'clicks'=>$clicks,
			'views'=>$views,
			'ads'=>$ads,
			'sites'=>$sites,
		];

		$data['graph-max-y-axis'] = 100;

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

        $monthlyStats = array_fill_keys($filter, ['impressions' => 0, 'clicks' => 0]);

        $graph = Stats::select('ad_id', 'type', DB::raw('DATE(created_at) as date'), DB::raw('SUM(CASE WHEN type = "click" THEN 1 ELSE 0 END) AS clicks'), DB::raw('SUM(CASE WHEN type = "view" THEN 1 ELSE 0 END) AS views'))
            ->whereNotNull('ad_id')
            ->whereBetween('created_at', [$filter[0] . ' 00:00:00', end($filter) . ' 23:59:59'])
            ->groupBy('ad_id', 'type', 'date')
            ->get();

        foreach ($graph as $stat) {
            $monthlyStats[$stat->date]['impressions'] += $stat->views;
            $monthlyStats[$stat->date]['clicks'] += $stat->clicks;

            $max = ($monthlyStats[$stat->date]['clicks'] > $monthlyStats[$stat->date]['impressions'] ? $monthlyStats[$stat->date]['clicks'] : $monthlyStats[$stat->date]['impressions']);
            $data['graph-max-y-axis'] = $data['graph-max-y-axis'] > $max ? $data['graph-max-y-axis'] : $max;
        }

        foreach ($filter as $key => $f) {
            $filter[$key]=Carbon::parse($f)->format('M d');
        }

	    return view('backend.index',compact('data','monthlyStats','filter'));
  	}
	  
  	public function terms_and_condition(Request $request) 
  	{
		if(request()->isMethod('post')) {
			//validaitons
			$validator = Validator::make(request()->all(), [
				'title' => 'required',
				'description' => 'required',
			]);
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			//createOrUpdate
			$terms_and_condition=\App\Models\TermsCondition::first();
			$terms_and_condition->fill(request()->except('_token','files'));
			$terms_and_condition->save();
			//redirect
			return redirect()->back()->with('success','Terms and condition updated successfully');
		}else{
			$terms=\App\Models\TermsCondition::first();
			return view('backend.pages.terms_and_condition',compact('terms'));
		}
  	}

  	public function options(Request $request) 
  	{
		if (in_array($request->query('type'),['customer','vendor'])) {
			$user=User::where('id',$request->id)->first();
			if ($user) {
				$options=$user->getAssociation();
				return response()->json([
					"status"=>true,
					"options"=>view('backend.components.options',compact('options'))->render()
				],200);
			}
			
		}

		return response()->json([
			"status"=>false,
		],400);
		
  	}

	public function updatePassword(Request $request)
	{
		if (request()->isMethod('get')) {
			return view('backend.profile');
			
		} elseif (request()->isMethod('post')) {
			$validator = Validator::make($request->all(),
	            [
	            	'old_pass' => 'required',
	            	'password' => 'required|max:30|confirmed',
	        	]
	        );

	        if ($validator->fails()) {
	            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
	        }

	        $user = User::find(auth()->user()->id);
	        if(!Hash::check($request->old_pass, $user->password)){

	        	return redirect()->back()
	             		->with(['password_error' => "Old Password doesn't matched."]);

	        }
			
			$user->password =  Hash::make($request->password);
			$user->save();

			return redirect()->back()->with('status','Password Updated Successfully.');
		}
	}

  	public function profile() 
  	{
	      return view('backend.profile.index');
  	}

  	public function publications() 
  	{
	      return view('backend.publications.index');
  	}

	public function search() 
	{
	return view('backend.search');
	}

}
