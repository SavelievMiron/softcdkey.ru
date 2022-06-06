import Pagination from "tui-pagination";

const btnMobileFilters = document.querySelector('button.btn-filters'),
btnMobileFiltersClose = document.querySelector('button.mobile-filters__close');

if (btnMobileFilters !== null) {
    btnMobileFilters.addEventListener('click', function () {
        const mobileFilters = document.querySelector('.mobile-filters');
        mobileFilters.classList.toggle('show');
        document.querySelector("body").classList.add("lock");
    });
}

if (btnMobileFiltersClose !== null) {
    btnMobileFiltersClose.addEventListener('click', function () {
        const mobileFilters = document.querySelector('.mobile-filters');
        mobileFilters.classList.toggle('show');
        document.querySelector("body").classList.remove("lock");
    });
}

const sidebar = document.querySelector('.catalog-sidebar');
if (sidebar !== null) {
    const categories = document.querySelectorAll('.categories__heading');
    if (categories.length !== 0) {
        categories.forEach(function (el) {
            el.addEventListener( 'click', function (e) {
				categories.forEach((item) => {
                    if (item === e.target) return;
					item.classList.remove( 'checked' )
                    item.classList.remove('open')
                })

                e.target.classList.toggle('open');
				e.target.classList.toggle('checked');

				getProducts()
			});
        });
    }

	const categoryItems = document.querySelectorAll('.categories__item');
    if (categoryItems.length !== 0) {
        categoryItems.forEach((el) => {
            el.onclick = (e) => {
                e.target.classList.toggle('checked');

                getProducts()
            }
        });
    }
}

function getProducts(page = 1) {
    const formData = {
        action: globalJS.ajax_actions.get_products,
        search: $('.products input#search').val(),
        tags: $('.catalog-sidebar .categories__item.checked,' +
			'.catalog-sidebar .categories__heading.checked').map((_, el) => {
            return $(el).data('id');
        }).get(),
        badges: $('.catalog-sidebar input[name="badges[]"]:checked').map((_, el) => {
            return $(el).val();
        }).get(),
        page: page,
        _wpnonce: globalJS.nonce.ajax.get_products
    }
    $.ajax({
        type: 'POST',
        url: globalJS.ajax_url,
        data: formData,
        dataType: 'json',
        beforeSend: () => {
            const loader = `<div class="product-loading"><div class="lds-facebook"><div></div><div></div><div></div></div></div>`
            $('#data-container').html(loader)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Произошла ошибка. Попробуйте ещё раз.')
        },
        success: function (response) {
            if (response.success) {
                $('#data-container').html(response.data.items)
                $('.total-found span').html(response.data.total)

                if (response.data.max_num_pages >= 2) {
                    if ($('#pagination').is(':hidden')) $('#pagination').show()
                    pagination.reset(response.data.total)
                } else {
                    if (!$('#pagination').is(':hidden')) $('#pagination').hide()
                }
            } else {
                alert('Произошла ошибка. Попробуйте ещё раз.')
            }
        }
    })
}

$('.products input#search').keypress(function (e) {
    if (e.which == 13) {
        e.preventDefault();
    }
});

$(`.products input#search, .catalog-sidebar input[name="badges[]"]`).on('change', getProducts)

const container = document.getElementById("pagination");
if (typeof container !== "undefined" && container !== null) {
  let options = {
    totalItems: catalogQueryVars.total,
    itemsPerPage: catalogQueryVars.per_page,
    visiblePages: 4,
    page: 1,
    centerAlign: true,
    usageStatistics: false,
    firstItemClassName: "page-link-first",
    lastItemClassName: "page-link-last",
    template: {
      page: '<a href="#" class="page-link" aria-label="Goto Page {{page}}">{{page}}</a>',
      currentPage:
        '<strong class="page-link page-link-current" aria-current="true">{{page}}</strong>',
      moveButton:
        '<a href="#" class="page-link page-link-{{type}}">' +

        "</a>",
      disabledMoveButton:
        '<span class="page-link page-link-{{type}} page-link-disabled">' +

        "</span>",
      moreButton:
        '<a href="#" class="page-link page-link-more">' +
        "<span>...</span>" +
        "</a>",
    },
  };

  const pagination = new Pagination(container, options);

  pagination.on('afterMove', (event) => {
    catalogQueryVars.page = event.page
    getProducts(event.page)
  })
}
