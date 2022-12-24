// match unique body_class
import Router from './util/Router'
import common from './routes/common'
import home from './routes/home'
import drinks from './routes/drinks' //pageId23
import taxDrinkFamily from './routes/drinks'
import shop from './routes/shop'
import single from './routes/single'
import singleLocation from './routes/single-location'
import about from './routes/about'

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  common,
  home,
  drinks,
  taxDrinkFamily,
  shop,
  single,
  singleLocation,
  about
})

/** Load Events */
routes.loadEvents()
