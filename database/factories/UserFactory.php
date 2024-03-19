<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate and store a fake image for the profile photo
        $profilePhoto = 'profiles/' . $this->faker->image('public/storage/profiles', 640, 480, null, false);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'last_name' => $this->faker->lastName,
            'about' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'skills' => $this->faker->paragraph(3, true),
            'linkedin' => $this->faker->url(),
            'github' => $this->faker->url(),
            'phone' => $this->faker->phoneNumber(),
            'views' => $this->faker->numberBetween(0, 500),
            'profile_photo' => $profilePhoto,
            'category' => $this->faker->randomElement(User::$categories),
            'location' => $this->faker->randomElement(User::$locations),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
