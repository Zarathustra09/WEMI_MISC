<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Attendance Report -->
                <div class="col-span-1 md:col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            Attendance Report
                        </h3>

                        <form action="{{ route('report.attendance') }}" method="POST" class="mt-4">
                            @csrf
                            <!-- Report Type -->
                            <div class="mb-4">
                                <label for="report_type" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                    Report Type
                                </label>
                                <select id="report_type" name="report_type" class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:focus:bg-gray-700">
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="semi-annualy">Semi-Annually</option>
                                    <option value="annually">Annually</option>
                                </select>
                            </div>

                            <!-- Generate Button -->
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Generate Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>
