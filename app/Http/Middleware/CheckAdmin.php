<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdmin
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
        $user=Auth::user();
       //dd($user);
       if($user->usertype=="admin"){
        return $next($request);
        
       }else{
                return redirect()->route('home');
             }
             
    }
}
