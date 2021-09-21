<?php
//date_default_timezone_set('Asia/Riyadh');
date_default_timezone_set('Africa/Cairo');

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\LanguagesController;
use \App\Http\Controllers\PublicController;
use \App\Http\Controllers\MediaController;

use \App\Http\Controllers\PermissionGroupsController;
use \App\Http\Controllers\PermissionsController;
use \App\Http\Controllers\RolesController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\LookupController;
use \App\Http\Controllers\PageController;

use \App\Http\Controllers\ServiceController;
use \App\Http\Controllers\TestimonialController;
use \App\Http\Controllers\ClientController;
use \App\Http\Controllers\PartnerController;
use \App\Http\Controllers\QuotationController;
use \App\Http\Controllers\MessageController;
use \App\Http\Controllers\ApplicantController;
use \App\Http\Controllers\TeamController;


// Site Languages
Route::get('language/{language}', [LanguagesController::class, 'setLanguage'])->name('language');

//Route::group(
//    ['middleware' => ['cors']
//    ],function (){
//
//});

// Public pages
//Route::get('/', [PublicController::class, 'index_home'])->name('public.home.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('dash', function () {
    return view('@dashboard/home/index');
});

// Dashboard
Route::group(['prefix'=>'dashboard', 'middleware'=>'auth'], function (){

    Route::get('/', function (){ return redirect(route('dashboard.home.index')); })->name('dashboard.main.index');

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.home.index');

    Route::resource('permission-groups', PermissionGroupsController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);

    Route::resource('lookup', LookupController::class);
    Route::get('export/lookup', [LookupController::class, 'export'])->name('lookup.export');

    Route::resource('page', PageController::class);
    Route::get('export/page', [PageController::class, 'export'])->name('page.export');

    Route::resource('media', MediaController::class);

    // User update data
    Route::get('user/profile', [UsersController::class, 'showUserProfile'])->name('users.showUserProfile');
    // Update password
    Route::put('users/{user}/update_password', [UsersController::class, 'updatePassword'])->name('users.update_password');
    // Reset password
    Route::get('users/{user}/reset_password', [UsersController::class, 'resetPassword'])->name('users.reset_password');

    // Download Backup
    Route::get('backups/index', [DashboardController::class, 'indexBackups'])->name('backup.index');
    Route::get('backup/generate', [DashboardController::class, 'generateBackups'])->name('backup.generate');

//    Route::resource('service', ServiceController::class);
//    Route::get('service/destroy/{service}', [ServiceController::class, 'destroy'])->name('dashboard.service.destroy');
//
//    Route::resource('resource', ResourceController::class);
//    Route::get('resource/destroy/{resource}', [ResourceController::class, 'destroy'])->name('dashboard.resource.destroy');
//
//    Route::resource('client', ClientController::class);
//    Route::get('client/destroy/{client}', [ClientController::class, 'destroy'])->name('dashboard.client.destroy');
//
//    Route::resource('partner', PartnerController::class);
//    Route::get('partner/destroy/{client}', [PartnerController::class, 'destroy'])->name('dashboard.partner.destroy');
//
//    Route::resource('testimonial', TestimonialController::class);
//    Route::get('testimonial/destroy/{testimonial}', [TestimonialController::class, 'destroy'])->name('dashboard.testimonial.destroy');
//
//    Route::resource('team', TeamController::class);
//    Route::get('team/destroy/{team}', [TeamController::class, 'destroy'])->name('dashboard.team.destroy');
//
//    Route::get('contact/edit', [ContactController::class, 'edit'])->name('dashboard.contact.edit');
//    Route::put('contact/update/{contact}', [ContactController::class, 'update'])->name('dashboard.contact.update');
//
//    Route::get('quotation', [QuotationController::class, 'index'])->name('dashboard.quotation.index');
//    Route::get('message', [MessageController::class, 'index'])->name('dashboard.message.index');
//    Route::get('applicant', [ApplicantController::class, 'index'])->name('dashboard.applicant.index');
});

require __DIR__.'/auth.php';

