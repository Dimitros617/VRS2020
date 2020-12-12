<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class permitionVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $data)
    {
        Log::info('middleware-PermitionVerify: ' . $data);
        if(Auth::permition()->$data == 1){
            return $next($request);
        }
        else{
            abort(403);
        }

    }


}
