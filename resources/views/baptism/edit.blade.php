<!-- resources/views/baptism/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Baptism Record') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
                <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <form action="{{route('baptism.update', $baptism->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="father_name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                            <input type="text" name="" id="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $baptism->user->first_name . ' ' . $baptism->user->last_name }}" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="date_baptised" class="block text-gray-700 text-sm font-bold mb-2">Date Baptised:</label>
                            <input type="date" name="date_baptised" id="date_baptised" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $baptism->date_baptised->format('Y-m-d') }}" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('baptism.index') }}" class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
