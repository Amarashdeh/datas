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
	require('./includes/config.inc.php');
	/* get list of  category */
	$subcat_count = 0;
	$result = mysql_query ( "SELECT * FROM ".$DBPrefix."categories ORDER BY cat_id" );
	if (!$result)
	{
		exit;
	}
	else
	{

?>
<TITLE><?php print $SETTINGS[sitename]?></TITLE>
      <TABLE width="84%" border="0" cellspacing="0" cellpadding="4" bgcolor="#FFFFFF" align="center">
<tr>	<TD  colspan="3" ><?php print $tlt_font?> Select category ID number to enter in the tab delimited file for bulk uploading</FONT></TD>
</tr>
        <TR>
					<TD  WIDTH="30%"><?php print $tlt_font?> CATEGORY ID</font><br>this is the number you enter in the tab delimited file</FONT></TD>
	<TD WIDTH="58%" valign="top"><?php print $tlt_font?>CATEGORY NAME<br><br></FONT></TD>
	<TD  WIDTH="12%"><?php print $tlt_font?> PARENT ID<br><br></FONT></TD>

</TR>
<?		$num_cats = mysql_num_rows($result);
		$i = 0;
		$bgcolor = "#EEEEEE";
		while($i < $num_cats){

		$cat_id = mysql_result($result,$i,"cat_id");
		//$cat_name = mysql_result($result,$i,"cat_name");
		#//  Select the translated category name
		$cat_name = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".intval($cat_id)." AND lang='".$language."'"),0,"cat_name");
		$parent_id = mysql_result($result,$i,"parent_id");
	if($bgcolor == "#EEEEEE"){
				$bgcolor = "#FFFFFF";
			}else{
				$bgcolor = "#EEEEEE";
			}

 	print "<TR BGCOLOR=\"$bgcolor\"><TD  align=\"center\" WIDTH=\"30%\">";
 print "<b>$cat_id</b>";
		print"</FONT></TD>";
	print "<TD  WIDTH=\"58%\">";
print "$cat_name</FONT></TD>";
	print "<TD  WIDTH=\"12%\">";
print "$parent_id";
	print"</FONT></TD></TR>";
	$i++;
		}
	}
?>
	<TR >
		<TD colspan="3" ALIGN="center" ><BR><BR>
<A HREF="Javascript:window.close()"><?=$MSG_678?></A></TD>
  </TR>
</TABLE>
