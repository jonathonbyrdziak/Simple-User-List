<?php 

//loading resources
$user =& eFactory::getUser();


if ($record->published)
{
	$title_class = "orange_title ";
}
else
{
	$title_class = "grey_title ";
}
?>
<div style="background:#ffffff;">
	<div class="left listing_img" id="upload_area">
		<?php if ($src = $record->getImageSrc()): ?>
			<img src="<?php echo $src; ?>" width="260px" />
		<?php endif; ?>
	</div>
	
	<div class="left" style="width:430px;padding-left:30px;">
		<h3 class="<?php echo $title_class; ?>left"><?php echo $record->name; ?></h3>
		
		<?php if ($user->isSpecial()): ?>
			<?php if (!JRequest::getVar('edit',false)): ?>
				<div class="edit_button">
					<a href="<?php echo JRoute::_('index.php?layout=add_one&record='.$record->id); ?>">
					edit</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<div class="clear"></div>
		
		<?php echo $record->description( 500 ); ?>
		
		<div class="clear"></div>
		<br/>
		
		<div class="left thumbnail_img" id="upload_area_thumb">
		<?php if ($src = $record->getImageSrc(1)): ?>
			<img src="<?php echo $src; ?>" width="163px" />
		<?php endif; ?>
		</div>
		
		
		<div class="left" style="width:185px;padding-left:30px;">
			<p><?php echo $record->email; ?></p>
			<p><?php echo $record->website; ?></p>
			<br/>
			<p>Office: <?php echo $record->office; ?></p>
			
		</div>
		
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>