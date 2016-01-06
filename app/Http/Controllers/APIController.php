<?php


namespace App\Http\Controllers;

use App\Post;
use App\Profile;

class APIController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getPosts() {
        return response()->json(Post::with([])->latest()->get());
    }

    public function getPost($id) {
        $post = Post::with(['profile'])->find($id);
        if(is_null($post)) {
            return response()->json(['error' => 'Post not found.'], 404);
        } else {
            return response()->json($post);
        }
    }

    public function getProfiles() {
        $profiles = Profile::with(['logo', 'hero', 'posts'])->get()->map(function(Profile $profile) {
            return $profile->toDetailedArray();
        });
        return response()->json($profiles);
    }

    public function getProfile($id) {
        /** @var Profile $profile */
        $profile = Profile::with(['logo', 'hero', 'posts'])->find($id);
        if(is_null($profile)) {
            return response()->json(['error' => 'Profile not found.'], 404);
        } else {
            return response()->json($profile->toDetailedArray());
        }
    }
}