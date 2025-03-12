<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Edit advisor</h2>

        <form action="{{ route('advisors.update', $advisor) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                    User
                </label>
                <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $advisor->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="advisor_id">
                    advisor ID
                </label>
                <input type="text" name="advisor_id" id="advisor_id" value="{{ $advisor->advisor_id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                    Position
                </label>
                <input type="text" name="position" id="position" value="{{ $advisor->position }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="department">
                    Department
                </label>
                <input type="text" name="department" id="department" value="{{ $advisor->department }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Assigned Students
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($students as $student)
                        <div class="flex items-center">
                            <input type="checkbox" name="students[]" value="{{ $student->id }}" 
                                {{ in_array($student->id, $selectedStudents) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <label class="ml-2">
                                {{ $student->user->name }} ({{ $student->student_id }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update advisor
                </button>
            </div>
        </form>
    </div>
</x-app-layout>