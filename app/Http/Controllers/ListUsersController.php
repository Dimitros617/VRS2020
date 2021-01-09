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
use Illuminate\Support\Facades\Log;


class ListUsersController extends Controller
{
    function showAllUsers()
    {

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'users.phone as userPhone', 'users.email as userEmail','users.nick as userNick', 'permition.id as permitionId', 'permition.name as permitionName')->orderBy('surname','asc')->get();
        //return $permition;
        return view('users', ['users' => $data]);


    }

    function showUser(User $id)
    {
        //return $id;
        if($id['id'] == Auth::user()->id){
            return redirect()->route('profile.show');
        }

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', $id['id'])->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'users.phone as userPhone', 'users.email as userEmail','users.nick as userNick', 'permition.id as permitionId', 'permition.name as permitionName')->get();
        $dataPermition = DB::table('permition')->select('permition.name as permitionName', 'permition.id as permitionId')->get();
        $dataLoans = DB::table('loans')->Join('items', 'loans.item', '=', 'items.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')->where('loans.user', $id['id'])->get();

        return view('singleUser', ['user' => $data, 'permitions' => $dataPermition, 'loans' => $dataLoans]);
    }

    function saveUserData(Request $request) //request pracuje s name ve formuláři
    {
        $user = User::find($request -> userId);
        $user -> name = $request -> userName;
        $user -> surname = $request -> userSurname;
        $user -> nick = $request -> userNick;
        $user -> phone = $request -> userPhone;
        $user -> email = $request -> userEmail;
        $user -> permition = $request -> selectPermition;
        $check = $user -> save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));
    }

    public function usersSort($sort){

        Log::info('ListUsersController:usersSort');

        $data = DB::table('users')->orderBy('surname', $sort)->get();
        return $data;

    }

    public function usersFind($find){

        Log::info('ListUsersController:usersFind');
        // nešlapající dotaz na databázi, aby se dalo hledat i podle permition $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->select('users.name as userName', 'users.surname as userSurname','users.nick as userNick','permition.name as permitionName')->where('userName', 'like', '%'.$find.'%')->orWhere('userSurname','like','%'.$find.'%')->orWhere('userNick','like','%'.$find.'%')->orWhere('permitionName','like','%'.$find.'%')->get();
        $data = DB::table('users')->where('name', 'like', '%'.$find.'%')->orWhere('surname','like','%'.$find.'%')->orWhere('nick','like','%'.$find.'%')->get();
        return $data;

    }

    public function getUserNames(){

        $data = DB::table('users')->select('nick')->get();

        return $data;
    }


}
