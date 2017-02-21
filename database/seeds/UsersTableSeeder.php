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
            'email' => 'orcun.otacioglu@acikgise.com',
            'password' => bcrypt('CPGKhrs7V'),
            'isAdmin' => true
        ]);

        DB::table('users')->insert([
            'name' => 'Oytun',
            'email' => 'oytun.otaci@hotmail.com',
            'password' => bcrypt('password'),
            'isAdmin' => false
        ]);
    }
}
