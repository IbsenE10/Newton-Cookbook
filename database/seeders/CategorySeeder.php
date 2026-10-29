<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // firstOrCreate: maakt de categorie alleen aan als hij nog niet bestaat,
        // dus je kunt deze seeder vaker draaien zonder dubbele rijen
        foreach (['Appetizer', 'Main dish', 'Dessert'] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
