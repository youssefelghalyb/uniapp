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
                    <h3 class="text-md font-medium text-gray-700 mb-1">Student</h3>
                    <p class="text-gray-800">{{ $request->student->user->name }}</p>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-md font-medium text-gray-700 mb-1">Student Request</h3>
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
        



        <form action="Route" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>            
        </form>



        <h1 class="text-lg"> Your Response </h1>
        <form action="{{route('advisor-requests.answer' , $request->id)}}" method="POST" class="mt-5">
            @csrf
            <div class="mb-4">
                <label for="response" class="block text-sm font-medium text-gray-700">Response</label>
                <textarea name="response" id="response" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
              <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="Answered">Answered</option>
                <option value="FAQ">FAQ</option>
              </select>

            </div>
            <div class="mb-4 mt-5">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Submit Response</button>
            </div>
        </form>

    </div>
</x-workers-layout>