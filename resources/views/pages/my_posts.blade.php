@extends('layout')


@section('content')

@foreach ($posts as $post)
	@if ($user->profile->owns($post))
		<article>
			@foreach ($user->profile->photos as $photo)
				@if ($photo->logo == "true")
					<div style="display:inline-block;vertical-align:top;">
						<img src="/{{ $photo->thumbnail_path }}">
					</div>
				@endif
			@endforeach
			<div style="display:inline-block;">
				<h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
				<p>{{ $post->published_at->diffForHumans() }}</p>
			</div>
		</article>
	@endif
@endforeach

@stop