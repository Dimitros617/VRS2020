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
        return view('borrowing', ['kategories'=>$data]);
    }
}
