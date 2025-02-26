<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-gray-900 text-white p-5 space-y-6 md:block hidden">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <nav>
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Dashboard</a>
                <a href="{{ route('students.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('students.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Students</a>
                <a href="{{ route('assistants.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('assistants.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Assistants</a>
                <a href="{{ route('courses.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('courses.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Courses</a>
                <a href="{{ route('departments.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('departments.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Departments</a>
            
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center flex-wrap">
                <button class="md:hidden bg-gray-900 text-white p-2 rounded">☰</button>
                <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-md w-full md:w-1/3 mt-2 md:mt-0">
                <div class="flex items-center space-x-4 mt-2 md:mt-0">
                    <span>Admin</span>
                    <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User Avatar">
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>