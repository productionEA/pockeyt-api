@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h1>{{ $profile->business_name }}</h1>
            @if ($user && $user->owns($profile))
                <a href="/profiles/{{ $profile->id }}/posts" class="btn btn-primary">View My Posts</a>
            @endif


            <hr>

            <div class="description">{!! nl2br($profile->description) !!}</div>
        </div>

        <div class="col-md-8 gallery">

            <div class="row">
                <div class="col-md-12">
                    <h2>Logo</h2>
                    @if(is_null($profile->logo))
                        <h4>Upload</h4>
                        <form id="uploadLogo" action="/profiles/{{ $profile->id }}/photos" method="POST" class="dropzone">
                            {{ csrf_field() }}
                            <input type="hidden" name="type" value="logo">
                        </form>
                    @else
                        <img src="{{ $profile->logo->url }}">
                        @if($user && $user->owns($profile))
                            <form action="/profiles/{{ $profile->id }}/photos" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="logo">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h2>Hero/Banner</h2>
                    @if(is_null($profile->hero))
                        <h4>Upload</h4>
                        <form id="uploadHero" action="/profiles/{{ $profile->id }}/photos" method="POST" class="dropzone">
                            {{ csrf_field() }}
                            <input type="hidden" name="type" value="hero">
                        </form>
                    @else
                        <img src="{{ $profile->hero->url }}">
                        @if($user && $user->owns($profile))
                            <form action="/profiles/{{ $profile->id }}/photos" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="hero">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>

            @if ($user && $user->owns($profile))
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="/posts">
                            @include ('posts.form')
                            @include ('errors.form')
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>

    <script>
        Dropzone.options.uploadLogo = {
            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
            init: function() {
                this.on('success', function() {
                    window.location.reload();
                });
            }
        };
        Dropzone.options.uploadHero = {
            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
            init: function() {
                this.on('success', function() {
                    window.location.reload();
                });
            }
        };
    </script>
@stop