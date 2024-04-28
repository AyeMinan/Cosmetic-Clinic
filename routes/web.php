<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacationController;
use App\Http\Middleware\MustbeAuthUser;
use App\Http\Middleware\MustbeGuestUser;
use App\Models\AddTime;
use App\Models\Day;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::middleware([MustbeGuestUser::class])->group(function () {
    Route::resource('login', LoginController::class)->only('index', 'store');
});

Route::middleware([MustbeAuthUser::class])->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy']);

    Route::get('/', function () {return view('welcome');});

    Route::patch('/setHoliday/{id}', [DayController::class, 'update']);
    Route::patch('/cancelHoliday/{id}', [DayController::class, 'cancel']);

    Route::resource('vacation', VacationController::class)->only(['index', 'store', 'destroy', 'show']);

    Route::resource('account', UserController::class);

    Route::resource('time', TimeController::class)->only('index', 'store', 'destroy', 'show', 'update');
});
