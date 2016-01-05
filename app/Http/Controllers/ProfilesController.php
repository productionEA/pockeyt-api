<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddPhotoRequest;

class ProfilesController extends Controller {

    /**
     * Create a new ProfilesController instance
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['show', 'index']]);

        parent::__construct();
    }

    /**************************
     * Resource actions
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request) {
        $profile = $this->user->publish(
            new Profile($request->all())
        );

        flash()->overlay('Welcome Aboard', 'Thank you for creating a profile!');

        return redirect(profile_path($profile));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $profile = Profile::find($id);

        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**************************
     * Other actions
     */

    public function getPosts($id) {
        $posts = Post::latest('published_at')
            ->where('profile_id', $id)
            ->get();

        return view('profiles.posts', ['posts' => $posts]);
    }

    public function getMyPosts() {
        return $this->getPosts(\Auth::user()->profile->id);
    }
}
