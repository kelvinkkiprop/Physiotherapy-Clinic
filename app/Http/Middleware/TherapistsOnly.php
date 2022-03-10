<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Auth;

class TherapistsOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->type==2){
            return $next($request);
        }
        return redirect()->back()->with('danger', 'Unauthorized');
    }
}
