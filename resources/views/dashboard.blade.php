<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Sales</h3>
                    <p class="text-2xl text-green-500 mt-2">₹{{ number_format($totalSales, 2) }}</p>
                </div><br>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Orders</h3>
                    <p class="text-2xl text-blue-500 mt-2">{{ $totalOrders }}</p>
                </div><br>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Low Stock Alerts</h3>
                    <p class="text-2xl text-red-500 mt-2">{{ $lowStockProducts->count() }}</p>
                </div>
            </div>

            {{-- Low Stock Details --}}
            @if ($lowStockProducts->count())
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">Products Low in Stock</h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-200">
                        @foreach ($lowStockProducts as $product)
                            <li>{{ $product->name }} — only {{ $product->quantity }} left</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
