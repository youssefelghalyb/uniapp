<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Add Student</h2>

        <form action="" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                    User
                </label>
                <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="student_id">
                    Student ID
                </label>
                <input type="text" name="student_id" id="student_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="curren_gpa">
                    Current GPA
                </label>
                <input type="text" name="curren_gpa" id="curren_gpa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Courses
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($courses as $course)
                        <div class="flex items-center">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <label class="ml-2">
                                {{ $course->course_name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Student
                </button>
            </div>


        </form>
    </div>
</x-app-layout>