<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Products::create([
                'name' => $faker->name,
                'supplier_id' => $faker->randomNumber,
                'description' => $faker->sentence,
                'media' => json_encode(['url' => $faker->domainName()]),
                'status' => rand(0, 1) ? 'UNACTIVE' : 'ACTIVE',
            ]);
        }
    }
}
