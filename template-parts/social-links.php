<div class="d-flex justify-content-center">
   <?php foreach($social_links as $sl):?>
      <a class="social-icon" href="<?php echo $sl['link'];?>" rel="noreferrer">
         <span class="sr-only">visit <?php echo $sl['label'];?> profile</span>
         <?php svg($sl['label']); ?>
      </a>
   <?php endforeach;?>
</div>