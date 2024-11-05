<?php

namespace App\Livewire;

use Livewire\Component;

class ProgressChart extends Component
{

    public $exercise;
    public $dates = [];
    public $weights = [];

    public function mount($exercise, $dates, $weights)
    {
        $this->exercise = $exercise;
        $this->dates = $dates;
        $this->weights = $weights;
    }


    public function render()
    {
        return view('livewire.progress-chart');
    }
}
