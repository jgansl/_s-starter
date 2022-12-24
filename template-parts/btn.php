<?php 
if(!$fields = $args) {
   $fields = get_fields();
}; 
$btn = $fields;
if(!array_key_exists('target', $btn)) {
   $btn['target'] = '_self';
}
?>
<?php if(array_key_exists('url', $btn)) { ?>
<a href="<?php echo $btn['url'];?>" 
   target="<?php echo $btn['target']?:'_self';?>" class="btn">
   <?php echo $btn['title']; ?>
</a>
<?php } ?>