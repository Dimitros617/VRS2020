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
     *
     *
     * Přidán parametrický middleware volat lze jako: permition:first_permiton,second_permiton..... a jako poslední uvést operátor tedy ,OR nebo ,AND , pokud není uvedeno je defaulní hodnota AND
     *
     */
    public function handle(Request $request, Closure $next)
    {

        $args = func_get_args();



        $operator = $args[count($args)-1] == "AND" || $args[count($args)-1] == "OR" ? $args[count($args)-1] : "AND";
        $count = $args[count($args)-1] == "AND" || $args[count($args)-1] == "OR" ? 1 : 0;

        $return = 0;
        for ($i = 2; $i < count($args)-$count; $i++) {
            $val = $args[$i];
            Log::info('middleware-PermitionVerify: ' . $val);
            $return += Auth::permition()->$val == 1 ? 1 : 0;

        }


        if($operator == "AND" && $return == (count($args)-2-$count) || $operator == "OR" && $return > 0 ){
            return $next($request);
        }
        else{
            abort(403);
        }
    }


}
