@extends('layouts.app')
@section('page_title')
{{$item->title}}
@endsection
@if($item)


    @section('content')

                <div class="game-list-record-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                            <img class="game-detail-image" src="{{url("storage/$item->image")}}" alt="book image">
                            </div>
                            <div class="col-6">
                                <ul>
                                    
                                    <b>Author</b>
                                    <br>
                                    <!--<a class="block" href="{{ url("developer_detail/$item->developer") }}">{{$item->developer}}</a></td> -->
                                    {{$item->author}}
                                    <br>
                                    <b>Year of first publication</b>
                                    <br>
                                    {{$item->year}}
                                    <br>
                                    <br>
                                    @if(Auth::check())
                                        @if($userReviewId != -1)
                                            <a class="btn btn-primary" role="button" href="{{ url("review/$userReviewId/edit") }}">Edit your review</a> 
                                        @else
                                            <a class="btn btn-primary" role="button" href="{{ url("review/create/$item->id") }}">Add a review</a>
                                        @endif
                                        @if(Auth::user()->isCurator())
                                            <a class="btn btn-primary" role="button" href="{{ url("book/$item->id/edit") }}">Edit this book</a> 
                                        @endif

                                    @else
                                        <p>Log in or register to review this book</p>
                                    @endif
                                                                    </ul>
                            </div>
                        </div>
                        </div>
                
                @if ($reviews) 
                        <br>
                        <hr>
                        <br>
                        </div>
                        <div class="text-center" style="width: 50%; margin: 0 auto;">
                            <div>
                               {{ $reviews->links()}} 
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

            <table class="table table-hover table-striped">
            <thead>
                <tr>
                
                <th scope="col">User</th>
                <th scope="col">Created</th>
                <th scope="col">Review</th>
                <th scope="col">Rating</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($reviews as $review)
                <tr>
                    <td>{{$review->user->name}}
                    <br>
                    </td>
                    <td>
                    {{$review->created_at->format('d M Y')}}
                    </td>
                    <td width=100%>
                        <b>{{$review->title}}</b> <br> 
                        {{$review->body}} 
                    </td>
                    <td style="vertical-align: middle;">{{$review->rating}}/5</td>
                </tr>
            @endforeach
            </tbody>
            </table>
        @endif
@else
<p>Could not find the item specified</p>
@endif
@endsection