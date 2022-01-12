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

include "./includes/config.inc.php";

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}

$sql=mysql_query("SELECT * FROM ".$DBPrefix."users WHERE id=".$_SESSION['PHPAUCTION_LOGGED_IN']) or die(mysql_error());
$uid=mysql_fetch_assoc($sql);
$userid = $uid['id'];
$messageid = $_GET['id'];

//check message is to user
$sql = mysql_query("SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' AND id='$messageid'");
$check = mysql_num_rows($sql);
if($check == 0){
    $_SESSION['message'] = "This message doesn't exist";
    //header('location: mail.php');
}

//get message details
$sql = "SELECT * FROM `".$DBPrefix."messages` WHERE `id`='$messageid'";
$run = mysql_query($sql) or die($sql.mysql_error());
$array = mysql_fetch_array($run);
$sent = $array['when'];
$from = $array['from'];
$subject = $array['subject'];
$replied = $array['replied'];
$message = $array['message'];
$hash = md5(rand(1,9999));
$array['message'] = str_replace("<br>", "", $array['message']);
$_SESSION['msg'.$hash] = "\n\n-+-+-+-+-+-+-+-+-+\n\n".$array['message'];

//get username
$usql = "SELECT * FROM `".$DBPrefix."users` WHERE `id`='$from'";
$urun = mysql_query($usql) or die($usql.mysql_error());
$uarray = mysql_fetch_array($urun);
$sendusername = $uarray['nick'];

$senderusername = "<a href=\"profile.php?user_id=1&auction_id=$from\">$sendusername</a>";

//if admin message
if($from == '0'){
	$senderusername = "Admin";
}

//update message
$sql = "UPDATE `".$DBPrefix."messages` SET `read`='1' WHERE `id`='$messageid'";
$run = mysql_query($sql) or die($sql.mysql_error());

//set session for reply
$_SESSION['subject'.$hash] = (substr($subject, 0, 3) == 'Re:') ? $subject : "Re: $subject";
$_SESSION['sendto'.$hash] = "$sendusername";
$_SESSION['reply'.$hash] = "$messageid";

include "header.php";
include phpa_include("template_yourmessages_php.html");
include "footer.php";

?>
