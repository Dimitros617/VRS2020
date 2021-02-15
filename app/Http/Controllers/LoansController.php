<?php

namespace App\Http\Controllers;

use App\Models\loans_histories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\loans;
use App\Models\items;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class LoansController extends Controller
{

    function showLoans(){

        Log::info('LoansController:showLoans');

        $data = DB::table('loans')->Join('items', 'loans.item', '=', 'items.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')->where('loans.user', Auth::user()->id)->get();

        return view('my-loans', ['loans' => $data]);

    }


    function showAllLoans(){

        Log::info('LoansController:showAllLoans');

        $waitingLoans = DB::table('loans')->Join('users', 'loans.user', '=', 'users.id')->Join('items', 'loans.item', '=', 'items.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')->where('loans.status', 2)->get();
        $activeLoans = DB::table('loans')->Join('users', 'loans.user', '=', 'users.id')->Join('items', 'loans.item', '=', 'items.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname',  'categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')->where('loans.status', 1)->get();
        $historyLoans = DB::table('loans_histories')->orderBy('name', 'asc')->orderBy('id', 'asc')->select('userId', 'name as userName', 'surname as userSurname',  'categoryId as categoryId', 'categories as categoryName',  'itemId as itemId', 'item as itemName', 'note', 'place' ,'inventory_number' , 'rent_from', 'rent_to', 'created')->get();

        //return $waitingLoans;
        return view('all-loans', ['waitingLoans' => $waitingLoans, 'activeLoans' => $activeLoans, 'historyLoans' => $historyLoans]);

    }

    function saveItemLoans(Request $request)
    {
        Log::info('LoansController:saveItemLoans');
        if(Auth::permition()->possibility_renting != 1){
            abort(403);
            return;
        }

        $borrow = new loans;
        $borrow->user = Auth::id();
        $borrow->item = $request->itemId;
        $from = explode("-",$request->rent_from);
        $borrow->rent_from = $from[2] ."-". $from[1] ."-". $from[0];
        $to = explode("-",$request->rent_to);
        $borrow->rent_to = $to[2] ."-". $to[1] ."-". $to[0];
        $check = $borrow->save();

        return $check;

    }

    function removeLoans($arr){

        Log::info('LoansController:removeLoans');

        $check = 0;
        foreach ($arr as $loan){
            $loanBackup = $activeLoans = DB::table('loans')->Join('users', 'loans.user', '=', 'users.id')->Join('items', 'loans.item', '=', 'items.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('users.id as userId', 'users.nick as userNick', 'users.name as userName', 'users.surname as userSurname','users.phone as userPhone', 'users.email as userEmail',  'categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')->where('loans.id', "=", $loan->id)->get();

            $mess = new MessagesController;
            if($loanBackup[0]->status == 1){
                $mess->sendMessage($loanBackup[0]->userNick,"Vaše rezervace položky " . $loanBackup[0]->itemName . " z kategorie " . $loanBackup[0]->categoryName . ", která byla zapsaná od " . date("d. m. Y", strtotime($loanBackup[0]->rent_from)) . " do " . date("d. m. Y", strtotime($loanBackup[0]->rent_to)) . ", byla zrušena administrátorem.", false);
            }else{
                $mess->sendMessage($loanBackup[0]->userNick,"Váš požadavek o vrácení položky " . $loanBackup[0]->itemName . " z kategorie " . $loanBackup[0]->categoryName . ", která byla rezervována od " . date("d. m. Y", strtotime($loanBackup[0]->rent_from)) . " do " . date("d. m. Y", strtotime($loanBackup[0]->rent_to)) . ", byl schválen administrátorem.", false);
            }

//            ('users.id as userId', 'users.nick as userNick', 'users.name as userName', 'users.surname as userSurname','users.phone as userPhone', 'users.email as userEmail',  'categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName', 'items.note', 'items.place' ,'items.inventory_number' , 'loans.id', 'loans.rent_from', 'loans.rent_to', 'loans.status')
            $loanHistory = new loans_histories;
            $loanHistory->userId = $loanBackup[0]->userId;
            $loanHistory->nick = $loanBackup[0]->userNick;
            $loanHistory->name = $loanBackup[0]->userName;
            $loanHistory->surname = $loanBackup[0]->userSurname;
            $loanHistory->phone = $loanBackup[0]->userPhone;
            $loanHistory->email = $loanBackup[0]->userEmail;

            $loanHistory->categoryId = $loanBackup[0]->categoryId;
            $loanHistory->categories = $loanBackup[0]->categoryName;

            $loanHistory->itemId = $loanBackup[0]->itemId;
            $loanHistory->item = $loanBackup[0]->itemName;
            $loanHistory->note = $loanBackup[0]->note;
            $loanHistory->place = $loanBackup[0]->place;
            $loanHistory->inventory_number = $loanBackup[0]->inventory_number;

            $loanHistory->rent_from = $loanBackup[0]->rent_from;
            $loanHistory->rent_to = $loanBackup[0]->rent_to;

            $loanHistory->created = \Carbon\Carbon::now()->toDateTimeString();

            $check = $loanHistory->save() == true ? 0 : 1;

            $check += DB::table('loans')->where('id', $loan->id)->delete() == true ? 0 : 1;

        }

        return $check != 0 ? false : true;
    }

    function clearHistory(Request $request){


        $count = $request["count"];
        if($count == ""){
            $count = "30";
        }

        $check = DB::table('loans_histories')->whereDate('created', '>', \Carbon\Carbon::now()->addDays($count))->delete();

        return $check >= 0 ? 1 : 0;
    }


    function showItemLoans($id)
    {

        Log::info('LoansController:showItemLoans');


        $item = items::find($id);
        $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $id)->select('users.id', 'users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to', 'loans.id as loanId', 'loans.status')->get();

        return view('item-status', ['item' => $item, 'users' => $users]);

    }

    function itemLoansReturn($id){

        Log::info('LoansController:itemLoansReturn');

        $status = 0;
        if(Auth::permition()->return_verification == 1){


            //$check = DB::table('loans')->where('id', $id)->delete();
            $check = $this->removeLoans(DB::table('loans')->where('id', $id)->get());
        }
        else
        {
            $loan = loans::find($id);
            $status = $loan->status == 1 ? 2 : 1;
            $loan->status = $status;
            $check = $loan->save();

        }

        $check = $check == true || $check == "1" ? "1": "0";

        return array("return" => $check, "status" => $status);

    }

    function showCategoryLoans($id)
    {
        Log::info('LoansControler:showCategoryLoans');

        $data = DB::table('items')->leftJoin('loans', 'items.id', '=', 'loans.item')->leftJoin('Users', 'loans.user', '=', 'Users.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('Users.id as userId', 'Users.name', 'Users.surname','categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName' , 'loans.id', 'loans.status', 'loans.rent_from', 'loans.rent_to')->where('categories.id', $id)->get();
        $name = DB::table('categories')->where('categories.id', $id)->select('name as categoryName')->get();
        //return $data;
        return view('category-status', ['categories' => $data, 'category' => $name]);

    }


}
