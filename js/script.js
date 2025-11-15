const swiper = new Swiper('.hero-slider', {
  loop: true,
  effect: 'fade',
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

document.querySelectorAll(".btn").forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();

    const targetid = link.getAttribute('href');
    const targetElement = document.querySelector(targetid);
    targetElement.scrollIntoView({
      behavior: 'smooth',
      block: 'center'
    });
  });
});