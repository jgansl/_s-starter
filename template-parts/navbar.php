<?php 
  global $option_fields;
?>
<div class="navbar-wrap">
  <div class="main">
  <div class="inner-wrap">
    <nav class="navbar">
      <a href="<?php echo get_site_url() ?>" class="logo-link">
      <span class="sr-only">home</span>
      <!-- TODO height/ width --> 
        <!-- <img src="<?php //echo $option_fields['logo']['sizes']['medium']; ?>" alt="<?php echo get_bloginfo() ?> Logo" width="<?php echo $option_fields['logo']['sizes']['medium-width']; ?>" height="<?php //echo $option_fields['logo']['sizes']['medium-height']; ?>"> -->
        <?php //include( locate_template('assets/svg/logo.svg', false, false, $args=[]));?>
      </a>
      <button id="toggle_nav" class="toggle-nav">
        <div class="hamburger">
          <div></div>
          <div></div>
          <div></div>
        </div>
        <span class="sr-only">Toggle mobile menu</span>
      </button>
      <?php
        wp_nav_menu( array(
          'menu' => get_term(get_nav_menu_locations()['primary-navigation'], 'nav_menu')->name,
          'container' => true,
          'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'menu_class' => 'header-links menu-trailing',
          'depth' => 3,
        ) );
      ?>
    </nav>
  </div>
  </div>
</div>
