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


class CategoryController extends Controller
{


    //
    function showCategories()
    {

        echo "<script>console.log('Debug Objects: CategoryController' );</script>";
        Log::info('CategoryControler:show');

        //$data = categories::all();
        $data = categories::orderBy('name', 'asc')->get(); //načtení dat z databáze a setřízení podle abecedy
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item', 'permition.possibility_renting')->get();

        if($permition[0]->possibility_renting == 1){
            return view('categories', ['categories' => $data, 'permition' => $permition]);
        }
        else
        {
            return redirect('/dashboard');
        }
    }

    function showItem(categories $name)
    {

//        echo "<script>console.log('Debug Objects: ' + $name->id + ' ' + $name->name + ' ' + $name->description);</script>";
        Log::info('CategoryControler:showItem');

        $dataItems = DB::table('items')->where('categories', $name['id'])->get();
        $dataLoans = DB::table('loans')->join('items', 'loans.item', '=', 'items.id')->where('categories', $name['id'])->select('loans.item', 'loans.rent_from', 'loans.rent_to')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item')->get();

        if($permition[0]->possibility_renting == 1){
            return view('category', ['category' => $name, 'items' => $dataItems, 'loans' => $dataLoans, 'permition' => $permition]);
        }
        else
        {
            return redirect('/dashboard');
        }


    }


    function saveItemLoans(Request $request)
    {
        Log::info('CategoryControler:saveItemLoans');

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

    function saveItem(Request $request)
    {
        Log::info('CategoryControler:saveItem');

        $item = items::find($request->itemId);
        $item->name = $request->name;
        $item->note = $request->note;
        $item->place = $request->place;
        $item->inventory_number = $request->inventory_number;
        $item->availability = $request->availability;
        $check = $item->save();

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }

    }

    function saveCategory(Request $request)
    {
        Log::info('CategoryControler:saveCategory');

        $category = categories::find($request->categoryId);
        $category->name = $request->categoryName;
        $category->description = $request->categoryDescription;
        $category->save();

        return redirect('categories/'.$request->categoryName);

    }


    function removeItem(Request $request)
    {
        Log::info('CategoryControler:removeItem');

        $loans = DB::table('loans')->where('item', $request->itemId)->count();

        if($loans == 0){
            $check = DB::table('items')->where('id', $request->itemId)->delete();

            if ($check) {
                return back()->withInput(array('saveCheck' => '1'));
            } else {
                return back()->withInput(array('saveCheck' => '0'));
            }
        }
        else{
            $item = items::find($request->itemId);
            $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $request->itemId)->select('users.id','users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to')->get();

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

        return redirect('categories/'.$item[0] -> name);

    }


    function showItemStatus(Request $request)
    {

        Log::info('CategoryControler:showItemStatus');


        $item = items::find($request->itemId);
        $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $request->itemId)->select('users.id','users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to')->get();

        return view('item-status', ['item' => $item, 'users' => $users]);

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

    function addNewCategory(Request $request)
    {
        Log::info('CategoryControler:addNewCategory');

        $category = new categories;
        $category->name = 'ZZZ - Nová kategorie';
        $check = $category->save();

        if ($check) {
            return back()->withInput(array('saveCheck' => '1'));
        } else {
            return back()->withInput(array('saveCheck' => '0'));
        }

    }
}
