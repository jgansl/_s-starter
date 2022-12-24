<?php 
if(!$fields = get_fields()): no_fields('hero.php');
?>
   <div class="page-hero">
      <div class="page-hero-content">
         <h1 class="sr-only"><?php echo $post->post_title; ?></h1>
         <h2 class="title is-1"><?php echo $fields['headline'] ?: $post->post_title; ?></h2>
         <p class="title is-1"><?php echo $fields['content']; ?></p>
         <?php part('btn', []);?>
      </div>
      <div class="page-hero-img">
         <picture>
            <?php echo get_the_post_thumbnail(get_the_ID(), 'fp-xlarge', ['role' => 'presentation', 'lazyload' => true]); ?>
            <?php //echo wp_get_image_attachment(); ?>
         </picture>
      </div>
   </div>
<?php endif;?>