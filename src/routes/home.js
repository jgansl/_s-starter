// import { gsap } from 'gsap'
// import { ScrollTrigger } from 'gsap/ScrollTrigger'

const { $ } = window
const $body = $(document.body)

let ioKey = 'body.home .page-default-content > *'

function animateOut(el) {
  $(el).on('click', (e) => {
    e.preventDefault()
    //gsap.timeline({}).reverse()
    $(ioKey).removeClass('show')
    setTimeout(function () {
      window.location.href = e.target.href
      
      //window.popstate/browser back button
      setTimeout(function () {
        $(ioKey).addClass('show')
      }, 1500)
    })
  })
}

function singleLocationIO() {
//   let count = 0
  let interval, t

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
         entry.target.classList.add('show')
      //   setTimeout(function () {
      //   }, 100 * count)
      //   count += 1

      //   if (interval) {
      //     return
      //   }
      //   interval = setInterval(function () {
      //     //  t = true
      //     count = Math.max(0, count - 1)
      //     if (count == 0) {
      //       t = false
      //       clearInterval(interval)
      //     }
      //   }, 20)
      } // else { entry.target.classList.remove('show') }
    })
  })
  $(ioKey).each((_idx, el) => io.observe(el))
  document.querySelectorAll('a').forEach(animateOut)
}

export default {
  init() {
    // gsap.registerPlugin(ScrollTrigger)
    singleLocationIO()

    //TODO if
    $('.feat-prod-wrap').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      fade: true,
      infinite: true,
      prevArrow:
        '<button type="button" class="slick-prev"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 0 39 0C17.4609 0 0 17.4609 0 39C0 60.5391 17.4609 78 39 78Z" fill="#006FAA"/> <path d="M21.5901 39L36.7001 56.04H49.8301L34.7201 39L49.8301 21.96H36.7001L21.5901 39Z" fill="white"/> </svg> <span class="sr-only">Previous</span></button>',
      nextArrow:
        '<button type="button" class="slick-next"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 4.21991e-06C17.4609 2.3369e-06 5.2925e-06 17.4609 3.40949e-06 39C1.52648e-06 60.5391 17.4609 78 39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 6.10291e-06 39 4.21991e-06Z" fill="#006FAA"/> <path d="M56.41 39L41.3 21.96L28.17 21.96L43.28 39L28.17 56.04L41.3 56.04L56.41 39Z" fill="white"/> </svg> <span class="sr-only">Next</span></button>',
    })

    // animateHomeHero()
  },
  finalize() {
    const instance = basicScroll.create({
      elem: document.querySelector('.fast-acting-img'),
      from: 'top-bottom',
      to: 'bottom-top',
      props: {
        '--fastActingY': {
          from: '4vmax',
          to: '-4vmax',
        },
      },
    })

    instance.start()
  },
}


// function animateHomeHero() {
//   let $homeHero = $('.feat-prod-wrap')
//   if(!$homeHero.length) return

//   gsap.set($homeHero, { y: 16})
//   gsap.from('.feat-shop-btn', { autoAlpha: 0, delay: 0.56, y: "40%", duration:0.65, scale: 0.97})
//   gsap.to($homeHero, {
//     delay: 0.5,
//     ease:'power1.out',
//     autoAlpha: 1,
//     y: 0
//   })
// }