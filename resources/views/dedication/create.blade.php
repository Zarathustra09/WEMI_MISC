<!-- resources/views/dedications/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Dedication') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('dedications.store') }}" method="POST">
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
                        <label for="father_name" class="block text-gray-700 text-sm font-bold mb-2">Father Name</label>
                        <input type="text" name="father_name" id="father_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter father name">
                    </div>

                    <div class="mb-4">
                        <label for="mother_name" class="block text-gray-700 text-sm font-bold mb-2">Mother Name</label>
                        <input type="text" name="mother_name" id="mother_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter mother name">
                    </div>

                    <div class="mb-4">
                        <label for="date_dedicated" class="block text-gray-700 text-sm font-bold mb-2">Date Dedicated</label>
                        <input type="date" name="date_dedicated" id="date_dedicated" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                        <a href="{{ route('dedications.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>