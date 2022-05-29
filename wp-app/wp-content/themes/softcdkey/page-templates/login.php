<?php

/** Template Name: Login */

get_header();
?>

<div class="page-login">
    <div class="container">
        <div class="row">
            <div class="page-content">
				<h1 class="h1">Авторизация</h1>
                <?= do_shortcode( '[user_registration_my_account]' ); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
