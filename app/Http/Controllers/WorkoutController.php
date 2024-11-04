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
        $workout = Workout::findOrFail($id);
        return view('workouts.show', compact('workout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $workout = Workout::findOrFail($id);
        return view('workouts.edit', compact('workout'));
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



    // ANALYTICS Controller
    public function analytics()
    {
        $workouts = Workout::all();

        // Calculate total weight by category
        $totalWeightByCategory = $workouts->groupBy('category')->map(function ($group) {
            return $group->sum('weight');
        })->toArray();

        // Count exercises by category for the pie chart
        $countByCategory = $workouts->groupBy('category')->map(function ($group) {
            return $group->count();
        })->toArray();

        // Calculate total weight lifted over time (grouped by date)
        $totalWeightOverTime = $workouts->groupBy(function ($workout) {
            return $workout->created_at->format('Y-m-d'); // Group by date (e.g., 2023-08-21)
            })->map(function ($group) {
                return $group->sum('weight');
            })->toArray();

            return view('workouts.analytics', compact('totalWeightByCategory', 'countByCategory', 'totalWeightOverTime'));
        }



    public function progress($exercise)
    {
        // Get all workouts of the specified exercise and order by date
        $workouts = Workout::where('exercise', $exercise)->orderBy('created_at', 'asc')->get();

        // Extract data for the chart (dates and weights)
        $dates = $workouts->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        })->toArray();

        $weights = $workouts->pluck('weight')->toArray();

        // Return the view with data for the chart
        return view('workouts.progress', compact('exercise', 'dates', 'weights'));
    }


    public function getAnalyticsData()
    {
        $workouts = Workout::all();

        // group workots by exercise
        $workoutGrouped = $workouts->groupBy('exercise');

        // weekly and montly ananyltics data
        $weeklyData = [];
        $montly = [];
    }

}
