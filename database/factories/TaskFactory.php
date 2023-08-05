<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'is_completed' => false,
            'start_at' => now(),
            'expired_at' => null
        ];
    }

    public function finalizada(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_completed' => true,
        ]);
    }

    public function conExpiracion(int $days = 2): static
    {
        return $this->state(fn (array $attributes) => [
            'expired_at' => $this->faker->randomElement([null, Carbon::parse($attributes['start_at'])->addDay($days)]),
        ]);
    }
}
