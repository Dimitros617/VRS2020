<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }


}
