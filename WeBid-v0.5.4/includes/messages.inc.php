<?php
if(!defined('INCLUDED')) exit("Access denied");
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

/** *************************************************************
* NOTE: Language management
*/

if(!empty($_GET['lan'])) {
	$language = $_GET['lan'];
	$_SESSION['language'] = $language;
	
	#// Set language cookie
	setcookie("USERLANGUAGE","",time()-3600);
	setcookie("USERLANGUAGE",$_GET['lan'],time()+31536000,"/");
} elseif(isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
} elseif(empty($_SESSION['language']) && !isset($_COOKIE['USERLANGUAGE'])) {
	$language = $SETTINGS['defaultlanguage'];
	$_SESSION['language'] = $language;
	
	#// Set language cookie
	setcookie("USERLANGUAGE","",time()-3600);
	setcookie("USERLANGUAGE",$language,time()+31536000);
} elseif(empty($_GET[lan])) {
  if(isset($_COOKIE['USERLANGUAGE'])) {
    $language = $_COOKIE['USERLANGUAGE'];
  } else {
    $language = $SETTINGS['defaultlanguage'];
  }
} elseif(isset($_COOKIE['USERLANGUAGE'])) {
	$language = $_COOKIE['USERLANGUAGE'];
} elseif(strlen($_GET[lan]) > 2 ) {
	$language = $SETTINGS['defaultlanguage'];
} else {
	$language = $SETTINGS['defaultlanguage'];
} 
$language = str_replace('..','',addslashes(htmlspecialchars($language)));
#// If the user is logged in, update the user's record
#// This is used to send the e-mails in the user's language
if(isset($_SESSION['PHPAUCTION_LOGGED_IN'])) {
	mysql_query("DELETE FROM ".$DBPrefix."userslanguage WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."'");
	mysql_query("INSERT INTO ".$DBPrefix."userslanguage VALUES(
						 '".$_SESSION['PHPAUCTION_LOGGED_IN']."',
						 '$language')");
}
if (!$language) $language = $SETTINGS['defaultlanguage'];

require($main_path.'language/'.$language.'/messages.inc.php');
/* **************************************************************/
?>