<?php 

$params = &JComponentHelper::getParams( EBOOK_COMPONENT );

$content =& JTable::getInstance('content');
$content->load( $params->get( 'Front Page Article' ) );






?>
<div class="directory_header">
	<div class="w_70 left">
		<h3 class="orange_title"><?php echo $content->title; ?></h3>
		<?php echo $content->introtext; ?>
	</div>
	
	<div class="w_20 left padtop_100">
		<a href="<?php echo JRoute::_('index.php?layout=add_one'); ?>" class="button_orange">Join Our Directory</a>
	</div>
</div>