<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ListUsers;
use App\Models\categories;
use App\Models\loans;
use App\Models\User;
use App\Models\items;


class ListUsersController extends Controller
{
    function showAllUsers()
    {

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->select('users.id as userId','users.name as userName', 'users.surname as userSurname', 'users.phone as userPhone', 'users.email as userEmail', 'permition.id as permitionId', 'permition.name as permitionName')->get();
        //return $permition;
        return view('users', ['users' => $data]);


    }

    function showUser(User $id)
    {
        //return $id;
        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', $id['id'])->select('users.id as userId','users.name as userName', 'users.surname as userSurname', 'users.phone as userPhone', 'users.email as userEmail', 'permition.id as permitionId', 'permition.name as permitionName')->get();
        $dataPermition = DB::table('permition')->select('permition.name as permitionName', 'permition.id as permitionId')->get();
        //return $dataPermition;
        return view('singleUser',['user' => $data, 'permitions' => $dataPermition]);
    }


}
