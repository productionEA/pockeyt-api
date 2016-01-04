@extends('layout')

@section('content')
	<h1>{{ $post->title }}</h1>
<hr>
	<article>
		{{ $post->body }}
	</article>
@stop