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



// Info:--------------- Only Authenticated and Approved Users ------------------------------#
Route::prefix('dashboard')->middleware(['auth','IsApproved'])->group(function(){
    Route::get('profile',[UserController::class, 'showProfile'])->name('user.profile.index');
    Route::put('profile/update/{id}',[UserController::class,'updateUser'])->name('user.update');
    Route::delete('profile/delete/{id}',[UserController::class,'destroy'])->name('user.destroy');

    // ?? ======================== Info: Parent Routes =========================== #
    // ! Only for parents ----->
    Route::prefix('parent')->middleware('can:parent-view')->controller(ParentController::class)->group(function () {
        Route::get('appointments', 'showAppointments')->name('parent.appointments');
        Route::post('appointment/store', 'storeAppointments')->name('parent.appointment.store');
        Route::get('requests', 'requests')->name('parent.requests');
    });// !<---- Only for parents

    // ! Children Controller ( for both parent and admin )
    Route::resource('/child',ChildrenController::class); 

    // ! Schedules for all Users (Appointments, Schedules, Upcoming Vaccinations)
    Route::controller(VaccinationScheduleController::class)->group(function () {

        Route::get('vaccinations','index')->name('vaccination.index');
        Route::get('bookings', 'bookings')->name('bookings.index');

    });

    Route::prefix('admin')->group(function(){
        
        // ???? Vaccination Schedule Controller for admin and hospitals
        Route::middleware('can:admin-or-hospital')->group(function () {
            Route::post('vaccinations/update/{id}', [VaccinationScheduleController::class, 'updateStatus'])->name('vaccination.updateStatus');
        });
        
        // hack:<----------- Routes for admin only
        Route::middleware('can:admin-view')->group(function(){

            // ????<-------------- Children Controller for Appointment Requests (admin)
            Route::controller(ChildrenController::class)->group(function(){
                Route::get('vaccine-requests', 'pending')->name('child.pending.requests');
                Route::post('vaccine-requests/approve/{id}', 'approve')->name('child.approve.requests');
                Route::post('vaccine-requests/reject/{id}', 'reject')->name('child.reject.requests');
            });

            // ????<-------------- Hospital Resource Controller
            Route::resource('hospital',HospitalController::class);

            // ????<-------------- Vaccine Controller
            Route::controller(VaccineController::class)->group(function(){
                Route::get('vaccines', 'index')->name('vaccine.index');
                Route::post('vaccines/{id}/update', 'update')->name('vaccine.update');
            });

            // ????<-------------- User Approval Controller
            Route::controller(UserApprovalController::class)->group(function(){
                Route::prefix('user-approvals')->group(function(){
                    Route::get('/', 'index')->name('user.approval.index');
                    Route::patch('/{user}/approve', 'approve')->name('user.approval.approve');
                    Route::delete('/{user}/reject', 'reject')->name('user.approval.reject');
                });
            });
        });
    });
});


// !================================ Website Controllers =================================

Route::get('/',[FrontController::class, 'index'])->name('web.index');
Route::post('/appointment',[FrontController::class, 'store'])->name('web.store');