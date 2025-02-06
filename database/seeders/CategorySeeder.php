<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Làctics']);
        Category::create(['name' => 'Carns']);
        Category::create(['name' => 'Begudes']);
    }
}
