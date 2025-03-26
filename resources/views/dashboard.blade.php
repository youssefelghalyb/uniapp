<x-app-layout>
    <div class="py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
        
        <!-- Main Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
                <p class="text-2xl font-bold text-blue-600">{{ number_format($stats['users']) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Students</h2>
                <p class="text-2xl font-bold text-green-600">{{ number_format($stats['students']) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Advisors</h2>
                <p class="text-2xl font-bold text-purple-600">{{ number_format($stats['advisors']) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Departments</h2>
                <p class="text-2xl font-bold text-yellow-600">{{ number_format($stats['departments']) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Branches</h2>
                <p class="text-2xl font-bold text-red-600">{{ number_format($stats['branches']) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Courses</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ number_format($stats['courses']) }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Requests</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ number_format($stats['requests']) }}</p>
            </div>


            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Meetings</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ number_format($stats['meetings']) }}</p>
            </div>
        </div>
        
        <!-- Student-Advisor Ratio Card -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Student to Advisor Ratio</h2>
            <div class="flex items-center">
                <p class="text-2xl font-bold text-gray-800">{{ $studentAdvisorRatio }}:1</p>
                <span class="ml-2 text-sm text-gray-500">({{ $stats['students'] }} students / {{ $stats['advisors'] }} advisors)</span>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Quick Access</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <a href="{{ route('students.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded text-center">
                    Manage Students
                </a>
                <a href="{{ route('advisors.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded text-center">
                    Manage Advisors
                </a>
                <a href="{{ route('departments.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded text-center">
                    Manage Departments
                </a>
                <a href="{{ route('branches.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded text-center">
                    Manage Branches
                </a>
                <a href="{{ route('courses.index') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded text-center">
                    Manage Courses
                </a>
                <a href="{{ route('users.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded text-center">
                    Manage Users
                </a>
            </div>
        </div>
    </div>
</x-app-layout>