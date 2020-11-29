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

        $data = kategories::all();
//        echo url()->current();
        return view('borrowing', ['kategories'=>$data]);
    }

    function showKategory(kategories $nazev){

        Log::info('This is some useful information.');

//        echo "<script>console.log('Debug Objects: ' +  );</script>"; die();

        return $nazev;

    }
}
