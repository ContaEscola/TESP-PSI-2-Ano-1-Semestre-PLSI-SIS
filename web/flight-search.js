import * as toolTip from './toolTip.js';
import * as screenUtils from './screenUtils.js';

let screenWidth = innerWidth;
window.addEventListener('resize', function () {
    screenWidth = window.innerWidth;
});

const flightFormTwoWay = document.querySelector('.flight-search-form[data-add-two-way-functionality]');

// Verifica se existe o form para ver se quer ou não a funcionalidade
if (flightFormTwoWay !== null) {
    // Seleciona todos os butões do flight tickets para ida 
    const flightTicketsGo = document.querySelectorAll('[data-flight-trip-go] [data-flight-ticket-reserve]');

    // Seleciona todos os butões do flight tickets para volta
    const flightTicketsBack = document.querySelectorAll('[data-flight-trip-back] [data-flight-ticket-reserve]');

    const RESERVE_BTN_GO = "RESERVE_BTN_GO";
    const RESERVE_BTN_BACK = "RESERVE_BTN_BACK";

    function SelectedBtns() {
        this.RESERVE_BTN_GO = null;
        this.RESERVE_BTN_BACK = null;
    }

    const selectedBtns = new SelectedBtns();


    flightTicketsGo.forEach((btn) => {
        btn.addEventListener('click', function () {
            if (btn.getAttribute('data-status') != 'locked')
                selectFlightBookBtn(this, RESERVE_BTN_GO);

        })
    })

    flightTicketsBack.forEach((btn) => {
        btn.addEventListener('click', function () {
            if (btn.getAttribute('data-status') != 'locked')
                selectFlightBookBtn(this, RESERVE_BTN_BACK);
        })
    })


    function selectFlightBookBtn(btn, type) {
        // Se já foi selecionado então dá reset
        if (selectedBtns[type] === btn) {
            selectedBtns[type] = null;
            resetReserveBtn(btn);

            switch (type) {
                case RESERVE_BTN_BACK:
                    unlockAllOtherBtns(flightTicketsBack);
                    break;
                case RESERVE_BTN_GO:
                    unlockAllOtherBtns(flightTicketsGo);
                    break;
            }

        } else {
            selectedBtns[type] = btn;

            // Verifica se já tão todos os butões necessários selecionados
            if (!hasAllBtnTypesSelected()) {
                resetOtherBtnTypes();
            }

            btn.setAttribute('data-status', 'selected');
            btn.querySelector('[data-book-btn-text').textContent = "Selecionado";

            switch (type) {
                case RESERVE_BTN_BACK:
                    lockAllOtherBtns(flightTicketsBack, 'Já tem o voo de volta selecionado!');
                    break;
                case RESERVE_BTN_GO:
                    lockAllOtherBtns(flightTicketsGo, 'Já tem o voo de ida selecionado!');
                    break;
            }


        }


    }

    // https://stackoverflow.com/questions/50619910/how-to-check-if-every-properties-in-an-object-are-null
    function hasAllBtnTypesSelected() {
        return Object.values(selectedBtns).every(o => o != null);
    }

    function resetOtherBtnTypes() {
        Object.entries(selectedBtns).forEach(([key, value]) => {
            if (value === null) return;
            resetReserveBtn(value);
        });

    }

    function resetReserveBtn(btn) {
        btn.setAttribute('data-status', '');
        btn.querySelector('[data-book-btn-text').textContent = "Reservar";
    }

    function lockAllOtherBtns(btns, titleForToolTip) {
        btns.forEach((btn) => {
            if (btn.getAttribute('data-status') === 'selected') return;

            btn.setAttribute('data-status', 'locked');
            toolTip.addTooltip(btn, titleForToolTip);

            // if (screenWidth < screenUtils.SMALL_MEDIA_QUERY) {

            //     btn.addEventListener('touchStart', function () {
            //         toolTip.forceOpenToolTip(btn, true)
            //     });

            //     btn.addEventListener('touchend', function () {
            //         toolTip.forceOpenToolTip(btn, false);
            //     })
            // }
        })
    }

    function unlockAllOtherBtns(btns) {
        btns.forEach((btn) => {
            btn.setAttribute('data-status', '');
            toolTip.removeToolTip(btn);
            // toolTip.forceOpenToolTip(btn, false);
        })
    }


}


