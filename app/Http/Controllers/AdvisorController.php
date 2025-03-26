<?php
namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Branch;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorController extends Controller
{
    public function index(Request $request)
    {
        // Get all branches for the filter dropdown
        $branches = Branch::orderBy('name')->get();
        
        // Get unique departments from the advisors table
        $departments = Advisor::select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department')
            ->filter();
            
        // Get unique positions from the advisors table
        $positions = Advisor::select('position')
            ->distinct()
            ->orderBy('position')
            ->pluck('position')
            ->filter();
        
        // Start building the query
        $query = Advisor::query();
        
        // Always eager load these relationships for better performance
        $query->with(['user', 'branch']);
        
        // Apply search filter if provided
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                // Search by advisor ID
                $q->where('advisor_id', 'LIKE', "%{$search}%")
                  // Or search by user name (requires join)
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Filter by branch if provided
        if ($branchId = $request->input('branch')) {
            $query->where('branch_id', $branchId);
        }
        
        // Filter by department if provided
        if ($department = $request->input('department')) {
            $query->where('department', $department);
        }
        
        // Filter by position if provided
        if ($position = $request->input('position')) {
            $query->where('position', $position);
        }
        
        // Get paginated results
        $advisors = $query->orderBy('advisor_id')->paginate(10);
        
        return view('advisors.index', compact('advisors', 'branches', 'departments', 'positions'));
    }

    public function create()
    {
        $advisor = Advisor::where('user_id', Auth::id())->first();
        $users = User::all();
        $students = Student::with('user')->get(); 
        $branches = Branch::all();
        return view('advisors.create', compact('users', 'students' , 'branches'));
    } 


    public function show(Advisor $advisor)
    {
        $advisor->load('user', 'students');
        return view('advisors.show', compact('advisor'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|unique:advisors|exists:users,id',
            'advisor_id' => 'required|unique:advisors',
            'branch_id' => 'required|exists:branches,id',
            'position' => 'required',
            'department' => 'required',
            'students' => 'array'
        ]);

        $isStudent = Student::where('user_id', $validated['user_id'])->exists();
        if($isStudent){
            return redirect()->route('advisors.index')->with('errors', 'Error creating advisor' . "User is a student");
        }
    
        $advisor = advisor::create([
            'user_id' => $validated['user_id'],
            'advisor_id' => $validated['advisor_id'],
            'position' => $validated['position'],
            'department' => $validated['department'],
            'branch_id' => $validated['branch_id']
        ]);
    
        if(isset($validated['students'])) {
            $advisor->students()->attach($validated['students']);
        }
    
        return redirect()->route('advisors.index')->with('success', 'advisor created successfully');
    }
    
    public function edit(advisor $advisor)
    {
        $users = User::all();
        $students = Student::where('branch_id' ,$advisor->branch_id )->get(); 
        $branches = Branch::all();

        $selectedStudents = $advisor->students->pluck('id')->toArray();
        return view('advisors.edit', compact('advisor', 'users', 'students', 'selectedStudents' , 'branches'));
    }
    
    public function update(Request $request, advisor $advisor)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'advisor_id' => 'required|unique:advisors,advisor_id,' . $advisor->id,
            'position' => 'required',
            'department' => 'required',
            'students' => 'array'
        ]);
    
        $advisor->update([
            'user_id' => $validated['user_id'],
            'advisor_id' => $validated['advisor_id'],
            'position' => $validated['position'],
            'department' => $validated['department']
        ]);
    
        $advisor->students()->sync($request->input('students', []));
    
        return redirect()->route('advisors.index')->with('success', 'advisor updated successfully');
    }
    

    public function destroy(advisor $advisor)
    {
        try{
            $advisor->delete();
            return redirect()->route('advisors.index')->with('success', 'advisor deleted successfully');

        }catch(Exception $e){
            return redirect()->route('advisors.index')->with('errors', 'Error deleting advisor' . "You Should reassign students first");
        }
    }
}

