import lozad from 'lozad'
import Accordion from './accordion'
import { runPageBlocks } from './blocks'
import DrinkFamily from '../components/DrinkFamily.svelte'

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
    drivingDistance()

    if($body.hasClass('tax-drink_family')) {
      console.log('svelte')
      let $anchor = $('#svelte-anchor')
      if($anchor.length) {
        new DrinkFamily({
          target: $anchor[0],
          props: $anchor.data(),
        })
      }
    }
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
    $('details').each((idx, el) => {
      new Accordion(el)
    })
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

function drivingDistance() {
  const {TravelMode, DirectionsService, DirectionsStatus, LatLng} = google.maps;
  const directionsService = new DirectionsService;
  let a = new google.maps.LatLng(-34, 151);
  let b = new google.maps.LatLng(-34, 121);
  let addresses = [
    a, b
  ]
  const origin = addresses.shift();
  const destination = addresses.pop();
  const waypoints = addresses.map(stop => ({location: stop}));

  // directionsService.route({
  //   origin,
  //   waypoints,
  //   destination,
  //   travelMode: TravelMode.DRIVING,
  // }, (response, status) => {
  //     if(status === DirectionsStatus.OK) {
  //         let distances = _.flatMap(response.routes, route => _.flatMap(route.legs, leg => leg.distance.value));

  //         return resolve(_.sum(distances));
  //     } else {
  //         return reject(new Error(status));
  //     }
  // });

}