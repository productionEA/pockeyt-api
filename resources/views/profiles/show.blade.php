@extends('layout')

@section('content')
	
	<div class="row">
		<div class="col-md-4">
			<h1>{{ $profile->business_name }}</h1>
			@if ($user && $user->owns($profile))
				<a href="/my_posts" class="btn btn-primary">View Your Posts</a>
			@endif
		
	
			<hr>

			<div class="description">{!! nl2br($profile->description) !!}</div>
		</div>

		<div class="col-md-8 gallery">
			@foreach ($profile->photos->chunk(4) as $set)
				<div class="row">
					@foreach ($set as $photo)
						<div class="col-md-3 gallery_image">
							@if ($user && $user->owns($profile))
								<form method="POST" action="/photos/{{ $photo->id }}">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="DELETE">
									<button type="submit">Delete</button>
								</form>
							@endif
							<img src="{{ $photo->thumbnail_path }}">
						</div>
					@endforeach
				</div>
			@endforeach

			@if ($user && $user->owns($profile))
				<hr>
						<h3>Add Logo Here</h3>
						<form id="addPhotoForm" action="/{{ $profile->business_name }}/photos" method="POST" class="dropzone">
							{{ csrf_field() }}
							<input type="hidden" name="logo" id="logo" value="true">
						</form>

				<hr>

				<form method="POST" action="/posts">
					@include ('posts.form')
					@include ('errors.form')
				</form>
			@endif
		</div>
	</div>
@stop

@section('scripts.footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>

	<script>
		Dropzone.options.addPhotoForm = {
			paramName: 'photo',
			maxFilesize: 3,
			acceptedFiles: '.jpg, .jpeg, .png, .bmp',
		}
	</script>



