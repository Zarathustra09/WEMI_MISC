<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendees') }} - {{ now()->format('F j, Y') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-5">
                <a href="{{ route('calendar.print', ['date' => $date]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <i class="fas fa-print mr-2"></i>
                    Print
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">Full Name</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($attendances as $attendance)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $attendance->user->first_name }} {{ $attendance->user->last_name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                lengthChange: false,
                info: true,
                paging: true
            });
        });
    </script>
</x-app-layout>
