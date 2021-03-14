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
           <br>
        </form>
        <br>
    </div>
@endsection