@if(count($posts) > 0)
    @foreach($posts as $post)
        <article>
            @if(!is_null($post->profile->logo) && (!isset($no_icons) || !$no_icons))
                <div style="display:inline-block; vertical-align:top;">
                    <img src="{{ $post->profile->logo->thumbnail_url }}">
                </div>
            @endif
            <div style="display:inline-block;">
                <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                <p>{{ $post->published_at->diffForHumans() }} by <a
                            href="/profiles/{{ $post->profile->id }}"><strong>{{ $post->profile->business_name }}</strong></a>
                </p>
            </div>
        </article>
    @endforeach

@else

    <div class="text-center alert alert-warning">No posts to show.</div>

@endif