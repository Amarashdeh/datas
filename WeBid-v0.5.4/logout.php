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

	include "includes/config.inc.php";

	$userid = $_SESSION["PHPAUCTION_LOGGED_IN"];

	unset($PHPAUCTION_LOGGED_IN);
	unset($PHPAUCTION_LOGGED_IN_USERNAME);
	unset($PHPAUCTION_LOGGED_IN_NAME);
	unset($PHPAUCTION_LOGGED_IN_EMAIL);
	unset($_SESSION["PHPAUCTION_LOGGED_IN"]);
	unset($_SESSION["PHPAUCTION_LOGGED_IN_USERNAME"]);
	unset($_SESSION["PHPAUCTION_LOGGED_IN_NAME"]);
	unset($_SESSION["PHPAUCTION_LOGGED_ACCOUNT"]);
	unset($_SESSION["PHPAUCTION_LOGGED_IN_EMAIL"]);

	if(isset($_COOKIE['PHPAUCTION_RM_ID'])) {
		@mysql_query("DELETE FROM ".$DBPrefix."rememberme WHERE hashkey='".$_COOKIE['PHPAUCTION_RM_ID']."'");
		setcookie("PHPAUCTION_RM_ID","",time()-3600);
	}
	Header("Location: $SETTINGS[siteurl]"."index.php");
	exit;

?>
