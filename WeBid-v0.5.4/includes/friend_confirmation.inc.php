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

#// Select language
if(isset($_COOKIE['USERLANGUAGE']))
{
	$USERLANG = $_COOKIE['USERLANGUAGE'];
}
else
{
	$USERLANG = $SETTINGS['defaultlanguage'];
}

$buffer = file($main_path."language/".$USERLANG."/friendmail.inc.php");
$i = 0;
$j = 0;

while($i < count($buffer)){
	if(!ereg("^#(.)*$",$buffer[$i])){
		$skipped_buffer[$j] = $buffer[$i];
		$j++;
	}
	$i++;
}

//--Retrieve message
$message = implode($skipped_buffer,"");

//--Change TAGS with variables content

$message = ereg_replace("<#s_name#>","$sender_name",$message);
$message = ereg_replace("<#s_email#>","$sender_email",$message);
$message = ereg_replace("<#s_comment#>","$sender_comment",$message);

$message = ereg_replace("<#f_name#>","$friend_name",$message);
$message = ereg_replace("<#f_email#>","$friend_email",$message);

$message = ereg_replace("<#i_title#>","$item_title",$message);
$auction_url = "$SITE_URL"."item.php?id=$auction_id";
$message = ereg_replace("<#i_url#>","$auction_url",$message);

$message = ereg_replace("<#c_sitename#>",$SETTINGS[sitename],$message);
$message = ereg_replace("<#c_siteurl#>",$SETTINGS[siteurl],$message);
$message = ereg_replace("<#c_adminemail#>",$SETTINGS[adminmail],$message);

mail($friend_email,"$MSG_905",$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");

?>