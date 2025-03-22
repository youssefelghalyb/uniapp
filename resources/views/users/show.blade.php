<!-- resources/views/users/show.blade.php -->
<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">User Details</h2>
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">User Information</h3>
                <div class="space-y-3">
                    <div>
                        <span class="font-medium">Name:</span>
                        <span class="ml-2">{{ $user->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Email:</span>
                        <span class="ml-2">{{ $user->email }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Role:</span>
                        <span class="ml-2">
                            @if($user->is_admin)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Admin
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    User
                                </span>
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="font-medium">Created At:</span>
                        <span class="ml-2">{{ $user->created_at->format('F d, Y') }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Last Updated:</span>
                        <span class="ml-2">{{ $user->updated_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 md:mt-0">
                <h3 class="text-lg font-semibold mb-4">Actions</h3>
                <div class="space-y-3">
                    <div>
                        <a href="{{ route('users.edit', $user) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Edit User
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>