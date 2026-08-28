<?php

use CollegeAdmin\Http\Controllers\Admin\AQARController;
use CollegeAdmin\Http\Controllers\Admin\AQARCriteriaController;
use CollegeAdmin\Http\Controllers\Admin\AQARSessionController;
use CollegeAdmin\Http\Controllers\Admin\BannerController;
use CollegeAdmin\Http\Controllers\Admin\DashboardController;
use CollegeAdmin\Http\Controllers\Admin\DepartmentController;
use CollegeAdmin\Http\Controllers\Admin\EventController;
use CollegeAdmin\Http\Controllers\Admin\EventGalleryController;
use CollegeAdmin\Http\Controllers\Admin\FacultyController;
use CollegeAdmin\Http\Controllers\Admin\NonFacultyController;
use CollegeAdmin\Http\Controllers\Admin\NoticeController;
use CollegeAdmin\Http\Controllers\Admin\PermissionController;
use CollegeAdmin\Http\Controllers\Admin\ProfileController;
use CollegeAdmin\Http\Controllers\Admin\RoleController;
use CollegeAdmin\Http\Controllers\Admin\SubjectDepartmentController;
use CollegeAdmin\Http\Controllers\Admin\UserController;
use CollegeAdmin\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('login', [LoginController::class, 'index'])->name('admin.login.form');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

// Language Switcher Route
Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'hi'])) {
        abort(400);
    }
    session()->put('locale', $locale);
    return back();
})->name('admin.language.switch');

// Protected Admin Routes
Route::name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('index');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('event', EventController::class);

    Route::get('event-gallery/{event}', [EventGalleryController::class, 'index'])->name('event.gallery');
    Route::post('event-gallery/store', [EventGalleryController::class, 'store'])->name('event.gallery.store');
    Route::delete('event-gallery/{gallery}', [EventGalleryController::class, 'destroy'])->name('event.gallery.destroy');

    Route::resource('permissions', PermissionController::class);
    Route::resource('notice', NoticeController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('subject-department', SubjectDepartmentController::class);
    Route::resource('faculty', FacultyController::class);
    Route::resource('non-faculty', NonFacultyController::class);
    Route::resource('aqar-session', AQARSessionController::class);
    Route::resource('aqar', AQARController::class);
    Route::resource('aqar-criteria', AQARCriteriaController::class);

    Route::resource('profile', ProfileController::class)->only(['index']);
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('role-has-permission/{role?}', [PermissionController::class, 'roleHasPermission'])->name('roles.permission');
    Route::post('role-has-permission-update/{id}', [PermissionController::class, 'rolePermissionUpdate'])->name('roles.permission.update');
});
