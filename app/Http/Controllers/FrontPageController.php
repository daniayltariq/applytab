<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\JoinUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FrontPageController extends Controller
{
	// if view exists return view else return 404
	public function pages($view)
	{
		if (view()->exists('frontend.pages.' . $view)) {
			return view('frontend.pages.' . $view);
		} else {
			abort(404);
		}
	}

	public function backendPages($view)
	{
		if (view()->exists('backend.pages.' . $view)) {
			return view('backend.pages.' . $view);
		} else {
			abort(404);
		}
	}

	public function joinUs(Request $request)
	{
		$validator = validator($request->all(), [
            'company_name' => 'required|string',
            'worker_name'=>'required|unique:join_us,worker_name,company_name'.$request->company_name,
            'city' => 'required|string',
            'phone'=>'required|unique:join_us,phone',
			
        ]);

		if ($validator->fails()) {
			return redirect()->back()
						->withErrors($validator)
						->withInput()
						->with('error','Validation error.')
						->with('join-error','Validation error.');
		}

		$data=JoinUs::create([
			'company_name'=>$request->company_name,
			'worker_name'=>$request->worker_name,
			'city'=>$request->city,
			'phone'=>$request->phone,
		]);

		return redirect()->back()->with('status','Data Saved.');
	}
}
