<?php

namespace App\Livewire;

use App\Models\Workout;
use Livewire\Component;

class ProgressChart extends Component
{

    public $exercise;
    public $dates = [];
    public $weights = [];

    public function mount($exercise)
    {
        $this->exercise = $exercise;

        // Fetch workout data for the specified exercise, ordered by date
        $workouts = Workout::where('exercise', $exercise)->orderBy('created_at')->get();

        // Extract dates and weights for the chart
        $this->dates = $workouts->pluck('created_at')->map(fn($date) => $date->format('Y-m-d'))->toArray();
        $this->weights = $workouts->pluck('weight')->toArray();
    }


    public function render()
    {
        return view('livewire.progress-chart');
    }
}
