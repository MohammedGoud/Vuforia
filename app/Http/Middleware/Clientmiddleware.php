<?php

namespace App\Http\Middleware;

use Closure;

class Clientmiddleware
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

        $user= $request->session()->get('id');
        if($user==null){
            \Session::put('url',$request->route()->getPath());
            return redirect('login');


        }
        return $next($request);
    }
}
