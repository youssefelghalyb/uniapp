<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Advisors</h2>
            <a href="{{ route('advisors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Advisor</a>
        </div>

        <!-- Search Form -->
        <div class="mb-6">
            <form action="{{ route('advisors.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                <div class="flex flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search by name or advisor ID" 
                        class="rounded-l border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 flex-1 px-4 py-2"
                        value="{{ request('search') }}"
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600"
                    >
                        Search
                    </button>
                </div>
                
                <div class="flex gap-2">
                    <!-- Branch Filter -->
                    <select 
                        name="branch" 
                        class="rounded border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    >
                        <option value="">All Branches</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <!-- Department Filter -->
                    <select 
                        name="department" 
                        class="rounded border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    >
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>
                    
                    <!-- Position Filter -->
                    <select 
                        name="position" 
                        class="rounded border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    >
                        <option value="">All Positions</option>
                        @foreach($positions as $position)
                            <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                                {{ $position }}
                            </option>
                        @endforeach
                    </select>
                    
                    @if(request('search') || request('branch') || request('department') || request('position'))
                        <a 
                            href="{{ route('advisors.index') }}" 
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
                        >
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Advisor ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($advisors as $advisor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $advisor->advisor_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $advisor->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $advisor->position }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $advisor->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $advisor->branch->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('advisors.edit', $advisor) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <a href="{{ route('advisors.show', $advisor) }}" class="text-green-600 hover:text-blue-900 mr-3">View</a>
                           
                            <form action="{{ route('advisors.destroy', $advisor) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No advisors found matching your criteria
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $advisors->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>