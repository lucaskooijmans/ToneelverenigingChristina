<script>
    @if ($upcomingPerformance)
        let upcomingPerformance = @json($upcomingPerformance);
    @endif
</script>
<script src="{{ asset('js/countdown.js') }}"></script>

<section class="aankomend">
    <div class="container">
        @if ($upcomingPerformance)
            <h1>{{ $upcomingPerformance->name }}</h1>
            <div class="countdown" id="countdown">
                <div class="countdown-item">
                    <span id="days"></span>
                    <p>dagen</p>
                </div>
                <div class="countdown-item">
                    <span id="hours"></span>
                    <p>uren</p>
                </div>
                <div class="countdown-item">
                    <span id="minutes"></span>
                    <p>minuten</p>
                </div>
                <div class="countdown-item">
                    <span id="seconds"></span>
                    <p>seconden</p>
                </div>
            </div>
        @else
            <p>Er is geen aankomende Voorstelling gepland</p>
        @endif
    </div>
</section>


