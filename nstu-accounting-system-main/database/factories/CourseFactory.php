<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $departments = Department::pluck('id')->toArray();
        return [
            'department_id' => fake()->randomElement($departments),
            'code' => fake()->unique()->regexify("[A-Z]{3}[1-4][1-2][0-9]{2}"),
            'title' => fake()->unique()->sentence(4),
            'credit' => fake()->randomElement([3, 4]),
        ];
    }
}
