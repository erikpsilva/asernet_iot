$(document).ready(function () {

    // ── Countdown ────────────────────────────────────────────────────────────

    var dateStr = (typeof SORTEIO_DATE !== 'undefined' && SORTEIO_DATE)
        ? SORTEIO_DATE
        : '2027-01-31T00:00:00-03:00';

    var target = new Date(dateStr).getTime();

    function updateCountdown() {
        var diff = Math.max(0, target - Date.now());

        var days    = Math.floor(diff / 86400000);
        var hours   = Math.floor((diff % 86400000) / 3600000);
        var minutes = Math.floor((diff % 3600000) / 60000);
        var seconds = Math.floor((diff % 60000) / 1000);

        var els = document.querySelectorAll('.home__cruise-countdown strong');
        if (els.length === 4) {
            els[0].textContent = days;
            els[1].textContent = String(hours).padStart(2, '0');
            els[2].textContent = String(minutes).padStart(2, '0');
            els[3].textContent = String(seconds).padStart(2, '0');
        }
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    // ── Modal Regulamento ────────────────────────────────────────────────────

    var $modalReg = $('#modalRegulamentoHome');

    function openModalReg() {
        $modalReg.addClass('cruise-modal--open');
        $('body').css('overflow', 'hidden');
    }

    function closeModalReg() {
        $modalReg.removeClass('cruise-modal--open');
        $('body').css('overflow', '');
    }

    $('#btnVerRegulamentoHome').on('click', function (e) { e.preventDefault(); openModalReg(); });
    $('#btnFecharRegulamentoHome').on('click', closeModalReg);
    $modalReg.on('click', function (e) {
        if (e.target === this) closeModalReg();
    });

});
