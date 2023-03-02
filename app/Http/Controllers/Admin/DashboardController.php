<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Stats;
use App\Models\JobPost;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
  	public function index() 
  	{
		$institutions=Institution::count();

		$active_jobs=JobPost::where('status',1)->whereNotNull('unique_id');

		$recent_jobs=(clone $active_jobs)->orderBy('post_date','desc')->limit(10)->get();
		
		$active_jobs=$active_jobs->count();
		// dd($graph->pluck('months')->toArray());
		$clicks=Stats::where('type', 'click')->count();
		$views=Stats::where('type', 'view')->count();
		$data=[
			'clicks'=>$clicks,
			'views'=>$views,
			'institutions'=>$institutions,
			'active_jobs'=>$active_jobs,
		];
		
	    return view('backend.index',compact('data','recent_jobs'));
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
