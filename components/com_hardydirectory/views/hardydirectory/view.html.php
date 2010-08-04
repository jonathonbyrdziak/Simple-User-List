<?php
/**
 * Joomla! 1.5 component Hardy Directory
 *
 * @version $Id: view.html.php 2010-07-12 13:23:30 svn $
 * @author Jonathon Byrd
 * @package Joomla
 * @subpackage Hardy Directory
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 * 
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * HTML View class for the Hardy Directory component
 */
class HardydirectoryViewHardydirectory extends ResView 
{
	
	var $_table = 'listings';
	
	/**
	 * 
	 * @param $tpl
	 */
	function display($tpl = null) 
	{
        parent::display($tpl);
    }
    
    /**
     * Category listings
     * 
     */
    protected function categories( $path = null )
    {
    	
		//loading media
		JHTML::script('accordion.js', 'components/'.EBOOK_COMPONENT.'/media/js/');
    	
    	$categories = $GLOBALS['dropdowns']['categories'];
    	
    	if (!is_array($categories)) return false;
    	
    	$total = count($categories);
    	$i = 0;
    	$last = "";
    	
    	foreach ($categories as $key => $name)
    	{
    		$i++;
    		if ($i >= $total) $last = "last_li";
    		$this->cat_key = (int)trim($key);
    		
    		require $path;
    	}
    }
    
    /**
     * Category listings module
     * 
     */
    protected function cat_listings( $path = null )
    {
    	$table =& JTable::GetInstance('listings', 'Table');
    	$listings = $table->getListingsOfCatId( $this->cat_key );
    	
    	//reasons to fail
    	if (!is_array($listings)) return false;
    	
    	foreach ($listings as $id => $listing)
    	{
    		require $path;
    	}
    	return true;
    }
    
    /**
     * Listing details
     * 
     * @param unknown_type $path
     */
    protected function listing_detail( $path = null )
    {
    	if ($id = JRequest::getVar('record',false))
    	{
    		$record =& JTable::getInstance('listings','Table');
    		$record->load($id);
    		
    		require $path;
    		return true;
    	}
    	if ($id = JRequest::getVar('edit', $this->id))
    	{
    		$record =& JTable::getInstance('listings','Table');
    		$record->load($id);
    		
    		require $path;
    		require dirname(__file__).DS."tmpl".DS."edit_listing.php";
    		return true;
    	}
    	
    	require_once dirname(__file__).DS."tmpl".DS."no_listings.php";
    	return false;
    	
    }
    
    /**
     * Saves the record on submit
     */
    protected function default_save()
    {
    	if (!JRequest::checkToken()) return false;
    	
    	//initializing variables
    	$data = JRequest::get('post');
    	$data['description'] = JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWHTML );
    	
    	//loading resources
    	$this->_record =& JTable::getInstance('listings', 'Table');
    	$this->_record->bind( $data, array(), false );
    	
    	$this->_record->store();
    	$this->id = $this->_record->id;
    	
    	return true;
    }
    
    /**
     * Saves the record on submit
     */
    protected function default_delete()
    {
    	//if (!JRequest::checkToken()) return false;
    	$user =& eFactory::getUser();
    	if (!$user->isSpecial()) return false;
    	
    	//loading resources
    	$this->_record =& JTable::getInstance('listings', 'Table');
    	$this->_record->load( JRequest::getVar('edit') );
    	
    	$this->_record->delete();
    	
    	header("Location: ".JRoute::_('index.php'));
    	exit();
    	
    	return true;
    }
    
    /**
     * Saves the record on submit
     */
    protected function default_publish()
    {
    	//if (!JRequest::checkToken()) return false;
    	$user =& eFactory::getUser();
    	if (!$user->isSpecial()) return false;
    	
    	//loading resources
    	$this->_record =& JTable::getInstance('listings', 'Table');
    	$this->_record->load( JRequest::getVar('edit') );
    	
    	$this->_record->published = 1;
    	
    	$this->_record->store();
    	$this->id = $this->_record->id;
    	
    	return true;
    }
    
    /**
     * Saves the record on submit
     */
    protected function default_unpublish()
    {
    	//if (!JRequest::checkToken()) return false;
    	$user =& eFactory::getUser();
    	if (!$user->isSpecial()) return false;
    	
    	//loading resources
    	$this->_record =& JTable::getInstance('listings', 'Table');
    	$this->_record->load( JRequest::getVar('edit') );
    	
    	$this->_record->published = 0;
    	
    	$this->_record->store();
    	$this->id = $this->_record->id;
    	
    	return true;
    }
}
?>