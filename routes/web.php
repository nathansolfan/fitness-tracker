<?php

use App\Http\Controllers\WorkoutController;
use App\Livewire\ProgressChart;
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



// Livewire Route
Route::get('/workouts/progress/{exercise}', ProgressChart::class)->name('workouts.progress');
