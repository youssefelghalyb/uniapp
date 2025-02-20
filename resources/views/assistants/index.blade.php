<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Assistants</h2>
            <a href="{{ route('assistants.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Assistant</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assistant ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($assistants as $assistant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $assistant->assistant_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $assistant->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $assistant->position }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $assistant->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('assistants.edit', $assistant) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <a href="{{ route('assistants.show', $assistant) }}" class="text-green-600 hover:text-blue-900 mr-3">view</a>
                           
                            <form action="{{ route('assistants.destroy', $assistant) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $assistants->links() }}
        </div>
    </div>
</x-app-layout>