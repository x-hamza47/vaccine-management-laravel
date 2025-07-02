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


Route::get('admin', [UserController::class, 'showLogin'])->name('login')->middleware('IsAuthenticated');
Route::post('admin/login',[UserController::class, 'login'])->name('admin.login');
Route::get('admin/logout',[UserController::class, 'logout'])->name('auth.logout');
Route::get('dashboard',[UserController::class, 'dashboard'])->name('show.dashboard')->middleware(['auth','IsApproved']);


Route::get('admin/register', function () {return view('dashboard.auth.register');})->name('register.show');
Route::post('admin/register',[UserController::class, 'store'])->name('user.register');


Route::prefix('dashboard')->middleware(['auth','IsApproved'])->group(function(){

    // ! Children Controller ( for both parent and admin )
    Route::resource('/child',ChildrenController::class); 

    // ! Schedules for all Users
    Route::get('vaccinations',[VaccinationScheduleController::class, 'index'])->name('vaccination.index');
    
    Route::prefix('admin')->group(function(){
        
        // hack: Routes for admin only
        Route::middleware('can:admin-view')->group(function(){

            // ???? Children Controller 
            Route::controller(ChildrenController::class)->group(function(){
                Route::get('vaccine-requests', 'pending')->name('child.pending.requests');
                Route::post('vaccine-requests/approve/{id}', 'approve')->name('child.approve.requests');
                Route::post('vaccine-requests/reject/{id}', 'reject')->name('child.reject.requests');
            });

            // ???? Hospital Resource Controller
            Route::resource('hospital',HospitalController::class);

            // ???? Vaccine Controller
            Route::controller(VaccineController::class)->group(function(){
                Route::get('vaccines', 'index')->name('vaccine.index');
                Route::post('vaccines/{id}/update', 'update')->name('vaccine.update');
            });

            // ???? User Approval Controller
            Route::controller(UserApprovalController::class)->group(function(){
                Route::prefix('user-approvals')->group(function(){
                    Route::get('/', 'index')->name('user.approval.index');
                    Route::patch('/{user}/approve', 'approve')->name('user.approval.approve');
                    Route::delete('/{user}/reject', 'reject')->name('user.approval.reject');
                });
            });
        });

        // ???? Vaccination Schedule Controller
        Route::controller(VaccinationScheduleController::class)->group(function(){
            Route::post('vaccinations/update/{id}', 'updateStatus')->name('vaccination.updateStatus');
            Route::get('bookings', 'bookings')->name('bookings.index');
        });
    });
});


// ! Vaccine Controller

// Route::get('admin/vaccines',VaccineController::class)->name('vaccine.index');
// Route::post('admin/vaccines/{id}/update',[VaccineController::class, 'update'])->name('vaccine.update');


// ! Hospital Controller

// Route::get('admin/hospitals',[HospitalController::class, 'index'])->name('hospital.index');
// Route::get('admin/hospitals/create',[HospitalController::class, 'create'])->name('hospital.create');
// Route::post('admin/hospitals/store',[HospitalController::class, 'store'])->name('hospital.store');
// Route::get('admin/hospitals/edit/{id}',[HospitalController::class, 'edit'])->name('hospital.edit')->whereNumber('id');
// Route::get('admin/hospitals/delete/{id}',[HospitalController::class, 'destroy'])->name('hospital.delete')->whereNumber('id');

// ! User Approval Controller

// Route::get('admin/user-approvals',[UserApprovalController::class, 'index'])->name('user.approval.index');
// Route::patch('admin/user-approvals/{user}/approve',[UserApprovalController::class, 'approve'])->name('user.approval.approve');
// Route::delete('admin/user-approvals/{user}/reject',[UserApprovalController::class, 'reject'])->name('user.approval.reject');



// ?#---------------------  Info:: Hospital Routes ----------------------------#

// Route::get('admin/hospital/appointments',[HospitalController::class, 'appointments'])->name('hospital.appointments');
Route::post('admin/hospital/appointments/update/{id}',[HospitalController::class, 'updateStatus'])->name('hospital.appointments.update');
Route::get('admin/hospital/appointments/history',[HospitalController::class, 'history'])->name('hospital.appointments.history');


// ?? ======================== Info: Parent Routes =========================== #

// Route::get('admin/parent',[ParentController::class, 'index'])->name('parent.child.index');
// Route::get('admin/parent/edit/{id}',[ParentController::class, 'edit'])->name('parent.child.edit');
// Route::get('admin/parent/create',[ParentController::class, 'create'])->name('parent.child.create');
// Route::post('admin/parent/store',[ParentController::class, 'store'])->name('parent.child.store');
// Route::put('admin/parent/update/{id}',[ParentController::class, 'update'])->name('parent.child.update');
// Route::get('admin/parent/schedule',[ParentController::class, 'schedule'])->name('parent.schedule.index');
Route::get('admin/parent/appointments',[ParentController::class, 'showAppointments'])->name('parent.appointments');
Route::post('admin/parent/appointment/store',[ParentController::class, 'storeAppointments'])->name('parent.appointment.store');
Route::get('admin/parent/history',[ParentController::class, 'history'])->name('parent.history');
Route::get('admin/parent/requests',[ParentController::class, 'requests'])->name('parent.requests');

// !================================ Website Controllers =================================

Route::get('/',[FrontController::class, 'index'])->name('web.index');
Route::post('/appointment',[FrontController::class, 'store'])->name('web.store');