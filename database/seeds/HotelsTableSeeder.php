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
            'unique_identifier' => rand(0, 5),
            'name' => 'Swissotel The Bosphorus Istanbul',
            'media_path' => 'swiss',
            'stars' => 5,
            'review_point' => 9,
            'review_count' => 2914,
            'location' => 'Macka/Besiktas',
            'description' => 'Lorem ipsum dolor'
        ]);

        DB::table('hotels')->insert([
            'id' => 2,
            'unique_identifier' => 'kajnjkfga',
            'name' => 'Divan Hotel Istanbul',
            'media_path' => 'divan',
            'stars' => 4,
            'review_point' => 8,
            'review_count' => 1436,
            'location' => 'Mecidiyekoy/Sisli',
            'description' => 'Lorem ipsum dolor'
        ]);
    }
}
