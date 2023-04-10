<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class heckseranned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Check if user is logged in
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user is banned
            if ($user->is_banned) {
                Auth::logout(); // Log out the user
                return redirect()->route('login')->with('error', 'Your account has been banned.'); // Redirect to login page with an error message
            }
        }

        return $next($request);
    }
}
