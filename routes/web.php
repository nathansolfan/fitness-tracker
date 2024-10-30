<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index');
Route::resource('workouts', WorkoutController::class);


// ANALYTICS Route
Route::get('/workouts/analytics', [WorkoutController::class, 'analytics'])->name('workouts.analytics');
