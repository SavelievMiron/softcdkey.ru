const mobileMenuFooter = document.querySelector("footer .mobile-menu-block"),
  mobileMenuHeader = document.querySelector("header .mobile-menu-block"),
  mobileSidebarFooter = document.querySelector("header .mobile-sidebar");
mobileMenuFooter.onclick = () => {
  mobileMenuFooter.classList.toggle("is-active");
  mobileMenuHeader.classList.toggle("is-active");
  mobileSidebarFooter.classList.toggle("show");
  document.querySelector("body").classList.toggle("lock");
};

/* const infoMenuFooter = document.querySelector(
  "footer .info-menu .hamburger, header .info-menu .hamburger"
);
infoMenuFooter.onclick = () => {
  infoMenuFooter.classList.toggle("is-active");
};
 */
