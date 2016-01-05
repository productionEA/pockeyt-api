<?php


namespace App\Http\Controllers;

use App\Http\Requests\AddPhotoRequest;
use App\Photo;
use App\Profile;

class PhotosController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
    }

    public function store(AddPhotoRequest $request) {
        $file = $request->file('photo');
        $logoBool = $request->logo;

        $photo = Photo::fromForm($file, $logoBool);

        $this->user->profile->addPhoto($photo);
    }

    public function destroy($id) {
        Photo::findOrFail($id)->delete();

        return back();
    }

}