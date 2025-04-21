<!-- resources/views/students-dashboard/meetings/index.blade.php -->
<x-workers-layout>
    
    <!-- Upcoming Meetings -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold mb-4 text-indigo-800">Your Upcoming Meetings</h2>
        
        @if($upcomingMeetings->isEmpty())
            <div class="bg-gray-50 p-4 rounded text-gray-600 text-center">
                You don't have any upcoming meetings.
            </div>
        @else
            <div class="space-y-4">
                @foreach($upcomingMeetings as $meeting)
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between">
                            <div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($meeting->dateTime)->format('l, F j, Y') }}</span>
                                </div>
                                <div class="ml-7 text-sm text-gray-600">{{ \Carbon\Carbon::parse($meeting->dateTime)->format('g:i A') }}</div>
                                <div class="ml-7 mt-2">
                                    <span class="text-sm text-gray-600">Advisor: </span>
                                    <span class="text-sm font-medium text-gray-900">{{ $meeting->advisor->user->name }}</span>
                                </div>
                                @if($meeting->notes)
                                    <div class="ml-7 mt-1 text-sm text-gray-600">
                                        <span class="font-medium">Notes:</span> {{ Str::limit($meeting->notes, 100) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col items-end">
                                <div>
                                    @if($meeting->status == 'Pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($meeting->status == 'Accept')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Accepted
                                        </span>
                                    @elseif($meeting->status == 'Reject')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @elseif($meeting->status == 'Rescheduled')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Rescheduled
                                        </span>
                                    @elseif($meeting->status == 'Attended')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Attended
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-4 space-x-2">
                                    <a href="{{ route('advisor-meetings.show', $meeting->id) }}" 
                                        class="text-indigo-600 hover:text-indigo-900 text-sm">View Details</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Previous Meetings -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-indigo-800">Past Meetings</h2>
        
        @if($pastMeetings->isEmpty())
            <div class="bg-gray-50 p-4 rounded text-gray-600 text-center">
                You don't have any past meetings.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Advisor</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pastMeetings as $meeting)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($meeting->dateTime)->format('M d, Y g:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $meeting->advisor->user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ Str::limit($meeting->notes, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($meeting->status == 'Attended')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Attended
                                        </span>
                                    @elseif($meeting->status == 'Reject')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $meeting->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('advisor-meetings.show', $meeting->id) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-workers-layout>