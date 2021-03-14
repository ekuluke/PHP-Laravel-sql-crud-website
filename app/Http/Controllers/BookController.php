<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use Auth;
class BookController extends Controller
{
    private $itemsPerPage = 5;
    private $genres = ['horror', 'sci-fi', 'drama', 'romance', 'non-fiction', 'thriller', 'action'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // returns the list index view
    public function index()
    {
        $books = Book::all();
        return view('book.index')->with('items', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // returns create form view.
    public function create()
    {
        return view('book.create')
        ->with('genres', $this->genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // stores the data in the request as a new book
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'author' => 'required|max:50',
            'genre' =>'required|max:50',
            'year' =>'required|numeric|min:1700|max:2021'
        ]);
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->genre = $request->genre;
        $image_store = request()->file('image')->store('book_images', 'public');
        $book->image = $image_store;


        $book->save();
        return redirect()->action('BookController@show',[$book->id]);
    }

    // returns the id of the review the user has written for a book if one exists, otherwise returns -1
    private function beenReviewed($reviews) {
        $userReviewed = -1;
        foreach($reviews as $review) {
            if($review->user_id == Auth::user()->id) {
                $userReviewed = $review->id;
            }     
        }
        return $userReviewed;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // detail page
    {
        $book = Book::find($id);
        $reviews = $book->reviewsPaginated(5);

        $num_items = $book->reviews->count();
        $userReviewId = Auth::check() ? $this->beenReviewed($reviews) : -1;
        $total_pages = ceil($num_items / $this->itemsPerPage); 
        #dd($reviews[0]->created_at);
        return view('book.show')->with('item', $book)
        ->with('reviews', $reviews)
        ->with('userReviewId', $userReviewId)
        ->with('genres', $this->genres);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // selects partial/full search based on the column, then
    // returns a sorted list of books that match the column's value.    
    public function search(Request $request)
    {
        $this->validate($request, [
            'searchText' => 'required|max:50',
            'searchColumn' => 'required' ]); 

        switch ($request->searchColumn){
            case 'title':
            case 'author':
                $books = $this->searchColumn($request->searchText, $request->searchColumn, true);
                break; 
            case 'genre':
            case 'year':
                $books = $this->searchColumn($request->searchText, $request->searchColumn, false);
                break; 
        }
        
        return view('book.index')->with('items',$books)
        ->with('query', $request->searchText)
        ->with('queryField', $request->searchColumn);
    }

    private function searchColumn($searchText, $column, $partial) {
        if($partial) {
            return Book::where($column, 'LIKE', '%' . $searchText . '%')->get();
        } else {
            return Book::where($column, '=', $searchText)->get();
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit')->with('book', $book)
        ->with('genres', $this->genres);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Updates the book with the parameter $id with the content of the request.
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'author' => 'required|max:50',
            'genre' =>'required|max:50',
            'year' =>'required|numeric|min:1700|max:2021'
        ]);

        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->genre = $request->genre;
        $image_store = request()->file('image')->store('book_images', 'public');
        $book->image = $image_store;
        $book->save();
        return redirect("book/$book->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // deletes the boook
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect("books");
    }
}
