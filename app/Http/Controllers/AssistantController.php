<?php
namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function index()
    {
        $assistants = Assistant::with('user')->paginate(10);
        return view('assistants.index', compact('assistants'));
    }

    public function create()
    {
        $users = User::all();
        $students = Student::all(); // Add this
        return view('assistants.create', compact('users', 'students'));
    }


    public function show(Assistant $assistant)
    {
        $assistant->load('user', 'students');
        return view('assistants.show', compact('assistant'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'assistant_id' => 'required|unique:assistants',
            'position' => 'required',
            'department' => 'required',
            'students' => 'array' // Add this
        ]);
    
        $assistant = Assistant::create([
            'user_id' => $validated['user_id'],
            'assistant_id' => $validated['assistant_id'],
            'position' => $validated['position'],
            'department' => $validated['department']
        ]);
    
        if(isset($validated['students'])) {
            $assistant->students()->attach($validated['students']);
        }
    
        return redirect()->route('assistants.index')->with('success', 'Assistant created successfully');
    }
    
    public function edit(Assistant $assistant)
    {
        $users = User::all();
        $students = Student::all();
        $selectedStudents = $assistant->students->pluck('id')->toArray();
        return view('assistants.edit', compact('assistant', 'users', 'students', 'selectedStudents'));
    }
    
    public function update(Request $request, Assistant $assistant)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'assistant_id' => 'required|unique:assistants,assistant_id,' . $assistant->id,
            'position' => 'required',
            'department' => 'required',
            'students' => 'array'
        ]);
    
        $assistant->update([
            'user_id' => $validated['user_id'],
            'assistant_id' => $validated['assistant_id'],
            'position' => $validated['position'],
            'department' => $validated['department']
        ]);
    
        $assistant->students()->sync($request->input('students', []));
    
        return redirect()->route('assistants.index')->with('success', 'Assistant updated successfully');
    }
    

    public function destroy(Assistant $assistant)
    {
        $assistant->delete();
        return redirect()->route('assistants.index')->with('success', 'Assistant deleted successfully');
    }
}

