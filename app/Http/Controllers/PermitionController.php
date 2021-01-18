<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\permition;

class PermitionController extends Controller
{

    function showPermissions(){

        Log::info('PermitionController:showPermissions');

        $data = DB::table('permition')->get();

        return view('permitions', ['permitions' => $data]);
    }

    function addPermition(){

        Log::info('PermitionController:addPermition');

        $permition = new permition;
        $permition->name = 'Nové oprávnění';
        $permition->possibility_renting = 0;
        $permition->new_user = 0;
        $permition->return_verification = 0;
        $permition->edit_item = 0;
        $permition->edit_permitions = 0;
        $check = $permition->save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));
    }

    function savePermitionData(Request $request){

        Log::info('PermitionController:savePermitionData');

        $permition = permition::find($request->id);
        $permition->name = $request->name;
        $permition->possibility_renting = $request->renting;
        $permition->new_user = $request->user;
        $permition->return_verification = $request->return;
        $permition->edit_item = $request->edit;
        $permition->edit_permitions = $request->permition;
        $check = $permition->save();

        return $check ? "1" : "0";

    }

    function removePermition($id){

        Log::info('PermitionController:removePermition');


        return "1";

    }
}
