<?php 

namespace Database\Seeders;

use App\Models\Advisor;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdvisorSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Computer Science', 'Mathematics', 'Physics', 'Chemistry', 'Biology'];
        $positions = ['Teaching Advisor', 'Research Advisor', 'Lab Advisor'];

        $users = User::whereDoesntHave('student')
                    ->whereDoesntHave('advisor')
                    ->take(5)
                    ->get();

        foreach ($users as $user) {
            Advisor::create([
                'user_id' => $user->id,
                'advisor_id' => 'Adv' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'position' => $positions[array_rand($positions)],
                'department' => $departments[array_rand($departments)],
            ]);
        }
    }
}
