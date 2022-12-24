<?php 
if(!$fields = $args) {
   $fields = get_fields();
}; 
$btn = $fields;
if(!array_key_exists('target', $btn)) {
   $btn['target'] = '_self';
}
?>
<a href="<?php echo $btn['url'];?>" 
   target="<?php echo $btn['target']?:'_self';?>" class="btn-outlined">
   <?php echo $btn['title']; ?>
</a>