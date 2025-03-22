<!-- resources/views/requests/index.blade.php -->
<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Student Requests</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('requests.index') }}" class="px-4 py-2 rounded-full {{ !request('status') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    All
                </a>
                <a href="{{ route('requests.index', ['status' => 'Pending']) }}" class="px-4 py-2 rounded-full {{ request('status') == 'Pending' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Pending
                </a>
                <a href="{{ route('requests.index', ['status' => 'Answered']) }}" class="px-4 py-2 rounded-full {{ request('status') == 'Answered' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Answered
                </a>
                <a href="{{ route('requests.index', ['status' => 'FAQ']) }}" class="px-4 py-2 rounded-full {{ request('status') == 'FAQ' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    FAQ
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Advisor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message Preview</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $request->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $request->student->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $request->advisor->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Illuminate\Support\Str::limit($request->message, 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($request->status == 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($request->status == 'Answered') bg-green-100 text-green-800
                                @elseif($request->status == 'FAQ') bg-purple-100 text-purple-800
                                @endif">
                                {{ $request->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $request->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('requests.show', $request) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No requests found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    </div>
</x-app-layout>