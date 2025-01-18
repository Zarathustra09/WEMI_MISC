<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Action Buttons -->
            <div class="flex justify-end mb-6 gap-4">
                <a href="{{route('pos.store')}}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-5 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center" id="saveAttendance">
                    <i class="fas fa-check-circle mr-2"></i>
                    Mark Present
                </a>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center" id="createUser">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add New User
                </button>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                        <thead>
                        <tr>
                            <th class="px-6 py-4 bg-gray-50 text-sm font-semibold text-gray-600 uppercase tracking-wider text-center">Full Name</th>
                            <th class="px-6 py-4 bg-gray-50 text-sm font-semibold text-gray-600 uppercase tracking-wider text-center">Select</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-no-wrap text-center text-gray-700">{{$user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded" data-user-id="{{$user->id}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var selectedItems = [];

            var table = $('#dataTable').DataTable({
                lengthChange: false,
                info: true,
                paging: true,
                ajax: {
                    url: '/pos/getData',
                    dataSrc: 'data'
                },
                columns: [
                    {
                        data: 'first_name',
                        render: function(data, type, row) {
                            return row.first_name + ' ' + row.last_name;
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return '<input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded" data-user-id="' + data + '">';
                        },
                        className: 'text-center'
                    }
                ]
            });

            $('#dataTable tbody').on('click', 'input[type="checkbox"]', function() {
                var userId = $(this).data('user-id');
                if ($(this).is(':checked')) {
                    selectedItems.push(userId);
                } else {
                    selectedItems = selectedItems.filter(function(id) {
                        return id !== userId;
                    });
                }
                console.log('Selected Items:', selectedItems);
            });

            $('#saveAttendance').on('click', function(e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '/pos/store',
                    data: {
                        checkedUsers: selectedItems,
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.info) {
                            toastr.info(response.info, 'Info');
                        } else if (response.success) {
                            toastr.success(response.success, 'Success');
                        }
                        $('input[type="checkbox"]:checked').prop('checked', false);
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#createUser').on('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Add New User',
                    html: `
                        <div class="space-y-4 mt-4">
                            <div class="relative">
                                <input id="first_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="First Name">
                            </div>
                            <div class="relative">
                                <input id="middle_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Middle Name">
                            </div>
                            <div class="relative">
                                <input id="last_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Last Name">
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Create User',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        container: 'custom-swal-container',
                        popup: 'rounded-xl shadow-xl',
                        header: 'border-b pb-4',
                        title: 'text-xl font-semibold text-gray-800',
                        confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-150 ease-in-out mr-2',
                        cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-150 ease-in-out'
                    },
                    buttonsStyling: false,
                    preConfirm: () => {
                        return {
                            first_name: document.getElementById('first_name').value,
                            middle_name: document.getElementById('middle_name').value,
                            last_name: document.getElementById('last_name').value
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            type: 'POST',
                            url: '{{ route("pos.userCreate") }}',
                            data: {
                                first_name: result.value.first_name,
                                middle_name: result.value.middle_name,
                                last_name: result.value.last_name,
                                _token: csrfToken
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.success,
                                    customClass: {
                                        popup: 'rounded-xl',
                                        title: 'text-xl font-semibold text-gray-800',
                                        confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-150 ease-in-out'
                                    },
                                    buttonsStyling: false
                                });
                                table.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while creating the user.',
                                    customClass: {
                                        popup: 'rounded-xl',
                                        title: 'text-xl font-semibold text-gray-800',
                                        confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-150 ease-in-out'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
