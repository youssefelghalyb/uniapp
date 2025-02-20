<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-2xl font-bold">1,250</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Sales</h2>
            <p class="text-2xl font-bold">$45,000</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Orders</h2>
            <p class="text-2xl font-bold">320</p>
        </div>
    </div>
    
    <div class="mt-6 bg-white p-6 rounded-lg shadow overflow-x-auto">
        <h2 class="text-xl font-bold mb-4">Recent Transactions</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="p-2">User</th>
                    <th class="p-2">Amount</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-2">John Doe</td>
                    <td class="p-2">$250</td>
                    <td class="p-2 text-green-500">Completed</td>
                </tr>
                <tr class="border-b">
                    <td class="p-2">Jane Smith</td>
                    <td class="p-2">$130</td>
                    <td class="p-2 text-yellow-500">Pending</td>
                </tr>
                <tr>
                    <td class="p-2">Mike Johnson</td>
                    <td class="p-2">$75</td>
                    <td class="p-2 text-red-500">Failed</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
