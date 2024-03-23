import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

let mm = gsap.matchMedia();

class Animation {
  constructor() {
    this.breakpoint = 1200;

    // Banners
    this.banners = document.querySelectorAll('.banner .banner__inner');
    this.animateBanners();

    this.animateItems = document.querySelectorAll('.animate');

    this.animateItems.forEach((item, index) => this.setAnimation(item, index));

    this.animateStagger = document.querySelectorAll('.animate-stagger');

    this.animateStagger.forEach((item) => {
      this.animateStaggered(item);
    });
  }

  animateBanners() {
    // Check if body has class .admin-bar
    const hasAdminBar = document.body.classList.contains('admin-bar');
    const startStr = hasAdminBar ? 'top-=32 top' : 'top top';

    this.banners.forEach((banner) => {
      mm.add(`(min-width: ${this.breakpoint}px)`, () => {
        const tl = gsap.timeline({
          scrollTrigger: {
            trigger: banner,
            start: startStr,
            end: 'bottom top',
            scrub: true,
          },
        });

        tl.to(banner, {
          yPercent: 100,
          // scale: 0.9,
          // opacity: 0,
          ease: 'none',
        });

        const bannerContent = banner.querySelector('.banner__content');
        if (bannerContent) {
          tl.to(
            bannerContent,
            {
              opacity: 0,
              yPercent: -100,
              ease: 'none',
            },
            0
          );
        }
      });
    });
  }

  setAnimation(elem, index) {
    const direction = elem.dataset.direction;
    const duration = elem.dataset.duration
      ? Number(elem.dataset.duration)
      : 1.5;
    const length = elem.dataset.length ? Number(elem.dataset.length) : 30;
    const delay = elem.dataset.delay ? Number(elem.dataset.delay) : 0;
    const offset = elem.dataset.offset ? Number(elem.dataset.offset) : 50;

    // Up is default
    let movement = (movement = {
      from: {
        y: length,
      },
      to: {
        y: 0,
      },
    });
    if (direction === 'up')
      movement = {
        from: {
          y: length,
        },
        to: {
          y: 0,
        },
      };
    if (direction === 'left') movement = { from: { x: length }, to: { x: 0 } };
    if (direction === 'right')
      movement = { from: { x: -length }, to: { x: 0 } };
    if (direction === 'bottom')
      movement = { from: { y: -length }, to: { y: 0 } };

    if (direction === 'none') movement = { from: {}, to: {} };

    mm.add(`(min-width: ${this.breakpoint}px)`, () => {
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: elem,
          start: `top 90%`,
        },
      });

      tl.fromTo(
        elem,
        {
          ...movement.from,
          opacity: 0,
        },
        {
          ...movement.to,
          opacity: 1,
          duration,
          delay,
        }
      );
    });
  }

  animateStaggered(item) {
    const targets = item.querySelectorAll('.stagger-item');

    if (!targets) return;

    const stagger = item.dataset.stagger ? Number(item.dataset.stagger) : 0.3;
    const delay = item.dataset.delay ? Number(item.dataset.delay) : 0;

    mm.add(`(min-width: ${this.breakpoint}px)`, () => {
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: item,
          start: `top 90%`,
        },
      });

      tl.fromTo(
        targets,
        { opacity: 0 },
        {
          opacity: 1,
          stagger,
          duration: 1,
          delay,
          ease: 'power1.easeInOut',
        }
      );
    });
  }
}

export default new Animation();
