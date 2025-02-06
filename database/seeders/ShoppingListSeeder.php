<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingList;

class ShoppingListSeeder extends Seeder
{
    public function run()
    {
        ShoppingList::create(['name' => 'Setmana', 'user_id' => 1]);
        ShoppingList::create(['name' => 'Festa', 'user_id' => 1]);
        ShoppingList::create(['name' => 'Càmping', 'user_id' => 1]);
    }
}

