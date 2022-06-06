<?php

/** Template Name: Register */

get_header();
?>

	<div class="page-registration">
		<div class="container">
			<div class="row">
				<div class="page-content">
					<h1 class="h1">Регистрация</h1>
					<?= do_shortcode( '[user_registration_form id="125"]' ); ?>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();
