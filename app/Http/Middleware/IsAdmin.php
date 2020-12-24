<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (!$user->admin) { 
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}
