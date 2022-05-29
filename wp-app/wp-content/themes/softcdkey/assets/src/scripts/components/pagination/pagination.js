import Pagination from "tui-pagination";

const container = document.getElementById("pagination");

if (typeof container !== "undefined" && container !== null) {
  let options = {
    totalItems: 4,
    itemsPerPage: 1,
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
}
