<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-5">
                <a href="{{route('pos.store')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center" id="saveAttendance">
                    <i class="fas fa-check-circle mr-2"></i> <!-- Font Awesome check-circle icon -->
                    Present
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">Full Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">Select</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">{{$user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" data-user-id="{{$user->id}}">
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

            $('#saveAttendance').on('click', function(e) {
                e.preventDefault();
                var checkedUsers = [];
                $('input[type="checkbox"]:checked').each(function() {
                    checkedUsers.push($(this).data('user-id'));
                });

                // Get the CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Send the array to the controller using AJAX with the CSRF token
                $.ajax({
                    type: 'POST',
                    url: '/pos/store',
                    data: {
                        checkedUsers: checkedUsers,
                        // Include the CSRF token in the request data
                        _token: csrfToken
                    },
                    success: function(response) {
                        // Handle success response if needed
                        console.log(response);
                        toastr.success('Attendance saved successfully!', 'Success');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response if needed
                        console.error(xhr.responseText);
                    }
                });
            });
        });


    </script>
</x-app-layout>
