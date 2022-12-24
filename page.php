<?php /** Default Page Template */
add_theme_support( 'wp-block-styles' );
$fields = get_fields();
get_header();
?>

<main id="site-main" class="main-content-wrap">
   <div class="main">
      <div class="inner-wrap">
         <div class="page-default-content">

<?php the_content(); ?>

<?php print_r(get_the_content()); ?>

         </div>
      </div>
   </div>
</main>

<?php
get_footer();