window.FrontendBookRecordApi = window.FrontendBookRecordApi || {};

(function (exports) {

    'use strict';

    exports.getCustomerAppointments = function (lineUserId){
        var url = GlobalVariables.baseUrl + '/index.php/record/get_appointments_from_line_id';
        var data = {
            csrfToken: GlobalVariables.csrfToken,
            lineUserId: lineUserId,
        };

        // ajax
        $.post(url, data)
            .done(function (response) {
                if (response) {
                    var html = '';
                    response.forEach(function(response, idx)
                    {
                        html += `<tr>
                                    <td>${response.book_datetime}</td>
                                    <td>${response.start_datetime} - ${response.end_datetime.replace(/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\s/ig, '')}</td>
                                    <td>${response.id_services}</td>
                                    <td>${response.situation}</td>
                                </tr> `;
                    });
                    $('.table tbody').html(html);
                }
            });

}

})(window.FrontendBookRecordApi);