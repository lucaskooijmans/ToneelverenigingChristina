<script>
    @if ($upcomingPerformance)
        let upcomingPerformance = @json($upcomingPerformance);
    @endif
</script>
<script src="{{ asset('js/countdown.js') }}"></script>

<section class="aankomend"
    style="@if ($upcomingPerformance) background-image: url('/images/{{ $upcomingPerformance->image }} @endif')">
    <div class="container">
        @if ($upcomingPerformance)
            <h1>{{ $upcomingPerformance->name }}</h1>
            <div class="countdown" id="countdown">
                <div class="countdown-item">
                    <span id="days" class="observable"></span>
                    <p>dagen</p>
                </div>
                <div class="countdown-item">
                    <span id="hours" class="observable"></span>
                    <p>uren</p>
                </div>
                <div class="countdown-item">
                    <span id="minutes" class="observable"></span>
                    <p>minuten</p>
                </div>
                <div class="countdown-item">
                    <span id="seconds" class="observable"></span>
                    <p>seconden</p>
                </div>
            </div>
            <div class="pulsing-button-container">
                <a class="button pulsing-button" tabindex="0" title="Koop kaarten voor de voorstelling {{ $upcomingPerformance->name }}"
                    href="{{ route('performances.show', $upcomingPerformance->id) }}">Kaarten Kopen</a>
            </div>
        @else
            <p>Er is geen aankomende Voorstelling gepland</p>
        @endif
    </div>
</section>
