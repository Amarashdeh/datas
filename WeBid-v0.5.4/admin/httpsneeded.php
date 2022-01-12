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
	
require('../includes/config.inc.php');

?>

<HTML>
<HEAD>
  <TITLE><?=$SETTINGS[sitename]?></TITLE>
</HEAD>
<BODY BGCOLOR="white" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <TABLE WIDTH="100%" CELLSPACING="0" BORDER="0" CELLPADDING="4">
    <TR BGCOLOR="#eeeeee">
      <TD WIDTH="85%" bgcolor="#eeeeee"><FONT FACE="Verdana,Helvetica,Arial" SIZE=2><B><?=$MSG_5297?></B></FONT></TD>
      <TD align=right WIDTH="15%" bgcolor="#eeeeee"> <img src="images/notsecure.gif"></TD>
    </TR>
    <TR ALIGN="center">
      <TD colspan="2">

      <TABLE WIDTH="100%" CELLSPACING="1" BORDER="0" CELLPADDING="2" bgcolor="#ffffff">
        <TR bgcolor="#ffffff">
          <TD WIDTH="39%" valign="top">&nbsp;</TD>
          <TD WIDTH="61%" valign="top">&nbsp;</TD>
        </TR>
        <TR bgcolor="#ffffff">
          <TD colspan="2" valign="top" align=center>
		  	<FONT FACE="Verdana, Arial, Helvetica, sans-serif" SIZE=2 COLOR=red>
			<B><?=$MSG_5298?></B>
			</FONT>
		  </TD>
        </TR>
      </TABLE>
      </TD>
    </TR>
  </TABLE>
<BR>
          <P align="center"><FONT FACE="Verdana, Arial, Helvetica, sans-serif" SIZE=2><A href="javascript:window.close()">Close</A></FONT></P>
</BODY>
</HTML>