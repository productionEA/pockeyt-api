<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfilePhotoRequest;
use App\Http\Requests\DeleteProfilePhotoRequest;
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
        $this->middleware('auth', ['except' => ['show', 'index', 'getPosts']]);
        $this->middleware('auth:admin', ['only' => ['index', 'postApprove', 'postUnapprove']]);

        parent::__construct();
    }

    /**************************
     * Resource actions
     */

    public function index() {
        $profiles = Profile::with(['owner', 'posts', 'logo', 'hero'])->latest()->get();

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(!is_null($this->user->profile))
            return redirect()->route('profiles.show', ['profiles' => $this->user->profile->id]);

        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request) {
        if(!is_null($this->user->profile))
            return redirect()->route('profiles.show', ['profiles' => $this->user->profile->id]);

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
        $profile = Profile::visible()->find($id);

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
        $posts = Post::with(['profile'])
            ->visible()
            ->latest('published_at')
            ->where('profile_id', $id)
            ->get();

        return view('profiles.posts', ['posts' => $posts]);
    }

    public function getMyPosts() {
        return $this->getPosts(\Auth::user()->profile->id);
    }

    public function postPhotos(AddProfilePhotoRequest $request, $profile_id) {
        $file = $request->file('photo');
        $photo = Photo::fromForm($file);
        $photo->save();
        Profile::findOrFail($profile_id)->{$request->get('type')}()->associate($photo)->save();
        return response('ok');
    }

    public function deletePhotos(DeleteProfilePhotoRequest $request, $profile_id) {
        /** @var Profile $profile */
        $profile = Profile::findOrFail($profile_id);
        $type = $request->get('type');
        $photo = $profile->{$type};
        $profile->{$type}()->dissociate()->save();
        $photo->delete();
        return back();
    }

    public function postApprove($profile_id) {
        /** @var Profile $profile */
        $profile = Profile::findOrFail($profile_id);
        $profile->approved = true;
        $profile->save();
        return redirect()->to(\URL::previous() . '#profile-' . $profile->id);
    }

    public function postUnapprove($profile_id) {
        /** @var Profile $profile */
        $profile = Profile::findOrFail($profile_id);
        $profile->approved = false;
        $profile->save();
        return redirect()->to(\URL::previous() . '#profile-' . $profile->id);
    }

}
