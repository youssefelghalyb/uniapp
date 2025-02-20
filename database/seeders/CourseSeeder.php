<?php 

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'course_id' => 'CS101',
                'course_name' => 'Introduction to Programming',
                'course_description' => 'Basic concepts of programming using Python'
            ],
            [
                'course_id' => 'CS201',
                'course_name' => 'Data Structures',
                'course_description' => 'Advanced data structures and algorithms'
            ],
            [
                'course_id' => 'MATH101',
                'course_name' => 'Calculus I',
                'course_description' => 'Introduction to differential calculus'
            ],
            [
                'course_id' => 'PHY101',
                'course_name' => 'Physics I',
                'course_description' => 'Mechanics and thermodynamics'
            ],
            [
                'course_id' => 'ENG101',
                'course_name' => 'English Composition',
                'course_description' => 'Academic writing and communication'
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Assign random courses to students
        $students = Student::all();
        $courseIds = Course::all()->pluck('id')->toArray();

        foreach ($students as $student) {
            $randomCourses = array_rand(array_flip($courseIds), rand(2, 4));
            $student->courses()->attach($randomCourses);
        }
    }
}
