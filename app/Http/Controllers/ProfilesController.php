<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddPhotoRequest;

class ProfilesController extends Controller
{
    /**
     * Create a new ProfilesController instance
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $profile = $this->user->publish(
            new Profile($request->all())
        );

       flash()->overlay('Welcome Aboard', 'Thank you for creating a profile!');

        return redirect(profile_path($profile));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($business_name)
    {
        $profile = Profile::locatedAt($business_name);

        return view('profiles.show', compact('profile'));
    }

    
    /**
     * Apply a photo to referenced profile
     *
     * @param  string  $business_name
     * @param  addPhotoRequest  $request
     */
    public function addPhoto($business_name, AddPhotoRequest $request)
    {
        $file = $request->file('photo');
        $logoBool = $request->logo;

        $photo = Photo::fromForm($file, $logoBool);

        Profile::locatedAt($business_name)->addPhoto($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove photo from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPhoto($id)
    {
        Photo::findOrFail($id)->delete();

        return back();
    }
}
