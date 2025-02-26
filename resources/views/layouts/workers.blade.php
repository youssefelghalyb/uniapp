<!-- resources/views/components/app-layout.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? config('app.name') }}</title>
    
    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .purple-blue-gradient {
            background: linear-gradient(0deg, rgba(39,86,198,1) 38%, rgba(161,9,245,1) 96%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div id="app" class="flex h-screen">
        <!-- Sidebar with gradient background -->
        <div class="purple-blue-gradient w-64 flex-shrink-0 text-white hidden md:block">
            <div class="p-6">
                <div class="text-2xl font-bold mb-8"> Uni Advisor</div>
                
                <!-- Navigation Links -->
                <nav class="space-y-6">
                    <a href="{{route('student-dashboard')}}" class="flex items-center space-x-3 opacity-80 hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{route('student-requests.index')}}" class="flex items-center space-x-3 opacity-80 hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span>Requests</span>
                    </a>
                    <a href="{{route('student-meetings.index')}}" class="flex items-center space-x-3 opacity-80 hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        <span>Meetings</span>
                    </a>
                    <a href="{{route('student-faq.index')}}" class="flex items-center space-x-3 opacity-80 hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" />
                        </svg>
                        <span>FAQ</span>
                    </a>
                </nav>
            </div>
            
            <!-- User profile section at bottom of sidebar -->
            <div class="absolute bottom-0 w-full p-6">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-white/20"></div>
                    <div>
                        <div class="font-medium">{{Auth::user()->name}}</div>
                        <div class="text-sm opacity-70">{{Auth::user()->email}}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile sidebar button and header -->
        <div class="md:hidden fixed top-0 left-0 right-0 z-10 bg-white border-b border-gray-200 px-4 py-2">
            <div class="flex justify-between items-center">
                <button class="text-indigo-600" id="mobile-menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="text-xl font-bold text-indigo-700">{{ config('app.name') }}</div>
                <div class="w-6"></div> <!-- Empty div for flex spacing -->
            </div>
        </div>
        
        <!-- Mobile sidebar (hidden by default) -->
        <div class="md:hidden fixed inset-0 z-20 purple-blue-gradient transform -translate-x-full transition-transform duration-300" id="mobile-menu">
            <div class="flex justify-end p-4">
                <button class="text-white" id="close-mobile-menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <nav class="space-y-6">
                    <a href="#" class="flex items-center space-x-3 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span>Home</span>
                    </a>
                    <!-- More mobile nav items... -->
                </nav>
            </div>
        </div>

        <!-- Main content area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Main content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 mt-12 md:mt-0">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0 text-gray-600">
                            <p>&copy; {{ date('Y') }} Uni Advisor. All rights reserved.</p>
                        </div>
                        <div class="flex space-x-4 text-indigo-600">
                            <a href="#" class="hover:text-indigo-800 transition">Privacy Policy</a>
                            <a href="#" class="hover:text-indigo-800 transition">Terms of Service</a>
                            <a href="#" class="hover:text-indigo-800 transition">Contact</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript for mobile menu toggle -->
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.remove('-translate-x-full');
        });
        
        document.getElementById('close-mobile-menu')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('-translate-x-full');
        });
    </script>
</body>
</html>