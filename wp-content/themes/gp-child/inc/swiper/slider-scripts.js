const swiper = new Swiper('.hero-slider', {
  slidesPerView: 1, // this
  //slidesPerColumn: 1, 
  loop: true,
  //effect: 'fade',
  // speed: 2000,
  // autoplay: {
  //   enabled: true,
  //   delay: 7000,
  // },
  //spaceBetween: 20,
  //centeredSlides: true,
  grabCursor: true,
  pagination: {
    el: '.slider-hero-pagination',
    //type: 'bullets',
  },
});
