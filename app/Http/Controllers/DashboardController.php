<?php 



namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Department;
use App\Models\Meeting;
use App\Models\Student;
use App\Models\User;
use Exception;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController{
    public function index(){
        $stats = [
            'users' => User::count(),
            'students' => Student::count(),
            'advisors' => Advisor::count(),
            'departments' => Department::count(),
            'branches' => Branch::count(),
            'courses' => Course::count(),
            'meetings' => Meeting::count(),
            'requests' => Request::count(),
        ];
        
        // Get the student to advisor ratio
        $studentAdvisorRatio = $stats['advisors'] > 0 
            ? round($stats['students'] / $stats['advisors'], 1) 
            : 0;
        
        return view('dashboard', compact('stats', 'studentAdvisorRatio'));
    }




    public function contact(){
        return view('dashboard.contact');
    }


    public function contactPost(Request $request){
        try{
            $request->validate([
                'message' => 'required|string'
            ]);

            Contact::create([
                'message' => $request->message,
                'user_id' => Auth::id()
            ]);

            return redirect()->back()->with('success' , 'Message Sent Successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error' , 'Something went wrong ' . $e->getMessage());
        }
    }


    public function contactsList(){
        $messages = Contact::all();
        return view('dashboard.contacts-list' , compact('messages'));
    }
}
