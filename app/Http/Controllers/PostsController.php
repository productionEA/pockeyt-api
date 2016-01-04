<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use Carbon\Carbon;
Use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

  /**
   * Create a new PostsController instance
   */
  public function __construct()
    {
        parent::__construct();
    }

	/**
   * Display listing of posts
   *
   * @return JSON  
   */
  public function index()
  {
    return Post::latest('published_at')->get();
  }

  /**
   * Display specified post
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
  	$post = Post::findOrFail($id);

  	return view('posts.show', compact('post'));
  }

  /**
   * Store new post
   *
   * @param PostRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(PostRequest $request)
  {

    $post = new Post($request->all());
    $post['published_at'] = Carbon::now();

    Profile::locatedAt($this->user->profile->business_name)->posts()->save($post);

    flash()->success('Success', 'Your post has been created!');
    return redirect('/my_posts');
  }
}
