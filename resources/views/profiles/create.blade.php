@extends('layout')

@section('content')
    <h1>Create Your Business Profile</h1>

    <hr>

    <div class="row">
        <form method="POST" action="/profiles" enctype="multipart/form-data" class="col-md-6">
            @include ('profiles.form')
            @include ('errors.form')
        </form>
    </div>
@stop