<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $profilePhoto = 'profiles/' . $this->faker->image('public/storage/profiles', 640, 480, null, false);
        return [
            'last_name' => $this->faker->lastName,
            'about' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'skills' => $this->faker->paragraph(3, true),
            'linkedin' => $this->faker->url(),
            'github' => $this->faker->url(),
            'phone' => $this->faker->phoneNumber(),
            'views' => $this->faker->numberBetween(0, 500),
            'profile_photo' => $profilePhoto,
            'category' => $this->faker->randomElement(Profile::$categories),
            'location' => $this->faker->randomElement(Profile::$locations),
        ];
    }
}
