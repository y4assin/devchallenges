<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PredefinedProduct;

class PredefinedProductSeeder extends Seeder
{
    public function run()
    {
        PredefinedProduct::create(['name' => 'Llet', 'icon' => '🥛']);
        PredefinedProduct::create(['name' => 'Pa', 'icon' => '🍞']);
        PredefinedProduct::create(['name' => 'Tomàquets', 'icon' => '🍅']);
    }
}

