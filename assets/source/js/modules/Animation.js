import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

class Animation {
  constructor() {
    this.elems = document.querySelectorAll('.animate');

    this.elems.forEach((elem) => this.setAnimation(elem));
  }

  setAnimation(elem) {
    const type = elem.dataset.animationType;
    const duration = elem.dataset.animationDuration
      ? Number(elem.dataset.animationDuration) / 1000
      : 1.5;
    const length = elem.dataset.animationLength
      ? Number(elem.dataset.animationLength)
      : 50;
    const delay = elem.dataset.animationDelay
      ? Number(elem.dataset.animationDelay) / 1000
      : 0;
    const offset = elem.dataset.animationOffset
      ? Number(elem.dataset.animationOffset)
      : 50;

    let movement = {};
    if (type === 'fadeInUp') movement = { y: length };
    if (type === 'fadeInLeft') movement = { x: length };
    if (type === 'fadeInRight') movement = { x: -length };
    if (type === 'fadeInBottom') movement = { y: -length };

    gsap.from(elem, {
      ...movement,
      opacity: 0,
      duration,
      delay,
      scrollTrigger: {
        trigger: elem,
        start: `-=${length - offset} bottom`,
      },
    });
  }
}

export default new Animation();
