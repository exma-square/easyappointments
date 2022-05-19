window.FrontendBookRecord = window.FrontendBookRecord || {};

(function (exports) {

    'use strict';

    exports.initialize = function (defaultEventHandlers, manageMode) {
        defaultEventHandlers = defaultEventHandlers || true;
        manageMode = manageMode || false;
        
        liff
        .init({ liffId: GlobalVariables.lineLiff })
        .then(() => {
            liff.getProfile()
            .then(profile => {
                const userid = profile.userId;
                FrontendBookRecordApi.getCustomerAppointments(userid);
            })
            .catch((err) => {
                // alert('error');
            });
        })
        .catch((error) => {
            console.log(error)
        })

        if (GlobalVariables.displayCookieNotice) {
            cookieconsent.initialise({
                palette: {
                    popup: {
                        background: '#ffffffbd',
                        text: '#666666'
                    },
                    button: {
                        background: '#429a82',
                        text: '#ffffff'
                    }
                },
                content: {
                    message: EALang.website_using_cookies_to_ensure_best_experience,
                    dismiss: 'OK'
                },
            });

            $('.cc-link').replaceWith(
                $('<a/>', {
                    'data-toggle': 'modal',
                    'data-target': '#cookie-notice-modal',
                    'href': '#',
                    'class': 'cc-link',
                    'text': $('.cc-link').text()
                })
            );
        }
        
    };

})(window.FrontendBookRecord);
