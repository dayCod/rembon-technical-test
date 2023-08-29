<?php

namespace Database\Seeders;

use App\Models\Produk;
use Database\Factories\ProdukFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::insert((new ProdukFactory())->definition());
    }
}
