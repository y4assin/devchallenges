<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create(['name' => 'Llet', 'completed' => false, 'category_id' => 1, 'shopping_list_id' => 1]);
        Product::create(['name' => 'Formatge', 'completed' => false, 'category_id' => 1, 'shopping_list_id' => 1]);
        Product::create(['name' => 'Vedella', 'completed' => true, 'category_id' => 2, 'shopping_list_id' => 1]);
    }
}
