<!-- resources/views/students-dashboard/meetings/show.blade.php -->
<x-workers-layout>
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-800">Meeting Details</h1>
            <a href="{{ route('student-meetings.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                &larr; Back to Meetings
            </a>
        </div>
        
        <!-- Meeting Info Card -->
        <div class="border border-gray-200 rounded-lg mb-6">
            <!-- Meeting Header -->
            <div class="bg-gray-50 p-4 border-b border-gray-200 rounded-t-lg">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div class="mb-2 sm:mb-0">
                        <h2 class="text-lg font-semibold text-gray-900">Meeting with Advisor</h2>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($meeting->dateTime)->format('l, F j, Y g:i A') }}</p>
                    </div>
                    <div>
                        @if($meeting->status == 'Pending')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($meeting->status == 'Accept')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Accepted
                            </span>
                        @elseif($meeting->status == 'Reject')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Rejected
                            </span>
                        @elseif($meeting->status == 'Rescheduled')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Rescheduled
                            </span>
                        @elseif($meeting->status == 'Attended')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                Attended
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Meeting Content -->
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Meeting Details -->
                    <div>
                        <div class="mb-4">
                            <h3 class="text-md font-medium text-gray-700 mb-1">Advisor</h3>
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium">{{ $meeting->advisor->user->name }}</p>
                                    <p class="text-gray-600 text-sm">{{ $meeting->advisor->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-md font-medium text-gray-700 mb-1">Schedule Information</h3>
                            <div class="bg-gray-50 rounded-md p-4">
                                <div class="flex items-start mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($meeting->dateTime)->format('l, F j, Y') }}</p>
                                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($meeting->dateTime)->format('g:i A') }}</p>
                                    </div>
                                </div>
                                
                                @if($meeting->created_at)
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-gray-600 text-sm">Requested on {{ $meeting->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Meeting Notes -->
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-1">Meeting Notes</h3>
                        @if($meeting->notes)
                            <div class="bg-gray-50 p-4 rounded-md text-gray-800 whitespace-pre-line min-h-[100px]">
                                {{ $meeting->notes }}
                            </div>
                        @else
                            <div class="bg-gray-50 p-4 rounded-md text-gray-500 italic min-h-[100px]">
                                No notes provided for this meeting.
                            </div>
                        @endif
                    </div>
                </div>
                
                @if(isset($meeting->response))
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <h3 class="text-md font-medium text-gray-700 mb-1">Advisor Response</h3>
                    <div class="bg-red-50 p-4 rounded-md text-gray-800 whitespace-pre-line">
                        {{ $meeting->response }}
                    </div>
                </div>
                @endif



            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex justify-between">
            <div>
                <!-- Only show delete/cancel button if it's still pending -->
                @if($meeting->status == 'Pending')
                    <form action="{{ route('student-meetings.destroy', $meeting->id) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Are you sure you want to cancel this meeting?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition">
                            Cancel Meeting
                        </button>
                    </form>
                @endif
            </div>
            
            <div>
                @if($meeting->status == 'Accept')
                    <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition mr-2" 
                            onclick="document.getElementById('reschedule-modal').classList.remove('hidden')">
                        Request Reschedule
                    </button>
                @endif
                
                <a href="{{ route('student-meetings.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                    Back to Meetings
                </a>
            </div>
        </div>
    </div>
    
    <!-- Reschedule Modal (hidden by default) -->
    <div id="reschedule-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Request Reschedule</h3>
            
            <form action="{{ route('student-meetings.reschedule', $meeting->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label for="new_datetime" class="block text-sm font-medium text-gray-700 mb-1">Proposed New Date & Time</label>
                    <input type="datetime-local" id="new_datetime" name="new_datetime" required 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                
                <div class="mb-4">
                    <label for="reschedule_reason" class="block text-sm font-medium text-gray-700 mb-1">Reason for Rescheduling</label>
                    <textarea id="reschedule_reason" name="reschedule_reason" rows="3" required 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Please explain why you need to reschedule..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('reschedule-modal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-workers-layout>