<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
        return [
            'user_id'      => '@' . fake()->unique()->text(10),
            'name'         => fake()->name(),
            'email'        => fake()->unique()->safeEmail(),
            'introduction' => fake()->realText(160),
            'location'     => fake()->city(),
            'birthday'     => fake()->date('Y-m-d'),
            'password'     => static::$password ??= Hash::make('password'),
        ];
    }
}
