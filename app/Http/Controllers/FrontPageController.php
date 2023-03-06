<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\Stats;
use App\Models\JoinUs;
use App\Models\JobPost;
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

	public function storeStats(Request $request,$id)
	{
		$job = JobPost::where('unique_id',$id)->first();
		if ($job) {
			$stats=new Stats;
			$stats->job_id=$job->id;
			$stats->type='click';
			$stats->source=request()->headers->get('referer');
			$stats->save();

			return redirect()->to($job->actual_apply_link);
		} else {
			return 'Link not found';
		}
	}
}
