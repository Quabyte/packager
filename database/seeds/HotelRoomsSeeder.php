<?php

use Illuminate\Database\Seeder;

class HotelRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotel_rooms')->insert([
            'id' => 1,
            'hotel_id' => 1,
            'name' => 'Single Room',
            'price' => 90,
            'type' => 1,
            'availability' => 10,
            'created_at' => \Carbon\Carbon::now('Europe/Istanbul'),
            'updated_at' => \Carbon\Carbon::now('Europe/Istanbul')
        ]);

        DB::table('hotel_rooms')->insert([
            'id' => 2,
            'hotel_id' => 1,
            'name' => 'Double Room',
            'price' => 100,
            'type' => 2,
            'availability' => 10,
            'created_at' => \Carbon\Carbon::now('Europe/Istanbul'),
            'updated_at' => \Carbon\Carbon::now('Europe/Istanbul')
        ]);

        DB::table('hotel_rooms')->insert([
            'id' => 3,
            'hotel_id' => 2,
            'name' => 'Single Room',
            'price' => 80,
            'type' => 1,
            'availability' => 10,
            'created_at' => \Carbon\Carbon::now('Europe/Istanbul'),
            'updated_at' => \Carbon\Carbon::now('Europe/Istanbul')
        ]);

        DB::table('hotel_rooms')->insert([
            'id' => 4,
            'hotel_id' => 2,
            'name' => 'Double Room',
            'price' => 90,
            'type' => 2,
            'availability' => 10,
            'created_at' => \Carbon\Carbon::now('Europe/Istanbul'),
            'updated_at' => \Carbon\Carbon::now('Europe/Istanbul')
        ]);

        DB::table('hotel_rooms')->insert([
            'id' => 5,
            'hotel_id' => 3,
            'name' => 'Single Room',
            'price' => 120,
            'type' => 1,
            'availability' => 10,
            'created_at' => \Carbon\Carbon::now('Europe/Istanbul'),
            'updated_at' => \Carbon\Carbon::now('Europe/Istanbul')
        ]);

        DB::table('hotel_rooms')->insert([
            'id' => 6,
            'hotel_id' => 3,
            'name' => 'Double Room',
            'price' => 120,
            'type' => 2,
            'availability' => 10,
            'created_at' => \Carbon\Carbon::now('Europe/Istanbul'),
            'updated_at' => \Carbon\Carbon::now('Europe/Istanbul')
        ]);
    }
}
