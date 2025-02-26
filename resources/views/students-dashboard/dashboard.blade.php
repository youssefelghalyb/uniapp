
<!-- resources/views/welcome.blade.php -->
<x-workers-layout>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-6 text-indigo-800">Hello {{$student->user->name}}</h1>
        

                <!-- Example of a purple/blue styled data section -->
                <div class="mt-12 bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-lg">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-800">Advisor Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-purple-600">name</div>
                            <div class="text-gray-600">{{$student->assistants[0]->user->name}}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-indigo-600">Email</div>
                            <div class="text-gray-600">{{$student->assistants[0]->user->email}}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600">10</div>
                            <div class="text-gray-600">Available Hours</div>
                        </div>
                    </div>
                </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <!-- Example card -->
            <div class="bg-white border border-indigo-100 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="text-purple-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-indigo-800">Requests</h3>
                <p class="text-gray-600 my-4">
                    Submit a request to your advisor for help or information.
                </p>
                <a href="{{route('student-requests.index')}}" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Learn More</a>
            </div>
            
            <!-- Example card -->
            <div class="bg-white border border-indigo-100 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="text-indigo-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-indigo-800">Meetings</h3>
                <p class="text-gray-600 my-4">
                    Schedule a meeting with your advisor to discuss your academic progress.
                </p>
                <a href="{{route('student-meetings.index')}}" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">Explore</a>
            </div>
            
            <!-- Example card -->
            <div class="bg-white border border-indigo-100 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-indigo-800">FAQ</h3>
                <p class="text-gray-600 my-4">
                    Browse frequently asked questions to find answers to common queries.
                </p>
                <a href="{{route('student-faq.index')}}" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Get Started</a>
            </div>
        </div>
        

    </div>
</x-workers-layout>