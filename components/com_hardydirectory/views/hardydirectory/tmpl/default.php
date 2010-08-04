<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php $this->element('header'); ?>


<div class="clear"></div>


<div class="directory_content maincol_full">
	<div class="w_20 left padbottom_15 accordion_menu">
		<?php $this->element('categories'); ?>
	</div>
	
	<div class="w_80 left">
		<?php $this->element('listing_detail'); ?>
	</div>
	
	<div class="clear"></div>
</div>