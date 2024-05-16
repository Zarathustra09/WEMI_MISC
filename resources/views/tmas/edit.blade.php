<!-- resources/views/tmas/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit TMA') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('tmas.update', $tma->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                        <input type="text" name="" id="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $tma->user->first_name . ' ' . $tma->user->last_name }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="date_started" class="block text-gray-700 text-sm font-bold mb-2">Date Started</label>
                        <input type="date" name="date_started" id="date_started" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $tma->date_started->format('Y-m-d') }}">
                    </div>

                    <div class="mb-4">
                        <label for="date_graduated" class="block text-gray-700 text-sm font-bold mb-2">Date Graduated</label>
                        <input type="date" name="date_graduated" id="date_graduated" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $tma->date_graduated ? $tma->date_graduated->format('Y-m-d') : '' }}">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('tmas.index') }}" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-times"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
