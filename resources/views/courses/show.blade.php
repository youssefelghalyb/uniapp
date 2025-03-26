<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Course Details</h2>
            <a href="{{ route('courses.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Course Information</h3>
                <div class="space-y-3">
                    <div>
                        <span class="font-medium">Course ID:</span>
                        <span class="ml-2">{{ $course->course_id }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Course Name:</span>
                        <span class="ml-2">{{ $course->course_name }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Description:</span>
                        <p class="mt-1 text-gray-600">{{ $course->course_description }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Enrolled Students</h3>
                <div class="space-y-2">
                    @forelse($course->students as $student)
                        <div class="p-3 bg-gray-50 rounded">
                            <div class="font-medium">{{ $student->user->name }}</div>
                            <div class="text-sm text-gray-600">ID: {{ $student->student_id }} - GPA: {{ $student->curren_gpa }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500">No students enrolled</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>