<?php

namespace Database\Seeders;

use App\Models\StokProduk;
use Database\Factories\StokProdukFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StokProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StokProduk::insert((new StokProdukFactory())->definition());
    }
}
