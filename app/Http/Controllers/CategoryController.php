<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    //
    function show(){

        echo "<script>console.log('Debug Objects: CategoryController' );</script>";
        Log::info('CategoryControler:show');

        //$data = categories::all();
        $data = categories::orderBy('name', 'asc')->get(); //načtení dat z databáze a setřízení podle abecedy
        return view('categories', ['categories'=>$data]);
    }

    function showKategory(categories $name){

        Log::info('CategoryControler:showKategory');

        return view('category', ['category'=>$name]);

    }
}
