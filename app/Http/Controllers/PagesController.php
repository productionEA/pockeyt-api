<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
	
/**
 * Show home page
 *
 *@return view
 */
	public function home()
	{
		return view('pages.home');
	}

	
	/**
	 * Show user's posts
	 *
	 * @return view
	 */
	public function my_posts()
  {
  	$posts = Post::latest('published_at')->get();
  	
  	return view('pages.my_posts', compact('posts'));
  }
}
