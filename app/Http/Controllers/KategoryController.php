<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategories;
use Illuminate\Support\Facades\Log;

class KategoryController extends Controller
{
    //
    function show(){

        echo "<script>console.log('Debug Objects: KategoryController' );</script>";
        Log::info('KategoryControler:show');

        $data = kategories::all();
        return view('categories', ['categories'=>$data]);
    }

    function showKategory(kategories $nazev){

        Log::info('KategoryControler:showKategory');

        return view('category', ['category'=>$nazev]);

    }
}
