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
$SUBJECT = "Question about your auction";
$MESSAGE = "Hello $seller_nick,<br>
<br>
This message is sent from $SETTINGS[sitename].<br>
<br>
$sender_name has posted a comment in the \"Post a question to the Seller\" section of the item page, for your auction $item_title.<br>
Auction URL: ".$SETTINGS['siteurl']."item.php?id=".$auction_id."<br>
<br>
COMMENT:<br>
<br>
".strip_tags(Filter($reqtext));
?>