<?php

use App\Http\Controllers\Website\FrontController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('web.index');
Route::post('/appointment', [FrontController::class, 'store'])->name('web.store');
