import * as toolTip from './toolTip.js';

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

    function getUrlOnSuccess() {
        let url = location.href;
        url += `&flightGoId=${selectedBtns.RESERVE_BTN_GO.getAttribute('data-flight-id')}`;
        url += `&flightBackId=${selectedBtns.RESERVE_BTN_BACK.getAttribute('data-flight-id')}`;
        return url;
    }

    flightTicketsGo.forEach((btn) => {

        btn.addEventListener('click', function (e) {
            e.target.focus();
            if (btn.getAttribute('data-status') != 'locked')
                selectFlightBookBtn(this, RESERVE_BTN_GO);

        })


        // Quando ganha o focus no mobile entao amostra o tooltip
        btn.addEventListener('focus', function () {
            toolTip.setForceOpenToolTip(btn, true);
        });
        // Quando perde o focus no mobile entao esconde o tooltip
        btn.addEventListener('blur', function () {
            toolTip.setForceOpenToolTip(btn, false);
        });
    })

    flightTicketsBack.forEach((btn) => {
        btn.addEventListener('click', function (e) {

            e.target.focus();
            if (btn.getAttribute('data-status') != 'locked')
                selectFlightBookBtn(this, RESERVE_BTN_BACK);
        })

        // Quando ganha o focus no mobile entao amostra o tooltip
        btn.addEventListener('focus', function () {
            toolTip.setForceOpenToolTip(btn, true);
        });
        // Quando perde o focus no mobile entao esconde o tooltip
        btn.addEventListener('blur', function () {
            toolTip.setForceOpenToolTip(btn, false);
        });
    })


    function selectFlightBookBtn(btn, type) {
        // Se já foi selecionado então dá reset
        if (selectedBtns[type] === btn) {
            selectedBtns[type] = null;

            unlockAllOtherBtns(type);
            resetReserveBtn(btn);

        } else {
            selectedBtns[type] = btn;

            // Verifica se já tão todos os butões necessários selecionados, se sim então redireciona a página
            if (!hasAllBtnTypesSelected()) {
                resetOtherBtnTypes();
            } else {
                location.href = getUrlOnSuccess();
            }


            btn.setAttribute('data-status', 'selected');
            btn.querySelector('[data-book-btn-text').textContent = "Selecionado";

            lockAllOtherBtns(type);
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

    function lockAllOtherBtns(type) {
        let btnsToLock;
        let titleForToolTip;
        switch (type) {
            case RESERVE_BTN_BACK:
                btnsToLock = flightTicketsBack;
                titleForToolTip = 'Já tem o voo de volta selecionado!';
                break;
            case RESERVE_BTN_GO:
                btnsToLock = flightTicketsGo;
                titleForToolTip = 'Já tem o voo de ida selecionado!';
                break;
        }

        btnsToLock.forEach((btn) => {
            if (btn.getAttribute('data-status') === 'selected') return;

            btn.setAttribute('data-status', 'locked');
            toolTip.addTooltip(btn, titleForToolTip);

        })
    }

    function unlockAllOtherBtns(type) {
        let btnsToUnlock;
        switch (type) {
            case RESERVE_BTN_BACK:
                btnsToUnlock = flightTicketsBack;
                break;
            case RESERVE_BTN_GO:
                btnsToUnlock = flightTicketsGo;
                break;
        }

        btnsToUnlock.forEach((btn) => {
            if (btn.getAttribute('data-status') === 'selected') return;

            btn.setAttribute('data-status', '');
            toolTip.removeToolTip(btn);
        })
    }


}



