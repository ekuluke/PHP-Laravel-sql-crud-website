<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
        'title' =>'b1',
        'author' => 'Arthur Stanley',
        'genre' => 'horror',
        'image' => 'book_images/default.jpg',
        'year' => '1990'
        ]);

        DB::table('books')->insert([
        'title' =>'1984',
        'author' => 'Aldous Huxley',
        'genre' => 'Non-fiction',
        'image' => 'book_images/default.jpg',
        'year' => '1954'
        ]);

        DB::table('books')->insert([
        'title' =>'Brave New World',
        'author' => 'Aldous Huxley',
        'genre' => 'Non-fiction',
        'image' => 'book_images/default.jpg',
        'year' => '1946'
        ]);

        DB::table('books')->insert([
        'title' =>'Dolers Vin',
        'author' => 'Jack Gur',
        'genre' => 'sci-fi',
        'image' => 'book_images/default.jpg',
        'year' => '1954'
        ]);
    }
}
