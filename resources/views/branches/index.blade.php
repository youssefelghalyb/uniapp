<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Branches</h2>
            <a href="{{ route('branches.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Branch</a>
        </div>

        <!-- Search Form -->
        <div class="mb-6">
            <form action="{{ route('branches.index') }}" method="GET" class="flex">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search by branch name" 
                    class="rounded-l border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 flex-1 px-4 py-2"
                    value="{{ request('search') }}"
                >
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600"
                >
                    Search
                </button>
                @if(request('search'))
                    <a 
                        href="{{ route('branches.index') }}" 
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2 hover:bg-gray-400"
                    >
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($branches as $branch)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $branch->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $branch->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('branches.edit', $branch->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            No branches found{{ request('search') ? ' matching "' . request('search') . '"' : '' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $branches->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>