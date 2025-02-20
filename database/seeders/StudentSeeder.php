<?php 

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $users = User::whereDoesntHave('student')
                    ->whereDoesntHave('assistant')
                    ->take(10)
                    ->get();

        foreach ($users as $user) {
            Student::create([
                'user_id' => $user->id,
                'student_id' => 'STU' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'curren_gpa' => number_format(rand(200, 400) / 100, 2),
            ]);
        }
    }
}
