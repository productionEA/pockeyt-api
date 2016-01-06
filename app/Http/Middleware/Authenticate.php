<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level = 'user') {
        if($this->auth->guest()) {
            if($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        } elseif($level === 'admin' && !$this->auth->user()->is_admin) {
            if($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->to('/');
            }
        } elseif(!$this->auth->user()->is_admin && is_null($this->auth->user()->profile) && (is_null($route = $request->route()) || $route->getName() !== 'profiles.create')) {
            if($request->ajax()) {
                return response('Must create profile first.', 400);
            } else {
                return redirect()->route('profiles.create');
            }
        }

        return $next($request);
    }
}
