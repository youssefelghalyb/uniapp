<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Edit Student</h2>

        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                    User
                </label>
                <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $student->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="branch_id">
                    Branch
                </label>
                <select name="branch_id" id="branch_id"
                
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($branches as $branch)
                        <option 
                        {{ $branch->id == $student->branch_id ? 'selected' : '' }}
                        value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="department_id">
                    Department
                </label>
                <select name="department_id" id="department_id"
                
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($departments as $department)
                        <option 
                        {{ $department->id == $student->department_id ? 'selected' : '' }}
                        value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="student_id">
                    Student ID
                </label>
                <input type="text" name="student_id" id="student_id" value="{{ $student->student_id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="curren_gpa">
                    Current GPA
                </label>
                <input type="text" name="curren_gpa" id="curren_gpa" value="{{ $student->curren_gpa }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Courses
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($courses as $course)
                        <div class="flex items-center">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" 
                                {{ in_array($course->id, $selectedCourses) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <label class="ml-2">
                                {{ $course->course_name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Student
                </button>
            </div>

        </form>
    </div>
</x-app-layout>