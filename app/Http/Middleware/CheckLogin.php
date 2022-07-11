<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!empty(auth()->user()->getAllPermissions()->toArray()) or Auth::user()->rolles == 'admin') {
            return $next($request);
        } else {
            return redirect()->route('user.dashboard.index');
        }
    }
}
