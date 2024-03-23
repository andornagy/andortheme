import $ from 'jquery';

class SmoothScroll {
  constructor() {
    this.links = $('.smooth-scroll');
    this.events();
  }

  events() {
    this.links.on('click', function (e) {
      if (this.hash !== '') {
        e.preventDefault();
        var hash = this.hash;
        var pScrollBuffer = 50;

        $('html, body').animate(
          {
            scrollTop:
              $(hash).offset().top -
              $('.header__inner').innerHeight() -
              pScrollBuffer,
          },
          800
        );
      }
    });
  }
}

export default new SmoothScroll();
