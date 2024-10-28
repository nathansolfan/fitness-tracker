<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index');
Route::resource('workouts', WorkoutController::class);
