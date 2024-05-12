<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('sites', SiteController::class);

    Route::resource('profiles', ProfileController::class);
    Route::post ('/profiles/personal-data',[ProfileController::class, 'updatePersonalData'])->name('personal-data');
    Route::post ('/users/personal-data/{id}',[UserController::class, 'updatePersonalData'])->name('personal-data-user');
    Route::post ('/users/site-zone/{id}',[UserController::class, 'updateSiteZone'])->name('site-zone-user');
});
