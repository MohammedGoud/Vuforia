<?php

namespace App\Http\Middleware;

use Closure;

class Adminmiddleware
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

        $user= $request->session()->get('adminid');
        if($user==null){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
