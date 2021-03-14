@extends('layouts.app')
    @section('page_title')
    Create Your Review for {{$book->title}}
    @endsection
    @section('content')

    @if (count($errors) > 0)
        <div class="error-msg">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif
        <div class ="container">
        <form action="{{url("review")}}" method="POST">
            {{ method_field('POST')}}
            {{ csrf_field() }} 
            <input type="hidden" value="{{$book->id}}" name="bookId">
            <div class="form-group">
                <label>Title</label>
                <input type="text" value="{{ old('title') }}" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>Rating</label><br>
                <input type="number" value="{{ old('rating') }}" min=1 max=5 step="1" name="rating"/>
            </div>
            <div class="form-group">
                <label>Write your review here (Drag the bottom right corner to expand)</label>
                <textarea class="form-control" rows="9" name="body" value="{{ old('body') }}"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <br>
        </form>
        <br>
    </div>
@endsection