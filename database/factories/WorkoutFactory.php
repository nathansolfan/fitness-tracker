<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workout>
 */
class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $exercises = ['Bench Press', 'Squat', 'Deadlift', 'Bicep Curl', 'Push Up'];

        return [
            'exercise' => $this->faker->randomElement($exercises),
            'sets' => $this->faker->numberBetween(1,5),
            'reps' => $this->faker->numberBetween(5,15),
            'weight' => $this->faker->numberBetween(10,150),
            'category' => $this->faker->randomElement(['strength', 'cardio']),
        ];
    }
}
