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
            'name' =>'admin',
            'email' => 'admin@a.org',
            'password' => bcrypt('p'),
            'type' => 'adminstrator',
            'status' => 'n/a'
        ]);

        DB::table('users')->insert([
            'name' =>'chris',
            'email' => 'chris@a.org',
            'password' => bcrypt('p'),
            'type' => 'curator',
            'status' => 'approved'
        ]);
        DB::table('users')->insert([
            'name' =>'chloe',
            'email' => 'chloe@a.org',
            'password' => bcrypt('p'),
            'type' => 'curator',
            'status' => 'waiting for approval'
        ]);
        DB::table('users')->insert([
            'name' =>'cara',
            'email' => 'cara@a.org',
            'password' => bcrypt('p'),
            'type' => 'curator',
            'status' => 'waiting for approval'
        ]);
        DB::table('users')->insert([
            'name' =>'bob',
            'email' => 'bob@a.org',
            'password' => bcrypt('p'),
            'type' => 'member',
            'status' => 'n/a'
        ]);
        DB::table('users')->insert([
            'name' =>'fred',
            'email' => 'fred@a.org',
            'password' => bcrypt('p'),
            'type' => 'member',
            'status' => 'n/a'
        ]);
    }
}
