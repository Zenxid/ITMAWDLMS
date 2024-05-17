let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
    notification.classList.toggle('active');
}

/* ------------------------- END OF NOTIFICATION AND BORROW BOOK JS ------------------- */

const display = document.getElementById('clock');

function updateTime() {
    const date = new Date();

    const hour = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();

    display.innerText=`${hour} : ${minutes} : ${seconds}`;
}

function formatTime(time) {
    if ( time < 10) {
        return '0' + time;
    }
    return time;
}

setInterval(updateTime, 1000)

function countdown() {
    const time = document.querySelector("#time");
    let hours = 24;
    let minutes = 0;
    let seconds = 0;

    const interval = setInterval(() => {
        if (hours === 0 && minutes === 0 && seconds === 0) {
            clearInterval(interval);
            alert("Countdown finished!");
            return;
        }

        // Decrease seconds by 1
        if (seconds === 0) {
            if (minutes === 0) {
                hours -= 1;
                minutes = 59;
            } else {
                minutes -= 1;
            }
            seconds = 59;
        } else {
            seconds -= 1;
        }

        // Format the time
        const formattedHours = hours < 10 ? "0" + hours : hours;
        const formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
        const formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

        // Update the time display
        time.textContent = formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;
    }, 1000);
}

countdown();