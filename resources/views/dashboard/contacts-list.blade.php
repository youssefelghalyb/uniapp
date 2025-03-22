<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Courses</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($messages as $message)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->course_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->user->name }}</td>
                        <td class="px-6 py-4">{{ $message->message }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
        </div>
    </div>
</x-app-layout>