<script>
   import Map from './shop/map.svelte'
   import Locations from './shop/locations.svelte'

   export let searchCoordinates
   export let locations
</script>

<section id="map-locations"> 
   <Map {searchCoordinates} {locations} /> 
   <Locations {locations} />
</section>