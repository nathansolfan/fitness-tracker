<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get the Workout Model and put it in a $variable
        $workouts = Workout::all();
        return view('workouts.index', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'exercise' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'weight' => 'nullable|numeric|min:0',
            'category' => 'required|in:strength,cardio',
        ]);

        Workout::create($request->all());
        return redirect()->route('workouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('workouts.show', compact('workouts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('workout.edit', compact('workouts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        $request->validate([
            'exercise' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
            'category' => 'required|in:strength,cardio'
        ]);

        $workout->update($request->all());
        return redirect()->route('workouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index');
    }
}
