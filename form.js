const formInputs = document.querySelectorAll(".form__input");

formInputs.forEach((input) => {

    if (input.value !== "") {
        input.setAttribute('data-validate', true);
    }

    input.addEventListener('keydown', () => {
        input.setAttribute('data-validate', true);
    })
})