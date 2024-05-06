<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-5">
                <a href="{{ route('dedications.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> <!-- Font Awesome plus-circle icon -->
                    Add
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Middle Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                            <!-- Add more table headers as needed -->
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{$user->first_name}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{$user->middle_name}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{$user->last_name}}</td>

                                <!-- Add more table cells for other fields as needed -->
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <a href="" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                    </a>


                                    <a href=""  class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-print"></i> <!-- Font Awesome print icon -->
                                    </a>
                                </td>
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

        function showDeleteModal(id) {
            document.getElementById('deleteForm').action = '/dedications/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>


</x-app-layout>
