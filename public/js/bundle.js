!function(){"use strict";var t=function(t){this.routes=t};t.prototype.fire=function(t,e,o){void 0===e&&(e="init");var n=""!==t&&this.routes[t]&&"function"==typeof this.routes[t][e];n&&this.routes[t][e](o)},t.prototype.loadEvents=function(){var t=this;this.fire("common"),document.body.className.toLowerCase().replace(/-/g,"_").split(/\s+/).map((function(t){return""+t.charAt(0).toLowerCase()+t.replace(/[\W_]/g,"|").split("|").map((function(t){return""+t.charAt(0).toUpperCase()+t.slice(1)})).join("").slice(1)})).forEach((function(e){t.fire(e),t.fire(e,"finalize")})),this.fire("common","finalize")};
/*! lozad.js - v1.16.0 - 2020-09-06
	* https://github.com/ApoorvSaxena/lozad.js
	* Copyright (c) 2020 Apoorv Saxena; Licensed MIT */
var e="undefined"!=typeof document&&document.documentMode,o={rootMargin:"0px",threshold:0,load:function(t){if("picture"===t.nodeName.toLowerCase()){var o=t.querySelector("img"),n=!1;null===o&&(o=document.createElement("img"),n=!0),e&&t.getAttribute("data-iesrc")&&(o.src=t.getAttribute("data-iesrc")),t.getAttribute("data-alt")&&(o.alt=t.getAttribute("data-alt")),n&&t.append(o)}if("video"===t.nodeName.toLowerCase()&&!t.getAttribute("data-src")&&t.children){for(var r,i=t.children,a=0;a<=i.length-1;a++)(r=i[a].getAttribute("data-src"))&&(i[a].src=r);t.load()}t.getAttribute("data-poster")&&(t.poster=t.getAttribute("data-poster")),t.getAttribute("data-src")&&(t.src=t.getAttribute("data-src")),t.getAttribute("data-srcset")&&t.setAttribute("srcset",t.getAttribute("data-srcset"));var s=",";if(t.getAttribute("data-background-delimiter")&&(s=t.getAttribute("data-background-delimiter")),t.getAttribute("data-background-image"))t.style.backgroundImage="url('"+t.getAttribute("data-background-image").split(s).join("'),url('")+"')";else if(t.getAttribute("data-background-image-set")){var c=t.getAttribute("data-background-image-set").split(s),u=c[0].substr(0,c[0].indexOf(" "))||c[0];u=-1===u.indexOf("url(")?"url("+u+")":u,1===c.length?t.style.backgroundImage=u:t.setAttribute("style",(t.getAttribute("style")||"")+"background-image: "+u+"; background-image: -webkit-image-set("+c+"); background-image: image-set("+c+")")}t.getAttribute("data-toggle-class")&&t.classList.toggle(t.getAttribute("data-toggle-class"))},loaded:function(){}};function n(t){t.setAttribute("data-loaded",!0)}var r=function(t){return"true"===t.getAttribute("data-loaded")},i=function(t,e){return void 0===e&&(e=document),t instanceof Element?[t]:t instanceof NodeList?t:e.querySelectorAll(t)};function a(t,e){void 0===t&&(t=".lozad"),void 0===e&&(e={});var a,s=Object.assign({},o,e),c=s.root,u=s.rootMargin,d=s.threshold,l=s.load,g=s.loaded;"undefined"!=typeof window&&window.IntersectionObserver&&(a=new IntersectionObserver(function(t,e){return function(o,i){o.forEach((function(o){(o.intersectionRatio>0||o.isIntersecting)&&(i.unobserve(o.target),r(o.target)||(t(o.target),n(o.target),e(o.target)))}))}}(l,g),{root:c,rootMargin:u,threshold:d}));for(var f,b=i(t,c),m=0;m<b.length;m++)(f=b[m]).getAttribute("data-placeholder-background")&&(f.style.background=f.getAttribute("data-placeholder-background"));return{observe:function(){for(var e=i(t,c),o=0;o<e.length;o++)r(e[o])||(a?a.observe(e[o]):(l(e[o]),n(e[o]),g(e[o])))},triggerLoad:function(t){r(t)||(l(t),n(t),g(t))},observer:a}}var s=(0,window.$)(document.body);var c=window.$,u=c(document.body),d={init:function(){a("img").observe(),window.onresize=function(){var t=c(".navbar-wrap").height();document.querySelector(":root").style.setProperty("--navbar-height",t+"px"),c("#mobile-menu").css("top",t+"px")},window.onload=window.onresize,s.hasClass("home")},finalize:function(){u.on("mousedown",(function(){u.addClass("using-mouse")})),u.on("keydown",(function(){u.removeClass("using-mouse")})),function(){var t=c("#mobile-menu");t.hide(),t.removeClass("loading");var e=c("#toggle_nav");function o(e){e.matches&&t.fadeOut()}c("main").on("click",(function(){t.slideUp()})),e.on("click",(function(e){console.log(e),t.slideToggle()}));var n=window.matchMedia("(min-width: 1025px)");o(n),n.addListener(o)}()}};var l=window.$;l(document.body);var g="body.home .page-default-content > *";function f(t){l(t).on("click",(function(t){t.preventDefault(),l(g).removeClass("show"),setTimeout((function(){window.location.href=t.target.href,setTimeout((function(){l(g).addClass("show")}),1500)}))}))}new t({common:d,home:{init:function(){var t;t=new IntersectionObserver((function(t){t.forEach((function(t){t.isIntersecting&&t.target.classList.add("show")}))})),l(g).each((function(e,o){return t.observe(o)})),document.querySelectorAll("a").forEach(f),l(".feat-prod-wrap").slick({slidesToShow:1,slidesToScroll:1,arrows:!0,fade:!0,infinite:!0,prevArrow:'<button type="button" class="slick-prev"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 0 39 0C17.4609 0 0 17.4609 0 39C0 60.5391 17.4609 78 39 78Z" fill="#006FAA"/> <path d="M21.5901 39L36.7001 56.04H49.8301L34.7201 39L49.8301 21.96H36.7001L21.5901 39Z" fill="white"/> </svg> <span class="sr-only">Previous</span></button>',nextArrow:'<button type="button" class="slick-next"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 4.21991e-06C17.4609 2.3369e-06 5.2925e-06 17.4609 3.40949e-06 39C1.52648e-06 60.5391 17.4609 78 39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 6.10291e-06 39 4.21991e-06Z" fill="#006FAA"/> <path d="M56.41 39L41.3 21.96L28.17 21.96L43.28 39L28.17 56.04L41.3 56.04L56.41 39Z" fill="white"/> </svg> <span class="sr-only">Next</span></button>'})},finalize:function(){basicScroll.create({elem:document.querySelector(".fast-acting-img"),from:"top-bottom",to:"bottom-top",props:{"--fastActingY":{from:"4vmax",to:"-4vmax"}}}).start()}}}).loadEvents()}();
//# sourceMappingURL=bundle.js.map