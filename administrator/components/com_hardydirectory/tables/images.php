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
class TableImages extends ResTable
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
	var $ext			= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $file_name		= null;

	/**
	 * 
	 *
	 * @var bool
	 */
	var $thumbnail		= null;

	/**
	 * 
	 *
	 * @var string
	 */
	var $listings_id	= null;

	
	/**
	 * @param database A database connector object
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__hardydirectory_images', 'id', $db );
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
		ext VARCHAR(55),
		thumbnail INT(1),
		listings_id INT,
		file_name VARCHAR(255))";
		
	    //loading resources
    	$db =& JFactory::getDBO();
    	
    	$db->setQuery( $query );
    	$results = $db->query();
    	
    	//reasons to fail
    	if (!$results) 
    		return false;
    	return true;
	}
	
	/**
	 * Delete the file too
	 */
	public function delete()
	{
		//initializing variables
		$path = $this->file( false );
		
		//reasons to fail
		if ( file_exists($path) )
		{
			unlink($path);
		}
		
		return parent::delete();
	}

	/**
	 * 
	 */
	function file( $http = true )
	{
		//initializing variables
		$path = EBOOK_IMAGES.DS.$this->id().'.'.$this->ext();
		
		//reasons to return
		if (!file_exists($path)) return false;
		
		if ($http) $path = DOTCOM_UPLOADS.$this->id().'.'.$this->ext();
		
		return $path;
	}

	/**
     * Method builds this model based on a contact's id
     * 
     * @param integer $user_id
     */
    function loadByListingId( $id = null, $thumbnail = false )
    {
    	if (is_null($id)) return false;
    	
    	//initializing variables
		$id = addslashes($id);
		
	 	//Get the Contacts information
		$query = "SELECT * FROM `".$this->_tbl."`"
				." WHERE `listings_id` = '".$id."'";
		
		if ($thumbnail)
		{
			$query .= " AND `thumbnail` = '1'";
		}
		else
		{
			$query .= " AND `thumbnail` != '1'";
		}
		
		$results = $this->query( $query );
		
		//reasons to return
		if (!$results) return false;
		
		$this->bind( $results[0] );
		return true;
    }

	/**
	 * 
	 */
	function listing_id()
	{
		//loading resources
		$listing =& $this->getOneToOne('listings');
		
		return $listing->id();
	}

	/**
	 * 
	 */
	function listing_name()
	{
		//loading resources
		$listing =& $this->getOneToOne('listings');
		
		return $listing->name();
	}
	
	/**
	 * 
	 */
	public function isThumbnail()
	{
		//loading resources
		$listing =& $this->getParent();
		$image = $listing->thumbnail();
		
		//reasosn to fail
		if (!$image) return false;
		
		if ($this->id() == $image->id())
		{
			$this->thumbnail = 1;
			$this->store();
			return true;
		}
		return false;
	}
	
	/**
	 * Save the Posted File
	 * 
	 */
	protected function saveFile()
	{
		//initializing variables
		$allowed_ext = array('jpg','jpeg','gif','png','bmp');
		$maxlimit = 9999999999;
		
		//loading resources
		$data = JRequest::getVar('file_name', null, 'files');
		$parts = pathinfo($data['name']);
		
		//initializing file variables
		$new_name = $this->id();
		$filesize = $data['size'];
		$file_ext = @$parts['extension'];
		
		$file_path = JPath::clean( EBOOK_IMAGES.DS.$new_name.'.'.$file_ext );
		
		
		//reasons to fail
		if ( empty($_FILES) )
		{
			$this->setError("101: File didn't post");
			return false;
		}
		
		if ( !in_array($file_ext, $allowed_ext) )
		{
			$this->setError("102: File type not allowed");
			return false;
		}
		
		if ( $filesize < 1 )
		{
			$this->setError("103: File size is zero");
			return false;
		}
		
		if ( $filesize > $maxlimit )
		{
			$this->setError("104: File over maximum limit");
			return false;
		}
		
		
		if(move_uploaded_file($data['tmp_name'], $file_path)) 
		{
			return true;
		}
		
		$this->setError("105: Couldn't move temporary file");
		return false;
	}
	
	/**
	 * Set the extension
	 * 
	 */
	protected function setExt()
	{
		//initializing variables
		$data = JRequest::getVar('file_name', null, 'files');
		
		//reasons to fail
		if (empty($_FILES)) return false;
		
		$parts = pathinfo($data['name']);
		$this->ext = $parts['extension'];
		return true;
	}
	
	/**
	 * Set this as the thumnail
	 * 
	 * Unsets the other thumbnail and then sets this one as the thumbnail
	 * 
	 */
	public function setThumbnail()
	{
		//loading resources
		$listing =& $this->getOneToOne('listings');
		$image = $listing->thumbnail();
		
		$image->thumbnail = 0;
		$image->store();
		
		$this->thumbnail = 1;
		$this->store();
		return true;
	}
	
	public function isPdfValid()
	{
		//reasons to fail
		if ($this->ext == 'bmp') return false;
		
		return true;
	}
	
	/**
	 * 
	 */
	protected function purge()
	{
		//reasons to fail
		if (!$this->listings_id) return false;
		
		//Get the Contacts information
		$query = "DELETE FROM `".$this->_tbl."`"
				." WHERE `listings_id` = '".$this->listings_id."'"
				." AND `id` != '$this->id'";
		
		if ($this->thumbnail)
		{
			$query .= " AND `thumbnail` = '1'";
		}
		else
		{
			$query .= " AND `thumbnail` != '1'";
		}
		
		$results = $this->query( $query );
		
		//reasons to return
		if (!$results) return false;
		return true;
	}

	/**
	 * 
	 */
	function store()
	{
		//initializing object properties
		$this->setExt();
		
		
		if ($id = parent::store())
		{
			//$this->saveRelationship('listings');
			$this->saveFile();
			$this->purge();
			
			if (!$this->valid())
			{
				$this->delete();
				$this->setError("106: Could not save image.");
				return false;
			}
			
			return $id;
		}
		else
		{
			$this->setError("109: Couldn't save the record.");
		}
		
		return false;
	}
	
	
	public function valid()
	{
		//initializing variables
		$path = $this->file( false );
		
		//reasons to fail
		if ( !file_exists($path) )
		{
			return false;
		}
		
		if ( !($contents = @file_get_contents($path)) )
		{
			$this->setError("107: Get Contents Failed");
			return false;
		}
		
		if ( strlen(trim($contents)) <1 )
		{
			$this->setError("108: File was empty");
			return false;
		}
		
		return true;
	}
	
}
