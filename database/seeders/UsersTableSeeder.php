<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        \DB::table('users')->insert(array(
            [
                'name' => 'Andrew',
                'email' => 'andrew@lamart.com',
                'password' => \Hash::make('andrew'),
                'foto' => 'user.png',
                'level' => 1
            ],
            [
                'name' => 'Aprianto',
                'email' => 'aprianto@lamart.com',
                'password' => \Hash::make('aprianto'),
                'foto' => 'user.png',
                'level' => 2
            ]
            ));
    }
}
