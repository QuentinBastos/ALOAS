document.addEventListener("DOMContentLoaded", function () {
    let timer;
    let isRunning = false;
    let seconds = 0;

    function updateDisplay() {
        let mins = Math.floor(seconds / 60).toString().padStart(2, "0");
        let secs = (seconds % 60).toString().padStart(2, "0");
        document.getElementById("timerDisplay").innerText = `${mins}:${secs}`;
    }

    function startStopTimer() {
        const btn = document.getElementById("startStopBtn");

        if (isRunning) {
            clearInterval(timer);
            btn.innerText = "Démarrer";
            btn.classList.replace("bg-red-500", "bg-blue-500");
        } else {
            timer = setInterval(() => {
                seconds++;
                updateDisplay();
            }, 1000);
            btn.innerText = "Arrêter";
            btn.classList.replace("bg-blue-500", "bg-red-500");
        }
        isRunning = !isRunning;
    }

    function resetTimer() {
        clearInterval(timer);
        seconds = 0;
        isRunning = false;
        updateDisplay();
        const btn = document.getElementById("startStopBtn");
        btn.innerText = "Démarrer";
        btn.classList.replace("bg-red-500", "bg-blue-500");
    }

    document.getElementById("startStopBtn").addEventListener("click", startStopTimer);
    document.getElementById("resetBtn").addEventListener("click", resetTimer);
});