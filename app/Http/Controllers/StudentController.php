<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentAdvisor;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        

        return view('students.index', compact('students'));
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
        return view('students.create', compact('users', 'courses' ));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_id' => 'required|unique:students',
            'curren_gpa' => 'required',
            'courses' => 'array' 
        ]);

    
        $student = Student::create([
            'user_id' => $validated['user_id'],
            'student_id' => $validated['student_id'],
            'curren_gpa' => $validated['curren_gpa'],
            "department_id" => 1
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
        return view('students.edit', compact('student', 'users', 'courses', 'selectedCourses'));
    }
    
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'curren_gpa' => 'required',
            'courses' => 'array'
        ]);
    
        $student->update([
            'user_id' => $validated['user_id'],
            'student_id' => $validated['student_id'],
            'curren_gpa' => $validated['curren_gpa']
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
