<?php

namespace App\Actions\Jetstream;

use App\Models\messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {

        $data = DB::table('messages')->where('from_user_id', Auth::user()->id)->get();
        foreach ($data as $mess){
            $message = messages::find($mess->id);
            $message->from_user_id = null;
            $message->save();
        }
        DB::table('messages')->where('user_id', Auth::user()->id)->delete();


        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
