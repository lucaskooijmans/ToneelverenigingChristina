// Get the datetime of the voorstelling from PHP
let voorstellingDatetime = new Date(upcomingPerformance.starttime).getTime();

// Update the countdown every second
let x = setInterval(function() {
    // Get the current datetime
    let now = new Date().getTime();

    // Calculate the remaining time
    let distance = voorstellingDatetime - now;

    // Calculate days, hours, minutes, seconds
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the countdown in the corresponding spans
    document.querySelector("#days").innerHTML = days;
    document.querySelector("#hours").innerHTML = hours;
    document.querySelector("#minutes").innerHTML = minutes;
    document.querySelector("#seconds").innerHTML = seconds;

    // If the countdown is over, display a message
    if (distance < 0) {
        clearInterval(x);
        document.querySelector("#countdown").innerHTML = "EXPIRED";
    }
}, 1000);

