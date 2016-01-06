@extends('layout')


@section('content')

    <div class="alert alert-danger">
        Note that your profile has not yet been approved by an administrator. Your posts, if you've made any, will show
        here when you're logged in, but other users and businesses won't be able to see them until your profile has been
        approved.
    </div>

    @include('partials.posts.list')

@stop