<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Student Details</h2>
            <a href="{{ route('students.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                <div class="space-y-3">
                    <div>
                        <span class="font-medium">Student ID:</span>
                        <span class="ml-2">{{ $student->student_id }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Name:</span>
                        <span class="ml-2">{{ $student->user->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Email:</span>
                        <span class="ml-2">{{ $student->user->email }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Current GPA:</span>
                        <span class="ml-2">{{ $student->curren_gpa }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Enrolled Courses</h3>
                <div class="space-y-2">
                    @forelse($student->courses as $course)
                        <div class="p-3 bg-gray-50 rounded">
                            <div class="font-medium">{{ $course->course_name }}</div>
                            <div class="text-sm text-gray-600">{{ $course->course_id }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500">No courses enrolled</p>
                    @endforelse
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Assigned Assistants</h3>
                <div class="space-y-2">
                    @forelse($student->assistants as $assistant)
                        <div class="p-3 bg-gray-50 rounded">
                            <div class="font-medium">{{ $assistant->user->name }}</div>
                            <div class="text-sm text-gray-600">{{ $assistant->position }} - {{ $assistant->department }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500">No assistants assigned</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>