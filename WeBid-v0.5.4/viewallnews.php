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
	// Include messages file
   

   // Connect to sql server & inizialize configuration variables
   require('./includes/config.inc.php');



?>

<HTML>
<HEAD>
<TITLE></TITLE>


</HEAD>

<BODY  BGCOLOR="#FFFFFF" TEXT="#08428C" LINK="#08428C" VLINK="#08428C" ALINK="#08428C">

<?php

require("header.php");

$query = "SELECT * from ".$DBPrefix."news where suspended=0 order by new_date";
$res = mysql_query($query);
if(!$res)
{
	MySQLError($query);
	exit;
}

while($new = mysql_fetch_array($res))
{

$new[title] = stripslashes($new[title]);
	$TPL_all_news .= "<strong><big>�</big></strong><A HREF=\"viewnew.php?id=$new[id]\">$new[title]</A>
							<BR>";
}

include phpa_include("template_view_allnews_php.html");

?>

<?php require("./footer.php"); ?>
</BODY>
</HTML>
