<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokProduk>
 */
class StokProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stok_produk_data = array();

        for($i = 1; $i <= 11; $i++) {
            $stok_produk_data[] = [
                'produk_id' => $i,
                'stok' => fake()->numberBetween(10, 100),
            ];
        }

        return $stok_produk_data;
    }
}
