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

	include "../includes/config.inc.php";
	include $include_path."tags.inc.php";
?>
<HTML>
<HEAD>
<TITLE><?php print $SETTINGS[sitename]?></TITLE>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>

<BODY bgcolor="#FFFFFF">
<CENTER>
  <P><B>
  	<FONT face="Verdana, Arial, Helvetica, sans-serif" size="4" color="#000066">
	<?=$MSG_5388?></B> </P>
        <CENTER>
          <P align="center"><A href="javascript:window.close()"><FONT face="Verdana, Arial, Helvetica, sans-serif" size="2">Close</A></P>
        </CENTER>

  <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
    <TR>
      <TD>
        <P><FONT face="Verdana, Arial, Helvetica, sans-serif" size="2">
		  <?=$MSG_5392?>
          </P>
        <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor=#dddddd>
          <tr bgcolor="#eeeeee">
            <td width="13%">
              <div align="center">
			  	<FONT FACE="Verdana,Helvetica,Arial" SIZE=2><B><?=$MSG_5389?></B>
			</div>
            </td>
            <td width="87%">
              <div align="center">
			  	<FONT FACE="Verdana,Helvetica,Arial" SIZE=2><B><?=$MSG_087?></B>
			  </div>
            </td>
          </tr>
		  <?php
		  	reset($SIGNUP);
			while(list($k,$v) = each($SIGNUP))
			{
		  ?>
          <tr VALIGN=TOP BGCOLOR=#ffffff>
            <td width="13%">
			  <FONT FACE="Verdana,Helvetica,Arial" SIZE=2><?=$k?>
            </td>
            <td width="87%">
			  <FONT FACE="Verdana,Helvetica,Arial" SIZE=2><?=$v?>
			</td>
          </tr>
		<?php
			}
		?>
        </table>
        <P><FONT face="Verdana, Arial, Helvetica, sans-serif" size="2"> </P>
        <CENTER>
          <P align="center"><A href="javascript:window.close()"><FONT face="Verdana, Arial, Helvetica, sans-serif" size="2">Close</A></P>
        </CENTER>
        </TD>
    </TR>
  </TABLE>
  </CENTER>
</BODY>
</HTML>
