<?php

use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});
Route::get('admin', [UserController::class, 'showLogin'])->name('login')->middleware('IsAuthenticated');
Route::post('admin/login',[UserController::class, 'login'])->name('admin.login');
Route::get('admin/logout',[UserController::class, 'logout'])->name('auth.logout');
Route::get('admin/dashboard',[UserController::class, 'dashboard'])->name('show.dashboard')->middleware(['auth','IsUserValid']);


Route::get('admin/register', function () {return view('dashboard.auth.register');})->name('register.show');
Route::post('admin/register',[UserController::class, 'store'])->name('user.register');


// ! Children Controller

Route::get('admin/children',[ChildrenController::class, 'index'])->name('child.index');
Route::get('admin/edit/{id}',[ChildrenController::class, 'edit'])->name('child.edit');
Route::put('admin/update/{id}',[ChildrenController::class, 'update'])->name('child.update');

