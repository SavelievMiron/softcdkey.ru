const sidebar = document.querySelector('.catalog-sidebar');
if (sidebar !== null) {
	const categories = document.querySelectorAll('.categories__heading');
	if (categories.length !== 0) {
		categories.forEach((el) => {
			el.onclick = (e) => {
				categories.forEach((el) => {
					if (el === e.target) return;
					el.classList.remove('open');
				});

				e.target.classList.toggle('open');
			};
		});
	}

	const categoryItems = document.querySelectorAll('.categories__item');
	if (categoryItems.length !== 0) {
		categoryItems.forEach((el) => {
			el.onclick = (e) => {
				e.target.classList.toggle('checked');
			};
		});
	}
}
