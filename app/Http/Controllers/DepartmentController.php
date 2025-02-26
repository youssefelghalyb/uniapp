<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index(){
    
        $departments = Department::all();
        return view('departments.index' , compact('departments'));
    }

    public function create(){
        return view('departments.create');
    }

    public function store(Request $request){

        Department::create([
            'name' => $request->name
        ]);

        return redirect()->route('departments.index');
    }




    public function edit($id){
        $department = Department::find($id);
        return view('departments.edit' , compact('department'));
    }

    public function update($id , Request $request){

        $department = Department::find($id);
        $department->update([
            'name' => $request->name
        ]);
        return redirect()->route('departments.index');
    
    }



    public function destroy($id){
        Department::destroy($id);
        return redirect()->route('departments.index');
    }


}
