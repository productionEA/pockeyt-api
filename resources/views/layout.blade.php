<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pockeyt Business</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/libs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                Pockeyt Business
                @if($isAdmin)
                    <span class="text-primary">(Admin)</span>
                @endif
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if ($signedIn)
                    @if($hasProfile)
                        <li><a href="/profiles/{{$user->profile->id}}">My Profile</a></li>
                        <li><a href="/profiles/{{$user->profile->id}}/posts">My Posts</a></li>
                    @elseif(!$isAdmin)
                        <li><a href="/profiles/create">Create Profile</a></li>
                    @endif

                    @if($isAdmin)
                        <li><a href="/profiles">All Profiles</a></li>
                        <li><a href="/posts">All Posts</a></li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-text navbar-right nav-pills">
                @if ($signedIn)
                    <li><a href="/auth/logout">Logout</a></li>
                @else
                    <li><a href="/auth/login">Login</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container">
    @yield('content')
</div>

<script src="/js/libs.js"></script>
@yield('scripts.footer')

@include('flash')

</body>
</html>