<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user()===null)
        {

            return redirect('/post');
        }
        $actions = $request->route()->getAction();//get l'action de la route
        $roles = isset($actions['roles']) ? $actions['roles'] : null; //verifier le role de user dans la route

        if($request->user()->hasAnyRole($roles) || !$roles)
        {

            return $next($request);
        }

        return redirect('/post');
    }


}
