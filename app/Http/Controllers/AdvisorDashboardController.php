<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Faq;
use App\Models\Meeting;
use App\Models\Request as MyCustomRequest;
use App\Models\Topic;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorDashboardController extends Controller
{
    public function dashboard()
    {

        $advisor = Advisor::where('user_id' , Auth::id()  ) ->first() ;  
        if(!$advisor){
            abort(403, 'Your Role is not advisor');
        }
    
        return view('advisor-dashboard.dashboard' , compact('advisor'));
    }




    public function myRequests(){
        $advisor = Advisor::where('user_id' , Auth::id())->first();

        $requests = MyCustomRequest::where('advisor_id' , $advisor->id)->get();
        return view('advisor-dashboard.requests.index' , compact('requests' , 'advisor'));
        
    }


    public function showRequest($id){
        $request = MyCustomRequest::where('id' , $id)->with('student')->first();

        return view('advisor-dashboard.requests.show' , compact('request'));
    }



    public function answerRequest(Request $answer , $id){
        try{
            $request = MyCustomRequest::where('id' , $id)->first();

            $answer->validate([
                'response' => 'required|string',
                'status' => 'required|in:Answered,FAQ'
            ]);

            $request->update([
                'response' => $answer->response,
                'status' => $answer->status
            ]);
            return redirect()->back()->with('success' , 'Request Answered Successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error' , 'Error Answering Request' . $e->getMessage());
        }

    }




    // Meetings

    public function myMeetings(){
        $today = Carbon::today();
        $advisor = Advisor::where('user_id' , Auth::id())->first();
        $upcomingMeetings = Meeting::where('advisor_id' , $advisor->id)
        ->whereDate('dateTime' , '>=' , $today)
        ->get();

        $pastMeetings = Meeting::where('advisor_id' , $advisor->id)
        ->whereDate('dateTime' , '<' , $today)
        ->where('status' , 'Attended')
        ->get();
        
        return view('advisor-dashboard.meetings.index' , compact('upcomingMeetings' , 'pastMeetings' , 'advisor'));
    }

    public function showMeeting($id){
        $meeting = Meeting::where('id' , $id)->with('student')->first();
        return view('advisor-dashboard.meetings.show' , compact('meeting'));
    }


    public function storeResponse(Request $request , $id){
        try{
            $meeting = Meeting::where('id' , $id)->first();
            $request->validate([
                'response' => 'required|string',
                'status' => 'required|in:Attended,Accept,Reject,Rescheduled'
            ]);

    
            $meeting->update([
                'response' => $request->response,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success' , 'Meeting Response Submit Successfully' );

        }catch(Exception $e){
            return redirect()->back()->with('error' , 'Error Answering Request' . $e->getMessage() );
        }
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
        return view('advisor-dashboard.faq.index', compact('faqs', 'topics', 'noResults'));
    }



    public function storeFaq(Request $request)
    {
        try{

            $request->validate([
                'question' => 'required|string',
                'answer' => 'required|string',
                'topic_id' => 'required|exists:topics,id'
            ]);
            
            // Create a new FAQ
            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->topic_id = $request->topic_id;
            $faq->save();
            
            // Redirect to the FAQ index page with a success message
            return redirect()->back()->with('success', 'FAQ added successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error' , 'Error Adding FAQ' . $e->getMessage());
        }
        // Validate the request
    }


    
}
