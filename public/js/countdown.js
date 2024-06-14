console.log('test 2')

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
    let daysElement = document.querySelector("#days");
    if (daysElement.innerHTML != days) {
        daysElement.innerHTML = days;
        daysElement.classList.add("changed");
        remove(daysElement)
    }

    let hoursElement = document.querySelector("#hours");
    if (hoursElement.innerHTML != hours) {
        hoursElement.innerHTML = hours;
        hoursElement.classList.add("changed");
        remove(hoursElement)
    }

    let minutesElement = document.querySelector("#minutes");
    if (minutesElement.innerHTML != minutes) {
        minutesElement.innerHTML = minutes;
        minutesElement.classList.add("changed");
        remove(minutesElement)
    }

    let secondsElement = document.querySelector("#seconds");
    if (secondsElement.innerHTML != seconds) {
        secondsElement.innerHTML = seconds;
        secondsElement.classList.add("changed");
        remove(secondsElement)
    }

    // If the countdown is over, display a message
    if (distance < 0) {
        clearInterval(x);
        document.querySelector("#countdown").innerHTML = "EXPIRED";
    }
}, 1000);

function remove(element) {
    setTimeout(() => {
        element.classList.remove("changed");
    }, 500);
}