<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeds for the users table
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'Mathijs Van den Broeck',
                'email' => 'mathijsvandenbroeck@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Matthias Christiaens',
                'email' => 'christiaens.matthias@hotmail.com',
                'password' => bcrypt('password'),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
