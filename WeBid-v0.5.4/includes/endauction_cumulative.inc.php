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

#// Retrieve user's prefered language
$USERLANG = @mysql_result(@mysql_query("SELECT language FROM ".$DBPrefix."userslanguage WHERE user='".$row['id']."'"),0,"language");
if(!isset($USERLANG)) $USERLANG = $SETTINGS['defaultlanguage'];

$buffer = file($main_path."language/".$USERLANG."/mail_endauction_cumulative.inc.php");
$i = 0;
$j = 0;
while($i < count($buffer))
{
	if(!ereg("^#(.)*$",$buffer[$i])){
		$skipped_buffer[$j] = $buffer[$i];
		$j++;
	}
	$i++;
}
//--Reteve message
$message = implode($skipped_buffer,"");

//--Change TAGS with variables content

$message = ereg_replace("<#s_name#>",$Seller['name'],$message);
$message = ereg_replace("<#i_report#>",$report,$message);

$message = ereg_replace("<#c_sitename#>",$SETTINGS[sitename],$message);
$message = ereg_replace("<#c_siteurl#>",$SETTINGS[siteurl],$message);
$message = ereg_replace("<#c_adminemail#>",$SETTINGS[adminmail],$message);

mail($Seller["email"],$MSG_25_0199,stripslashes($message),"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");

?>