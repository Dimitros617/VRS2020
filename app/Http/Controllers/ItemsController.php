<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ItemsController extends Controller
{

    function addNewItem(Request $request)
    {
        Log::info('ItemsController:addNewItem');

        if(Auth::permition()->edit_item != 1){
            abort(403);
            return "0";
        }

        $item = new items;
        $item->name = "Nepojmenováno";
        $item->categories = $request->category;
        $check = $item->save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));

    }

    function saveItem(Request $request)
    {
        Log::info('ItemsController:saveItem');

        if(Auth::permition()->edit_item != 1){
            return "0";
        }

        $item = items::find($request->itemId);
        $item->name = is_null($request->name) ? "": $request->name;
        $item->note = is_null($request->note) ? "": $request->note;
        $item->place = is_null($request->place) ? "": $request->place;
        $item->inventory_number = is_null($request->inventory_number) ? "": $request->inventory_number;
        $item->availability = is_null($request->availability) ? "0":  $request->availability;
        $check = $item->save();

        return $check;
    }

    function changeItemAvailability(Request $request)
    {
        Log::info('ItemsController:changeItemAvailability');

        if(Auth::permition()->edit_item != 1){
            abort(403);
            return array("return" => "0", "availability" => "1");
        }

        $item = items::find($request->id);
        $item->availability = (($request->availability + 1) % 2);
        $check = $item->save();

        $availability = (($request->availability + 1) % 2);
        return array("return" => $check, "availability" => $availability);

    }

    function removeItem(Request $request)
    {
        Log::info('ItemsController:removeItem' . $request->id);

        if(Auth::permition()->edit_item != 1){
            abort(403);
            return "0";
        }

        $loans = DB::table('loans')->where('item', $request->id)->count();

        if ($loans == 0) {
            $check = DB::table('items')->where('id', $request->id)->delete();

            return  $check;

        } else {
            $item = items::find($request->id);
            $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $request->id)->select('users.id', 'users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to')->get();

            return view('item-remove-verify', ['item' => $item, 'users' => $users]);

        }

    }

    function removeItemHard(Request $request)
    {
        Log::info('ItemsController:removeItemHard');

        if(Auth::permition()->edit_item != 1){
            abort(403);
            return;
        }

        $item = DB::table('items')->join('categories', 'items.categories', '=', 'categories.id')->where('items.id', $request->itemId)->select('categories.name')->get();

        $loansController = new LoansController;
        $loansController->removeLoans(DB::table('loans')->where('item', $request->itemId)->get());
        $loansController->removeLoans(DB::table('items')->where('id', $request->itemId)->get());


        return redirect('categories/' . $item[0]->name);

    }

    public function itemsSort($sort){

        Log::info('ItemsController:itemsSort');

        $data = DB::table('items')->orderBy('name', $sort)->get();
        return $data;

    }

}
