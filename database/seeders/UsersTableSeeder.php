<?php

namespace Database\Seeders;

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
        \App\Models\User::insert([
            [
                'name'    => "admin",
                'email'    => "admin@gmail.com",
                'password'    => bcrypt('12345678')
            ],
            [
                'name'    => "kejur",
                'email'    => "kejur@gmail.com",
                'password'    => bcrypt('12345678')
            ],
        ]);
    }
}
