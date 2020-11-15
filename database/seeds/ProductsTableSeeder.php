<?php

use App\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 20 ; $i++) { 
            
            Product::create([
                "title" => $faker->sentence(2),
                "slug" => $faker->slug,
                "description" => $faker->text,
                "price" => $faker->numberBetween(100,1000) * 100,
                "image" => 'https://via.placeholder.com/200x250'
            ])->categories()->attach([
                rand(1,3)
            ]);
        }
    }
}
