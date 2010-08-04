<?php
/**
 * Joomla! 1.5 component Hardy Directory
 *
 * @version $Id: hardydirectory.php 2010-07-12 13:23:30 svn $
 * @author Jonathon Byrd
 * @package Joomla
 * @subpackage Hardy Directory
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 * 
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Initialize the controller
$controller = new HardydirectoryController();
$controller->execute( null );

// Redirect if set by the controller
$controller->redirect();
?>