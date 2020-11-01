<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;


class ControllerUsing extends Controller
{
    public function main()
    {
        return view( 'main');
    }
}

//classa s metodami na zobrazování stran přes controllery
