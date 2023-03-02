<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Stats;
use App\Models\JobPost;
use App\Models\Institution;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Admin\{
    CategoryController,
    CouponController,
    ContactController,
    UserController,
    DashboardController,
    CompanyController,
    ContractController,
    JobController,
    CarController,
    ProposalController,
    OrderController,
    ReportController,
    BlogController,
    InstitutionController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//test notification
// Route::get('test_notification',[App\Http\Controllers\App\DataController::class, 'testNotify']);

Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('lang_change');
Route::get('/', function () {
    return redirect()->route('login');
})->name('/');

Route::get('/job-update', function () {
    $jobs=JobPost::select('id','unique_id')->get();
    foreach($jobs as $job)
    {
        $job->unique_id=hexdec(uniqid());
        $job->save();
    }
    return 123;
});

Route::get('/watch/{id}', function (Request $request,$id) {
    // Create an image, 1x1 pixel in size
  $im=imagecreate(1,1);

  // Set the background colour
  $white=imagecolorallocate($im,255,255,255);

  // Allocate the background colour
  imagesetpixel($im,1,1,$white);

  // Set the image type
  header("content-type:image/jpg");

  // Create a JPEG file from the image
  imagejpeg($im);

  // Free memory associated with the image
  imagedestroy($im);
  if ($id) {
    // createLog('PAGE_VIEW',[
    //     'job_id'       => $_GET['jID'],
    //     'ip'        => $_SERVER['REMOTE_ADDR'],
    //     'date'      => date('Y-m-d H:i:s'),
    //     'referer'   => $_SERVER['HTTP_REFERER'],
    //     'useragent' => $_SERVER['HTTP_USER_AGENT']/* ,
    //     'browser'   => get_browser(null, true) */
    // ]);

    $job=JobPost::where('unique_id', $id)->first();
    if ($job) {
        $stats=new Stats;
        $stats->job_id=$job->id;
        $stats->type='view';
        $stats->source=$_SERVER['HTTP_REFERER'];
        $stats->object=json_encode([
            'job_id'       => $job->id,
            'ip'        => $_SERVER['REMOTE_ADDR'],
            'date'      => date('Y-m-d H:i:s'),
            'referer'   => $_SERVER['HTTP_REFERER'],
            'useragent' => $_SERVER['HTTP_USER_AGENT']
        ]);
        $stats->save();
    }
    
  }
  
})->name('pixel.watch');

Route::group([
	'prefix' => 'backend',
    'as' => 'backend.',
	'middleware' => ['auth','role:superadmin|customer'],
],function(){

    Route::get('/password/update',[DashboardController::class, 'updatePassword'])->name('password.update');
    Route::post('/password/update',[DashboardController::class, 'updatePassword'])->name('password.update');

    // Add Permissions
    Route::group([
        'middleware' => ['role_or_permission:superadmin|Add Data'],
    ],function(){
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('contract/create', [ContractController::class, 'create'])->name('contract.create');

        Route::post('category', [CategoryController::class, 'store'])->name('category.store');
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::post('contract', [ContractController::class, 'store'])->name('contract.store');
        Route::get('contract_print', [ContractController::class, 'print'])->name('contract.print');
    });
    
    // View Permissions
    Route::group([
        'middleware' => ['role:superadmin|customer'],
    ],function(){
        
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');
    
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
        
        Route::get('job', [JobController::class, 'index'])->name('job.index');
        Route::get('institution', [InstitutionController::class, 'index'])->name('institution.index');
        Route::get('contract/{id}', [JobController::class, 'show'])->name('contract.show');

        Route::get('jobstats', [JobController::class, 'jobStats'])->name('jobstats.index');
        Route::get('jobstats/details/{jobid}', [JobController::class, 'jobStatDetail'])->name('jobstats.detail');
        Route::get('report/{id}', [JobController::class, 'report'])->name('job.report');

    });

    // Update Permissions
    Route::group([
        'middleware' => ['role_or_permission:superadmin|Update Data'],
    ],function(){
        
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('contract/{id}/edit', [ContractController::class, 'edit'])->name('contract.edit');
        Route::get('job_update/{id}', [JobController::class, 'fieldUpdate'])->name('job_update');
        Route::post('job_update/{id}', [JobController::class, 'fieldUpdate'])->name('job_update');
        Route::get('updateStatus/{id}', [ContractController::class, 'updateStatus'])->name('contract.update_status');

        Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::put('contract/{id}', [ContractController::class, 'update'])->name('contract.update');
    });

    // Delete Permissions
    Route::group([
        'middleware' => ['role_or_permission:superadmin|Delete Data'],
    ],function(){
        
        Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::delete('contract/{id}', [ContractController::class, 'destroy'])->name('contract.destroy');
    });
    
    
    Route::resource('/notification', "App\Http\Controllers\Admin\NotificationController");
    Route::get('/view_notifications', 'App\Http\Controllers\Admin\NotificationController@view')->name("view_notifications");
    Route::get('/mark_notifications', 'App\Http\Controllers\Admin\NotificationController@markNotifications')->name("mark_notifications");
    
    Route::get('/{slug}',[App\Http\Controllers\FrontPageController::class, 'backendPages'])->name('backend-pages');
});

require __DIR__.'/auth.php';


Route::get('{id}',[App\Http\Controllers\FrontPageController::class, 'storeStats'])->name('job-post');

Route::get('terms_and_condition', function () {
    return view('frontend.pages.terms_and_condition');
 });
 
 Route::get('privacy_policy', function () {
    return 'not found';
    //  return response()->file(public_path('storage/Privacy_Policy.pdf'));
 })->name('contact-us');
Route::get('/{slug}',[App\Http\Controllers\FrontPageController::class, 'pages'])->name('page');

