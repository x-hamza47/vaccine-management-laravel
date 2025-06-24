<?php

use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccinationScheduleController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\Website\FrontController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard.index');
// });
Route::get('admin', [UserController::class, 'showLogin'])->name('login')->middleware('IsAuthenticated');
Route::post('admin/login',[UserController::class, 'login'])->name('admin.login');
Route::get('admin/logout',[UserController::class, 'logout'])->name('auth.logout');
Route::get('admin/dashboard',[UserController::class, 'dashboard'])->name('show.dashboard')->middleware(['auth','IsApproved']);


Route::get('admin/register', function () {return view('dashboard.auth.register');})->name('register.show');
Route::post('admin/register',[UserController::class, 'store'])->name('user.register');


// ! Children Controller

Route::get('admin/children',[ChildrenController::class, 'index'])->name('child.index')->can('admin-view');
Route::get('admin/edit/{id}',[ChildrenController::class, 'edit'])->name('child.edit')->can('admin-view');
Route::put('admin/update/{id}',[ChildrenController::class, 'update'])->name('child.update')->can('admin-view');
Route::get('admin/delete/{id}',[ChildrenController::class, 'destroy'])->name('child.delete')->can('admin-view');
Route::get('admin/vaccine-requests',[ChildrenController::class, 'pending'])->name('child.pending.requests')->can('admin-view');
Route::post('admin/vaccine-requests/approve/{id}',[ChildrenController::class, 'approve'])->name('child.approve.requests');
Route::post('admin/vaccine-requests/reject/{id}',[ChildrenController::class, 'reject'])->name('child.reject.requests');

// ! Vaccination Schedule Controller

Route::get('admin/vaccinations', [VaccinationScheduleController::class, 'index'])->name('vaccination.index');
Route::post('admin/vaccinations/update/{id}', [VaccinationScheduleController::class, 'updateStatus'])->name('vaccination.updateStatus');
Route::get('admin/bookings', [VaccinationScheduleController::class, 'bookings'])->name('bookings.index');


// ! Vaccine Controller

Route::get('admin/vaccines',VaccineController::class)->name('vaccine.index');
Route::post('admin/vaccines/{id}/update',[VaccineController::class, 'update'])->name('vaccine.update');


// ! Hospital Controller

Route::get('admin/hospitals',[HospitalController::class, 'index'])->name('hospital.index');
Route::get('admin/hospitals/create',[HospitalController::class, 'create'])->name('hospital.create');
Route::post('admin/hospitals/store',[HospitalController::class, 'store'])->name('hospital.store');
Route::get('admin/hospitals/edit/{id}',[HospitalController::class, 'edit'])->name('hospital.edit')->whereNumber('id');
Route::get('admin/hospitals/delete/{id}',[HospitalController::class, 'destroy'])->name('hospital.delete')->whereNumber('id');

// ! User Approval Controller

Route::get('admin/user-approvals',[UserApprovalController::class, 'index'])->name('user.approval.index');
Route::patch('admin/user-approvals/{user}/approve',[UserApprovalController::class, 'approve'])->name('user.approval.approve');
Route::delete('admin/user-approvals/{user}/reject',[UserApprovalController::class, 'reject'])->name('user.approval.reject');



// ?#---------------------  Info:: Hospital Routes ----------------------------#

Route::get('admin/hospital/appointments',[HospitalController::class, 'appointments'])->name('hospital.appointments');
Route::post('admin/hospital/appointments/update/{id}',[HospitalController::class, 'updateStatus'])->name('hospital.appointments.update');
Route::get('admin/hospital/appointments/history',[HospitalController::class, 'history'])->name('hospital.appointments.history');


// ?? ======================== Info: Parent Routes =========================== #
Route::get('admin/parent',[ParentController::class, 'index'])->name('parent.child.index');
Route::get('admin/parent/edit/{id}',[ParentController::class, 'edit'])->name('parent.child.edit');
Route::put('admin/parent/update/{id}',[ParentController::class, 'update'])->name('parent.child.update');
Route::get('admin/parent/schedule',[ParentController::class, 'schedule'])->name('parent.schedule.index');
Route::get('admin/parent/appointments',[ParentController::class, 'showAppointments'])->name('parent.appointments');
Route::get('admin/parent/history',[ParentController::class, 'history'])->name('parent.history');

// !================================ Website Controllers =================================

Route::get('/',[FrontController::class, 'index'])->name('web.index');