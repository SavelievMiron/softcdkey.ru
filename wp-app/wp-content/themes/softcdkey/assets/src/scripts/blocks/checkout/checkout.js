import $ from 'jquery';

if (window.location.href.indexOf('checkout') !== -1) {
	$(document).on(
		'change',
		'.wc_payment_method input[type="radio"]',
		function () {
			$('.wc_payment_method').each(function () {
				$(this).removeClass('is-active');
			});
			if ($(this).is(':checked')) {
				$(this).parents('.wc_payment_method').addClass('is-active');
			} else {
				$(this).parents('.wc_payment_method').removeClass('is-active');
			}
		}
	);

	$(window).on('load', function () {
		console.log('page is loaded')
		$('.wc_payment_method input[type="radio"]').each(function () {
			if ($(this).is(':checked')) {
				$(this).parents('.wc_payment_method').addClass('is-active');
			}
		});
	});
}
