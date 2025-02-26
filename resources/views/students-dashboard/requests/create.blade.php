<!-- resources/views/requests/create.blade.php -->
<x-workers-layout>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold mb-4 text-indigo-800">Submit Request to Advisor</h1>
        
        <!-- Request Form -->
        <form action="{{ route('student-requests.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Hidden student ID field (assuming the authenticated user is a student) -->
            <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

            
            <!-- Request Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Request</label>
                <textarea id="message" name="message" rows="4" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Describe your question or request..."></textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Submit Request
                </button>
            </div>
        </form>
    </div>
    
    <!-- Previous Requests Table -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-indigo-800">Your Previous Requests</h2>
        
        @if($requests->isEmpty())
            <div class="bg-gray-50 p-4 rounded text-gray-600 text-center">
                You haven't submitted any requests yet.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Advisor</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($requests as $request)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->assistant->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ Str::limit($request->message, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($request->status == 'Pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($request->status == 'Answered')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Answered
                                        </span>
                                    @elseif($request->status == 'FAQ')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            FAQ
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('student-requests.show', $request->id) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @endif
    </div>
</x-workers-layout>