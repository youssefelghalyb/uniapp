<?php 

namespace Database\Seeders;

use App\Models\Assistant;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssistantSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Computer Science', 'Mathematics', 'Physics', 'Chemistry', 'Biology'];
        $positions = ['Teaching Assistant', 'Research Assistant', 'Lab Assistant'];

        $users = User::whereDoesntHave('student')
                    ->whereDoesntHave('assistant')
                    ->take(5)
                    ->get();

        foreach ($users as $user) {
            Assistant::create([
                'user_id' => $user->id,
                'assistant_id' => 'AST' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'position' => $positions[array_rand($positions)],
                'department' => $departments[array_rand($departments)],
            ]);
        }
    }
}
