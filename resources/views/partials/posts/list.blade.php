@if(count($posts) > 0)
    @foreach($posts as $post)
        <article>
            @if(!is_null($post->profile->logo))
                <div style="display:inline-block; vertical-align:top;">
                    <img src="{{ $post->profile->logo->thumbnail_url }}">
                </div>
            @endif
            <div style="display:inline-block;">
                <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                <p>{{ $post->published_at->diffForHumans() }} by <a
                            href="/profiles/{{ $post->profile->id }}"><strong>{{ $post->profile->business_name }}</strong></a>
                </p>
            </div>
        </article>
    @endforeach

@else

    <h2 class="text-center">No posts to show.</h2>

@endif