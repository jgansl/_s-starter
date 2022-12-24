import lozad from 'lozad'
// import Accordion from './accordion'
import { runPageBlocks } from './functions'

const { $ } = window
const $body = $(document.body)

export default {
  init() {
    const observer = lozad('img')
    observer.observe()

    // gsap.registerPlugin(ScrollTrigger)
    window.onresize = () => {
      let navHeight = $('.navbar-wrap').height()
      document
        .querySelector(':root')
        .style.setProperty('--navbar-height', navHeight + 'px')
      $('#mobile-menu').css('top', navHeight + 'px')
    }
    window.onload = window.onresize

    runPageBlocks()
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    // class to hide outlines if not using keyboard
    $body.on('mousedown', function () {
      $body.addClass('using-mouse')
    })
    $body.on('keydown', function () {
      $body.removeClass('using-mouse')
    })

    mobileMenu()

    // FAQs();
    // $('details').each((idx, el) => {
    //   new Accordion(el)
    // })
  },
}

function mobileMenu() {
  // assumes existence
  let $menu = $('#mobile-menu')
  $menu.hide()
  $menu.removeClass('loading')
  let $btn = $('#toggle_nav')
  $('main').on('click', function () {
    $menu.slideUp()
  })
  $btn.on('click', function (e) {
    console.log(e)
    $menu.slideToggle()
  })

  function closeOnDesktop(x) {
    if (x.matches) {
      $menu.fadeOut()
    }
  }

  var x = window.matchMedia('(min-width: 1025px)') //match
  closeOnDesktop(x)
  x.addListener(closeOnDesktop)
}
