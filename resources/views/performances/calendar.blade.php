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
            let buttonText = window.innerWidth < 768 ? {
                today: 'Vandaag'
            } : {
                today: 'Deze week'
            };

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: initialView,
                slotMinTime: '8:00:00',
                slotMaxTime: '24:00:00',
                firstDay: 1,
                locale: 'nl',
                buttonText: buttonText,
                nowIndicator: true,
                events: @json($events),

                eventContent: function(info) {
                    return {
                        html: '<b>' + info.timeText + '</b><br>' + info.event.title + ' (' + info.event
                            .extendedProps.available_seats + ')'
                    };
                },

                eventClick: function(info) {
                    window.location.href = "{{ route('performances.show', ':id') }}".replace(':id', info
                        .event.id);
                },

                eventDidMount: function(info) {
                    if (info.event.end < new Date()) {
                        info.el.style.backgroundColor = 'lightgrey';
                        info.el.style.borderColor = 'lightgrey';
                        info.event.setProp('title', info.event.title + ' (VERLOPEN)');
                    }


                    if (info.event.extendedProps.available_seats > 10 && info.event.end > new Date()) {
                        info.el.style.backgroundColor = 'green';
                        info.el.style.borderColor = 'green';
                    } else if (info.event.extendedProps.available_seats > 5 && info.event.extendedProps
                        .available_seats <= 10 && info.event.end > new Date()) {
                        info.el.style.backgroundColor = 'orange';
                        info.el.style.borderColor = 'orange';
                    } else if (info.event.extendedProps.available_seats > 0 && info.event.extendedProps
                        .available_seats <= 5 && info.event.end > new Date()) {
                        info.el.style.backgroundColor = 'orangered';
                        info.el.style.borderColor = 'orangered';
                    } else if (info.event.extendedProps.available_seats === 0 && info.event.end >
                        new Date()) {
                        info.el.style.backgroundColor = 'red';
                        info.el.style.borderColor = 'red';
                        info.event.setProp('title', info.event.title + ' (UITVERKOCHT)');
                    }

                }

            });

            calendar.render();
        });
    </script>

</head>

<body>
    <x-navbar />
    <div class="calendar">
        <div class="container">
            <h1>Agenda</h1>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('performances.index') }}" class="button blue-button" tabindex="3">
                        <i class="fas fa-info-circle"></i> Beheer voorstellingen
                    </a>
                @endif
            @endauth
            <div id="calendar"></div>
        </div>
    </div>
</body>

</html>
