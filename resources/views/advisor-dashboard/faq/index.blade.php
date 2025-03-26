<!-- resources/views/faq/index.blade.php -->
<x-workers-layout>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold mb-6 text-indigo-800">Frequently Asked Questions</h1>
        

        <!-- Add New FAQ Form -->
        <div class="bg-indigo-50 rounded-lg p-6 mb-6 border border-indigo-100">
            <h2 class="text-xl font-semibold text-indigo-800 mb-4">Add New FAQ</h2>
            
            <form action="{{ route('advisor-faq.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Topic Selection -->
                    <div>
                        <label for="new_topic_id" class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                        <select id="new_topic_id" name="topic_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select a Topic</option>
                            @foreach($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Question Input -->
                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                        <input type="text" id="question" name="question" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Enter the frequently asked question">
                    </div>
                    
                    <!-- Answer Input -->
                    <div>
                        <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
                        <textarea id="answer" name="answer" rows="4" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Enter the answer to the question"></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                            class="w-full md:w-auto px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Add FAQ
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Search and Filter Form -->
        <form action="{{ route('student-faq.index') }}" method="GET" class="mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Topic Filter -->
                <div class="w-full md:w-1/3">
                    <label for="topic_id" class="block text-sm font-medium text-gray-700 mb-1">Filter by Topic</label>
                    <select id="topic_id" name="topic_id" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">All Topics</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}" {{ request('topic_id') == $topic->id ? 'selected' : '' }}>
                                {{ $topic->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Search Input -->
                <div class="w-full md:w-2/3">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="flex">
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                            class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Search questions or answers...">
                        <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Reset Filters Button (only show if filters are active) -->
            @if(request('topic_id') || request('search'))
                <div class="mt-2 text-right">
                    <a href="{{ route('student-faq.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        Clear filters
                    </a>
                </div>
            @endif
        </form>
        
        <!-- No Results Message -->
        @if($noResults)
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">
                            No FAQs found matching your filters. 
                            <a href="{{ route('student-faq.index') }}" class="font-medium underline hover:text-yellow-700">
                                View all FAQs
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- FAQ Accordion -->
        <div class="space-y-4">
            @forelse($faqs as $faq)
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <!-- Topic Badge - only show if not filtering by topic -->
                    @if(!request('topic_id'))
                        <div class="bg-indigo-50 p-1 rounded-sm text-indigo-800 text-xs font-semibold  rounded-br inline-block">
                            {{ $faq->topic->name }}
                        </div>
                    @endif
                    
                    <!-- Question (Header) -->
                    <button @click="open = !open" class="w-full px-4 py-3 text-left bg-white hover:bg-gray-50 focus:outline-none transition">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">{{ $faq->question }}</h3>
                            <span class="ml-6 flex-shrink-0" x-show="!open">
                                <svg class="h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-6 flex-shrink-0" x-show="open">
                                <svg class="h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                    </button>
                    
                    <!-- Answer (Content) -->
                    <div x-show="open" class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                        <div class="prose prose-indigo max-w-none">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    No FAQs available.
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $faqs->withQueryString()->links() }}
        </div>
    </div>
</x-workers-layout>