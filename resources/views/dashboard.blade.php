<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <canvas id="chart" class="w-full h-64"></canvas>
                </div>
            </div>
        </div>
    </div>



    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: {!! json_encode($datasets) !!}
            },
            options: {
                elements: {
                    line: {
                        borderColor: 'black'
                    }
                }
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {!! json_encode($attendance) !!},
                eventClick: function(info) {
                    var formattedDate = info.event.startStr;
                    console.log('Event clicked: ' + formattedDate); // Debug: print the event start date to the console
                    window.location.href = '{{ route("calendar.index") }}?date=' + formattedDate;
                }
            });

            calendar.render();
        });


    </script>

</x-app-layout>
