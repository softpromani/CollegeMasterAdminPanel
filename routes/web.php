<?php

use App\Http\Controllers\admin\AQARController;
use App\Http\Controllers\admin\AQARCriteriaController;
use App\Http\Controllers\admin\AQARSessionController;
use App\Http\Controllers\admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\EventGalleryController;
use App\Http\Controllers\admin\FacultyController;
use App\Http\Controllers\admin\NonFacultyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SubjectDepartmentController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', [LoginController::class, 'index'])->name('index');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('event', EventController::class);

    Route::get(
        'event-gallery/{event}',
        [EventGalleryController::class, 'index']
    )->name('event.gallery');

    Route::post(
        'event-gallery/store',
        [EventGalleryController::class, 'store']
    )->name('event.gallery.store');

    Route::delete(
        'event-gallery/{gallery}',
        [EventGalleryController::class, 'destroy']
    )->name('event.gallery.destroy');

    Route::resource('permissions', PermissionController::class);
    Route::resource('notice', NoticeController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('subject-department', SubjectDepartmentController::class);
    Route::resource('faculty', FacultyController::class);
    Route::resource('non-faculty', NonFacultyController::class);
    Route::resource('aqar-session', AQARSessionController::class);
    Route::resource('aqar', AQARController::class);
    Route::resource('aqar-criteria', AQARCriteriaController::class);

    Route::resource('profile', ProfileController::class)
        ->only(['index']);

    Route::put(
        'profile/update',
        [ProfileController::class, 'update']
    )
        ->name('profile.update');

    Route::post(
        'profile/password',
        [ProfileController::class, 'updatePassword']
    )
        ->name('password.update');

    Route::get(
        'role-has-permission/{role?}',
        [PermissionController::class, 'roleHasPermission']
    )->name('roles.permission');

    Route::post(
        'role-has-permission-update/{id}',
        [PermissionController::class, 'rolePermissionUpdate']
    )->name('roles.permission.update');
});
