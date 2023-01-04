const closeModalBtns = document.querySelectorAll("[data-close-modal]");

closeModalBtns.forEach((btn) => {
    btn.addEventListener('click', closeModal)
})

function closeModal() {
    let modal = this.closest('[data-modal]');
    modal.classList.add('hide');
    modal.addEventListener('animationend', function () {
        modal.classList.remove('hide');
        modal.close();
        modal.removeEventListener('animationend', arguments.callee, false);
    })
}