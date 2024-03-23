import Splide from '@splidejs/splide';

class SplideSlider {
  constructor() {
    this.events();
  }

  events() {
    const sliders = document.querySelectorAll('.splide');
    if (!sliders.length) return;

    for (let i = 0; i < sliders.length; i++) {
      const splide = new Splide(sliders[i], {
        type: 'loop',
        perPage: sliders[i].dataset.perPage || 1,
        breakpoints: {
          1024: {
            perPage: sliders[i].dataset.perPageMedium || 1,
          },
          640: {
            perPage: sliders[i].dataset.perPageSmall || 1,
          },
        },
        gap: '1rem',
        arrows: true,
        pagination:
          sliders[i].dataset.pagination &&
          sliders[i].dataset.pagination === 'no'
            ? false
            : true,
        autoplay: false,
        autoHeight: true,
        arrowPath:
          'M22.1667 28.7917C21.8334 28.4583 21.6734 28.0556 21.6867 27.5833C21.7012 27.1111 21.8751 26.7083 22.2084 26.375L26.9167 21.6667H8.33341C7.86119 21.6667 7.46508 21.5067 7.14508 21.1867C6.82619 20.8678 6.66675 20.4722 6.66675 20C6.66675 19.5278 6.82619 19.1317 7.14508 18.8117C7.46508 18.4928 7.86119 18.3333 8.33341 18.3333H26.9167L22.1667 13.5833C21.8334 13.25 21.6667 12.8539 21.6667 12.395C21.6667 11.9372 21.8334 11.5417 22.1667 11.2083C22.5001 10.875 22.8962 10.7083 23.3551 10.7083C23.8129 10.7083 24.2084 10.875 24.5417 11.2083L32.1667 18.8333C32.3334 19 32.4517 19.1806 32.5217 19.375C32.5906 19.5695 32.6251 19.7778 32.6251 20C32.6251 20.2222 32.5906 20.4306 32.5217 20.625C32.4517 20.8195 32.3334 21 32.1667 21.1667L24.5001 28.8333C24.1945 29.1389 23.8129 29.2917 23.3551 29.2917C22.8962 29.2917 22.5001 29.125 22.1667 28.7917Z',
      }).mount();
    }
  }
}

export default new SplideSlider();
