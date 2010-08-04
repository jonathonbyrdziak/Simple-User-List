<?php
/**
 * Joomla! 1.5 component reservation
 *
 * @version $Id: view.html.php 2010-06-02 12:34:25 svn $
 * @author 
 * @package Joomla
 * @subpackage Listings
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 * 
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
$user =& eFactory::getUser();

//loading media
JHTML::script('ajaxupload.js', 'components/'.EBOOK_COMPONENT.'/media/js/');

?>
<ul class="edit_menu" style="width:730px;">
	<li class="ajax_img">
		<form action="<?php echo JRoute::_('index.php?option='.EBOOK_COMPONENT.'&format=ajax&view=hardydirectory&layout=ajaxupload'); ?>" 
		method="post" name="sleeker" id="sleeker" enctype="multipart/form-data">
			<?php echo JHTML::_( 'form.token' ); ?>
			<input type="hidden" name="listings_id" value="<?php echo $record->id; ?>" /> 
			<input type="hidden" name="published" value="1"/>
			<input type="hidden" name="thumbnail" value="0"/>
			<input type="file" id="file_name" name="file_name" onChange="javascript: var thisform = document.getElementById('sleeker');ajaxUpload(thisform,thisform.action,'upload_area','File Uploading Please Wait...','Error in Upload, check settings and path info in source code.'); return false;" />
			
		</form>
	</li>
	<li class="ajax_img">
		<form action="<?php echo JRoute::_('index.php?option='.EBOOK_COMPONENT.'&format=ajax&view=hardydirectory&layout=ajaxupload'); ?>" 
		method="post" name="sleeker1" id="sleeker1" enctype="multipart/form-data">
			<?php echo JHTML::_( 'form.token' ); ?>
			<input type="hidden" name="listings_id" value="<?php echo $record->id; ?>" /> 
			<input type="hidden" name="published" value="1"/>
			<input type="hidden" name="thumbnail" value="1"/>
			<input type="file" id="file_name" name="file_name" onChange="javascript: var thisform = document.getElementById('sleeker1');ajaxUpload(thisform,thisform.action,'upload_area_thumb','File Uploading Please Wait...','Error in Upload, check settings and path info in source code.'); return false;" />
			
		</form>
	</li>
	<li><a href="<?php echo JRoute::_('index.php?task=delete&edit='.$record->id); ?>">Delete</a></li>
	
	<?php if ($user->isSpecial()): ?>
		<?php if (!$record->published): ?>
			<li><a href="<?php echo JRoute::_('index.php?task=publish&edit='.$record->id); ?>">Publish</a></li>
		<?php else: ?>
			<li><a href="<?php echo JRoute::_('index.php?task=unpublish&edit='.$record->id); ?>">UnPublish</a></li>
		<?php endif; ?>
	<?php endif; ?>
</ul>

<div class="clear"></div>

