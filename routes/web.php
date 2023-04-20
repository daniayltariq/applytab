<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Stats;
use App\Models\JobPost;
use App\Models\Institution;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Admin\{
    UserController,
    DashboardController,
    AdController,
    AdvertiserController,
    SiteController,
    ReportController,
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

Route::get('/clear', function () {
   Artisan::call('cache:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});

Route::get('/link-storage', function () {
    Artisan::call('storage:link');
 
    return "Link created successfully";
});

Route::get('/', function () {
    return redirect('http://www.jobadvertize.com/');
})->name('/');

Route::group([
	'prefix' => 'backend',
    'as' => 'backend.',
	'middleware' => ['auth','role:superadmin|customer'],
],function(){

    // View Permissions
    Route::group([
        'middleware' => ['role:superadmin|customer'],
    ],function(){

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('ads', [AdController::class, 'index'])->name('adsListing');
        Route::get('ad/status', [AdController::class, 'status'])->name('ad.status');
        Route::get('job-board', [SiteController::class, 'index'])->name('site.index');

        Route::get('ad/{id}/renew', [AdController::class, 'renew'])->name('ad.renew');
        Route::post('ad/{id}/renew', [AdController::class, 'renew'])->name('ad.renew');

        Route::get('adstats', [AdController::class, 'adStats'])->name('adstats.index');
        Route::get('adstats/details/{id}', [AdController::class, 'adStatDetail'])->name('adstats.detail');
        Route::get('report/{id}', [AdController::class, 'report'])->name('ad.report');

    });

    // Update Permissions
    Route::group([
        'middleware' => ['role:superadmin'],
    ],function(){

        Route::get('ad/create', [AdController::class, 'create'])->name('adCreate');
        Route::get('ad/edit/{id}', [AdController::class, 'edit'])->name('adEdit');
        Route::post('ad/store', [AdController::class, 'store'])->name('adStore');
        Route::delete('ad/delete/{id}', [AdController::class, 'destroy'])->name('adDelete');
        
        Route::get('advertiser', [AdvertiserController::class, 'index'])->name('advertiser.index');
        Route::get('advertiser/create', [AdvertiserController::class, 'create'])->name('advertiser.create');
        Route::get('advertiser/edit/{id}', [AdvertiserController::class, 'edit'])->name('advertiser.edit');
        Route::post('advertiser/store', [AdvertiserController::class, 'store'])->name('advertiser.store');
        Route::delete('advertiser/delete/{id}', [AdvertiserController::class, 'destroy'])->name('advertiser.delete');
        Route::get('advertiser/{id}/details', [AdvertiserController::class, 'adStatDetail'])->name('advertiser.show');

        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('job_update/{id}', [AdController::class, 'fieldUpdate'])->name('job_update');
        Route::post('job_update/{id}', [AdController::class, 'fieldUpdate'])->name('job_update');

        Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    });


    Route::resource('/notification', "App\Http\Controllers\Admin\NotificationController");
    Route::get('/view_notifications', 'App\Http\Controllers\Admin\NotificationController@view')->name("view_notifications");
    Route::get('/mark_notifications', 'App\Http\Controllers\Admin\NotificationController@markNotifications')->name("mark_notifications");

    Route::get('/{slug}',[App\Http\Controllers\FrontPageController::class, 'backendPages'])->name('backend-pages');
});

require __DIR__.'/auth.php';


