<?php
if(!$fields = get_fields()): no_fields('hero.php'); else:
   global $post;
?>
   <div class="page-hero">
      <div class="page-hero-content">
         <h1 class="sr-only"><?php echo $post->post_title; ?></h1>
         <h2 class="title is-1"><?php echo $fields['headline'] ?: $post->post_title; ?></h2>
         <p class="hero-description"><?php echo $fields['content']; ?></p>
         <?php if($btns = $fields['buttons']): ?>
            <?php 
            foreach($btns as $btn) {
               add_part('btn', $btn);
            } ?>
         <?php endif;?>
      </div>
      <div class="page-hero-img cover">
         <picture>
            <div class="decor-img" style="background-image: url(https://picsum.photos/1920/1920.webp)"></div>
            <?php //echo get_the_post_thumbnail(get_the_ID(), 'fp-xlarge', ['role' => 'presentation', 'lazyload' => true]); ?>
            <?php //echo wp_get_image_attachment(); ?>
         </picture>
      </div>
   </div>
<?php endif;?>