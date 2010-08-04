<?php
/**
 * Joomla! 1.5 component Hardy Directory
 *
 * @version $Id: controller.php 2010-07-12 13:23:30 svn $
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

jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );

/**
 * Hardy Directory Controller
 *
 * @package Joomla
 * @subpackage Hardy Directory
 */
class HardydirectoryController extends JController {
    /**
     * Constructor
     * @access private
     * @subpackage Hardy Directory
     */
    function __construct() {
        //Get View
        if(JRequest::getCmd('view') == '') {
            JRequest::setVar('view', 'default');
        }
        $this->item_type = 'Default';
        parent::__construct();
    }
}
?>