<?php

use Illuminate\Database\Seeder;

class PriceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_categories')->insert([
            'name' => 'CSS Row 1',
            'price' => 4455,
            'online' => false
        ]);

        DB::table('price_categories')->insert([
            'name' => 'CSS Row 2',
            'online' => false
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Gold Suite',
            'price' => 1905,
            'online' => false
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Silver Suite',
            'price' => 1755,
            'online' => false
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Gold Hospitality',
            'color' => 'F2A654',
            'price' => 1508,
            'available' => 8,
            'online' => false,
            'zones' => '103.104.105'
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Price List 2',
            'color' => 'F7DA64',
            'price' => 788,
            'available' => 40,
            'online' => false,
            'zones' => '318'
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Price List 3',
            'color' => '3AA99E',
            'price' => 623,
            'available' => 49,
            'online' => true,
            'zones' => '124'
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Price List 4',
            'color' => '62A8EA',
            'price' => 578,
            'available' => 40,
            'online' => false,
            'zones' => '316'
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Price List 5',
            'color' => '57C7D4',
            'price' => 518,
            'available' => 40,
            'online' => true,
            'zones' => '419'
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Price List 8',
            'color' => '926DDE',
            'price' => 398,
            'available' => 26,
            'online' => true,
            'zones' => '324'
        ]);

        DB::table('price_categories')->insert([
            'name' => 'Price List 10',
            'color' => '677AE4',
            'price' => 338,
            'available' => 10,
            'online' => true,
            'zones' => '412'
        ]);
    }
}
