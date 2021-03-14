@extends('layouts.app')
@section('page_title')
@if(isset($query) && isset($queryField))
    <h3>Showing books that match the query: '{{$query}}' of field: '{{$queryField}}'</h3>
@else
    Curator Approval Panel
@endif
@endsection
@section('content')

@if(Auth::user()->isAdmin())
    <div class="container">
        <div class="row justify-content-end">


        </div>
    </div>
    <br>

    @if ($items)
        <table class="table table-hover table-striped">
        <thead>
            <tr>
            
            <th scope="col">Index</th>
            <th scope="col">Approve</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
        <tr>

               <th scope="row">{{$loop->index}}</th>
                <td><a class="btn btn-primary" href="{{ url("user/$item->id/approve") }}" role="button">Approve</a></td>

                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
        </form>
    @else
        <p>No users are waiting to be approved</p>
    @endif
</div>
@else
    Only adminstrators can view this page.
@endif
@endsection
