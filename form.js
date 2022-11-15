const REQUIRED_ERROR_MULTIPLE_INPUTS = "Campos obrigatórios!";
const REQUIRED_ERROR_SINGLE_INPUT = "Campo obrigatório!";

const forms = document.querySelectorAll(".form");
const formInputs = document.querySelectorAll(".form__input");

formInputs.forEach((input) => {
    if (input.value !== "") {
        input.setAttribute('data-validate', true);
        checkInputValidity(input);
    }

    input.addEventListener('keyup', () => {
        input.classList.remove("invalid");
        input.setAttribute('data-validate', true);
        checkInputValidity(input);
    })
})

forms.forEach((form) => {
    form.addEventListener('submit', (e) => {

        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }


        let inputs = form.querySelectorAll(".form__input");
        let firstWrongInputHasFocus = false;

        inputs.forEach((input) => {
            if (!checkInputValidity(input)) {
                input.classList.add("invalid");

                if (!firstWrongInputHasFocus) {
                    input.focus();
                    firstWrongInputHasFocus = true;
                }

            }
        })
    })
})

function checkInputValidity(input) {
    let parentFormGroup = input.closest(".form__group");
    let inputError = parentFormGroup.querySelector(".input__error");

    if (!input.checkValidity()) {

        let title = input.getAttribute("title");

        if (input.value == "") {

            if (input.getAttribute("required") !== null) {
                // Significa que e um group com dois inputs que partilham o mesmo error
                if (parentFormGroup.querySelectorAll(".form__input").length != 1)
                    inputError.innerHTML = REQUIRED_ERROR_MULTIPLE_INPUTS;
                else
                    inputError.innerHTML = REQUIRED_ERROR_SINGLE_INPUT;
            }
            else
                inputError.innerHTML = title;

        }
        else {
            input.parentElement.querySelector(".input__error").innerHTML = title;
        }

        return false;

    } else {
        input.parentElement.querySelector(".input__error").innerHTML = "";
        return true;
    }
}

