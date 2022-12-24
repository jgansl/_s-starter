const { $ } = window
const $body = $(document.body)

// let $sideBar = $('aside')
// let $toggle = $('.filter-toggle button')
// let $close = $('.filters-close svg')
// let isOpen = true
// let t = false

//TODO
// function updateUrl() {
//   history.replaceState(null, null, null)
// }

export default {
  init() {
    window.onload = () => {
      // startIntersectionObserver()
    }

   //  let paramString = window.location.href.split('?')[1]
   //  let queryString = new URLSearchParams(paramString)

    // $sideBar.hide()
    //  $('.drinks-grid').isotope({
    //    // options
    //    itemSelector: '.drinks-item',
    //    // layoutMode: 'fitRows',
    //    // percentPosition: true,
    //    masonry: {
    //      // use element for option
    //      //   columnWidth: '.grid-sizer'
    //      columnWidth: '.grid-sizer',
    //      gutter: '.gutter-sizer',
    //    },
    //    // filter: function() {
    //    //    // _this_ is the item element. Get text of element's .number
    //    //    var number = $(this).find('.number').text();
    //    //    // return true to show, false to hide
    //    //    return parseInt( number, 10 ) > 50;
    //    // }
    //  })

   //  $toggle.on('click', () => {
   //    setTimeout(function () {
   //      console.log('resizing')
   //      $('.drinks-grid').isotope('destroy')
   //      $('.drinks-grid').isotope({
   //        // options
   //        itemSelector: '.drinks-item',
   //        // layoutMode: 'fitRows',
   //        // percentPosition: true,
   //        masonry: {
   //          // use element for option
   //          //   columnWidth: '.grid-sizer'
   //          columnWidth: '.grid-sizer',
   //          gutter: '.gutter-sizer',
   //        },
   //        // filter: function() {
   //        //    // _this_ is the item element. Get text of element's .number
   //        //    var number = $(this).find('.number').text();
   //        //    // return true to show, false to hide
   //        //    return parseInt( number, 10 ) > 50;
   //        // }
   //      })
   //    }, 250)
   //  })
   //  window.onresize = () => {
   //    $('.drinks-grid').isotope('destroy')
   //    $('.drinks-grid').isotope({
   //      // options
   //      itemSelector: '.drinks-item',
   //      // layoutMode: 'fitRows',
   //      // percentPosition: true,
   //      masonry: {
   //        // use element for option
   //        //   columnWidth: '.grid-sizer'
   //        columnWidth: '.grid-sizer',
   //        gutter: '.gutter-sizer',
   //      },
   //      // filter: function() {
   //      //    // _this_ is the item element. Get text of element's .number
   //      //    var number = $(this).find('.number').text();
   //      //    // return true to show, false to hide
   //      //    return parseInt( number, 10 ) > 50;
   //      // }
   //    })
   //  }
    // filter items on button click
    let selection = []
    // Array.prototype.remove = function(value) {
    //    return selection.filter(function(v) {
    //        return v != value;
    //    });
    // }
    $('.tax-item').on('click', 'input', function () {
      let $vals = $('.tax-item input').map((idx, el) => {
        return $(el).val()
      })
      // console.log($vals)
      var filterValue = $(this).val() //attr('data-filter');
      if (selection.includes(filterValue)) {
        // console.info(selection.indexOf(filterValue))
        selection = selection.filter(function (item) {
          return item !== filterValue
        })
      } else {
        selection.push(filterValue)
      }
      // console.log(selection)
      // console.info(selection.map((el) => '.'+el).join(" "))
      let filter = selection.map((el) => '.' + el).join(', ')
      // if(filter) {
      //    $(`.drinks-item:not(${filter})`).animate({ transform: 'scale(0)', opacity: 0})
      //    $(filter).animate({ transform: 'scale(1)', opacity: 1})
      // } else {
      //    $('.drinks-item').animate({ transform: 'scale(1)', opacity: 1})
      // }
      // $('.drinks-grid').isotope({ filter: filter ? filter : '*' })
    })
  },
  finalize() {
   //  $toggle.on('click', toggleSidebar)
   //  $close.on('click', toggleSidebar) //should be isOpen
  },
}

//TODO deprecated
function toggleSidebar() {
  if (t) {
    return
  }
  t = true

  if (isOpen) {
    $sideBar.fadeOut(200)
    $toggle.text('Show Filters')
  } else {
    $sideBar.fadeIn(200)
    $toggle.text('Hide Filters')
  }

  isOpen = !isOpen //timeout rxjs
  setTimeout(function () {
    t = false
  }, 200)
}

