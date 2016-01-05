<?php

namespace App;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    /**
     * Fillable fields for a photo
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'published_at'
    ];

    /**
     * an instance of the $date
     */
    protected $dates = ['published_at'];

    /**
     * Sets the published at attribute
     *
     * @param mixed $date
     */
    public function setPublishedAtAttribute($date) {
        $this->attributes['published_at'] = Carbon::parse($date, new DateTimeZone(\Config::get('app.timezone')));
    }

    public function setBodyAttribute($body) {
        $this->attributes['body'] = clean_newlines($body);
    }

    /**
     * A post belongs to its profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile() {
        return $this->belongsTo('App\Profile');
    }

    public function getFormattedBodyAttribute() {
        return html_newlines_to_p($this->body);
    }
}