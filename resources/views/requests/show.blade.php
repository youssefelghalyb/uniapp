<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Request Details</h2>
            <a href="{{ route('requests.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                    </svg>
                </div>
                
                
            <div class="ml-3">
                    <p class="text-sm text-blue-800">
                        Request #{{ $request->id }} - 
                        <span class="font-semibold">
                            @if($request->status == 'Pending')
                                Waiting for response
                            @elseif($request->status == 'Answered')
                                Has been answered
                            @elseif($request->status == 'FAQ')
                                Added to FAQ
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-semibold mb-4">Request Information</h3>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <span class="font-medium text-gray-600">Student:</span>
                            <span class="ml-2">{{ $request->student->user->name ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Advisor:</span>
                            <span class="ml-2">{{ $request->advisor->user->name ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Status:</span>
                            <span class="ml-2 px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($request->status == 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($request->status == 'Answered') bg-green-100 text-green-800
                                @elseif($request->status == 'FAQ') bg-purple-100 text-purple-800
                                @endif">
                                {{ $request->status }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Created:</span>
                            <span class="ml-2">{{ $request->created_at->format('F d, Y g:i A') }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Last Updated:</span>
                            <span class="ml-2">{{ $request->updated_at->format('F d, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Student Message</h3>
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <div class="p-3 bg-white rounded border">
                            {{ $request->message }}
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Response</h3>
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        @if($request->response)
                            <div class="p-3 bg-white rounded border">
                                {{ $request->response }}
                            </div>
                        @else
                            <div class="p-3 bg-yellow-50 text-yellow-700 rounded border border-yellow-200">
                                No response has been provided yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>