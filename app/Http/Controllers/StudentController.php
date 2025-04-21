<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use App\Models\StudentAdvisor;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Get all branches and departments for the filter dropdowns
        $branches = Branch::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        
        // Start building the query
        $query = Student::query();
        
        // Always eager load these relationships for better performance
        $query->with(['user', 'branch', 'department']);
        
        // Apply search filter if provided
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                // Search by student ID
                $q->where('student_id', 'LIKE', "%{$search}%")
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
        if ($departmentId = $request->input('department')) {
            $query->where('department_id', $departmentId);
        }
        
        // Get paginated results
        $students = $query->orderBy('student_id')->paginate(10);
        
        return view('students.index', compact('students', 'branches', 'departments'));
    }

    public function show($id)
    {
        $student = Student::find( $id);
        return view('students.show', compact('student'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all(); 
        $departments = Department::all();
        $branches = Branch::all();
        return view('students.create', compact('users', 'courses' , 'departments' , 'branches')); 
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_id' => 'required|unique:students',
            'branch_id' => 'required|exists:branches,id',
            'curren_gpa' => 'required',
            'courses' => 'array' 
        ]);

        $isAdvisor = Advisor::where('user_id', $validated['user_id'])->exists();
        if($isAdvisor){
            return redirect()->route('students.index')->with('errors', 'Error creating advisor' . "User is a advisor");
        }
    

    
        $student = Student::create([
            'user_id' => $validated['user_id'],
            'student_id' => $validated['student_id'],
            'curren_gpa' => $validated['curren_gpa'],
            'branch_id' => $validated['branch_id'],
            "department_id" => $request['department_id']
        ]);
        
        foreach($validated['courses'] as $course){
            StudentCourse::create([
                'student_id' => $student->id,
                'course_id' => $course
            ]);
        }


    
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }
    
    public function edit(Student $student)
    {
        $users = User::all();
        $courses = Course::all();
        $selectedCourses = $student->courses->pluck('id')->toArray();
        $branches = Branch::all();
        $departments = Department::all();
        return view('students.edit', compact('student', 'users', 'courses', 'selectedCourses'  , 'branches' , 'departments'));
    }
    
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'curren_gpa' => 'required',
            'courses' => 'array',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id'
        ]);
    
        $student->update([
            'user_id' => $validated['user_id'],
            'student_id' => $validated['student_id'],
            'curren_gpa' => $validated['curren_gpa'],
            'branch_id' => $validated['branch_id'],
            'department_id' => $validated['department_id']
        ]);
    
        $student->courses()->sync($request->input('courses', []));
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }
    

    public function destroy(Student $student)
    {
        $id = $student->id;
        $advisors = StudentAdvisor::where('student_id', $id)->get();
        foreach($advisors as $advisor) {
            $advisor->delete();
        }
        $courses = StudentCourse::where('student_id', $id)->get();
        foreach($courses as $course) {
            $course->delete();
        }
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
