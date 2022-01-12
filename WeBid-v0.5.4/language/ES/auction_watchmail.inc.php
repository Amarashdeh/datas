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

$message = "Hola ".$row["name"].",<br>
<br>
Este es tu cazador de articulos.<br>
La siguiente subasta ha sido abierta y coincide con tu(s) palabra(s) clave: ".$row["auc_watch"]."<br>
<br>
Subasta : ".$sessionVars["SELL_title"]."<br>
URL de la Subasta: ".$SETTINGS['siteurl']."item.php?id=".$sessionVars['SELL_auction_id'];

//send
$message = ereg_replace("\n","<br>",$message);
mail($row["email"],$SETTINGS["sitename"]." - ".$MSG_471,$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");

?>