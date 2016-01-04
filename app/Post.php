<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
	 * @param date $date
	 */
	public function setPublishedAtAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::parse($date);
	}

	/**
	 * A post belongs to its profile
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}
}