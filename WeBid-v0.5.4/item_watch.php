<?php
/***************************************************************************
*   copyright				: (C) 2008 WeBid
*   site					: http://sourceforge.net/projects/simpleauction
***************************************************************************/

/***************************************************************************
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version. Although none of the code may be
*   sold. If you have been sold this script, get a refund.
***************************************************************************/

require('./includes/config.inc.php');
include $include_path."browseitems.inc.php";

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}

require("header.php");

// Auction id is present, now update table
if (isset($_GET['add']) && !empty($_GET['add'])) {
	// Check if this item is not already added
	$query = "SELECT item_watch from ".$DBPrefix."users where nick='".addslashes($_SESSION[PHPAUCTION_LOGGED_IN_USERNAME])."'";
	$result = @mysql_query("$query");
	if(!$result) {
		MySQLError($query);
		exit;
	}
	$items = trim(mysql_result ($result,0,"item_watch"));
	if ($items!="disabled") {
		$match = strstr($items, $_GET['add']);
		$items = $items;
	} else { 
		$items = ""; 
	}
	
	if (!$match) {
		$item_watch = trim("$items ".$_GET['add']);
		$item_watch_new = trim($item_watch);
		$query = "UPDATE ".$DBPrefix."users set item_watch='".addslashes($item_watch_new)."',reg_date=reg_date where nick='".addslashes($_SESSION[PHPAUCTION_LOGGED_IN_USERNAME])."' ";
		$result = @mysql_query("$query");
		if(!$result) {
			MySQLError($query);
			exit;
		}
	}
}

// Delete item form item watch
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$query = "SELECT item_watch from ".$DBPrefix."users where nick='".addslashes($_SESSION[PHPAUCTION_LOGGED_IN_USERNAME])."' ";
	$result = @mysql_query("$query");
	if(!$result) {
		MySQLError($query);
		exit;
	}
	$items = trim(mysql_result ($result,0,"item_watch"));
	
	$auc_id = split(" ",$items);
	for ($j=0; $j < count($auc_id); $j++) {
		$match = strstr($auc_id[$j],$_GET['delete']);
		if ($match) { 
			$item_watch = $item_watch; 
		} else {
			$item_watch = "$auc_id[$j] $item_watch";
		} 
	}
	$item_watch_new = trim($item_watch);
	if (($item_watch_new=="") || ($item_watch_new==" ")) { $item_watch_new="disabled"; }
	$query = "UPDATE ".$DBPrefix."users set item_watch='$item_watch_new',reg_date=reg_date where nick='".addslashes($_SESSION[PHPAUCTION_LOGGED_IN_USERNAME])."' ";
	$result = @mysql_query("$query");
	if(!$result) {
		MySQLError($query);
		exit;
	}
}


// Show results
$query = "SELECT item_watch from ".$DBPrefix."users where nick='".addslashes($_SESSION[PHPAUCTION_LOGGED_IN_USERNAME])."' ";
$result = @mysql_query("$query");
if(!$result) {
	MySQLError($query);
	exit;
}
$TPL_auctions_list_value = '';
$items = trim(mysql_result ($result,0,"item_watch"));
if(@mysql_num_rows($result) > 0) $HasResults = TRUE;
if (($items=="disabled") || ($items=="") || ($items=="NULL") ) { } else {
	$item = split(" ",$items);
	$itemids = "0";
	for ($j=0; $j < count($item); $j++){
		$itemids .= ",$item[$j]";
	}
	$query = "SELECT * from ".$DBPrefix."auctions where id IN ($itemids)";
	$result = @mysql_query("$query") or die (mysql_error().$query);
	if(!$result) {
		MySQLError($query);
		exit;
	} elseif(mysql_num_rows($result) > 0){
		$TPL_auctions_list_value=browseItems($result);
	}
}

include phpa_include("template_item_watch_php.html");
include "./footer.php";

?>