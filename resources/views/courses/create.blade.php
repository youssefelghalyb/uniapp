<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Add Course</h2>

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="course_id">
                    Course ID
                </label>
                <input type="text" name="course_id" id="course_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="course_name">
                    Course Name
                </label>
                <input type="text" name="course_name" id="course_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="course_description">
                    Course Description
                </label>
                <textarea name="course_description" id="course_description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Course
                </button>
            </div>
        </form>
    </div>
</x-app-layout>