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

#// Create new list
if($_POST['action'] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
	$query = "UPDATE ".$DBPrefix."users SET endemailmode='".addslashes($_POST['endemailmod'])."', 
			  startemailmode='".addslashes($_POST['startemailmod'])."',reg_date=reg_date 
			  WHERE id=".intval($_SESSION['PHPAUCTION_LOGGED_IN']);
	$res = @mysql_query($query);
	if(!$res) {
		MySQLError($query);
		exit;
	} else {
		$ERR = $MSG_25_0192;
	}
}


$EMAILMODE = @mysql_fetch_array(@mysql_query("SELECT startemailmode,endemailmode FROM ".$DBPrefix."users WHERE id=".intval($_SESSION['PHPAUCTION_LOGGED_IN'])));

require("header.php");
include phpa_include("template_sellermails_php.html");
include "./footer.php";

?>