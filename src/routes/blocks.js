// import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
// import { CSSPlugin } from 'gsap/CSSPlugin'
// import Hero from '../components/example.svelte'
// import Drinks from '../components/drinks.svelte'
// import DrinkGrid from '../components/drink-grid.svelte'
// import Locations from '../components/locations.svelte'
import MapLocations from '../components/MapLocations.svelte'
// import loadjs from 'loadjs'

// gsap.registerPlugin(ScrollTrigger)
// gsap.registerPlugin(CSSPlugin)

const { $ } = window
const $body = $(document.body)

const prevArrow =
  '<button type="button" class="slick-prev"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 0 39 0C17.4609 0 0 17.4609 0 39C0 60.5391 17.4609 78 39 78Z" fill="#006FAA"/> <path d="M21.5901 39L36.7001 56.04H49.8301L34.7201 39L49.8301 21.96H36.7001L21.5901 39Z" fill="white"/> </svg> <span class="sr-only">Previous</span></button>'
const nextArrow =
  '<button type="button" class="slick-next"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 4.21991e-06C17.4609 2.3369e-06 5.2925e-06 17.4609 3.40949e-06 39C1.52648e-06 60.5391 17.4609 78 39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 6.10291e-06 39 4.21991e-06Z" fill="#006FAA"/> <path d="M56.41 39L41.3 21.96L28.17 21.96L43.28 39L28.17 56.04L41.3 56.04L56.41 39Z" fill="white"/> </svg> <span class="sr-only">Next</span></button>'

function articles(){
  if(!$('.article-slider').length) { return; }
  function articleSlider(x) {
    if (x.matches) {
      // console.log('slick')
      $('.article-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        infinite: true,
        prevArrow,
        nextArrow,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      })
    } else {
      if ($('.article-slider.slick-initialized').length) {
        $('.article-slider').slick('unslick')
      }
    }
  }

  var x = window.matchMedia('(min-width: 601px)')
  // Call listener function at run time
  articleSlider(x)
  // Attach listener function on state changes
  x.addListener(articleSlider)
}
function join(){
  if(!$('.join-slider').length) { return; }
  function joinSlider(x) {
    if (x.matches) {
      // console.log('slick')
      $('.join-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        infinite: true,
        prevArrow,
        nextArrow,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      })
    } else {
      if ($('.join-slider.slick-initialized').length) {
        $('.join-slider').slick('unslick')
      }
    }
  }

  var x = window.matchMedia('(min-width: 601px)')
  // Call listener function at run time
  joinSlider(x)
  // Attach listener function on state changes
  x.addListener(joinSlider)
}

//assumes only on per page
function bestSellers() {
  function bestSellerSlider(x) {
    if (x.matches) {
      $(document.querySelector('.best-sellers-grid')).slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        infinite: true,
        prevArrow,
        nextArrow,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      })
    } else {
      if ($('.best-sellers-grid.slick-initialized').length) {
        $('.best-sellers-grid').slick('unslick')
      }
    }
  }

  var x = window.matchMedia('(min-width: 601px)')
  // Call listener function at run time
  bestSellerSlider(x)
  // Attach listener function on state changes
  x.addListener(bestSellerSlider)
}

function animateBestSellers() {
  let $headline = $('.best-sellers > .title')
  let $btns = $('.best-sellers-grid .slick-arrow')
  let $more = $('.best-sellers > a')
  if ($headline.length) {
    gsap.from($headline, {
      opacity: 0,
      scrollTrigger: { trigger: '.best-seller', start: 'top 75%' },
    })
  }
  $('.best-sellers-item').each((idx, el) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 75%',
      },
      y: 16,
      autoAlpha: 0,
      delay: idx * 0.1,
    })
  })
  if ($btns.length) {
    gsap.from($btns, {
      autoAlpha: 0,
      delay: 0.85,
      duration: 0.65,
      scrollTrigger: { trigger: '.best-sellers-grid', start: 'top 75%' },
    })
  }
  if ($more.length) {
    gsap.from($more, {
      autoAlpha: 0,
      delay: 0.25,
      duration: 0.35,
      scrollTrigger: { trigger: $more, start: 'top 90%' },
    })
  }
}

