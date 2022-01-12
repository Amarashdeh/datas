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

include("./includes/config.inc.php");

if($SETTINGS['boards'] == 'n') {
	Header("Location: index.php");
}


#// ################################################
#// Is the seller logged in?
if(!isset($_SESSION['PHPAUCTION_LOGGED_IN'])) {
	$REDIRECT_AFTER_LOGIN = "boards.php";
	$_SESSION['REDIRECT_AFTER_LOGIN']=$REDIRECT_AFTER_LOGIN;

	Header("Location: user_login.php");
	exit;
}
#// ################################################

#// Retrieve message boards from the database
$query = "SELECT * FROM ".$DBPrefix."community WHERE active=1 ORDER BY name";
$ress_ = @mysql_query($query);
if(!$ress_) {
	$TMP_ERROR =  "Error: $query<BR>".mysql_error();
	$_SESSION["TMP_ERROR"]=$TMP_ERROR;

	Header("Location: error.php");
	exit;
}

include "./header.php";
include phpa_include("template_boards_php.html");
include "./footer.php";

?>
