<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    function show()
    {
        $activeLoans = DB::table('loans')->where('loans.user', Auth::user()->id)->where('status', 1)->get();
        $waitingLoans = DB::table('loans')->where('loans.user', Auth::user()->id)->where('status', 2)->get();
        $allWaitingLoans = DB::table('loans')->where('status', 2)->get();

        $vypujcky_pocet =count($activeLoans);
        $vraceni_pocet = count($waitingLoans);
        $schvaleni_pocet = count($allWaitingLoans);


        Log::info('DashboardControler:show');
        return view( 'dashboard',['vypujcky_pocet' => $vypujcky_pocet, 'schvaleni_pocet' => $schvaleni_pocet, 'vraceni_pocet' => $vraceni_pocet]);

    }
}
