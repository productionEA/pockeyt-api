@foreach ($posts as $post)
    <article>
        @foreach ($post->profile->photos as $photo)
            @if ($photo->logo == "true")
                <div style="display:inline-block;vertical-align:top;">
                    <img src="/{{ $photo->thumbnail_path }}">
                </div>
            @endif
        @endforeach
        <div style="display:inline-block;">
            <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
            <p>{{ $post->published_at->diffForHumans() }} by <a href="/profiles/{{ $post->profile->id }}"><strong>{{ $post->profile->business_name }}</strong></a></p>
        </div>
    </article>
@endforeach