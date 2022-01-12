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

#// Delete users and banners if necessary
if(is_array($_POST[delete]) && basename($HTTP_REFERER) == basename($PHP_SELF))
{
	while(list($k,$v) = each($_POST[delete]))
	{
		@mysql_query("DELETE FROM ".$DBPrefix."banners WHERE user=$v");
		@mysql_query("DELETE FROM ".$DBPrefix."bannersusers WHERE id=$v");
	}
}

#// Retrieve users from the database
$query = "SELECT * FROM ".$DBPrefix."bannersusers ORDER BY name";
$res_ = @mysql_query($query);
if(!$res_)
{
	print "$query<BR>".mysql_error();
	exit;
}
?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_ban.gif" ></td>
          <td class=white><?=$MSG_25_0011?>&nbsp;&gt;&gt;&nbsp;<?=$MSG__0008?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
<TR>
<TD align="center">
	<BR>
	<FORM NAME=this ACTION="<?=basename($_SERVER['PHP_SELF'])?>" METHOD=POST>
	<TABLE WIDTH="80%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
	  <TR>
		<TD ALIGN=CENTER class=title>
		  <?php print $MSG__0008; ?>
		  </TD>
	  </TR>
	  <TR>
		<TD>
		  <TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#dddddd">
			<TR VALIGN="TOP" BGCOLOR=white>
			  <TD COLSPAN="6" ALIGN=CENTER> 
				<A HREF="newbannersuser.php">
				<?=$MSG__0026?>
				</A></TD>
			</TR>
			<TR VALIGN="TOP" BGCOLOR="#eeeeee">
			  <TD WIDTH="15%">
				<?=$MSG_5180?>
				</TD>
			  <TD WIDTH="25%">
				<?=$MSG__0022?>
				</TD>
			  <TD WIDTH="28%">
				<?=$MSG_303?>
				</TD>
			  <TD WIDTH="11%" ALIGN=CENTER>
				<?=$MSG__0025?>
				 </TD>
			  <TD WIDTH="10%" ALIGN=CENTER>
				<?=$MSG__0024?>
				</TD>
			  <TD WIDTH="11%" ALIGN=CENTER><?=$MSG_008?>
				</TD>
			</TR>
			<?php
			while($row = mysql_fetch_array($res_))
			{
				#// Retriee the number of banners for this user
				$query = "SELECT id FROM ".$DBPrefix."banners WHERE user=$row[id]";
				$r = @mysql_query($query);
				if(!$r)
				{
					print "$query<BR>".mysql_error();
					exit;
				}
				$COUNTER = mysql_num_rows($r);
			?>
			<TR VALIGN="TOP" BGCOLOR="#ffffff">
			  <TD WIDTH="15%"> 
				<A HREF="editbannersuser.php?id=<?=$row[id]?>"><?=$row[name]?></A>
				 </TD>
			  <TD WIDTH="25%"> 
				<?=$row[company]?>
				 </TD>
			  <TD WIDTH="28%"> 
				<A HREF="mailto:<?=$row[email]?>">
				<?=$row[email]?>
				</A>  </TD>
			  <TD WIDTH="11%" ALIGN=CENTER>
				<?=$COUNTER?>
				</TD>
			  <TD WIDTH="10%" ALIGN=CENTER><A HREF="userbanners.php?id=<?=$row[id]?>"><IMG BORDER=0 SRC="./images/tool.gif"></A></TD>
			  <TD WIDTH="11%" ALIGN=CENTER> &nbsp;
				<INPUT TYPE="checkbox" NAME="delete[]" VALUE="<?=$row[id]?>">
			  </TD>
			</TR>
			<?php
			}
			?>
			<TR VALIGN="TOP" ALIGN=CENTER BGCOLOR="#ffffff">
			  <TD COLSPAN="6">
				<INPUT TYPE="submit" NAME="Submit" VALUE="<?=$MSG__0028?>">
			  </TD>
			</TR>
		  </TABLE>
		</TD>
	  </TR>
	</TABLE>
	</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>
