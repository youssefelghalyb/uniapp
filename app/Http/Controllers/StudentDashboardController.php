<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Faq;
use App\Models\Meeting;
use App\Models\Request as ModelsRequest;
use App\Models\Student;
use App\Models\StudentAssistant;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function dashboard()
    {

        $student = Student::with(['user' , 'assistants' ,'assistants.user'])->where('user_id' , Auth::id())->first();
        return view('students-dashboard.dashboard' , compact('student'));
    }


    public function newRequest()
    {
        // Get the current student's ID
        $studentId = Student::where('user_id' , Auth::id())->first();
        
        // Get all requests for this student, paginated
        $requests = ModelsRequest::where('student_id', $studentId->id)
            ->with('assistant')
            ->orderBy('created_at', 'desc')
            ->get();
           
            $assistant = StudentAssistant::where('student_id' , $studentId->id)->first();
        
        return view('students-dashboard.requests.create', compact('requests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeRequest(Request $request)
    {
        // Validate the form data
        try {
            $validated = $request->validate([
            'message' => 'required|string',
            ]);
            $studentId = Student::where('user_id' , Auth::id())->first();
            $assistant = StudentAssistant::where('student_id' , $studentId->id)->first();
            // Create the request
            ModelsRequest::create([
            'student_id' => $studentId->id,
            'assistant_id' => $assistant->assistant_id,
            'message' => $validated['message'],
            'status' => 'Pending',
            ]);
            
            return redirect()->route('student-requests.index')
            ->with('success', 'Your request has been submitted successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()
            ->withErrors(['error' => 'An error occurred while submitting your request. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showRequest($id)
    {
        // Make sure the request belongs to the current student
        $request = ModelsRequest::where('id', $id)
            ->with('assistant')
            ->first();
        return view('students-dashboard.requests.show', compact('request'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyRequest($id)
    {
        // Make sure the request belongs to the current student and is still pending
        $request = ModelsRequest::where('id', $id)
            ->with('assistant')
            ->first();
            $studentId = Student::where('user_id' , Auth::id())->first();
            $canDelete = $studentId->id == $request->student_id;
        if (!$canDelete || $request->status !== 'Pending') {
            abort(403, 'Unauthorized action.');
        }
        
        $request->delete();
        
        return redirect()->route('student-requests.index')
            ->with('success', 'Request deleted successfully.');
    }





    public function meetings()
    {
        // Get the current student's ID
        $student = Student::where('user_id', Auth::id())->first();
        
        // Get upcoming meetings (today's date or future)
        $today = Carbon::today();
        $upcomingMeetings = Meeting::where('student_id', $student->id)
            ->with('assistant.user')
            ->whereDate('dateTime', '>=', $today)
            ->orderBy('dateTime', 'asc')
            ->get();
            
        // Get past meetings
        $pastMeetings = Meeting::where('student_id', $student->id)
            ->with('assistant.user')
            ->whereDate('dateTime', '<', $today)
            ->orderBy('dateTime', 'desc')
            ->get();
        
        return view('students-dashboard.meetings.index', compact('upcomingMeetings', 'pastMeetings'));
    }

    /**
     * Store a newly created meeting in storage.
     */
    public function storeMeeting(Request $request)
    {
        // Validate the form data
        try {
            $validated = $request->validate([
                'dateTime' => 'required|date|after:now',
                'notes' => 'nullable|string',
            ]);
            
            $studentId = Student::where('user_id', Auth::id())->first();
            $assistant = StudentAssistant::where('student_id', $studentId->id)->first();
            
            // Create the meeting
            Meeting::create([
                'student_id' => $studentId->id,
                'assistant_id' => $assistant->assistant_id,
                'dateTime' => $validated['dateTime'],
                'notes' => $validated['notes'],
                'status' => 'Pending',
            ]);
            
            return redirect()->route('student-meetings.index')
                ->with('success', 'Your meeting has been requested successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while requesting your meeting. Please try again.']);
        }
    }

    /**
     * Display the specified meeting.
     */
    public function showMeeting($id)
    {
        // Get the meeting with relationships
        $meeting = Meeting::where('id', $id)
            ->with('assistant.user')
            ->first();
            
        // Make sure the student is authorized to view this meeting
        $student = Student::where('user_id', Auth::id())->first();
        if ($meeting->student_id != $student->id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('students-dashboard.meetings.show', compact('meeting'));
    }

    /**
     * Remove the specified meeting from storage.
     */
    public function destroyMeeting($id)
    {
        // Get the meeting
        $meeting = Meeting::where('id', $id)->first();
        
        // Make sure the student is authorized to cancel this meeting
        $student = Student::where('user_id', Auth::id())->first();
        $canDelete = $student->id == $meeting->student_id;
        
        if (!$canDelete || $meeting->status != 'Pending') {
            abort(403, 'Unauthorized action.');
        }
        
        $meeting->delete();
        
        return redirect()->route('student-meetings.index')
            ->with('success', 'Meeting cancelled successfully.');
    }






    public function faq(Request $request)
    {
        // Get all topics for the filter dropdown
        $topics = Topic::orderBy('name')->get();
        
        // Start with a base query
        $faqQuery = Faq::with('topic');
        
        // Apply topic filter if provided
        if ($request->has('topic_id') && $request->topic_id != '') {
            $faqQuery->where('topic_id', $request->topic_id);
        }
        
        // Apply search filter if provided
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $faqQuery->where(function($query) use ($searchTerm) {
                $query->where('question', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('answer', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Get the FAQs with pagination
        $faqs = $faqQuery->orderBy('topic_id')->orderBy('id')->paginate(10);
        
        // Handle the case when filtering returns no results
        if ($faqs->isEmpty() && ($request->has('topic_id') || $request->has('search'))) {
            $noResults = true;
        } else {
            $noResults = false;
        }
        
        // Return the view with the data
        return view('students-dashboard.faq.index', compact('faqs', 'topics', 'noResults'));
    }

}
