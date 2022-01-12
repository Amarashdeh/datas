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
include "loggedin.inc.php";



//-- Set offset and limit for pagination

$limit = 20;
if(!$offset) $offset = 0;


include "./header.php";
?>
<STYLE type="text/css">
<!--
.unnamed1 {  font: 10pt Tahoma, Arial; color: #000066; text-decoration: none}
-->
body {
scrollbar-face-color: #aaaaaa;
scrollbar-shadow-color: #666666;
scrollbar-highlight-color: #aaaaaa;
scrollbar-3dlight-color: #dddddd;
scrollbar-darkshadow-color: #444444;
scrollbar-track-color: #cccccc;
scrollbar-arrow-color: #ffffff;
}</STYLE>
<link rel='stylesheet' type='text/css' href='style.css' />
<BR>
<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#296FAB" ALIGN="CENTER">
	<TR>
		<TD ALIGN=CENTER class=title><?php print $MSG_067; ?></TD>
	</TR>
	<TR>
		<TD>
			<TABLE WIDTH=100% CELPADDING=0 CELLSPACING=1 BORDER=0 ALIGN="CENTER" CELLPADDING="3">
		<?php
		$query = "select a.id, u.nick, a.title, a.starts, a.description, c.cat_name, d.description as duration,
				  a.suspended FROM
				  ".$DBPrefix."auctions a,
				  ".$DBPrefix."users u,
				  ".$DBPrefix."categories c,
				  ".$DBPrefix."durations d
				  where
				  u.id=a.user AND
				  c.cat_id = a.category AND
				  (a.title like '%$_POST[keyword]%' OR
				  a.description like '%$_POST[keyword]%')
				  group by a.id
				  ORDER BY nick
				  LIMIT $offset, $limit";
		$result = mysql_query($query);
		if(!$result){
			print "Database access error: abnormal termination<BR>$query<BR>".mysql_error();
			exit;
		}
		$num_auction = mysql_num_rows($result);
		print "<TR BGCOLOR=#FFFFFF><TD COLSPAN=7><B>
				$num_auction $MSG_311</B></TD></TR>";
	?>
				<TR BGCOLOR="#999999">
					<TD ALIGN=CENTER>
						<B><?php print $MSG_312; ?></B>
					</TD>
					<TD ALIGN=CENTER>
						<B>
						<?php print $MSG_313; ?>
						</B> </TD>
					<TD ALIGN=CENTER>
						<B>
						<?php print $MSG_314; ?>
						</B> </TD>
					<TD ALIGN=CENTER> 
						<B>
						<?php print $MSG_315; ?>
						</B></TD>
					<TD ALIGN=LEFT>
						<B>
						<?php print $MSG_316; ?>
						</B></TD>
					<TD ALIGN=LEFT>
						<B>
						<?php print $MSG_317; ?>
						</B></TD>
					<TD ALIGN=LEFT>
						<B>
						<?php print $MSG_297; ?>
						</B></TD>
				<TR>
		<?php
		$result = mysql_query($query);
		if(!$result){
			print "Database access error: abnormal termination<BR>$query<BR>".mysql_error();
			exit;
		}
		$num_auction = mysql_num_rows($result);
		$i = 0;
		$bgcolor = "#FFFFFF";
		while($i < $num_auction){
			
			if($bgcolor == "#FFFFFF"){
				$bgcolor = "#EEEEEE";
			}else{
				$bgcolor = "#FFFFFF";
			}
			
			$id = mysql_result($result,$i,"id");
			$title = stripslashes(mysql_result($result,$i,"title"));
			$nick = mysql_result($result,$i,"nick");
			$tmp_date = mysql_result($result,$i,"starts");
			$duration = mysql_result($result,$i,"duration");
			$category = mysql_result($result,$i,"cat_name");
			$description = stripslashes(mysql_result($result,$i,"description"));
			$suspended = mysql_result($result,$i,"suspended");
			$day = substr($tmp_date,6,2);
			$month = substr($tmp_date,4,2);
			$year = substr($tmp_date,0,4);
			$date = "$day/$month/$year";
			
			print "<TR BGCOLOR=$bgcolor><TD>";
			if($suspended == 1)
			{
				print "<FONT COLOR=red><B>$title</B></FONT>";
			}
			else
			{
				print $title;
			}
			print "
				</TD>
				<TD>
				".$nick."
				</TD>
				<TD>
				".$date."
				</TD>
				<TD>
				$duration
				</TD>
				<TD>
				$category
				</TD>
				<TD>
				$description
				</TD>
				<TD ALIGN=LEFT>
				<A HREF=\"editauction.php?id=$id&offset=$offset\" class=\"nounderlined\">$MSG_298</A><BR>
				<A HREF=\"deleteauction.php?id=$id&offset=$offset\" class=\"nounderlined\">$MSG_008</A><BR>
				<A HREF=\"excludeauction.php?id=$id&offset=$offset\" class=\"nounderlined\">";
			if($suspended == 0)
			{
				print $MSG_300;
			}
			else
			{
				print $MSG_310;
			}
			print "</A><BR>
						</TD>
						<TR>";
			
			$i++;
		}
		
		print "</TABLE><BR>
			   </TD></TR></TABLE>";
		
		
		
		//-- Build navigation line
		print "<TABLE WIDTH=600 BORDER=0 CELLPADDING=4 CELLSPACING=0 ALIGN=CENTER>
			   <TR ALIGN=CENTER BGCOLOR=#FFFFFF>
			   <TD COLSPAN=2>";
		print "<SPAN CLASS=\"navigation\">";
		$num_pages = ceil($num_auction / $limit);
		$i = 0;
		while($i < $num_pages ){
			
			$of = ($i * $limit);
			
			if($of != $offset){
				print "<A HREF=\"listauctions.php?offset=$of\" CLASS=\"navigation\">".($i + 1)."</A>";
				if($i != $num_pages) print " | ";
			}else{
				print $i + 1;
				if($i != $num_pages) print " | ";
			}
			
			$i++;
		}
		print "</SPAN></TR></TD>";
		
		
		
	  ?>
	  	<TR BGCOLOR=#FFFFFF ALIGN=CENTER>
	  	<TD>
		<BR>
		<BR>
		<CENTER>
			<A HREF="admin.php" CLASS="links">Admin Home</A>
		</CENTER>
		<BR>
		</TD>
		</TR>
		</TABLE>


<?php include "./footer.php"; ?>
