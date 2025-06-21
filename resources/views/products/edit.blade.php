<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('products.form')

                    <div class="mt-4 flex space-x-2">
                        <button type="submit" style="background-color:green;" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Update
                        </button>&nbsp;&nbsp;
                        <a href="{{ route('admin.products') }}" style="background-color:gray;" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
