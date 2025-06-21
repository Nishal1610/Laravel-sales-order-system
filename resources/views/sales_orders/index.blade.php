
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales Orders') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="mb-6">
                <a href="{{ route('sales.orders.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create New Order
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Order Number</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $order->order_number }}</td>
                                <td class="px-4 py-2" style="text-align: center;">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="px-4 py-2" style="text-align: center;">{{ ucfirst($order->status) }}</td>
                                <td class="px-4 py-2" style="text-align: center;">
                                    <a href="{{ route('sales.orders.pdf', $order) }}" class="text-blue-600 hover:underline">Download PDF</a>
                                </td>
                            </tr>
                        @endforeach
                        @if($orders->isEmpty())
                            <tr><td colspan="4" class="text-center py-4">No orders found.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
