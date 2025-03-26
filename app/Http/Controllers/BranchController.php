<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index(Request $request)
    {
        // Start building the query
        $query = Branch::query();
        
        // Apply search filter if search parameter exists
        if ($search = $request->input('search')) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
        
        // Get paginated results
        $branches = $query->orderBy('name')->paginate(10);
        
        return view('branches.index', compact('branches'));
    }

    public function create(){
        return view('branches.create');
    }

    public function store(Request $request){

        Branch::create([
            'name' => $request->name
        ]);

        return redirect()->route('branches.index');
    }




    public function edit($id){
        $branch = Branch::find($id);
        return view('branches.edit' , compact('branch'));
    }

    public function update($id , Request $request){

        $branch = Branch::find($id);
        $branch->update([
            'name' => $request->name
        ]);
        return redirect()->route('branches.index');
    
    }



    public function destroy($id){
        Branch::destroy($id);
        return redirect()->route('branches.index');
    }


}
