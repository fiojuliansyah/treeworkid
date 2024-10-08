<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MinuteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeLeaveController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\mobile\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\mobile\MLeaveController;
use App\Http\Controllers\mobile\MMinuteController;
use App\Http\Controllers\mobile\MProfileController;
use App\Http\Controllers\mobile\MReliverController;
use App\Http\Controllers\mobile\MOvertimeController;
use App\Http\Controllers\mobile\MAttendanceController;

Route::get('/career', [DashboardController::class, 'career'])->name('web-career');
Route::get('/career/{id}/detail', [DashboardController::class, 'careerDetail'])->name('web-career-detail');
Route::get('/account/tab-account-detail', [DashboardController::class, 'indexAccount'])->name('web-account');
Route::get('/account/tab-profile-detail', [DashboardController::class, 'indexProfile'])->name('web-profile');
Route::get('/account/tab-document-detail', [DashboardController::class, 'indexDocument'])->name('web-document');

Route::middleware(['guest', 'prevent-back-history'])->group(function () {
    Route::get('/', [DashboardController::class, 'welcome']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('web')->name('logout');

Route::middleware(['auth', 'prevent-back-history'])->prefix('manage')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/recuit', [DashboardController::class, 'recruit'])->name('recruit');
    Route::get('/activities', [DashboardController::class, 'activities'])->name('activities');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('employees', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('statuses', StatusController::class);
    Route::resource('generates', GenerateController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('overtimes', OvertimeController::class);
    Route::resource('minutes', MinuteController::class);
    Route::resource('leaves', LeaveController::class);
    Route::resource('types', TypeLeaveController::class);
    Route::get('/letter/{id}/regenerate', [GenerateController::class, 'regenerate'])->name('letter-regenerate');

    Route::resource('careers', CareerController::class);
    Route::put('/careers/{id}/update-status', [CareerController::class, 'updateStatus'])->name('update-career');
    Route::get('/careers/{id}/banner', [CareerController::class, 'banner'])->name('banner-career');

    Route::resource('letters', LetterController::class);

    Route::resource('applicants', ApplicantController::class);
    Route::put('/applicants/{id}/update-status', [ApplicantController::class, 'updateStatus'])->name('update-status');
    Route::put('/applicants/{id}/update-approve', [ApplicantController::class, 'updateApprove'])->name('update-approve');

    Route::get('/profile/tab-account-detail', [ProfileController::class, 'indexAccount'])->name('index-account');
    Route::get('/profile/tab-profile-detail', [ProfileController::class, 'indexProfile'])->name('index-profile');
    Route::get('/profile/tab-document-detail', [ProfileController::class, 'indexDocument'])->name('index-document');
    Route::put('/profile/tab-account-detail', [ProfileController::class, 'updateAccount'])->name('update-account');
    Route::post('/profile/tab-profile-detail',[ProfileController::class, 'updateProfile'])->name('update-profile');
    Route::post('/profile/tab-document-detail',[ProfileController::class, 'storeDocument'])->name('store-document');
    
    Route::post('/users/personal-data/{id}',[UserController::class, 'updatePersonalData'])->name('personal-data-user');
    Route::post('/users/site-zone/{id}',[UserController::class, 'updateSiteZone'])->name('site-zone-user');
    Route::post('/users/import',[UserController::class,'import'])->name('import-user');
    Route::get('/profile/{id}/tab-resume-detail', [UserController::class, 'indexResume'])->name('user-resume');
    Route::get('/profile/{id}/tab-account-detail', [UserController::class, 'indexAccount'])->name('user-account');
    Route::get('/profile/{id}/tab-profile-detail', [UserController::class, 'indexProfile'])->name('user-profile');
    Route::get('/profile/{id}/tab-document-detail', [UserController::class, 'indexDocument'])->name('user-document');
    Route::get('/profile/{id}/tab-activities', [UserController::class, 'indexActivities'])->name('user-activities');
    Route::get('/profile/{id}/tab-mutations', [UserController::class, 'indexMutations'])->name('user-mutations');
    Route::put('/profile/{id}/tab-account-detail', [UserController::class, 'updateAccount'])->name('user-update-account');
    Route::post('/profile/{id}/tab-profile-detail',[UserController::class, 'updateProfile'])->name('user-update-profile');
    Route::post('/profile/{id}/tab-document-detail',[UserController::class, 'storeDocument'])->name('user-store-document');

    Route::get('/report/attendance', [ReportController::class, 'attendanceReport'])->name('attendance.report');
    Route::get('/employee/view', [ReportController::class, 'employeeView'])->name('employee.view');
    Route::get('/site/export', [ReportController::class, 'siteExport'])->name('site.export');
    Route::get('/site/view', [ReportController::class, 'siteView'])->name('site.view');
});

Route::middleware('auth')->prefix('mobile')->group(function () {
    Route::get('/employee/export', [ReportController::class, 'employeeExport'])->name('employee.export');
    Route::get('/export/excel', [ReportController::class, 'exportToExcel'])->name('export.excel');
});

Route::get('/get-started', [HomeController::class, 'getStarted'])->name('mobile.walkthrough');

Route::middleware(['auth', 'prevent-back-history'])->prefix('mobile')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('mobile.home');
    Route::get('/setting', [HomeController::class, 'setting'])->name('mobile.setting');

    Route::get('/account', [MProfileController::class, 'account'])->name('mobile.account');
    Route::post('/account/update', [MProfileController::class, 'updateAccount'])->name('mobile.update.account');

    Route::get('/profile', [MProfileController::class, 'profile'])->name('mobile.profile');
    Route::post('/profile/update', [MProfileController::class, 'updateProfile'])->name('mobile.update.profile');

    Route::get('/bank', [MProfileController::class, 'bank'])->name('mobile.bank');
    Route::post('/bank/update', [MProfileController::class, 'updateBank'])->name('mobile.update.bank');

    Route::get('/esign', [MProfileController::class, 'esign'])->name('mobile.esign');
    Route::post('/esign/update', [MProfileController::class, 'updateEsign'])->name('mobile.update.esign');

    Route::get('/attendance', [MAttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/logs', [MAttendanceController::class, 'logs'])->name('attendance.logs');
    Route::get('/attendance/clockin', [MAttendanceController::class, 'clockin'])->name('attendance.clockin');
    Route::post('/attendance/clockin', [MAttendanceController::class, 'clockinStore'])->name('clockin.store');
    Route::get('/attendance/clockout', [MAttendanceController::class, 'clockout'])->name('attendance.clockout');
    Route::post('/attendance/clockout', [MAttendanceController::class, 'clockoutStore'])->name('clockout.store');
    Route::post('/attendance/off', [MAttendanceController::class, 'timeOff'])->name('attendance.off');

    Route::get('/overtime', [MOvertimeController::class, 'index'])->name('overtime.index');
    Route::post('/overtime/clockin', [MOvertimeController::class, 'clockinStore'])->name('overtime.clockin');
    Route::post('/overtime/clockout', [MOvertimeController::class, 'clockoutStore'])->name('overtime.clockout');

    Route::get('/minute', [MMinuteController::class, 'index'])->name('minute.index');
    Route::get('/minute/create', [MMinuteController::class, 'create'])->name('minute.create');
    Route::post('/minute/store', [MMinuteController::class, 'minute'])->name('minute.store');
    Route::get('/minute/{id}/show', [MMinuteController::class, 'show'])->name('minute.show');

    Route::get('/leave', [MLeaveController::class, 'index'])->name('leave.index');
    Route::get('/leave/create/{slug}', [MLeaveController::class, 'createLeave'])->name('leave.create.main');
    Route::get('/leave/create', [MLeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave/store', [MLeaveController::class, 'store'])->name('leave.store');
    Route::get('/leave/{id}/show', [MLeaveController::class, 'show'])->name('leave.show');

    Route::get('/reliver', [MReliverController::class, 'index'])->name('reliver.index');
    Route::post('/reliver/update-site', [MReliverController::class, 'updateSite'])->name('reliver.updateSite');
    Route::post('/reliver/clockin/site', [MReliverController::class, 'clockin'])->name('reliver.clockin');
    Route::post('/reliver/clockin', [MReliverController::class, 'clockinStore'])->name('reliver.clockin.store');
    Route::get('/reliver/clockout', [MReliverController::class, 'clockout'])->name('reliver.clockout');
    Route::post('/reliver/clockout', [MReliverController::class, 'clockoutStore'])->name('reliver.clockout.store');
});
