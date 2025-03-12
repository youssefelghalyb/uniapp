<x-workers-layout>
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-800">Request Details</h1>
            <a href="{{ route('student-requests.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                &larr; Back to Requests
            </a>
        </div>
        
        <!-- Request Info Card -->
        <div class="border border-gray-200 rounded-lg mb-6">
            <div class="bg-gray-50 p-4 border-b border-gray-200 rounded-t-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-sm text-gray-500">Submitted on</span>
                        <span class="ml-2 text-sm font-medium">{{ $request->created_at->format('M d, Y \a\t h:i A') }}</span>
                    </div>
                    <div>
                        @if($request->status == 'Pending')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($request->status == 'Answered')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Answered
                            </span>
                        @elseif($request->status == 'FAQ')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                FAQ
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Request Content -->
            <div class="p-4">
                <div class="mb-4">
                    <h3 class="text-md font-medium text-gray-700 mb-1">Advisor</h3>
                    <p class="text-gray-800">{{ $request->advisor->user->name }}</p>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-md font-medium text-gray-700 mb-1">Your Request</h3>
                    <div class="bg-gray-50 p-4 rounded-md text-gray-800 whitespace-pre-line">{{ $request->message }}</div>
                </div>
                
                @if($request->response)
                    <div class="mb-4 border-t border-gray-200 pt-4">
                        <h3 class="text-md font-medium text-gray-700 mb-1">Response from Advisor</h3>
                        <div class="bg-indigo-50 p-4 rounded-md text-gray-800 whitespace-pre-line">
                            {{ $request->response }}
                        </div>
                        
                        <div class="mt-2 text-sm text-gray-500">
                            Responded on {{ $request->updated_at->format('M d, Y \a\t h:i A') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex justify-between">
            <div>
                <!-- Only show delete button if it's still pending -->
                @if($request->status == 'Pending')
                    <form action="{{ route('student-requests.destroy', $request->id) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Are you sure you want to delete this request?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition">
                            Delete Request
                        </button>
                    </form>
                @endif
            </div>
            
            <!-- Only show these options if request has been answered -->
            @if($request->status == 'Answered')
                <div>
                    <a href="#" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition mr-2">
                        Send Follow-up
                    </a>
                    <a href="#" class="px-4 py-2 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition">
                        Mark as Resolved
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-workers-layout>