function startIntersectionObserver() {
  let count = 0
  let interval, t
  function animateOut(el) {
    el.addEventListener('click', function (e) {
      e.preventDefault()
      $('.drinks-featured-item').each((idx, ele) => {
         count +=1
         setTimeout(function () {
            ele.classList.remove('show')
         }, 100 * count)
      })
      setTimeout(function () { //TODO TEST drinks page functionality
        e.target.href ?
        window.location.href = e.target.href :  window.location.href = '/'
        //home header logo
      }, 100 * count)
      
      $('.drinks-featured-item').each((idx, ele) => {
         count +=1
         setTimeout(function () {
            ele.classList.add('show')
         }, 200 + 100 * count)
      })
      
      // console.log(count)
      // console.log(interval)
      // // if (interval) { return }
      interval = setInterval(function () {
         //  t = true
          count = Math.max(0, count - 1)
          if (count == 0) {
            t = false
            clearInterval(interval)
         }
      }, 100)
    })
  }
  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        setTimeout(function () {
          entry.target.classList.add('show')
        }, 100 * count)
        count += 1
        
        if (interval) { return }
        interval = setInterval(function () {
         //  t = true
          count = Math.max(0, count - 1)
          if (count == 0) {
            t = false
            clearInterval(interval)
         }
        }, 100)
      } // else { entry.target.classList.remove('show') }
    })
  })
  $(`.drinks-featured-item`).each((_idx, el) => io.observe(el))
  document.querySelectorAll('a').forEach(animateOut)
}

//TODO deprecate
// function xstartIntersectionObserver() {
//   let count = 0
//   let interval
//   function animateOut(el) {
//     el.addEventListener('click', function (e) {
//       e.preventDefault()
//       $('.drinks-featured-item').each((idx, el) => {
//         setTimeout(function () {
//           el.classList.remove('show')
//         }, count * 80)
//         count += 1
//         //for popstate
//         setTimeout(function () {
//           el.classList.add('show')
//         }, 650 + 80 * count)
//       })
//       console.log(count)
//       setTimeout(function () {
//         window.location.href = e.target.href
//       }, count * 80)
//     })
//   }
//   const io = new IntersectionObserver((entries) => {
//     entries.forEach((entry) => {
//       //TODO prevent in viewport
//       //TODO lazy-load background-imgs
//       if (entry.isIntersecting) {
//         setTimeout(function () {
//           //TODO done -> remove transiitions css
//           entry.target.classList.add('show')
//           console.log(entry.target)
//         }, 80 * count)
//         count += 1
//         interval = setInterval(function () {
//           if (interval) {
//             return
//           }
//           count = Math.max(0, count - 1)
//           if (count == 0) {
//             console.log('clear')
//             clearInterval(interval)
//           }
//         }, 100)
//         //   setTimeout(function () {
//         //     count = 0
//         //   }, 1000)
//       } else {
//         entry.target.classList.remove('show')
//       }
//     })
//   })
//   $(`
//       .drinks-featured-item
//     `).each((_idx, el) => io.observe(el))

//   document.querySelectorAll('a').forEach(animateOut)
// }
// function _startIntersectionObserver() {
//   console.log('io')
//   let count = 0
//   setInterval(function () {
//     count = Math.max(0, count - 1)
//     console.log(count)
//   }, 100)
//   $(`
//       .drinks-featured-item
//    `).each((_idx, el) => {
//     setTimeout(function () {
//       //TODO done -> remove transiitions css
//       el.classList.add('show')
//     }, 80 * count)
//     count += 1
//   })
//   //   const io = new IntersectionObserver((entries) => {
//   //     entries.forEach((entry) => {
//   //       //TODO prevent in viewport
//   //       //TODO lazy-load background-imgs
//   //       if (entry.isIntersecting) {
//   //         setTimeout(function () {
//   //            //TODO done -> remove transiitions css
//   //           entry.target.classList.add('show')
//   //           console.log(entry.target)
//   //         }, 80 * count)
//   //         count += 1
//   //       //   setTimeout(function () {
//   //       //     count = 0
//   //       //   }, 1000)
//   //       }
//   //       // else {
//   //       //   entry.target.classList.remove('show')
//   //       // }
//   //     })
//   //   })
//   //   $(`
//   //       .drinks-featured-item
//   //    `).each((_idx, el) => io.observe(el))
//   function animateOut(el) {
//     el.addEventListener('click', function (e) {
//       e.preventDefault()
//       console.log('animatingOut')
//       $('.drinks-featured-item').each((idx, el) => {
//         setTimeout(function () {
//           el.classList.remove('show')
//         }, count * 80)
//         count += 1
//       })
//       console.log(count)
//       setTimeout(function () {
//         window.location.href = e.target.href
//       }, count * 80)
//     })
//   }
//   document.querySelectorAll('a').forEach(animateOut)

//   window.addEventListener('popstate', function (e) {
//     history.pushState(null, null, document.title)
//     e.preventDefault()
//     console.info(e)
//   })
// }
