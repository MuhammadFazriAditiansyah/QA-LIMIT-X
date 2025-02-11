<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Futami;

class isGuest
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
        // if(Auth::check()) {
            if(Auth::check() && Auth::user()->role == 'operator') {
                return redirect()->route('operator')->with('notAllowed','Anda sudah login!');
            } elseif(Auth::check() && Auth::user()->role == 'staff'){
                return redirect()->route('staff')->with('notAllowed','Anda sudah login!');
            } elseif(Auth::check() && Auth::user()->role == 'supervisor') {
                return redirect()->route('supervisor')->with('notAllowed','Anda sudah login!');
            }elseif(Auth::check() && Auth::user()->role == 'superadmin') {
                return redirect()->route('admin')->with('notAllowed','Anda sudah login!');
            } 
            return $next($request); 
    }
}
