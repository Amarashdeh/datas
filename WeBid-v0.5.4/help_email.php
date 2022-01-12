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

<SCRIPT Language=PHP>

require("header.php");


	print "<FONT FACE=\"Verdana,Helvetica,Arial\" SIZE=\"4\">";
 	print "<BR><CENTER><B>$HLP_008</B><BR><BR>$MSG_143</CENTER>";


	print "<FONT FACE=\"Verdana,Helvetica,Arial\" SIZE=\"2\">";
 	print "<BR><CENTER><B>$HLP_009</B></CENTER>";

</SCRIPT>

<?php require("./footer.php"); ?>
</BODY>
</HTML>
