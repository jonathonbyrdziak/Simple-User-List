<?php
/**
* @version		$Id: user.php 11223 2008-10-29 03:10:37Z pasamio $
* @package		Joomla.Framework
* @subpackage	Table
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Users table
 *
 * @package 	Joomla.Framework
 * @subpackage		Table
 * @since	1.0
 */
class TableListings extends ResTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id				= null;

	/**
	 * 
	 * 
	 * @var string
	 */
	var $name			= null;

	/**
	 * 
	 * 
	 * @var string
	 */
	var $description	= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $category_id	= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $email			= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $website		= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $office			= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $published		= null;

	
	/**
	 * @param database A database connector object
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__hardydirectory_listings', 'id', $db );
		//$this->checkTable();
	}

	/**
	 * 
	 */
	function Check()
	{
		return true;
	}
	
	/**
	 * Makes sure that the table exists
	 */
	protected function checkTable()
	{
		//reasons to return
		if ($this->table_exists()) return true;
		if ($this->create_table()) return true;
		return false;
	}
	
	/**
	 * Creates the database table
	 * 
	 */
	protected function create_table()
	{
		//initializing variables
		$query = "CREATE TABLE `$this->_tbl`(
		id CHAR(36) NOT NULL,
		PRIMARY KEY(id),
		name VARCHAR(255),
		description TEXT,
		category_id INT(11),
		email VARCHAR(255),
		website VARCHAR(255),
		office VARCHAR(255),
		published INT(11))";
		
	    //loading resources
    	$db =& JFactory::getDBO();
    	
    	$db->setQuery( $query );
    	$results = $db->query();
    	
    	//reasons to fail
    	if (!$results) 
    		return false;
    	return true;
	}
	
	
	public function getListingsOfCatId( $id )
	{
		if (is_null($id)) return false;
    	
    	//initializing variables
		$id = addslashes($id);
		$new = array();
		
	 	//Get the Contacts information
		$query = "SELECT * FROM `".$this->_tbl."`"
				." WHERE `category_id` = '".$id."';";
		$this->_db->setQuery($query);
		$results = $this->_db->loadAssocList(); 
		
		//reasons to return
		if (!$results) return false;
		
		foreach($results as $result)
		{
			$instance = JTable::getInstance('listings','Table');
			$instance->bind($result);
			
			$new[$result['id']] = $instance;
		}
		
		return $new;
	}
	
	/**
	 * 
	 */
	public function getImage( $thumb = false )
	{
		$image =& JTable::getInstance('images','Table');
		$image->loadByListingId( $this->id, $thumb );
		
		if (!$image->id) return false;
		
		return $image;
	}
	
	/**
	 * 
	 */
	public function getImageSrc( $thumb = false )
	{
		$image = $this->getImage( $thumb );
		
		if (!$image) return false;
		
		return $image->file();
	}

	/**
	 * 
	 */
	function store()
	{
		if ($id = parent::store())
		{
			//$this->saveRelationship('byrdlist_listings');
			return $id;
		}
		return false;
	}
}
