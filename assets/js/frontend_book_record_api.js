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
                var a = response.shift();
                $('.recordCard').empty();        
                var protocol = location.protocol;
                var host = location.host;
                var imageUrl = (a.image && a.image.length > 0) ? a.image : `${protocol}//${host}/assets/img/service_title.png`;
                var card = `<div class="service-card">
                                <div class="img-style">
                                    <img class="img-fluid" src="${imageUrl}">
                                </div>
                                <span class="service-name">${a.name}</span>
                                <div class="word">
                                    <span>簡介</span> 
                                </div>
                                <div class="text-wrap">
                                    <span class="service-price">$ ${a.price}</span>
                                    <span class="service-time">${a.duration} 分鐘</span>
                                </div>
                            </div>`;
                $('.recordCard').html(card);

                $('.appointment-details').empty();
                var detail =`<div>
                                <div class="word">
                                    <span>預約時間 : ${a.start_datetime} - ${a.end_datetime.replace(/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\s/ig, '')}</span> 
                                </div>
                                <div class="word">
                                    <span>狀態 : ${a.situation == 1 ? '審核通過' : '待審核'}</span> 
                                </div>
                            </div>`;
                $('.appointment-details').html(detail);

                var html = '';
                response.forEach(function(response, idx)
                {
                    html += `<tr>
                                <td>${response.book_datetime}</td>                                    
                                <td>${response.start_datetime} - ${response.end_datetime.replace(/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\s/ig, '')}</td>
                                <td>${response.name}</td>
                                <td>${response.situation == 1 ? '審核通過' : '待審核'}</td>
                            </tr> `;
                });
                $('.table tbody').html(html);
            });
    }

})(window.FrontendBookRecordApi);