const radioButtons = document.querySelectorAll("[type='radio']");

radioButtons.forEach((radio) => {
    radio.addEventListener('change', () => {
        enable(radio);
    })
})

function enable(radio) {
    radio.parentElement.setAttribute('data-active', true);

    let group = radio.closest('.form__group');
    let allOtherRadios = group.querySelectorAll("[type='radio']:not(:checked)");

    allOtherRadios.forEach((otherRadio) => {
        disable(otherRadio);
    })
}

function disable(radio) {
    radio.parentElement.setAttribute('data-active', false);
}