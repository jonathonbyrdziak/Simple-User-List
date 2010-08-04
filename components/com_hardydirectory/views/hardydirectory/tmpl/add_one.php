<?php 

//initializing variables
$data = JRequest::get('post');
$data['description'] = JRequest::getVar( 'description', $this->_record->description(), 'post', 'string', JREQUEST_ALLOWHTML );



//loading resources
$editor =& JFactory::getEditor();

$params = array( 
	'smilies'=> 0,
	'layer'  => 0,
	'clear_entities' => 0,
	'compressed' => 0,
	'style'  => 0,
	'newlines'  => 1,
	'theme'  => 'advanced',
	'searchreplace'  => 0,
	'insertdate'  => 0,
	'inserttime'  => 0,
	'hr'  => 0,
	'fullscreen'  => 0,
	'directionality'  => 0,
	'xhtmlxtras'  => 0,
	'table'  => 1,
);
                 
// parameters : areaname, content, width, height, cols, rows
$description = $editor->display( 'description', $data['description'], '545px', '550', '75', '20', false, $params );


?>
<div class="directory_header">
	<h3 class="orange_title">Submit a Listing</h3>
	<p>Upon submitting your listing, our staff will be notified and they will begin to 
	review the information that you have provided. If your listing is approved, then
	a staff member will activate your listing. Upon activation you will receive an
	email notification. Thank you for submitting your listing!</p>
</div>

<form method="post" action="<?php echo JRoute::_('index.php?task=save'); ?>">
<table class="add_new" border="0" cellspacing="0" cellpadding="0">
	
	<input type="hidden" name="published" value="<?php echo $this->_record->published; ?>" /> 
	<input type="hidden" name="id" value="<?php echo $this->_record->id; ?>" /> 
	<?php echo JHTML::_( 'form.token' ); ?>
	
	<tr> 
		<td class="add_label">Category</td>
		<td class="add_new"><?php $this->element('dropdown_category'); ?></td>
	</tr>
	<tr>
		<td class="add_label">Name</td>
		<td class="add_new"><input type="text" name="name" value="<?php echo $this->_record->name; ?>" /></td>
	</tr>
	<tr>
		<td class="add_label">Email</td>
		<td class="add_new"><input type="text" name="email" value="<?php echo $this->_record->email; ?>" /></td>
	</tr>
	<tr>
		<td class="add_label">Website</td>
		<td class="add_new"><input type="text" name="website" value="<?php echo $this->_record->website; ?>" /></td>
	</tr>
	<tr>
		<td class="add_label">Office</td>
		<td class="add_new"><input type="text" name="office" value="<?php echo $this->_record->office; ?>" /></td>
	</tr>
	<tr>
		<td class="add_label">Description</td>
		<td class="add_new"><?php echo $description; ?></td>
	</tr>
</table>

<button type="button" class="listing_cancel" onClick="javascript: window.location ='<?php echo JRoute::_('index.php?option='.EBOOK_COMPONENT); ?>';">Go Back</button>
<button type="submit" class="listing_submit">Submit this Listing</button>
</form>