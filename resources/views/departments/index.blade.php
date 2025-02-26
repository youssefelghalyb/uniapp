<x-app-layout>


    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Departments</h2>
            <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Department</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($departments as $department)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{route('departments.edit' , $department->id)}}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{  route('departments.delete' , $department->id)  }}" method="POST" class="inline">
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


    </div>


</x-app-layout>
