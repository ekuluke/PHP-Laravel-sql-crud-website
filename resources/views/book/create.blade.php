@extends('layouts.app')
    @section('page_title')
    Add a new book
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
        <form action="{{url("book")}}" method="POST" enctype="multipart/form-data">
            {{ method_field('POST')}}
            {{ csrf_field() }} 
            <div class="form-group">
                <label>Title</label>
                <input type="text" value="{{ old('title') }}" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>author</label><br>
                <input type="text" value="{{ old('author') }}" class="form-control" name="author"/>
            </div>
            <div class="form-group">
                <label>year</label><br>
                <input type="number" value="{{ old('author') }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Front Cover(jpg/png)</label><br>
                <input type="file" name="image"/>
            </div>
            <div class="form-group">
                <label>genre</label><br>

                <p><select name="genre">
                @foreach($genres as $genre)
                    @if($loop->first)
                        <option value="{{ old('genre')}}" selected="selected">{{old ('genre') }}</option>
                    @else
                        <option value="{{$genre}}">{{$genre}}</option>
                    @endif
                @endforeach
                </p></select>


            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <br>
        </form>
        <br>
    </div>
@endsection