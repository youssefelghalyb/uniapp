<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class MonitorController extends Controller
{

    public function indexMeetings()
    {
        $meetings = Meeting::with(['student', 'advisor'])
            ->latest()
            ->paginate(10);
            
        return view('meetings.index', compact('meetings'));
    }


    public function showMeeting(Meeting $meeting)
    {
        $meeting->load(['student', 'advisor']);
        
        return view('meetings.show', compact('meeting'));
    }


    public function indexRequests(Request $request)
    {
        $query = ModelsRequest::with(['student', 'advisor'])->latest();
        
        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, ['Pending', 'Answered', 'FAQ'])) {
            $query->where('status', $request->status);
        }
        
        $requests = $query->paginate(10);
        
        return view('requests.index', compact('requests'));
    }


    public function showRequest(ModelsRequest $request)
    {
        $request->load(['student', 'advisor']);
        
        return view('requests.show', compact('request'));
    }
}