<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\Site;
use App\Models\Stats;
use App\Models\JoinUs;
use App\Models\JobPost;
use App\Models\SiteHaveJob;
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
		$ids = explode('-',$id);

		$job_id = null;
		$referrer = null;
		
		if (count($ids) == 1) {
			$job_id = $ids[0];
			$referrer = request()->headers->get('referer');
			$site = Site::where('site_url','LIKE','%'.$referrer.'%')->first();
		}else{
			$job_id = $ids[1];
			$site = Site::where('id',$ids[0])->first();

			if ($site) {
				$referrer = $site->site_url;
			}
			
		}

		$job = JobPost::where('id',$job_id)->first();

		if ($job && $referrer && $referrer !='') {
			$stats = new Stats;
			$stats->job_id = $job->id;
			$stats->type = 'click';
			
			$stats->source = $referrer ? str_replace('www.','',parse_url($referrer)['host']) : $referrer;
			$stats->save();

			if (isset($site) && $site) {
				$job->total_applied = $job->total_applied+1;
				$job->save();

				$site_have_job=SiteHaveJob::where('sites_id',$site->id)->where('jobs_id',$job->id)->first();
				if($site_have_job){
					SiteHaveJob::where('sites_id',$site->id)->where('jobs_id',$job->id)->update(['applied'=>$site_have_job->applied+1]);
				}
			}
			return redirect()->to($job->apply_link);
		} else {
			return 'Link not found';
		}
	}
}
