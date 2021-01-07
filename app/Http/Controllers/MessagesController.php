<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    /*V tabulce jsou označeny prioritou
        0 = Nová
        1 = Přečtená
    */

    function countNewMessages(){

        Log::info('MessagesController:countNewMessages');

        $data = DB::table('message')->select(DB::raw('COUNT(user_id) as count'))->where('user_id', Auth::user()->id)->get();

        return $data[0]->count;
    }
}
