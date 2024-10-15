<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Todo::class;

    public function definition(): array
    {
        return [
            //
            'task_title' => $this->faker->sentence(),  // Generates a random sentence for task title
            'description' => $this->faker->paragraph(),  // Generates a random paragraph for description
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),  // Randomly selects one of the priority values
            'status' => $this->faker->randomElement(['pending', 'in progress', 'completed']),  // Randomly selects one of the status values
            'deadline' => $this->faker->date(),  // Generates a random date, nullable (optional)

        ];
    }
}
