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

        $data = DB::table('categories')->leftJoin('items', 'categories.id', '=', 'items.categories')->select('categories.name', 'categories.description', 'items.availability', DB::raw('COUNT(items.categories) as count'))->groupByRaw('categories.name, categories.description, items.availability')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item', 'permition.possibility_renting')->get();

        return view('categories', ['categories' => $data, 'permition' => $permition]);


    }

    function showItem(categories $name)
    {

        Log::info('CategoryControler:showItem');

        $dataItems = DB::table('items')->where('categories', $name['id'])->get();
        $dataLoans = DB::table('loans')->join('items', 'loans.item', '=', 'items.id')->where('categories', $name['id'])->select('loans.item', 'loans.rent_from', 'loans.rent_to')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item')->get();

        return view('category', ['category' => $name, 'items' => $dataItems, 'loans' => $dataLoans, 'permition' => $permition]);

    }





    function saveCategory(Request $request)
    {
        Log::info('CategoryControler:saveCategory');

        $category = categories::find($request->categoryId);
        $category->name = is_null($request->categoryName) ? "": $request->categoryName;
        $category->description = is_null($request->categoryDescription) ? "": $request->categoryDescription;
        $category->save();

        return redirect('categories/' . $request->categoryName);

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
