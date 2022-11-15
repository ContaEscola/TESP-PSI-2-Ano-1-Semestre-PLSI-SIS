const alerts = document.querySelectorAll(".alert");

alerts.forEach((alert) => {

    let alertToggle = alert.querySelector(".alert-toggle-btn");
    let animDuration = window.getComputedStyle(alert).animationDuration;
    animDuration = animDuration.replace("s", " ");

    let durationInMs = animDuration * 1000;
    //Adicionar delay para ter a certeza que fez a animação
    durationInMs += 100;

    alertToggle.addEventListener("click", async () => {
        alert.setAttribute("data-close", true);


        deleteAlertAfterClosing(alert, durationInMs);
    });
})

function deleteAlertAfterClosing(alert, delay) {
    new Promise(() => {
        setTimeout(() => {
            alert.remove();
        }, delay);
    });
}