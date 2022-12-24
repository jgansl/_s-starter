<div id="mobile-menu" class="loading">
   <div class="main">
      <div class="inner-wrap">
         
         <nav>
         <?php
         wp_nav_menu( array(
            'menu' => get_term(get_nav_menu_locations()['mobile-navigation'], 'nav_menu')->name,
            'container' => true,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'menu_class' => 'mobile-links',
            'depth' => 3,
         ) );
         ?>
         </nav>
         
      </div>
   </div>
</div>