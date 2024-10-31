<?php

namespace Database\Seeders;

use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Define the Workout Seeder - will be updated to a duration to better display it
        // Workout::factory()->count(20)->create();

        $exercises = ['Bench Press', 'Squat', 'Deadlift', 'Bicep Curl', 'Push Up'];
        $categories = ['strength', 'cardio'];

        // Seed data for the last 30 days
        foreach ($exercises as $exercise) {
            $date = Carbon::now()->subDays(30); // Start 30days ago

            for ($i=0; $i < 30; $i++) {
                Workout::create([
                    'exercise' => $exercise,
                    'sets' => rand(3,5),
                    'reps' => rand(8, 15),
                    'weight' => rand(20, 100), // Adjust the weight range as desired
                    'category' => 'strength', // Assume all exercises are strength-based for simplicity
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                // Move to the next day
                $date->addDay();
            }
        }
    }
}
