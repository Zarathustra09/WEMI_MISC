
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit BC') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('bc.update', $beginner->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container mx-auto mt-10">

                        <div class="mb-4">
                            <label for="" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                            <input type="text" name="" id="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $beginner->user->first_name . ' ' . $beginner->user->last_name }}" readonly>
                        </div>

                    <div class="mb-4">
                        <label for="date_started" class="block text-gray-700 text-sm font-bold mb-2">Date Started</label>
                        <input type="date" name="date_started" id="date_started" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $beginner->date_started->format('Y-m-d') }}">
                    </div>

                    <div class="mb-4">
                        <label for="date_graduated" class="block text-gray-700 text-sm font-bold mb-2">Date Graduated</label>
                        <input type="date" name="date_graduated" id="date_graduated" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $beginner->date_graduated ? $beginner->date_graduated->format('Y-m-d') : '' }}">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('bc.index') }}" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-times"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
