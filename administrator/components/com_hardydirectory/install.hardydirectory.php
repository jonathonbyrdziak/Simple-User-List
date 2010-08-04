<?php 

//loading resources
$db =& JFactory::getDBO();
  	

//initializing variables
$query = "CREATE TABLE `#__hardydirectory_images`(
id CHAR(36) NOT NULL,
PRIMARY KEY(id),
ext VARCHAR(55),
thumbnail INT(1),
listings_id char(36),
file_name VARCHAR(255))";

$db->setQuery( $query );
$results = $db->query();



//initializing variables
$query = "CREATE TABLE `#__hardydirectory_listings`(
id CHAR(36) NOT NULL,
PRIMARY KEY(id),
name VARCHAR(255),
description TEXT,
category_id INT(11),
email VARCHAR(255),
website VARCHAR(255),
office VARCHAR(255),
published INT(11))";

$db->setQuery( $query );
$results = $db->query();
?>