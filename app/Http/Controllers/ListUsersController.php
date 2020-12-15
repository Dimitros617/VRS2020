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

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'users.phone as userPhone', 'users.email as userEmail', 'permition.id as permitionId', 'permition.name as permitionName')->get();
        //return $permition;
        return view('users', ['users' => $data]);


    }

    function showUser(User $id)
    {
        //return $id;
        if($id['id'] == Auth::user()->id){
            return redirect()->route('profile.show');
        }

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', $id['id'])->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'users.phone as userPhone', 'users.email as userEmail', 'permition.id as permitionId', 'permition.name as permitionName')->get();
        $dataPermition = DB::table('permition')->select('permition.name as permitionName', 'permition.id as permitionId')->get();
        //return $dataPermition;
        return view('singleUser', ['user' => $data, 'permitions' => $dataPermition]);
    }

    function saveUserData(Request $request) //request pracuje s name ve formuláři
    {
        $user = User::find($request -> userId);
        $user -> name = $request -> userName;
        $user -> surname = $request -> userSurname;
        $user -> phone = $request -> userPhone;
        $user -> email = $request -> userEmail;
        $user -> permition = $request -> selectPermition;
        $check = $user -> save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));
    }

}
