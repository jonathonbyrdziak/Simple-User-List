<?php
/**
 * Joomla! 1.5 component byrdlist
 *
 * @version $Id: byrdlist.php 2010-06-07 11:32:44 svn $
 * @author Jonathon Byrd
 * @package Joomla
 * @subpackage byrdlist
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 * 
 *
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

//initializing variables
$data = JRequest::get('post');

//loading resources
$record =& JTable::getInstance('images', 'Table');
$record->bind( $data, array(), false );

$record->store();

if ($record->thumbnail)
{
	$width = "260px";
}
else
{
	$width = "260px";
}
?>
<?php if ($record->valid()): ?>
	<img src="<?php echo $record->file(); ?>" border="0" width="<?php echo $width; ?>"/>
<?php else: ?>
	<span class="warning"><p style="line-height:12px !important;">
	Sorry, there was an error: <?php echo $record->getError(); ?></p></span>
<?php endif; ?>