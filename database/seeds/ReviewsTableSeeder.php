<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
        'title' =>'Pretty good',
        'body' => 'dummyreview1',
        'rating' => '4',
        'user_id' => '1',
        'book_id' => '1'
        ]);

        DB::table('reviews')->insert([
        'title' =>'Pretty good',
        'body' => 'dummyreview2',
        'rating' => '1',
        'user_id' => '2',
        'book_id' => '1'
        ]);

        DB::table('reviews')->insert([
        'title' =>'Pretty good',
        'body' => 'dummyreview2',
        'rating' => '3',
        'user_id' => '3',
        'book_id' => '1'
        ]);

        DB::table('reviews')->insert([
        'title' =>'Pretty good',
        'body' => 'dummyreview2',
        'rating' => '3',
        'user_id' => '4',
        'book_id' => '1'
        ]);

        DB::table('reviews')->insert([
        'title' =>'Pretty good',
        'body' => 'dummyreview2',
        'rating' => '3',
        'user_id' => '5',
        'book_id' => '1'
        ]);

        DB::table('reviews')->insert([
        'title' =>'Pretty good',
        'body' => 'dummyreview2',
        'rating' => '3',
        'user_id' => '6',
        'book_id' => '1'
        ]);
    }
}
