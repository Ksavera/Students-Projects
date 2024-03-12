<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create(); // Create a user for each student

        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'about' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'skills' => $this->faker->paragraph(3, true),
            'linkedin' => $this->faker->url(),
            'github' => $this->faker->url(),
            'phone' => $this->faker->phoneNumber(),
            'views' => $this->faker->numberBetween(0, 500),
            'category' => $this->faker->randomElement(Student::$categories),
            'location' => $this->faker->randomElement(Student::$locations),
            'user_id' => $user->id, // Associate the student with the user
        ];
    }
}
