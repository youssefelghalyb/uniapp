<?php
namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    public function index()
    {
        $advisors = Advisor::with('user')->paginate(10);
        return view('advisors.index', compact('advisors'));
    }

    public function create()
    {
        $users = User::all();
        $students = Student::all(); // Add this
        return view('advisors.create', compact('users', 'students'));
    }


    public function show(Advisor $advisor)
    {
        $advisor->load('user', 'students');
        return view('advisors.show', compact('advisor'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'advisor_id' => 'required|unique:advisors',
            'position' => 'required',
            'department' => 'required',
            'students' => 'array' // Add this
        ]);
    
        $advisor = advisor::create([
            'user_id' => $validated['user_id'],
            'advisor_id' => $validated['advisor_id'],
            'position' => $validated['position'],
            'department' => $validated['department']
        ]);
    
        if(isset($validated['students'])) {
            $advisor->students()->attach($validated['students']);
        }
    
        return redirect()->route('advisors.index')->with('success', 'advisor created successfully');
    }
    
    public function edit(advisor $advisor)
    {
        $users = User::all();
        $students = Student::all();
        $selectedStudents = $advisor->students->pluck('id')->toArray();
        return view('advisors.edit', compact('advisor', 'users', 'students', 'selectedStudents'));
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
        $advisor->delete();
        return redirect()->route('advisors.index')->with('success', 'advisor deleted successfully');
    }
}

