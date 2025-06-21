<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Sales Order') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('sales.orders.store') }}" method="POST">
            @csrf
            <div id="product-list">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="products[0][product_id]" class="block text-sm font-medium">Product</label>
                        <select name="products[0][product_id]" class="form-select w-full">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="products[0][quantity]" class="block text-sm font-medium">Quantity</label>
                        <input type="number" name="products[0][quantity]" class="form-input w-full" min="1" value="1">
                    </div>
                    <div class="flex items-end">
                        <button type="button" class="remove-row bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Remove</button>
                    </div>
                </div>
            </div>

            <button type="button" id="add-product" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mb-4">Add Product</button>

            <div>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded">Submit Order</button>
            </div>
        </form>
    </div>

    <script>
        let index = 1;
        document.getElementById('add-product').addEventListener('click', () => {
            const row = `
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <select name="products[${index}][product_id]" class="form-select w-full">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="number" name="products[${index}][quantity]" class="form-input w-full" min="1" value="1">
                    </div>
                    <div class="flex items-end">
                        <button type="button" class="remove-row bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Remove</button>
                    </div>
                </div>
            `;
            document.getElementById('product-list').insertAdjacentHTML('beforeend', row);
            index++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.grid').remove();
            }
        });
    </script>
</x-app-layout>
