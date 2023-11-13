<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PunchEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('2023-10-01', '2023-10-31');
        $deletedAt = null;
        if (fake()->boolean(20)) {
            $deletedAt = fake()->dateTime();
        }
        return [
            'punch_event_type_id' => fake()->numberBetween(1, 2),
            'employee_id' => fake()->numberBetween(1, 200),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
            'deleted_at' => $deletedAt,
        ];
    }
}
