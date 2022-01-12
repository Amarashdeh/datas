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

#// Check if the e-mail has to be sent or not
$emailmode = @mysql_result(@mysql_query("SELECT endemailmode FROM ".$DBPrefix."users WHERE id='".$Seller['id']."'"),0,"endemailmode");
if($emailmode != 'one') return;

#// Retrieve user's prefered language
$USERLANG = @mysql_result(@mysql_query("SELECT language FROM ".$DBPrefix."userslanguage WHERE user='".$Seller['id']."'"),0,"language");
if(!isset($USERLANG)) $USERLANG = $SETTINGS['defaultlanguage'];

$buffer = file($main_path."language/".$USERLANG."/mail_endauction_nowinner.inc.php");

$i = 0;

$j = 0;

while($i < count($buffer)){

	if(!ereg("^#(.)*$",$buffer[$i])){

		$skipped_buffer[$j] = $buffer[$i];

		$j++;

	}

	$i++;

}

#// Handle time correction
$ENDS = explode(" ",$ends_string);
//$DATE = explode("-",$ENDS[0]);
$HOUR = explode(":",$ENDS[3]);
$ENDS_DATE = ArrangeDateNoCorrMesCompleto($ENDS[1],$ENDS[0],$ENDS[2],$HOUR[0],$HOUR[1]);



//--Reteve message

$message = implode($skipped_buffer,"");

//--Change TAGS with variables content

$message = ereg_replace("<#s_name#>",$Seller['name'],$message);
$message = ereg_replace("<#s_nick#>",$Seller['nick'],$message);
$message = ereg_replace("<#s_email#>",$Seller['email'],$message);
$message = ereg_replace("<#s_address#>",$Seller['address'],$message);
$message = ereg_replace("<#s_city#>",$Seller['city'],$message);
$message = ereg_replace("<#s_prov#>",$Seller['prov'],$message);
$message = ereg_replace("<#s_country#>",$Seller['country'],$message);
$message = ereg_replace("<#s_zip#>",$Seller['zip'],$message);
$message = ereg_replace("<#s_phone#>",$Seller['phone'],$message);

$message = ereg_replace("<#w_report#>",$report_text,$message);

$message = ereg_replace("<#i_title#>",$Auction['title'],$message);
$message = ereg_replace("<#i_description#>",substr(strip_tags($Auction['description']),0,50)."...",$message);
$auction_url = "$SITE_URL"."item.php?id=".$Auction['id'];
$message = ereg_replace("<#i_url#>",$auction_url,$message);
$message = ereg_replace("<#i_ends#>",$ENDS_DATE,$message);

$message = ereg_replace("<#c_sitename#>",$SETTINGS[sitename],$message);
$message = ereg_replace("<#c_siteurl#>",$SETTINGS[siteurl],$message);
$message = ereg_replace("<#c_adminemail#>",$SETTINGS[adminmail],$message);

mail($Seller["email"],$MSG_112.$MSG_908,stripslashes($message),"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");

?>