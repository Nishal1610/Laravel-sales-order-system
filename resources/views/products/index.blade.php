<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-600 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.products.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"  >
                    Add New Product
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 dark:border-gray-700" style="width: 100%;">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">SKU</th>
                                <th class="px-4 py-2 border">Price</th>
                                <th class="px-4 py-2 border">Quantity</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @forelse($products as $product)
                                <tr class="text-gray-700 dark:text-gray-300">
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">{{ $product->sku }}</td>
                                    <td class="px-4 py-2 border">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ $product->quantity }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('admin.products.edit', $product) }}" style="background: #939309;"
                                           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-2 py-1 rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                              class="inline-block" 
                                              onsubmit="return confirm('Are you sure to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: red;"
                                                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-2 py-1 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center px-4 py-2 border">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
