<?php
if(!defined("INCLUDED")) exit("Access denied");
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

$message = "Hello ".$row["name"].",

This is Your Auction Watch.
The following Auction  has been opened matching your keyword(s) : ".$row["auc_watch"]."

Auction : ".$sessionVars["SELL_title"]."
Auction URL: ".$SETTINGS['siteurl']."item.php?id=".$sessionVars['SELL_auction_id']."
";

//send
mail($row["email"],$SETTINGS["sitename"]." - ".$MSG_471,$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");

?>