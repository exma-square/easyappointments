<div id="footer">
    <div id="footer-content" class="col-12 col-sm-8" style="background: <?= $main_color ?>">
        Copyright 
        <a href="<?= $url ?>" target="_blank"> © 2020 <?= $chinese_name ?></a>
        All rights reserved.
    </div>

    <div id="footer-user-display-name" class="col-12 col-sm-4" style="background: <?= $main_color ?>">
        <?= lang('hello') . ', ' . $user_display_name ?>!
    </div>
</div>

<script src="<?= asset_url('assets/js/backend.js') ?>"></script>
<script src="<?= asset_url('assets/js/polyfill.js') ?>"></script>
<script src="<?= asset_url('assets/js/general_functions.js') ?>"></script>
</body>
</html>
