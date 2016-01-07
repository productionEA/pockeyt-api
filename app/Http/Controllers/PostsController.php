<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Eloquent\Collection;
Use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostsController extends Controller {

    /**
     * Create a new PostsController instance
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('auth', ['only' => 'store']);
        $this->middleware('auth:admin', ['only' => ['index']]);
    }

    /**
     * Display listing of posts
     *
     * @return Collection
     */
    public function index() {
        $posts = Post::visible()->latest('published_at')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Display specified post
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::visible()->find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Store new post
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request) {
        $post = new Post($request->all());
        $post['published_at'] = Carbon::now(new DateTimeZone(config('app.timezone')));

        $this->user->profile->posts()->save($post);

        flash()->success('Success', 'Your post has been created!');
        return redirect('/profiles/' . $this->user->profile->id);
    }
}
