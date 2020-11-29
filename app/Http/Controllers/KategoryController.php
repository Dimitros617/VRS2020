<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategories;

class KategoryController extends Controller
{
    //
    function show(){
        echo "<script>console.log('Debug Objects: KategoryController' );</script>";

        $data = Kategories::all();
        echo url()->current();
        return view('borrowing', ['kategories'=>$data]);
    }

    function showKategory(Kategories $nazev){

        $category_name = Products::findOrFail($nazev);

        echo "<script>console.log('Debug Objects: ' + $category_name );</script>"; die();

        echo $nazev;

    }
}
