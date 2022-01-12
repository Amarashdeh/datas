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

$FROM = "From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET";
$TO = stripslashes($seller_email);
$SUBJECT = $MSG_30_0201;
$MESSAGE = "Hola $seller_nick,<br>
<br>
Este mensaje ha sido enviado desde $SETTINGS[sitename].<br>
<br>
<#s_name#> con email <a href='mailto:<#sender_email#>'><#sender_email#></a> tiene una pregunta sobre tu subasta $item_title.<br>
<br>
Pregunta:<br>
".strip_tags(Filter($sender_question))."<br>
<br>
URL de la subasta: <a href='".$SETTINGS['siteurl']."item.php?id=".$auction_id."'>".$SETTINGS['siteurl']."item.php?id=".$auction_id."</a><br>
<br>
Gracias por ser parte de $SETTINGS[sitename]<br>
<a href='<#c_siteurl#>'><#c_siteurl#></a><br>
";

$MESSAGE = ereg_replace("<#s_name#>",$_POST["sender_name"],$MESSAGE);
$MESSAGE = ereg_replace("<#s_email#>",$_POST["sender_email"],$MESSAGE);
$MESSAGE = ereg_replace("<#s_comment#>",$_POST["sender_comment"],$MESSAGE);
$MESSAGE = ereg_replace("<#sender_question#>","$sender_question",$MESSAGE);
$MESSAGE = ereg_replace("<#sender_email#>",$_POST["sender_email"],$MESSAGE);
$MESSAGE = ereg_replace("<#c_sitename#>",$SETTINGS[sitename],$MESSAGE);
$MESSAGE = ereg_replace("<#c_siteurl#>",$SETTINGS[siteurl],$MESSAGE);

?>
