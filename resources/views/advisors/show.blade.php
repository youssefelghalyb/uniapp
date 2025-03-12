<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Advisor Details</h2>
            <a href="{{ route('advisors.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                <div class="space-y-3">
                    <div>
                        <span class="font-medium">Advisor ID:</span>
                        <span class="ml-2">{{ $advisor->advisor_id }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Name:</span>
                        <span class="ml-2">{{ $advisor->user->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Email:</span>
                        <span class="ml-2">{{ $advisor->user->email }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Position:</span>
                        <span class="ml-2">{{ $advisor->position }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Department:</span>
                        <span class="ml-2">{{ $advisor->department }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Assigned Students</h3>
                <div class="space-y-2">
                    @forelse($advisor->students as $student)
                        <div class="p-3 bg-gray-50 rounded">
                            <div class="font-medium">{{ $student->user->name }}</div>
                            <div class="text-sm text-gray-600">ID: {{ $student->student_id }} - GPA: {{ $student->curren_gpa }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500">No students assigned</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>