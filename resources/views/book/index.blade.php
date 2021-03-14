@extends('layouts.app')
@section('page_title')
@if(isset($query) && isset($queryField))
    <h3>Showing books that match the query: '{{$query}}' of field: '{{$queryField}}'</h3>
@else
    All Books
@endif
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-end">


            <form action="{{route("book.search")}}" method="POST">
            {{ method_field('POST')}}
            {{ csrf_field() }} 
            
            <div class="form-group">
                <label><b>Search:</b></label>
                    @if (count($errors) > 0)
                        <div class="error-msg">
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                        @endif
            @auth
                @if(Auth::user()->isCurator())
                <a style="float: right;" class="btn btn-primary" href="{{ url("book/create") }}" role="button">Add a new book</a>
                @endif
            @endauth
                <br>
                <input type="text" value="{{ old('searchText') }}" class="form-control" name="searchText">
                <label>Search by: </label>
                <label>
                <input type="radio" value="title" name="searchColumn"/>
                title
                </label>

                <label>
                <input type="radio" value="author" name="searchColumn"/>
                author
                </label>
                <label>
                <input type="radio" value="year" name="searchColumn"/>
                year
                </label>
                <label>
                <input type="radio" value="genre" name="searchColumn"/>
                genre
                </label>

                <button type="submit" class="btn btn-primary">Search</button>
            </div>
    </div>
</div>
<br>

@if ($items)
    <table class="table table-hover table-striped">
    <thead>
        <tr>
        
        <th scope="col">Index</th>
        @auth
            @if(Auth::user()->isCurator())
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            @endif
        @endauth
        <th scope="col">Title</th>
        <th scope="col">Authors</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
        <tr>

            <th scope="row">{{$loop->index}}</th>
            @auth
                @if(Auth::user()->isCurator())
                <td><a class="block" href="{{ url("book/$item->id/edit") }}">&#9998;</a></td>
                <td><form action="{{ url("book/$item->id")}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="submit">&#128465</button>
                </form></td>
                @endif
            @endauth
            <td><a class="block" href="{{ url("book/$item->id") }}">{{$item->title}}</a></td>
            <td><a class="block" href="{{ url("book/$item->id") }}">{{$item->author}}</a></td>
        </tr>
    @endforeach
    </tbody>
    </table>
    </form>
@else
    <p>No items were found. Click the button above to add items to the database.</p>
@endif
</div>
@endsection
