
<li class="dir_category_li accordion_toggler_<?php echo $key; ?>">
	<a href="#" onClick="javascript: return false;" class="<?php echo $last; ?>"><?php echo $name; ?></a>
</li>

<ul class="cat_listings accordion_content_<?php echo $key; ?>">
	<?php $this->element('cat_listings'); ?>
</ul>