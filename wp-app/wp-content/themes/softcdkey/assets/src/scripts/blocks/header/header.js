import $ from 'jquery';
import customSelect from 'custom-select';

const header = document.getElementsByTagName('header')[0];
if (typeof header !== 'undefined') {
	customSelect('.language-switcher', {
		containerClass: 'language-switcher-container',
		openerClass: 'language-switcher-opener',
		panelClass: 'language-switcher-panel',
		optionClass: 'language-switcher-option',
		optgroupClass: 'language-switcher-optgroup',
		isSelectedClass: 'is-selected',
		hasFocusClass: 'has-focus',
		isDisabledClass: 'is-disabled',
		isOpenClass: 'is-open',
	});

	/* window.onscroll = () => {
    if (window.scrollY > (header.offsetTop + 30)) {
      header.classList.add('hide-topbar');
    } else {
      header.classList.remove('hide-topbar');
    }
  } */

	const mobileMenu = document.querySelectorAll('.mobile-menu-block');
	const mobileSidebar = document.querySelector('header .mobile-sidebar');

	mobileMenu.forEach((item) => {
		item.onclick = function () {
			const mobileMenuFooter = document.querySelector(
				'footer .mobile-menu-block'
			);
			const mobileMenuHeader = document.querySelector(
				'header .mobile-menu-block'
			);
			mobileMenuFooter.classList.toggle('is-active');
			mobileMenuHeader.classList.toggle('is-active');

			mobileSidebar.classList.toggle('show');
			document.querySelector('body').classList.toggle('lock');
		};
	});

	/* mobileMenu.onclick = () => {
		mobileMenu.classList.toggle('is-active');
		mobileMenuFooter.classList.remove('is-active');
		mobileSidebar.classList.toggle('show');
		document.querySelector('body').classList.toggle('lock');
	}; */

	const infoMenu = document.querySelector('header .info-menu .hamburger');
	infoMenu.onclick = () => {
		infoMenu.classList.toggle('is-active');
	};

	const authBtn = header.querySelector('.user-auth'),
		authModal = document.querySelector('.modal--authorization');
	if (authBtn !== null) {
		authBtn.addEventListener('click', (e) => {
			authModal.classList.remove('hide');
		});
	}

	$('button.cart-dropdown__basket').on('click', function () {
		const cartDropdown = $('.cart-dropdown__menu'),
			cartIcon = $(this).find('i');
		if (cartDropdown.hasClass('hide')) {
			cartDropdown.removeClass('hide');
			cartIcon.addClass('toggle-up');
		} else {
			cartDropdown.addClass('hide');
			cartIcon.removeClass('toggle-up');
		}
	});

	$('button#search').on('click', function (e) {
		$('.modal--search').removeClass('hide');
	});
}
