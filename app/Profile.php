<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
        'hero_photo_id',
        'featured'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'featured' => 'boolean',
    ];

    protected $appends = ['formatted_description'];

    public function toDetailedArray() {
        $data = array_only($this->toArray(), ['id', 'business_name', 'website', 'description', 'formatted_description', 'created_at', 'updated_at', 'posts', 'featured']);
        $data['logo_thumbnail'] = is_null($this->logo) ? '' : $this->logo->thumbnail_url;
        $data['logo'] = is_null($this->logo) ? '' : $this->logo->url;
        $data['hero_thumbnail'] = is_null($this->hero) ? '' : $this->hero->thumbnail_url;
        $data['hero'] = is_null($this->hero) ? '' : $this->hero->url;

        return $data;
    }

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

    public function getFormattedDescriptionAttribute() {
        return html_newlines_to_p($this->description);
    }

    /**
     * @param Builder|\Illuminate\Database\Eloquent\Builder|Profile $query
     * @return mixed
     */
    public function scopeApproved($query) {
        return $query->where('approved', true);
    }

    /**
     * @param Builder|\Illuminate\Database\Eloquent\Builder|Profile $query
     * @return mixed
     */
    public function scopeVisible($query) {
        return $query->where(function($query) {
            $query = $query->approved();
            if(\Auth::check()) {
                $query = $query->orWhere('user_id', \Auth::id());
            }
            return $query;
        });
    }

    /**
     * @param Builder|\Illuminate\Database\Eloquent\Builder|Profile $query
     * @return mixed
     */
    public function scopeFeatured($query) {
        return $query->where('featured', true);
    }

    /**
     * @param Builder|\Illuminate\Database\Eloquent\Builder|Profile $query
     * @return mixed
     */
    public function scopeNotFeatured($query) {
        return $query->where('featured', false);
    }
}