function drinkSlider() {
  let $el = $('.drink-slider-container')
  if (!$el.length) return

  $el.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    infinite: true,
    prevArrow,
    nextArrow,
  })
}

function drinkAttrsPrimary() {
  let $el = $('.drink-attrs-primary')
  if (!$el.length) return

  $el.slick({
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 3,
    slidesToScroll: 1,
    // arrows: true,
    // centerMode: true,
    infinite: true,
    // prevArrow,
    // nextArrow,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          fade: true,
        }
      },
    ]
  })
  
}

function drinkReviews() {
  let $el = $('.drink-reviews-container')
  if (!$el.length) return

  function showSlider(x) {
    if (x.matches) {
      $('.drink-reviews-container.slick-initialized').slick( 'unslick' )
    } else {
      $el.slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        // centerMode: true,
        infinite: true,
        prevArrow,
        nextArrow,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
            }
          },
        ]
      })
    }
  }
  
  var x = window.matchMedia("(max-width: 600px)")
  showSlider(x)
  x.addListener(showSlider)
}

function FAQs() {
  //TODO dynamically set min height to account for accordion opening
  // let $faqs = $('.faqs')
  // if (!$faqs.length) return
  // let newHeight = $faqs.height() + 200
  // $faqs.height(newHeight)
  //TODO
  // function collapse(el) {
  //   $(el).parent().removeAttr('open')
  //   $(el).siblings(':not(summary)').removeAttr('style')
  // }
  // // $(function () {
  // //Set accessibility attributes
  // $('summary').each(function () {
  //   $(this).attr('role', 'button')
  //   if ($(this).parent().is('[open]')) {
  //     $(this).attr('aria-expanded', 'true')
  //   } else {
  //     $(this).attr('aria-expanded', 'false')
  //   }
  // })
  // //Event handler
  // $('summary').on('click', function (e) {
  //   e.preventDefault()
  //   if ($(this).parent().is('[open]')) {
  //     $(this).attr('aria-expanded', 'false')
  //     $(this).siblings(':not(summary)').css('transform', 'scaleY(0)')
  //     window.setTimeout(collapse, 300, $(this))
  //   } else {
  //     // $('summary').each((idx, el) => {
  //     //   collapse(el)
  //     // })
  //     $(this).parent().attr('open', '')
  //     $(this).attr('aria-expanded', 'true')
  //   }
  // })
  // });
}

// function locations() {
//   let $anchor = $('#shop-nearby-locations')
//   if ($anchor.length) {
//     new Locations({
//       target: $anchor[0],
//       props: $anchor.data()
//     })
//   }
// }

// function _makeMap($mapEl) {
//   //@see https://docs.mapbox.com/mapbox-gl-js/api/map/
//   // import('loadjs').then(() => {
// 	loadjs(
// 		[
// 			'https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js',
// 			'https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css',
// 		],
// 		() => {
// 			const { mapboxgl } = window
// 			let [ lng, lat ] = $mapEl.data()['search_coordinates']

// 			mapboxgl.accessToken = 
//           'pk.eyJ1IjoiamdhbnN0ZiIsImEiOiJjbDl5a29vdGIwNXNsM3Bxb3ltZmhteDI3In0.Q5PZdLZvu8eUDiy7jPOO8g'
// 				//'pk.eyJ1IjoiaGdkYm9vc3QiLCJhIjoiY2o5NzJpdTU1MDJ4ZDMycnc2M2o1YmI3dSJ9.3XkwPViaSNyAWG14U3i2qA'

// 			// init map
// 			window.map = new mapboxgl.Map({
// 				container: 'map-wrap',
// 				// style: 'mapbox://styles/mapbox/dark-v10', //'mapbox://styles/hgdboost/ckfr2d4q102ya19nzr1wf9hus',
// 				// style: 'mapbox://styles/oopsie/clatrjjvn000715qx5mstlxt7', //'mapbox://styles/hgdboost/ckfr2d4q102ya19nzr1wf9hus',
// 				// style: 'mapbox://styles/jganstf/cl9ykvo9n001114o4koc04drs', //'mapbox://styles/hgdboost/ckfr2d4q102ya19nzr1wf9hus',
//         // style: 'mapbox://styles/jganstf/clbmi3ba9000314pfcugd5vqt',
//         style: 'mapbox://styles/jganstf/clbo7yeg0000r14o4vgnzz564',
// 				center: [lng - 0.01, lat - 0.01],
// 				zoom: 12,
// 			})

