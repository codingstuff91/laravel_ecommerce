<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Vin Blanc',
            'slug' => 'vin-blanc'
        ]);
        
        Category::create([
            'name' => 'Vin Rouge',
            'slug' => 'vin-rouge'
        ]);

        Category::create([
            'name' => 'Vin rosé',
            'slug' => 'vin-rosé'
        ]);


    }
}
