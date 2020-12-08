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

class ItemsController extends Controller
{

    function addNewItem(Request $request)
    {
        Log::info('CategoryControler:addNewItem');

        $item = new items;
        $item->categories = $request->category;
        $check = $item->save();

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }

    }

    function saveItem(Request $request)
    {
        Log::info('CategoryControler:saveItem');

        $item = items::find($request->itemId);
        $item->name = is_null($request->name) ? "": $request->name;
        $item->note = is_null($request->note) ? "": $request->note;
        $item->place = is_null($request->place) ? "": $request->place;
        $item->inventory_number = is_null($request->inventory_number) ? "": $request->inventory_number;
        $item->availability = is_null($request->availability) ? "0":  $request->availability;
        $check = $item->save();

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }
    }

    function changeItemAvailability(Request $request)
    {
        Log::info('CategoryControler:changeItemAvailability');

        $item = items::find($request->itemId);
        $item->availability = (($request->availability + 1) % 2);
        $check = $item->save();

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }

    }

    function removeItem(Request $request)
    {
        Log::info('CategoryControler:removeItem');

        $loans = DB::table('loans')->where('item', $request->itemId)->count();

        if ($loans == 0) {
            $check = DB::table('items')->where('id', $request->itemId)->delete();

            if ($check) {
                return back()->withInput(array('saveCheck' => '1'));
            } else {
                return back()->withInput(array('saveCheck' => '0'));
            }
        } else {
            $item = items::find($request->itemId);
            $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $request->itemId)->select('users.id', 'users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to')->get();

            return view('item-remove-verify', ['item' => $item, 'users' => $users]);

        }

        return $check;

    }

    function removeItemHard(Request $request)
    {
        Log::info('CategoryControler:removeItemHard');

        $item = DB::table('items')->join('categories', 'items.categories', '=', 'categories.id')->where('items.id', $request->itemId)->select('categories.name')->get();
        DB::table('loans')->where('item', $request->itemId)->delete();
        DB::table('items')->where('id', $request->itemId)->delete();

        return redirect('categories/' . $item[0]->name);

    }

}
