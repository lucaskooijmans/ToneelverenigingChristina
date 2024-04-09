<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let initialView = window.innerWidth < 768 ? 'timeGridDay' : 'timeGridWeek';
            let buttonText = window.innerWidth < 768 ? { today: 'Vandaag'} : { today: 'Deze week'};

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: initialView,
                slotMinTime: '8:00:00',
                slotMaxTime: '24:00:00',
                firstDay: 1,
                locale: 'nl',
                buttonText: buttonText,
                events: @json($events),

                eventContent: function(info) {
                    return {
                        html: '<b>' + info.timeText + '</b><br>' + info.event.title + ' (' + info.event.extendedProps.available_seats + ')'
                    };
                },

                eventClick: function(info) {
                    window.location.href = "{{ route('performances.show', ':id') }}".replace(':id', info.event.id);
                },



            });

            calendar.render();
        });
    </script>

    <style>
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>

</head>

<body>
    <x-navbar />
    <h1>Agenda</h1>
    <div id="calendar"></div>
</body>

</html>
