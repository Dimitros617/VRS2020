<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\loans;
use App\Models\User;

class DashboardController extends Controller
{
    function show()
    {

        Log::info('DashboardControler:show');

        $firstUser = $this->checkUserAlone();
        if($firstUser != null){
            return $firstUser;
        }


        $activeLoans = DB::table('loans')->where('loans.user', Auth::user()->id)->where('status', 1)->get();
        $waitingLoans = DB::table('loans')->where('loans.user', Auth::user()->id)->where('status', 2)->get();
        $allWaitingLoans = DB::table('loans')->where('status', 2)->get();
        $users = DB::table('users')->get();

        $vypujcky_pocet =count($activeLoans);
        $vraceni_pocet = count($waitingLoans);
        $schvaleni_pocet = count($allWaitingLoans);
        $users_pocet = count($users);


        return view( 'dashboard',['vypujcky_pocet' => $vypujcky_pocet, 'schvaleni_pocet' => $schvaleni_pocet, 'vraceni_pocet' => $vraceni_pocet, 'users_pocet' => $users_pocet]);

    }

    function checkUserAlone(){

        Log::info('DashboardControler:show->checkUserAlone');

        $count = DB::table('users')->get();

        if(count($count) == 1){
            $user = User::find(Auth::user()->id);
            if($user -> current_team_id == null) {
                $user->current_team_id = 1;
                $user->permition = 3;
                $user->save();
                return view( 'first-user');
            }
        }

        return null;

    }


}
