<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dovakhin',
            'surname' => 'Otacıoglu',
            'address' => 'none',
            'postal_code' => '14100',
            'country' => 'Turkey',
            'telephone' => '5315718209',
            'tc_id' => '00000000000',
            'email' => 'orcun.otacioglu@acikgise.com',
            'password' => bcrypt('CPGKhrs7V'),
            'isAdmin' => true
        ]);
    }
}