// 			// add marker
//       let curMarker = document.createElement('div')
//       curMarker.className = 'cur-sp-marker'
//       let tmp = new mapboxgl.Marker(curMarker).setLngLat([lng, lat]).addTo(map)
      
//       let locations = $mapEl.data()['locations'];
//       // for(let location of locations) {
//       //   let marker = document.createElement('div')
//       //   marker.className = 'sp-marker'
//       //   let co = location['geo_coords'].split(/,\s*/)
//       //   new mapboxgl.Marker(marker).setLngLat([parseFloat(co[1]), parseFloat(co[0])]).addTo(map)
//       // }

// 			// add scale control
// 			window.map.addControl(new mapboxgl.NavigationControl())

// 			// disable map zoom when using scroll
// 			window.map.scrollZoom.disable()
//       console.log(locations)
//       let locationscoorinates = []
//       locationscoorinates = [...locations.recreational.map(location => {
//         return location['geo_coords'].split(/,\s*/).map(co => parseFloat(co)).reverse()
//       })]
//       // locationscoorinates = [...locations.medical.map(location => {
//       //   return location['geo_coords'].split(/,\s*/).map(co => parseFloat(co)).reverse()
//       // })]
//       locationscoorinates.push([lng, lat])
//       let fitCoords = [
//         [
//           Math.min(...locationscoorinates.map(l => l[0])),
//           Math.min(...locationscoorinates.map(l => l[1])),
//         ],
//         [
//           Math.max(...locationscoorinates.map(l => l[0])),
//           Math.max(...locationscoorinates.map(l => l[1])),
//         ]
//       ]
// 			window.map.fitBounds(fitCoords, {
//         // linear: true, //easeto
//         padding: 80, 
//         //offset: [80, 60]
//       })
//       // setTimeout(function() {map.zoomOut({offset: [80, 60]})}, 2000);

//       //TODO hide show on recreational/medical toggle
//       // setTimeout(function() {
//       //   tmp.remove()
//       // }, 5000)
//       // window.onresize = () => { //TODO end interval/timeout
//       var timeOutFunctionId;
//       window.addEventListener("resize", function() {// clearTimeOut() resets the setTimeOut() timer
//         // due to this the function in setTimeout() is
//         // fired after we are done resizing
//         clearTimeout(timeOutFunctionId);
       
//         // setTimeout returns the numeric ID which is used by
//         // clearTimeOut to reset the timer
//         timeOutFunctionId = setTimeout(function(){
//           console.log('fitting')
//           window.map.fitBounds(fitCoords, {
//             // linear: true, //easeto
//             padding: 80, 
//             //offset: [80, 60]
//           })
//         }, 1000)
//       })
// 		}
// 	)
// }
function handleMap() {
  let $mapAnchor = $('#map-locations-wrap')
  if(!$mapAnchor.length){ return }
  //TODO console.log($mapAnchor.data())
  // _makeMap($mapAnchor)

  new MapLocations({
    target: $mapAnchor[0],
    props: $mapAnchor.data()
  })
}

function runPageBlocks() {
  if($body.hasClass('shop')) {
    handleMap()
  }
  if($body.hasClass('home') || $body.hasClass('single-drink')) {
    bestSellers()
    // animateBestSellers()
    //TODO FAQs()
  }

  if($body.hasClass('single-drink')) {
    // drinkSlider() //TODO turned to apge navigation
    drinkAttrsPrimary()
    drinkReviews()
  }

  //TODO deprecated
  // if($body.hasClass('drinks') || $body.hasClass('tax-drink_family')) {
  //   let $anchor = $('.cb-anchor')
  //   if ($anchor.length) {
  //     new Drinks({
  //       target: $anchor[0]
  //     })
  //   }
  // }
  
  
  //about
  articles()
  // join()
  
  //shop
  // locations()

}

export { 
  prevArrow,
  nextArrow,
  // bestSellers, 
  // drinkReviews, 
  // drinkSlider, 
  // FAQs,
  runPageBlocks
}