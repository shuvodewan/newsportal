<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$data)
    {
        if(Auth::guard('admin')->check()){
            if(Auth::guard('admin')->user()->id == 1){
                return $next($request);
            }
            if(Auth::guard('admin')->user()->sectionCheck($data)){
                return $next($request);
            }
        }
        return redirect()->route('admin.dashboard')->with('unsuccess',"You don't have access to that section"); 
    }
}
