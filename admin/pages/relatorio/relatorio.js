$(function () {
    var API = ADMIN_BASE_URL + '/services/api/campaign';

    $('#downloadReport').on('click', function () {
        window.location.href = API + '/export_lucky_numbers_report.php';
    });

    $('#generatePrint').on('click', function () {
        window.location.href = ADMIN_BASE_URL + '/bilhetessorteio';
    });
});
