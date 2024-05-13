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

<script>
    @if ($upcomingPerformance)
        // Get the datetime of the voorstelling from PHP
        var voorstellingDatetime = new Date("{{ $upcomingPerformance->starttime }}").getTime();

        // Update the countdown every second
        var x = setInterval(function() {
            // Get the current datetime
            var now = new Date().getTime();
          
            // Calculate the remaining time
            var distance = voorstellingDatetime - now;
          
            // Calculate days, hours, minutes, seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          
            // Display the countdown in the corresponding spans
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;
          
            // If the countdown is over, display a message
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    @endif
</script>
