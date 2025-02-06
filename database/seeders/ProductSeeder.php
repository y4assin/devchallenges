<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $product1 = Product::create(['name' => 'Llet', 'completed' => false, 'category_id' => 1, 'shopping_list_id' => 1]);
        $product2 = Product::create(['name' => 'Formatge', 'completed' => false, 'category_id' => 1, 'shopping_list_id' => 1]);
        $product3 = Product::create(['name' => 'Vedella', 'completed' => true, 'category_id' => 2, 'shopping_list_id' => 1]);

        // Asignar tags a productos
        $product1->tags()->attach([1, 2]); // Bio, Sense gluten
        $product2->tags()->attach([2]);    // Sense gluten
        $product3->tags()->attach([3]);    // Bonpreu Esclat
    }
}