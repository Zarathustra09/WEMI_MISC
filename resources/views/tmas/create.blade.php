<!-- resources/views/tmas/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create TMA') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('tmas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter first name">
                    </div>

                    <div class="mb-4">
                        <label for="middle_name" class="block text-gray-700 text-sm font-bold mb-2">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter middle name">
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter last name">
                    </div>

                    <div class="mb-4">
                        <label for="date_started" class="block text-gray-700 text-sm font-bold mb-2">Date Started</label>
                        <input type="date" name="date_started" id="date_started" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="date_graduated" class="block text-gray-700 text-sm font-bold mb-2">Date Graduated</label>
                        <input type="date" name="date_graduated" id="date_graduated" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                        <a href="{{ route('tmas.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
