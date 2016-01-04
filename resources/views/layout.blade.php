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
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/">Pockeyt Business</a>
	    </div>
	    <div id="navbar" class="collapse navbar-collapse">
		    	@if ($signedIn && $user->profile !== null)
			    	<ul class="nav navbar-nav">
			    		<li><a href="/{{$user->profile->business_name}}">My Profile</a></li>
			    	</ul>
		    	@endif
	      <ul class="navbar-text navbar-right">
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