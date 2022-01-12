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

$FROM = "From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\nReplyTo:$SETTINGS[adminmail]";
$TO = stripslashes($seller_email);
$SUBJECT = "Pregunta acerca de tu subasta";
$MESSAGE = "Hola $seller_nick,<br>
<br>
Este mensaje ha sido enviado desde $SETTINGS[sitename].<br>
<br>
$sender_name ha enviado un comentario a trav?s de \"Envia una pregunta al vendedor\" acerca de tu subasta $item_title.<br>
URL de la subasta: ".$SETTINGS['siteurl']."item.php?id=".$auction_id."<br>
<br>
COMMENTARIO:<br>
<br>
".strip_tags(Filter($reqtext));
?>