<?php
/**
 * Joomla! 1.5 component Every Booking
 *
 * @author Jonathon Byrd
 * @package Joomla
 * @subpackage everybooking
 * @license Proprietary software, closed source, All rights reserved November 2009 Every Booking Inc.
 * For more information please see http://www.everybooking.com
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

//loading resources
$user =& eFactory::getUser();

$GLOBALS['dropdowns'] = array(
	'categories' => array(
		'Realtors','Dentists','Lawyers','Doctors','Physicians','Landscapers'
	),
);
