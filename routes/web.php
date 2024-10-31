<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index');


// ANALYTICS Route
Route::get('/workouts/analytics', [WorkoutController::class, 'analytics'])->name('workouts.analytics');

// Route::get('/workouts/analytics', function () {
//     dd('Route is working');
// });

Route::get('/workouts/progress/{exercise}', [WorkoutController::class,'progress'])->name('workouts.progress');


Route::resource('workouts', WorkoutController::class);
