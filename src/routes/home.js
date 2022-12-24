// import { gsap } from 'gsap'
// import { ScrollTrigger } from 'gsap/ScrollTrigger'
// gsap.registerPlugin(ScrollTrigger)

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
  init() {},
  finalize() {
    // const instance = basicScroll.create({
    //   elem: document.querySelector('.fast-acting-img'),
    //   from: 'top-bottom',
    //   to: 'bottom-top',
    //   props: {
    //     '--fastActingY': {
    //       from: '4vmax',
    //       to: '-4vmax',
    //     },
    //   },
    // })
    // // instance.start()
  },
}
