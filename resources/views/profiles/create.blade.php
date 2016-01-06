@extends('layout')

@section('content')
    <h1>Create Your Business Profile</h1>

    <hr>

    <div class="row">

        @if($isAdmin)
            <div class="alert alert-warning">
                Heads up! You're logged in as an administrator. This form will create a profile for you which is likely
                not what you want to do.
            </div>
        @endif

        <form method="POST" action="/profiles" enctype="multipart/form-data" class="col-md-6">
            @include ('profiles.form')
            @include ('errors.form')
        </form>
    </div>
@stop