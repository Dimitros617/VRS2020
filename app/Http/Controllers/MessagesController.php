<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\messages;
use App\Models\User;
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

        $data = DB::table('messages')->select(DB::raw('COUNT(user_id) as count'))->where('user_id', Auth::user()->id)->where('priority', '0')->get();

        return $data[0]->count;
    }

    function showAllMessages(){

        Log::info('MessagesController:showAllMessages');

        $data = DB::table('messages')->join('users', 'messages.from_user_id', '=', 'users.id')->select("users.nick","messages.messages","messages.priority","messages.id as id")->where('user_id', Auth::user()->id)->get();

        return $data;
    }

    function changeMessagePriority($id){

        Log::info('MessagesController:changeMessagePriority => ' . $id);

        $message = messages::find($id);
        $message->priority = 1;
        $message->save();


        return;
    }

    function removeMessage($id){

        Log::info('MessagesController:removeMessage => ' . $id );

        DB::table('messages')->where('id', $id)->delete();


        return;
    }

    function sendMessage($nick, $text){

        Log::info('MessagesController:removeMessage');

        $message = new messages();
        $message->user_id = DB::table('users')->where('nick', $nick)->get()[0]->id;
        $message->from_user_id = Auth::user()->id;
        $message->messages = $text;;
        $message->priority = 0;
        $message->save();

        return;
    }
}
