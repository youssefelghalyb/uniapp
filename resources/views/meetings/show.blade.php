<!-- resources/views/meetings/show.blade.php -->
<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Meeting Details</h2>
            <a href="{{ route('meetings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Meeting Information</h3>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <span class="font-medium text-gray-600">Meeting ID:</span>
                            <span class="ml-2">{{ $meeting->id }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Student:</span>
                            <span class="ml-2">{{ $meeting->student->user->name ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Advisor:</span>
                            <span class="ml-2">{{ $meeting->advisor->user->name ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Date & Time:</span>
                            <span class="ml-2">{{ \Carbon\Carbon::parse($meeting->dateTime)->format('F d, Y g:i A') }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Status:</span>
                            <span class="ml-2 px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($meeting->status == 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($meeting->status == 'Accept') bg-green-100 text-green-800
                                @elseif($meeting->status == 'Reject') bg-red-100 text-red-800
                                @elseif($meeting->status == 'Rescheduled') bg-blue-100 text-blue-800
                                @elseif($meeting->status == 'Attended') bg-purple-100 text-purple-800
                                @endif">
                                {{ $meeting->status }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Created At:</span>
                            <span class="ml-2">{{ $meeting->created_at->format('F d, Y g:i A') }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Last Updated:</span>
                            <span class="ml-2">{{ $meeting->updated_at->format('F d, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Notes & Response</h3>
                <div class="bg-gray-50 p-4 rounded-lg border h-full">
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-600 mb-2">Meeting Notes:</h4>
                        <div class="p-3 bg-white rounded border">
                            {{ $meeting->notes ?? 'No notes available' }}
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-600 mb-2">Response:</h4>
                        <div class="p-3 bg-white rounded border">
                            {{ $meeting->response ?? 'No response provided' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>