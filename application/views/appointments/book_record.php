<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">

    <title><?= lang('record_title') . ' ' . $company_name ?></title>
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/frontend.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/general.css') ?>">

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <link rel="icon" sizes="192x192" href="<?= asset_url('assets/img/logo.png') ?>">

    <script src="<?= asset_url('assets/ext/fontawesome/js/fontawesome.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/fontawesome/js/solid.min.js') ?>"></script>
</head>

<body>
<div id="main" class="container">
    <div class="row wrapper">
        <div id="book-appointment-wizard" class="col-12 col-lg-10 col-xl-8">

            <!-- FRAME TOP BAR -->
            <div id="logo-background">
                <img src="<?= $company_logo ?>">
            </div>

            <div id="header">
                <img src="<?= $company_banner ?>">
                <span id="service-title"><?= lang('appointment_record') ?></span> 
            </div>

            <!-- APPOINTMENT RECORD -->

            <div id="wizard-frame-0" class="wizard-frame">
                <div class="frame-container">
                    <h2 class="frame-title"><?= lang('recent_record') ?></h2>
                
                    <div class="row frame-content">
                        <div class="col">
                            <div class="form-group">

                                <div class="recordCard"></div>
                                <div class="appointment-details col-12 col-md-6" 
                                     style="margin-left: 3%; margin-top: 3%; margin-bottom: 3%"></div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">預約時間</th>
                                        <th scope="col" id="service">服務項目</th>
                                        <th scope="col">狀態</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- FRAME FOOTER -->

            <div id="frame-footer" style="background: <?= $main_color ?>">
                <small>
                    <span class="footer-powered-by">
                        Copyright
                        <a href="<?= $url ?>" target="_blank"> © 2020 <?= $chinese_name ?></a>
                        All rights reserved.
                    </span>

                    <span class="footer-options">
                        <span id="select-language" class="badge badge-secondary">
                            <i class="fas fa-language mr-2"></i>
                            <?= ucfirst(config('language')) ?>
                        </span>

                        <a class="backend-link badge badge-primary" style="display: none;" href="<?= site_url('backend'); ?>">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            <?= $this->session->user_id ? lang('backend_section') : lang('login') ?>
                        </a>
                    </span>
                </small>
            </div>

        </div>
    </div>
</div>


<script>
    var GlobalVariables = {
        baseUrl: <?= json_encode(config('base_url')) ?>,
        csrfToken: <?= json_encode($this->security->get_csrf_hash()) ?>,
        lineLiff: '<?= Config::LINE_LIFF ?>',
    };

    var EALang = <?= json_encode($this->lang->language) ?>;
    var availableLanguages = <?= json_encode(config('available_languages')) ?>;
</script>

<script src="<?= asset_url('assets/js/general_functions.js') ?>"></script>
<script src="<?= asset_url('assets/ext/jquery/jquery.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/popper/popper.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/tippy/tippy-bundle.umd.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/datejs/date.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/moment/moment.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/moment/moment-timezone-with-data.min.js') ?>"></script>
<script src="<?= asset_url('assets/js/frontend_book_record_api.js?q=3213124124') ?>"></script>
<script src="<?= asset_url('assets/js/frontend_book_record.js?q=45642341341') ?>"></script>

<script>
    $(function () {
        FrontendBookRecord.initialize(true, GlobalVariables.manageMode);
        GeneralFunctions.enableLanguageSelection($('#select-language'));
    });
</script>

<?php google_analytics_script(); ?>
</body>
</html>
