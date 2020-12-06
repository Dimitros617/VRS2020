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
    function show()
    {
        $data = ListUsers::orderBy('surname', 'asc')->get(); //načtení dat z databáze a setřízení podle abecedy
        return view('users', ['users' => $data]);

    }

    function showListUsers()
    {
        /*$dataItems = DB::table('items')->where('categories', $name['id'])->get();
        $dataLoans = DB::table('loans')->join('items', 'loans.item', '=', 'items.id')->where('categories', $name['id'])->select('loans.item', 'loans.rent_from', 'loans.rent_to')->get();
//        return $dataLoans;
        return view('category', ['category' => $name, 'items' => $dataItems, 'loans' => $dataLoans]);*/
    }

}
