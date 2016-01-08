<?php

namespace App\Http\Requests;

use App\Profile;

class DeletePostRequest extends Request {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return !is_null($user = \Auth::user()) && ($user->is_admin || $user->profile->posts->contains($this->route('posts')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [];
    }
}
