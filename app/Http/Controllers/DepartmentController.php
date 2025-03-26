<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        // Start building the query
        $query = Department::query();
        
        // Apply search filter if search parameter exists
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }
        
        // Get paginated results
        $departments = $query->orderBy('name')->paginate(10);
        
        return view('departments.index', compact('departments'));
    }
    public function create(){
        return view('departments.create');
    }

    public function store(Request $request){

        try{
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            Department::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect()->route('departments.index');
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'Please fill all the fields');
        }


    }




    public function edit($id){
        $department = Department::find($id);
        return view('departments.edit' , compact('department'));
    }

    public function update($id , Request $request){

        $department = Department::find($id);
        try{
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $department->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect()->route('departments.index');
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'Please fill all the fields');
        }
    
    }



    public function destroy($id){
        Department::destroy($id);
        return redirect()->route('departments.index');
    }


}
