<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query
        $query = Course::query();
        
        // Apply search filter if search parameter exists
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('course_id', 'LIKE', "%{$search}%")
                  ->orWhere('course_name', 'LIKE', "%{$search}%");
            });
        }
        
        // Get paginated results
        $courses = $query->orderBy('course_id')->paginate(10);
        
        return view('courses.index', compact('courses'));
    }


    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|unique:courses',
            'course_name' => 'required',
            'course_description' => 'required'
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_id' => 'required|unique:courses,course_id,' . $course->id,
            'course_name' => 'required',
            'course_description' => 'required'
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
