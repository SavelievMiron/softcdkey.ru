import $ from 'jquery';
const searchModal = document.querySelector('.modal--search');
if (searchModal !== null) {
	$(searchModal).on('click', '.modal__close', function () {
		$(searchModal).addClass('hide');
		console.log('hello');
	});

	$(searchModal).on('input', 'input[type=search]', function () {
		$(searchModal).find('form').trigger('submit');
	});

	let timer = false;

	$('.modal--search form').on('submit', function (e) {
		e.preventDefault();

		const $this = $(this);

		clearTimeout(timer);

		timer = setTimeout(function () {
			$.ajax({
				type: 'POST',
				url: globalJS.ajax_url,
				data: {
					action: globalJS.ajax_actions.get_products,
					search: $this.find('input[type=search]').val(),
					_wpnonce: globalJS.nonce.ajax.get_products,
				},
				dataType: 'json',
				error: function (response, textStatus, thrownError) {},
				success: function (response, textStatus, thrownError) {
					if (response.success) {
						$(searchModal)
							.find('#data-container')
							.html(response.data.items);
					}
				},
			});
		}, 1000);
	});
}
