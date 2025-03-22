<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for handling sidebar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen flex-col md:flex-row">
        <!-- Mobile Sidebar Backdrop -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>
        
        <!-- Sidebar -->
        <aside 
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
            class="fixed top-0 left-0 z-30 w-64 h-full bg-gray-900 text-white p-5 space-y-6 transform transition-transform duration-200 ease-in-out md:relative md:translate-x-0">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <button @click="sidebarOpen = false" class="p-2 rounded-md hover:bg-gray-700 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav>
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Dashboard</a>
                <a href="{{ route('users.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('users.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Users</a>
                <a href="{{ route('students.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('students.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Students</a>
                <a href="{{ route('advisors.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('advisors.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Advisors</a>
                <a href="{{ route('courses.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('courses.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Courses</a>
                <a href="{{ route('departments.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('departments.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Departments</a>
                <hr class="my-2 border-gray-700">
                <a href="{{ route('contacts.list') }}" class="block py-2 px-4 rounded {{ request()->routeIs('contact-list.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Messages</a>
                <a href="{{ route('topics.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('topics.*') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">Topics</a>
                <hr>
                <form  action="{{route('logout')}}" method="POST" class="mt-5 flex items-center space-x-3 opacity-80 hover:opacity-100 transition">
                    @csrf
                    
                    <button type="submit" class="text-red-500">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:pl-0">
            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden bg-gray-900 text-white p-2 rounded mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-md w-full md:w-64">
                </div>
                <div class="flex items-center space-x-4">
                    <span>Admin</span>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 overflow-y-auto flex-1">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('errors'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('errors') }}
                    </div>
                @endif
                
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>