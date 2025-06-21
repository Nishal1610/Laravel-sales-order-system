<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf

                    @include('products.form')

                    <div class="mt-4 flex space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" style="background-color: slateblue;">
                            Create
                        </button>&nbsp;&nbsp;
                        <a href="{{ route('admin.products') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500" style="background-color: gray;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
