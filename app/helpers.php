<?php


/**
 * Display a flash message
 *
 * @param string $title
 * @param string message
 * @return void
 */
function flash($title = null, $message = null) {
	$flash = app('App\Http\Flash');

	if (func_num_args() == 0) {
		return $flash;
	}

	return $flash->info($title, $message);
}


/**
 * The path to a given profile
 *
 * @param App\Profile $profile
 * @return string
 */
function profile_path(App\Profile $profile) {
	return str_replace(' ', '-', $profile->business_name);
}