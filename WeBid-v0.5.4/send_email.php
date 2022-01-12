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
// Connect to sql server & inizialize configuration variables
include './includes/config.inc.php';
include $include_path.'wordfilter.inc.php';
$_SESSION["CURRENT_ITEM"] = intval($_SESSION["CURRENT_ITEM"]);
if (!isset($_POST['auction_id']) && !isset($_GET['auction_id'])) {
	$auction_id = $_SESSION["CURRENT_ITEM"];
} else {
	$_SESSION["CURRENT_ITEM"]=$auction_id;
}

//--Get item description

$query = "select user,title from ".$DBPrefix."auctions where id=".intval($auction_id);
$result = mysql_query($query);
if(!$result) {
	MySQLError($query);
	exit;
}

$seller_id = stripslashes(mysql_result($result,0,"user"));
$item_title = stripslashes(mysql_result($result,0,"title"));

//--Get seller data

$query = "select nick,email from ".$DBPrefix."users where id=".intval($seller_id);
$result = mysql_query($query);
if(!$result) {
	MySQLError($query);
	exit;
}

$seller_nick = stripslashes(mysql_result($result,0,"nick"));
$seller_email = stripslashes(mysql_result($result,0,"email"));

$TPL_auction_id = "".$auction_id;
$userid = $_SESSION['PHPAUCTION_LOGGED_IN'];
$time = date('d/m/y, H:i:s');
$TPL_seller_nick_value = $seller_nick;
$TPL_seller_email_value = $seller_email;
$TPL_sender_name_value = $_POST[sender_name];
$TPL_sender_email_value = $_POST[sender_email];
$TPL_item_title = $item_title;
$TPL_sender_question = $_POST[sender_question];
if (empty($_POST[action])) {
	include "header.php";
	include phpa_include("template_send_email_php.html");
	include "footer.php";
	exit;
}
//--Check errors

if	($_POST[action] && (!$_POST[sender_name] || !$_POST[sender_email] || !$seller_nick || !$seller_email)) {
	$TPL_error_text = $ERR_032;
}

if	($_POST[action] && (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$",$_POST[sender_email]) ||
!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$",$seller_email))) {
	$TPL_error_text = $ERR_008;
}
if (strlen($TPL_error_text)>0 ) {
	include "header.php";
	include phpa_include("template_send_email_php.html");
	include "footer.php";
	exit;
} else {
	$MSG = "$MSG_337: <i>$seller_nick</i><br><br>";
}

#// Retrieve user's prefered language
$USERLANG = @mysql_result(@mysql_query("SELECT language FROM ".$DBPrefix."userslanguage WHERE user=".intval($seller_id)),0,"language");
if(!isset($USERLANG)) $USERLANG = $SETTINGS['defaultlanguage'];		
include $include_path."send_email.".$USERLANG.".inc.php";
mail($TO,$SUBJECT,$MESSAGE,$FROM);
$sql = "INSERT INTO ".$DBPrefix."messages( `sentto` , `from` , `when` , `message` , `subject` )  VALUES ('$seller_id', '$userid', '$time', '$MESSAGE', '$SUBJECT')";
$run = mysql_query($sql) or die($sql.mysql_error());

include "header.php";
include phpa_include("template_send_email_php.html");
include "footer.php";
exit;
?>