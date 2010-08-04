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

/**
 * Authorization array
 * 
 * 
 */
$authorization = array(
	'Super Administrator' => array(
		'authors.new',
		'authors.new_two',
	),
	'Editor' => array(
	
	),
	'Author' => array(
		'myaccount.default',
		'myaccount.delete',
		'listings.ajaxupload',
		'listings.new',
		'listings.new_two',
		'listings.new_three',
	),
	'Registered' => array(
		'myaccount.watchlist',
		'myaccount.subscriptions',
		'listings.payment',
		'listings.request',
		'listings.comment',
		'listings.offer',
		'listings.report',
	),
	'Public' => array(
		'authors.default',
		'authors.details',
		'myaccount.ipn',
		'myaccount.cron',
		'categories.default',
		'listings.buy_now',
		'listings.search_results',
		'listings.default',
		'listings.details',
		'listings.details_donation',
		'listings.details_financial',
		'listings.details_need',
		'listings.details_pdf',
		'listings.recommend',
		'listings.contact',
		'listings.search',
	),
	
);

//loading libraries
require_once EBOOK_HELPERS.DS.'authorization.php';

//process this array
eHelper::loop( $authorization );



