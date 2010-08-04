<?php
/**
 * Joomla! 1.5 component reservation
 *
 * @version $Id: view.feed.php 2010-06-02 12:34:25 svn $
 * @author 
 * @package Joomla
 * @subpackage reservation
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 * 
 *
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/**
 * Feed View class for the reservation component
 */
class HardydirectoryViewHardydirectory extends ResView 
{
	/**
	 * Contains the table model to use
	 * 
	 * @var string
	 */
	var $_table = 'listings';
	
	/**
	 * 
	 */
	function display($tpl = null) 
	{
        parent::display($tpl);
    }
    
    
}
?>