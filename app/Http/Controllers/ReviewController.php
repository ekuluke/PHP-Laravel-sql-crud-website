<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Book;
use Auth;

class ReviewController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // returns create review form view
    public function create($id)
    {
        $book = Book::find($id);
        return view('review.create')->with('book', $book);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // stores a new review
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'body' =>'required|min:5|max:5000'
        ]);

        $review = new Review;
        $review->title = $request->title;
        $review->rating  = $request->rating;
        $review->body = $request->body;
        $review->user_id = Auth::user()->id;
        $review->book_id = $request->bookId;
        $review->save();
        return redirect("book/$review->book_id")->with("reviewCreated", true);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // allows a user to edit their review by returning the edit view form.
    public function edit($id)
    {
        
        $review = Review::find($id);

        return view('review.edit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // allows the user to update thier review.
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'body' =>'required|min:5|max:5000'
        ]);

        $review = Review::find($id);
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->body = $request->body;
        $review->save();
        return redirect("book/$review->book_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
