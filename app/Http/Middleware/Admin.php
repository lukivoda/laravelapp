<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        //proveruvame dali ima logiran user
        if(Auth::check()){

           //proveruvame dali user-ot e admin i dali i user-ot aktiven(imame custom method vo  User modelot)
            if(Auth::user()->is_admin()){
               // ako e admin go odobruvame negoviot request
                return $next($request);
            }

        }
       // ako ne e aadmin ne vraca na prva strana kaj user-ite
        return redirect('/');

    }
}
