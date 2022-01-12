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
if(!defined("INCLUDED")) exit("Access denied");

#// Atuomatically login user is necessary ("Remember me" option
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"]) && isset($_COOKIE['PHPAUCTION_RM_ID'])) {
	$query = "SELECT userid FROM ".$DBPrefix."rememberme WHERE hashkey='".addslashes($_COOKIE['PHPAUCTION_RM_ID'])."'";
	$res = mysql_query($query);
	if(!$res){
		MySQLError($query);
		exit;
	}elseif(mysql_num_rows($res) > 0){
		$REMEMBER = mysql_fetch_array(mysql_query("SELECT id,email,nick,name FROM ".$DBPrefix."users WHERE id=".intval(mysql_result($res,0,"userid"))));
		mysql_error();
		$_SESSION["PHPAUCTION_LOGGED_IN"] = $REMEMBER['id'];
		$_SESSION["PHPAUCTION_LOGGED_EMAIL"] = $REMEMBER['email']; 
		$_SESSION["PHPAUCTION_LOGGED_NAME"] = $REMEMBER['name'];
		$_SESSION["PHPAUCTION_LOGGED_IN_USERNAME"] = $REMEMBER['nick'];
	}
}

/** *************************************************************************
* NOTE: Modules enbled version
* This version of header.php can be called from any Phpauction XL module
* It uses the $prefix variable to set the correct include path.
*
*
*****************************************************************************/

include $prefix."includes/ips.inc.php";
//-- Function definition section
include $prefix."includes/dates.inc.php";

include $prefix."maintenance.php";
include $prefix."includes/banners.inc.php";

#//
if(basename($PHP_SELF) !== "error.php")
{
	include $include_path."stats.inc.php";
}
// flag to enable style editor
$editstyle=isset($_SESSION["PHPAUCTION_ADMIN_USER"]) && !isset($_GET['thepage']);
$editstyle=$editstyle && $prefix=="";
// to handle relative paths to themes when browsing webstores
// Seeks path to header.php.html in address of being at home directory or webstores module
if (!isset($SETTINGS['theme']) || empty($SETTINGS['theme'])) $SETTINGS['theme']='default';
$htmlheader="themes/".$SETTINGS['theme']."/header.php.html";

if (!file_exists($htmlheader)) {
	$htmlheader="../../themes/".$SETTINGS['theme']."/header.php.html";
}

include($htmlheader);
?>
