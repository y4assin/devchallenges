<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => 'Bio']);
        Tag::create(['name' => 'Sense gluten']);
        Tag::create(['name' => 'Bonpreu Esclat']);
    }
}

