<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produk_data = array();

        for($i = 0; $i <= 10; $i++) {
            $produk_data[] = [
                'uuid' => Str::uuid(),
                'nama' => fake()->name(),
                'brand' => fake()->randomElement(['nike', 'adidas', 'diadora', 'puma']),
                'harga' => fake()->numberBetween(10000, 150000),
                'slug' => fake()->slug(),
                'tgl_dibuat' => now(),
                'tgl_rilis' => now(),
            ];
        }

        return $produk_data;
    }
}
