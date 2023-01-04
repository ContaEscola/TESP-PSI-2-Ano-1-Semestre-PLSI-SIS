const flightFormTwoWay = document.querySelector('.flight-search-form[data-add-two-way-functionality]');

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
            selectFlightBookBtn(this, RESERVE_BTN_GO);
        })
    })

    flightTicketsBack.forEach((btn) => {
        btn.addEventListener('click', function () {
            selectFlightBookBtn(this, RESERVE_BTN_BACK);
        })
    })


    function selectFlightBookBtn(btn, type) {
        // Se já foi selecionado então dá reset
        if (selectedBtns[type] === btn) {
            resetReserveBtn(btn);

        } else {
            selectedBtns[type] = btn;

            // Verifica se já tão todos os butões necessários selecionados
            if (!hasAllBtnTypesSelected())
                resetOtherBtnTypes();

            // btn.setAttribute('data-status', 'selected');
            // btn.querySelector('[data-book-btn-text').textContent = "Selecionado";
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
}


