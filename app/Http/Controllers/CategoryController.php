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
use function PHPUnit\Framework\returnArgument;


class CategoryController extends Controller
{
    //
    function show()
    {

        echo "<script>console.log('Debug Objects: CategoryController' );</script>";
        Log::info('CategoryControler:show');

        //$data = categories::all();
        $data = categories::orderBy('name', 'asc')->get(); //načtení dat z databáze a setřízení podle abecedy
        return view('categories', ['categories' => $data]);
    }

    function showKategory(categories $name)
    {

        Log::info('CategoryControler:showKategory');
        $data = DB::table('items')->where('categories', $name['id'])->get();
        return view('category', ['category' => $name, 'items' => $data]);

    }

    function saveCategory(Request $request)
    {
        Log::info('CategoryControler:saveKategory');

        $borrow = new loans;
        $borrow->user = Auth::id();
        $borrow->item = $request->itemId;
        $borrow->rent_from = $request->rent_from;
        $borrow->rent_to = $request->rent_to;
        return redirect()->back();
    }
}
