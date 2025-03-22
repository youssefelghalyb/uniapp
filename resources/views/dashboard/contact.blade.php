<!-- resources/views/contact/index.blade.php -->
<x-workers-layout>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-indigo-800">Contact Us</h1>
        
        <!-- Contact Form -->
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            
            <!-- Message Input -->
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                <textarea id="message" name="message" rows="6" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Type your message here..."></textarea>
                
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="w-full md:w-auto px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Send Message
                </button>
            </div>
        </form>
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-workers-layout>