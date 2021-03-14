<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('book', 'BookController');
Route::resource('user', 'UserController');
Route::resource('review', 'ReviewController');

// custom create
Route::get('review/create/{id}', 'ReviewController@create')->where('id', '[0-9]+');

// book searchk
Route::post('book/search', [
    'as' => 'book.search',
    'uses' => 'BookController@search'
    ]);

Route::get('admin-panel', function() {
    
    $users = User::where('status', '=', 'waiting for approval')->get();
     

    return view('admin')->with('items', $users);

}); 

Route::get('docs', function() {
    return view('docs');
});

Route::get('user/{id}/approve', function(Request $request, $id) {

    $user = User::find($id);
    $user->status = 'approved';
    $user->save();
    $items = Book::all();
    return view('book.index')->with('items', $items);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/books', 'BookController@index')->name('books');