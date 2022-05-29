import Swiper, {Navigation, Autoplay} from "swiper";

Swiper.use([Navigation, Autoplay]);

if (document.getElementsByClassName('about-banner').length !== 0) {
  const swiper = new Swiper(".about-banner", {
    loop: true,
    speed: 800,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
      delay: 10000,
    },
    grabCursor: true,
    lazy: true
  });
}
