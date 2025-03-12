<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Advisor;
use App\Models\Collage;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create users
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $collages = [
            ['name' => 'Business', 'description' => 'Business collage'],
            ['name' => 'Arts',  'description' => 'Arts collage'],
            ['name' => 'Science', 'description' => 'Science collage'],
            ['name' => 'Medicine', 'description' => 'Medicine collage'],
            ['name' => 'Law', 'description' => 'Law collage'],
        ];

        foreach ($collages as $collage) {
            Department::create($collage);
        }


        // Create students
        $userIds = User::pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            Student::create([
                'user_id' => $userIds[$i],
                'student_id' => 'STU' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'department_id' => rand(1, 5),
                'curren_gpa' => number_format(rand(200, 400) / 100, 2),
            ]);
        }

        // Create Advisors
        $departments = ['Computer Science', 'Mathematics', 'Physics', 'Chemistry', 'Biology'];
        $positions = ['Teaching Advisor', 'Research Advisor', 'Lab Advisor'];

        for ($i = 10; $i < 15; $i++) {
            Advisor::create([
                'user_id' => $userIds[$i],
                'advisor_id' => 'Adv' . str_pad($i - 9, 3, '0', STR_PAD_LEFT),
                'position' => $positions[array_rand($positions)],
                'department' => $departments[array_rand($departments)],
            ]);
        }

        // Create courses
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
        $courseIds = Course::pluck('id')->toArray();
        
        foreach ($students as $student) {
            $randomCourseCount = rand(2, 4);
            $randomCourses = array_rand(array_flip($courseIds), $randomCourseCount);
            $student->courses()->attach((array)$randomCourses);
        }

        // Assign random students to advisors
        $advisors = Advisor::all();
        $studentIds = Student::pluck('id')->toArray();

        foreach ($advisors as $advisor) {
            $randomStudentCount = rand(2, 5);
            $randomStudents = array_rand(array_flip($studentIds), $randomStudentCount);
            $advisor->students()->attach((array)$randomStudents);
        }
    }
}

