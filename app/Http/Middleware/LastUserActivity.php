<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\User;
use Closure;

class LastUserActivity
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
        /*
        *   Si el user está logueado, Carbon pone un timestamp
        *   en la cache de la app, con el ID del user.
        *
        *   Luego el AdminController pide esta info en la cache para ver
        *   quien está logueado.
        *   
        *   El middleware está puesto en middleWareGroups y se actualiza la info
        *   cada vez que el user manda un get o un post.
        */

        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1); 
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);

            /*
            *   Se actualiza la info del user con el timestamp del get o post
            *   en la db. 
            *   
            *   Esta info tiene un delay de 1 minuto.
            */

            User::where('id', Auth::user()->id)->update(['last_seen' => (new \DateTime())->format("Y-m-d H:i:s")]);
        }

        return $next($request);
    }
}
