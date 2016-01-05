<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    /**
     * Fillable fields for a flyer
     *
     * @var
     */
    protected $fillable = [
        'business_name',
        'website',
        'description',
        'logo_photo_id',
        'hero_photo_id'
    ];

    /**
     * Find profile at business_name
     *
     * @param string $business_name
     * @return Builder
     */

    /**
     * Gets profile with the given $business_name
     *
     * @param string $business_name
     * @return Profile
     */
    public static function locatedAt($business_name) {
        $business_name = str_replace('-', ' ', $business_name);

        return static::where(compact('business_name'))->firstOrFail();
    }

    public function logo() {
        return $this->belongsTo('App\Photo', 'logo_photo_id');
    }

    public function hero() {
        return $this->belongsTo('App\Photo', 'hero_photo_id');
    }

    /**
     * A profile is owned by a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determine if the given user created the profile
     * @param User $user
     * @return boolean
     */
    public function ownedBy(User $user) {
        return $this->user_id == $user->id;
    }

    /**
     * A profile has many posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }

    /**
     * method to check if profile owns object
     *
     * @param var passed from view
     * @return boolean
     */
    public function owns($relation) {
        return $relation->profile_id == $this->id;
    }
}
