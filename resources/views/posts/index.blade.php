@extends('layout')


@section('content')

    <div class="alert alert-info">
        Only posts from approved profiles will be shown here.
    </div>

    @include('partials.posts.list')

@stop