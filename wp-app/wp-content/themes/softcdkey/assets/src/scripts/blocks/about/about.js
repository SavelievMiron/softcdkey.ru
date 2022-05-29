import Swiper, {Navigation, Autoplay} from "swiper";

Swiper.use([Navigation, Autoplay]);

if (typeof document.getElementsByClassName('about-banner')[0] !== 'undefined') {
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
    autoWidth: true
  });
}
