@extends('layout')


@section('content')
    <div class="jumbotron">
        <h1>Pockeyt Business</h1>

        <p>An easier way to find and connect with your customers</p>
        @if ($signedIn)
            <a href="/profiles/{{$user->profile->id}}" class="btn btn-primary">View Profile</a>
        @else
            <a href="/auth/register" class="btn btn-primary">Sign Up</a>
        @endif
    </div>
@stop