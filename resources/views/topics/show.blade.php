<x-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Course Details</h2>
            <a href="{{ route('topics.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Topic Information</h3>
                <div class="space-y-3">

                    <div>
                        <span class="font-medium">Topic Name:</span>
                        <span class="ml-2">{{ $topic->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Description:</span>
                        <p class="mt-1 text-gray-600">{{ $topic->description }}</p>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</x-layout>