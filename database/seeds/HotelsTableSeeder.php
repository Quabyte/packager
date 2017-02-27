<?php

use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
            'id' => 1,
            'unique_identifier' => str_random(6),
            'name' => 'The Marmara Taksim',
            'media_path' => 'marmara-taksim',
            'stars' => 5,
            'review_point' => 8.4,
            'review_count' => 2278,
            'location' => 'Taksim/Beyoglu',
            'description' => 'Lorem ipsum dolor'
        ]);

        DB::table('hotels')->insert([
            'id' => 2,
            'unique_identifier' => str_random(6),
            'name' => 'The Marmara Pera',
            'media_path' => 'marmara-pera',
            'stars' => 4,
            'review_point' => 8.1,
            'review_count' => 2345,
            'location' => 'Tepebasi/Beyoglu',
            'description' => 'Lorem ipsum dolor'
        ]);

        DB::table('hotels')->insert([
            'id' => 3,
            'unique_identifier' => str_random(6),
            'name' => 'InterContinental Istanbul',
            'media_path' => 'intercontinental',
            'stars' => 5,
            'review_point' => 8.7,
            'review_count' => 2634,
            'location' => 'Taksim/Beyoglu',
            'description' => 'Lorem ipsum dolor'
        ]);
    }
}
