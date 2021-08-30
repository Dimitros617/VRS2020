<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Shows lit of departments.
     */
    public function showDepartments()
    {
        $departments = department::orderBy('short')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item', 'permition.possibility_renting')->get();

        return view('departments', ['departments' => $departments, 'permition' => $permition]);
    }

    /**
     * Adds a new department into DB.
     */
    function addNewDepartment(Request $request)
    {
        if(Auth::permition()->edit_item != 1){
            abort(403);
        }

        $department = new department;
        $department->name = 'Název katedry';
        $department->short = '_ZK';
        $check = $department->save();

        return back()->withInput(array('saveCheck' => $check));

    }

    /**
     * Show department info. 
     */
    public function getDepartment(string $short)
    {
        $department = department::where('short', 'LIKE', $short)->first();

        if($department === null){
            abort(404);
        }

        $data = DB::table('categories')->where('department_id', $department->id)->leftJoin('items', 'categories.id', '=', 'items.categories')->select('categories.id', 'categories.name', 'categories.description', 'items.availability', DB::raw('COUNT(items.categories) as count'))->whereNull('items.deleted_at')->groupByRaw('categories.name, categories.description, items.availability, categories.id')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item', 'permition.possibility_renting')->get();
        //dd($data);
        return view('department', ['categories' => $data, 'permition' => $permition, 'department' => $department]);
    }

    /**
     * Updates informations about department.
     */
    public function saveDepartment(string $short, Request $request)
    {
        //Log::info('CategoryControler:saveCategory');

        if(Auth::permition()->edit_item != 1){
            abort(403);
        }

        if($this->checkDepartmentNameExist($request->departmentName) == "true" && $request->departmentName != $request->departmentNameOld){
            abort(409);
        }

        $department = department::find($request->departmentId);

        if($department->short != $short){
            abort(403);
        }

        if(strlen($request->departmentName) == 0 || strlen($request->departmentShort) == 0 || strlen($request->departmentShort) > 3)
            return back();

        $department->name = is_null($request->departmentName) ? "": $request->departmentName;
        $department->short = is_null($request->departmentShort) ? "": $request->departmentShort;
        $department->save();

        return redirect('departments/'.$request->departmentShort);
    }

    public function checkDepartmentNameExist($name){

        //Log::info('CategoryControler:checkCategoryNameExist');
        $data = DB::table('departments')->where('name', $name)->get();
        return count($data) > 0 ? "true" : "false";

    }
    
    public function removeDepartment(Request $request)
    {   
        //Log::info('DepartmentControler:removeDepartment');

       
        if(Auth::permition()->edit_item != 1){
            abort(403);
            return "0";
        }
        $department = department::find($request->id);
        
        if($department == null)
            abort(404);

        if(count($department->categories) == 0){            
            $check = $department->delete();
            return $check;
        }else {

            $array = array();
            foreach($department->categories as $categorie)
            {
                array_push($array, $categorie->id);
            }

            $data = DB::table('items')
                ->leftJoin('loans', 'items.id', '=', 'loans.item')
                ->leftJoin('Users', 'loans.user', '=', 'Users.id')
                ->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')
                ->select('Users.id as userId', 'Users.name', 'Users.surname','categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName' , 'loans.id', 'loans.rent_from', 'loans.rent_to')
                ->whereRaw('categories.id IN ('.implode(",", $array).')')->get();

            return view('department-remove-verify', ['categories' => $data, 'department' => $department]);
        }
    }

    public function removeDepartmentHard(Request $request)
    {
        $department = department::find($request->departmentId);
        if($department === null)
            abort(404);

        if(Auth::permition()->edit_item != 1){
            abort(403);
        }

        //dd($department->categories);
        foreach($department->categories as $category)
        {
            foreach($category->items as $item)
            {
                foreach($item->loans as $loan)
                {
                    $loan->delete();
                }
                foreach($item->historyEvidences as $evidence)
                {
                    $evidence->delete();
                }
                $item->forceDelete();
            }
            $category->delete();
        }
        $department->delete();
        return redirect()->route('departments');
    }
}
