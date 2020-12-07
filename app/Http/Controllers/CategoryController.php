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
        return view('categories', ['categories' => $data]);
    }

    function showItem(categories $name)
    {

//        echo "<script>console.log('Debug Objects: ' + $name->id + ' ' + $name->name + ' ' + $name->description);</script>";
        Log::info('CategoryControler:showItem');

        $dataItems = DB::table('items')->where('categories', $name['id'])->get();
        $dataLoans = DB::table('loans')->join('items', 'loans.item', '=', 'items.id')->where('categories', $name['id'])->select('loans.item', 'loans.rent_from', 'loans.rent_to')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item')->get();
        return view('category', ['category' => $name, 'items' => $dataItems, 'loans' => $dataLoans, 'permition' => $permition]);

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
}
