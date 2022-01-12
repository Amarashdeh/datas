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
define('INCLUDED', 1);
include('passwd.inc.php');
$PHP_SELF=htmlspecialchars($PHP_SELF);
$REMOTE_ADDR=(get_magic_quotes_runtime()) ? $REMOTE_ADDR: addslashes($REMOTE_ADDR);
if(isset($_SESSION['PHPAUCTION_LOGGED_IN_USERNAME'])) 
	$_SESSION['PHPAUCTION_LOGGED_IN_USERNAME'] = addslashes($_SESSION['PHPAUCTION_LOGGED_IN_USERNAME']);
#// ########################################################################################################
# Test mode
# TESTMODE variable will force WeBid to run in "test mode" ($PHPAUCTION_TESTMODE = 'yes')
# or in "live mode" ($PHPAUCTION_TESTMODE = 'no')
#
# When running in test mode Phpuction will provide you the ability to use the Paypal simulator
#// to simulate the payment processes
$PHPAUCTION_TESTMODE = 'yes'; // Possible values: 'yes, 'no'		
#// ########################################################################################################

//-- The path where your WeBid installation is
$main_path = "D:\wamp\www\auction\\";


//-- DONT EDIT PAST THIS POINT
$MD5_PREFIX = "fhQYBpS5FNs4";
$include_path = $main_path."includes/"; 
$uploaded_path = "uploaded/";
$image_upload_path = $main_path.$uploaded_path; 
$logPath = $main_path."logs/";
$cronScriptHTMLOutput = FALSE;
include $include_path."settings.inc.php";
include $include_path."messages.inc.php";
include $include_path."languages.inc.php";
?>
