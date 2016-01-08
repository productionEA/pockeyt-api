@extends('layout')

@section('content')

    @if(is_null($profile))

        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Profile not found.</h2>
            </div>
        </div>

    @else

        <div class="row">
            <div class="col-md-4">
                <h1>{{ $profile->business_name }}</h1>
                @if ($user && $user->owns($profile))
                    @if($profile->approved)
                        <div class="alert alert-success">
                            Your profile is <strong>approved</strong>. Users will be able to see it and any of your posts.
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Your profile is <strong>not approved</strong>. Users will not be able to see it or any of your
                            posts until an administrator reviews it.
                        </div>
                    @endif
                @endif

                @if($signedIn && $isAdmin)
                    @include('partials.profiles.admin_approval_status')
                @endif

                <hr>

                <div class="description">{!! nl2br($profile->description) !!}</div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <p><label>Logo</label></p>
                        @if(is_null($profile->logo))
                            <form id="uploadLogo" action="/profiles/{{ $profile->id }}/photos" method="POST" class="dropzone">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="logo">
                            </form>
                        @else
                            <p><img src="{{ $profile->logo->url }}"></p>
                            @if($user && $user->owns($profile))
                                <form action="/profiles/{{ $profile->id }}/photos" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="type" value="logo">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger btn-block">Delete</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <p><label>Hero/Banner</label></p>
                        @if(is_null($profile->hero))
                            <form id="uploadHero" action="/profiles/{{ $profile->id }}/photos" method="POST" class="dropzone">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="hero">
                            </form>
                        @else
                            <p><img src="{{ $profile->hero->url }}"></p>
                            @if($user && $user->owns($profile))
                                <form action="/profiles/{{ $profile->id }}/photos" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="type" value="hero">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger btn-block">Delete</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if($user && $user->owns($profile))
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Create a Post</h2>
                            <form method="POST" action="/posts">
                                @include ('posts.form')
                                @include ('errors.form')
                            </form>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Posts</h2>
                        @include('partials.posts.list', ['posts' => $profile->posts, 'no_icons' => true])
                    </div>
                </div>
            </div>
        </div>

    @endif
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