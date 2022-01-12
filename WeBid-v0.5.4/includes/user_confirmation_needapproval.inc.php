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

if(isset($_COOKIE['USERLANGUAGE'])) {
  $USERLANG = $_COOKIE['USERLANGUAGE'];
} else {
  $USERLANG = $SETTINGS['defaultlanguage'];
}

include $include_path."messages.inc.php";
$buffer = file($main_path."language/".$USERLANG."/usermail_needapproval.inc.php");

$i = 0;
$j = 0;
while($i < count($buffer)) {
  if(!ereg("^#(.)*$",$buffer[$i])){
    $skipped_buffer[$j] = $buffer[$i];
    $j++;
  }
  $i++;
}
//--Reteve message

$CONFIRMATIONPAGE = $SETTINGS[siteurl]."confirm.php?id=$TPL_id_hidden";

$message = implode($skipped_buffer,"");

//--Change TAGS with variables content

$message = ereg_replace("<#c_id#>",AddSlashes($TPL_id_hidden),$message);
$message = ereg_replace("<#c_name#>",AddSlashes($TPL_name_hidden),$message);
$message = ereg_replace("<#c_nick#>",AddSlashes($TPL_nick_hidden),$message);
$message = ereg_replace("<#c_address#>",AddSlashes($_POST[TPL_address]),$message);
$message = ereg_replace("<#c_city#>",AddSlashes($_POST[TPL_city]),$message);
$message = ereg_replace("<#c_prov#>",AddSlashes($_POST[TPL_prov]),$message);
$message = ereg_replace("<#c_zip#>",AddSlashes($_POST[TPL_zip]),$message);
$message = ereg_replace("<#c_country#>",AddSlashes($_POST[TPL_country]),$message);
$message = ereg_replace("<#c_phone#>",AddSlashes($_POST[TPL_phone]),$message);
$message = ereg_replace("<#c_email#>",AddSlashes($_POST[TPL_email]),$message);
$message = ereg_replace("<#c_password#>",AddSlashes($_POST[TPL_password_hidden]),$message);
$message = ereg_replace("<#c_sitename#>",$SETTINGS[sitename],$message);
$message = ereg_replace("<#c_siteurl#>",$SETTINGS[siteurl],$message);
$message = ereg_replace("<#c_adminemail#>",$SETTINGS[adminmail],$message);
$message = ereg_replace("<#c_confirmation_page#>",$CONFIRMATIONPAGE,$message);
$message = ereg_replace("<#c_logo#>",$SETTINGS[siteurl]."themes/".$SETTINGS[theme]."/".$SETTINGS[logo],$message);

mail($TPL_email_hidden,$MSG_098,$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\r\n" . "Reply-To: $SETTINGS[adminmail]\r\n" . "Return-path: $SETTINGS[adminmail]\r\n" . "MIME-Version: 1.0\n" . "Content-Type: text/html; charset=$CHARSET");
mail($SETTINGS['adminmail'],$MSG_098,$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\r\n" . "Reply-To: $SETTINGS[adminmail]\r\n" . "Return-path: $SETTINGS[adminmail]\r\n" . "MIME-Version: 1.0\n" . "Content-Type: text/html; charset=$CHARSET");

?>