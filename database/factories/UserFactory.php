<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_data = array();

        for ($i = 0; $i <= 10; $i++) {
            $user_data[] =  [
                'uuid' => Str::uuid(),
                'nama_depan' => fake()->name(),
                'nama_belakang' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'nomor_hp' => fake()->phoneNumber(),
                'role' => fake()->randomElement(['buyer', 'seller']),
                'tgl_dibuat' => now(),
            ];
        }

        return $user_data;
    }
}
