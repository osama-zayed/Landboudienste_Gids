<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Models\Permission;

Route::get('/', function () {
    return view('admin.page.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', [Admin\HomeController::class, 'index'])->name('home');
    Route::resource('/departments', Admin\DepartmentController::class);
    Route::resource('/users', Admin\UserController::class);
});