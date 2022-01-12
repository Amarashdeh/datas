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
include './includes/config.inc.php';
include $include_path.'countries.inc.php';

/* get list of  countries */
/*
$result = mysql_query ( "SELECT * FROM ".$DBPrefix."countries ORDER BY country_id" );
if (!$result) {
	// output error message and exit 
} else {
*/
?>
<HTML>
<HEAD>
<TITLE><?php print $SETTINGS['sitename']?></TITLE>
</HEAD>
<BODY>
<TABLE width="80%" border="0" cellspacing="0" cellpadding="4" align="center" bgcolor="#FFFFFF">
  <tr>
    <TD ><?php print $tlt_font?>Select exact Country Name to enter in the tab delimited file for bulk uploading</FONT></TD>
  </tr>
  <TR>
    <TD WIDTH="100%"><?php print $tlt_font?>COUNTRY NAME<br>
      <br>
      </FONT></TD>
  </TR>
  <?php
	reset($countries);
	foreach($countries as $k=>$v) {
		if($k) {		
			print "<TR BGCOLOR=\"$bgcolor\">
			<TD>$v</FONT></TD>";
			print"</TR>";
		}
	}
?>
  <TR >
    <TD ALIGN="center"><BR>
      <BR>
      <A HREF="Javascript:window.close()">
      <?=$MSG_678?>
      </A></TD>
  </TR>
</TABLE>
</BODY>
</HTML>
