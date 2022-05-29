import $ from 'jquery';
import Swiper, {Navigation, Pagination, Thumbs, Autoplay} from "swiper";

const productSlider = document.querySelector(".product__slider");
if (productSlider !== null) {
	Swiper.use([Navigation, Thumbs]);

	const productSlider2 = new Swiper(
		".product__slider--2__wrapper .product__slider--2",
		{
			direction: "vertical",
			spaceBetween: 20,
			slidesPerView: 3,
			slideToClickedSlide: true,
			autoplay: {
				delay: 10000,
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			pagination: {
				el: ".product__slider--2__wrapper .swiper-pagination",
				clickable: true,
			},

			breakpoints: {
				0: {
					direction: "horizontal",
				},
				992: {
					direction: "vertical",
				},
			},
		}
	);
	const productSlider1 = new Swiper(".product__slider--1", {
		direction: "vertical",
		slidesPerView: 1,
		thumbs: {
			swiper: productSlider2,
		},
		breakpoints: {
			0: {
				direction: "horizontal",
			},
			992: {
				direction: "vertical",
			},
		},
	});
}

const openOfficialDistributorsButton = document.getElementById('official-distributor');
if (openOfficialDistributorsButton !== null) {
	const officialDistributorsModal = document.querySelector('.modal--distributors');

	openOfficialDistributorsButton.addEventListener('click', function () {
		officialDistributorsModal.classList.remove('hide')
	})

	const closeModal = officialDistributorsModal.querySelector(".modal__close");
	closeModal.onclick = function (e) {
		officialDistributorsModal.classList.add("hide");
	};
}

/* change product quantity */
const productQuantity = document.getElementById("quantity"),
	plus = document.getElementById("plus"),
	minus = document.getElementById("minus");

if (productQuantity !== null) {
	const productAddToCart = document.querySelector('.single-add_to_cart')
	console.log(productAddToCart)
	productQuantity.addEventListener('input', function (e) {
		productAddToCart.dataset.quantity = e.target.value
		console.log(productAddToCart.dataset.quantity)
	})

	plus.addEventListener("click", function (e) {
		const min = productQuantity.getAttribute("min"),
			max = productQuantity.getAttribute("max");

		let newVal = Number(productQuantity.value) + 1;

		if (newVal > max) {
			e.target.disabled = true;
			return;
		} else {
			e.target.disabled = false;

			if (minus.disabled) {
				minus.disabled = false;
			}
		}

		productQuantity.value = newVal;
		productAddToCart.dataset.quantity = newVal;
	});

	minus.addEventListener("click", function (e) {
		const min = productQuantity.getAttribute("min"),
			max = productQuantity.getAttribute("max");
		let currentVal = productQuantity.value;

		let newVal = Number(productQuantity.value) - 1;

		if (newVal < min) {
			e.target.disabled = true;
			return;
		} else {
			e.target.disabled = false;

			if (plus.disabled) {
				plus.disabled = false;
			}
		}

		productQuantity.value = newVal;
		productAddToCart.dataset.quantity = newVal;
	});
}

const productTestimonials = document.querySelector(".product-testimonials__slider");
if (productTestimonials !== null) {
	Swiper.use([Navigation, Pagination]);

	const swiper = new Swiper(".product-testimonials__slider", {
		loop: true,
		pagination: {
			el: ".product-testimonials .swiper-pagination",
			type: "bullets",
		},
		navigation: {
			nextEl: ".product-testimonials__slider .swiper-button-next",
			prevEl: ".product-testimonials__slider .swiper-button-prev",
		},
		grabCursor: true,
		centeredSlides: true,
		breakpoints: {
			0: {
				slidesPerView: 1,
				loopedSlides: 1,
				spaceBetween: 20,
			},
			756: {
				slidesPerView: 2,
				loopedSlides: 2,
				spaceBetween: 30,
				centeredSlides: false,
			},
			992: {
				slidesPerView: 3,
				loopedSlides: 3,
				spaceBetween: 45,
			},
		},
	});
}

const productDescription = document.getElementById("product-description");
if (productDescription !== null) {
	const productDescTabs = document.querySelectorAll(".product-desc__tab"),
		productDescTabsContent = document.querySelectorAll(
			".product-desc__tab-content"
		);

	if (productDescTabs.length !== 0) {
		productDescTabs.forEach((el) => {
			el.addEventListener("click", function (e) {
				const btn = e.target,
					id = btn.dataset.id,
					content = document.getElementById(id);

				productDescTabs.forEach(function (el) {
					el.classList.remove("is-active");
				});
				btn.classList.add("is-active");

				productDescTabsContent.forEach(function (el) {
					el.classList.remove("is-active");
				});
				content.classList.add("is-active");
			});
		});
	}

	if ($(window).width() < 576) {
		$(".product-desc__tab, .product-desc__tab-content").removeClass(
			"is-active"
		);
		$(".mobile-tab").addClass("is-active");
	}

	Swiper.use([Navigation, Thumbs]);

	var descSlider2 = new Swiper(".description__slider--2", {
		spaceBetween: 30,
		slidesPerView: 4,
		freeMode: true,
		watchSlidesProgress: true,
		breakpoints: {
			992: {
				slidesPerView: 4,
			},
			768: {
				slidesPerView: 3,
			},
			0: {
				slidesPerView: 2,
			},
		},
		pagination: {
			el: ".description__slider .swiper-pagination",
		},
	});
	var descSlider1 = new Swiper(".description__slider--1", {
		spaceBetween: 10,
		thumbs: {
			swiper: descSlider2,
		},
	});
}

$(document).on('click', '.product__bundle--item', function () {
	const $this = $(this),
		id = $this.data('product_id');

	if ($this.hasClass('is-active')) {
		return
	} else {
		$('.product__bundle--item').each(function () {
			$(this).removeClass('is-active')
		})
		$this.addClass('is-active')

		$.ajax({
			type: 'GET',
			url: globalJS.ajax_url,
			data: {
				action: globalJS.ajax_actions.get_product_info,
				id: id,
				_wpnonce: globalJS.nonce.ajax.get_product_info,
			},
			dataType: 'json',
			error: function (xhr, ajaxOptions, thrownError) {
				alert('Произошла ошибка. Попробуйте ещё раз.')
			},
			success: function (response) {
				if (response.success) {
					const SwiperSlide = (url) => `
						<div class="swiper-slide">
						  <img src="${url}">
						</div>
				  `;
					$('.product__slider--1 .swiper-wrapper, .product__slider--2 .swiper-wrapper').each(function () {
						$(this).html(response.data.gallery.map(SwiperSlide).join(''))
					});
					Object.entries(response.data.info[0]).map(item => {
						$(`.list-item[data-id=${item[0]}] .list-item__content, .list__item[data-id=${item[0]}] .list__item--content`).html(item[1])
					})
					$this.addClass('is-active');
				}
			}
		})
	}
})

new Swiper(".similar-reviews-slider", {
	slidesPerView: 1,
	spaceBetween: 30,
	loop: true,
	keyboard: {
		enabled: true,
	},
	pagination: {
		el: ".similar-reviews-slider .swiper-pagination",
	},
});
