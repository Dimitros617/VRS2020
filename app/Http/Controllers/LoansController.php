<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\loans;
use App\Models\User;
use App\Models\items;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use function PHPUnit\Framework\returnArgument;

class LoansController extends Controller
{

    function showLoans(){

        Log::info('LoansController:show');

        $data = DB::table('loans')->Join('items', 'loans.item', '=', 'items.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')->where('loans.user', Auth::user()->id)->get();

        return view('loans', ['loans' => $data]);

    }

    function saveItemLoans(Request $request)
    {
        Log::info('LoansController:saveItemLoans');

        $borrow = new loans;
        $borrow->user = Auth::id();
        $borrow->item = $request->itemId;
        $borrow->rent_from = $request->rent_from;
        $borrow->rent_to = $request->rent_to;
        $check = $borrow->save();

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }

    }

    function showItemLoans(Request $request)
    {

        Log::info('LoansController:showItemStatus');


        $item = items::find($request->itemId);
        $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $request->itemId)->select('users.id', 'users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to')->get();

        return view('item-status', ['item' => $item, 'users' => $users]);

    }

    function itemLoansReturn(Request $request){


        if(Auth::permition()->return_verification == 1){

            $check = DB::table('loans')->where('id', $request->loanId)->delete();
        }
        else
        {
            $loan = loans::find($request->loanId);
            $loan->status = $loan->status == 1 ? 2 : 1;
            $check = $loan->save();

        }

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }

    }

    function showCategoryLoans(Request $request)
    {
        Log::info('CategoryControler:removeCategory');

        $data = DB::table('items')->leftJoin('loans', 'items.id', '=', 'loans.item')->leftJoin('Users', 'loans.user', '=', 'Users.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('Users.id as userId', 'Users.name', 'Users.surname','categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName' , 'loans.id', 'loans.rent_from', 'loans.rent_to')->where('categories.id', $request->id)->get();

//        return count($data);
        return view('category-status', ['categories' => $data]);

    }


}
