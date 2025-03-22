<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Edit Topic</h2>

        <form action="{{ route('topics.update', $topic) }}" method="POST">
            @csrf
            @method('PUT')
            


            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                     Name
                </label>
                <input type="text" name="name" id="name" value="{{ $topic->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="course_description">
                     Description
                </label>
                <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $topic->description }}</textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Topic
                </button>
            </div>
        </form>
    </div>
</x-app-layout>