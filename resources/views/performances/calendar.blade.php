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

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: '8:00:00',
                slotMaxTime: '24:00:00',
                firstDay: 1,
                locale: 'nl',
                buttonText: { today: 'Vandaag'},
                events: @json($events)
            });

            calendar.render();
        });
    </script>

</head>

<body>
    <x-navbar />
    <h1>Agenda</h1>
    <div id="calendar"></div>
</body>

</html>
