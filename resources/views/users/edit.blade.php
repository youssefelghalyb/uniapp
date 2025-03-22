<!-- resources/views/users/edit.blade.php -->
<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-6">Edit User</h2>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" required>
                <p class="text-gray-500 text-xs mt-1">Enter current password or a new password</p>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Role
                </label>
                <div class="mt-2">
                    <div class="flex items-center">
                        <input id="admin" name="is_admin" type="radio" value="1" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" {{ (old('is_admin', $user->is_admin) == 1) ? 'checked' : '' }}>
                        <label for="admin" class="ml-3 block text-sm font-medium text-gray-700">
                            Admin
                        </label>
                    </div>
                    <div class="flex items-center mt-2">
                        <input id="user" name="is_admin" type="radio" value="0" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" {{ (old('is_admin', $user->is_admin) == 0) ? 'checked' : '' }}>
                        <label for="user" class="ml-3 block text-sm font-medium text-gray-700">
                            Regular User
                        </label>
                    </div>
                </div>
                @error('is_admin')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>