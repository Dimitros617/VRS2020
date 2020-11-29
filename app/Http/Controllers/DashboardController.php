<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    function show()
    {
        $vypujcky_pocet_d = 'Zatím 0';  //kontrolní hodnota pro zobrazení
        $schvaleni_pocet_d = 'Zatím 0';

        Log::info('DashboardControler:show');
        return view( 'dashboard',['vypujcky_pocet' => $vypujcky_pocet_d, 'schvaleni_pocet' => $schvaleni_pocet_d]);

    }
}
