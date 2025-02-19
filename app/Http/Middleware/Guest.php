<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if(Auth::check()) {
    //         // return redirect()->route('operator')->with('notAllowed','Anda sudah login!');
    //         return redirect()->back()->with('notAllowed','Anda sudah login!');
    //     }
    //     return $next($request);
    // }



    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            return redirect()->back()->with('notAllowed','Anda sudah login!')->withErrors(['notAllowed' => 'Anda sudah login!']);
        }

        return $next($request);
    }


}


