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

#//
unset($ERR);

#//
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	#// Data check
	if(empty($_POST[sitename]) ||
	empty($_POST[siteurl]) ||
	empty($_POST[adminmail]))
	{
		$ERR = $ERR_047;
		$SETTINGS = $_POST;
	}
	else
	{
		#// Update data
		$query = "update ".$DBPrefix."settings set
			sitename='".addslashes($_POST[sitename])."',
			adminmail='".addslashes($_POST[adminmail])."',
			siteurl='".addslashes($_POST[siteurl])."'";
		$res = mysql_query($query);
		if(!$res)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		else
		{
			$ERR = $MSG_542;
			$SETTINGS = $_POST;
		}
	}
}
else
{
	#//
	$query = "SELECT siteurl,adminmail,sitename FROM ".$DBPrefix."settings";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	elseif(mysql_num_rows($res) > 0)
	{
		$SETTINGS = mysql_fetch_array($res);
	}
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
          <td width=31><img src="images/i_set.gif" width="21" height="19"></td>
          <td class=white><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_526?></td>
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
			<FORM NAME=conf ACTION=<?=basename($_SERVER['SCRIPT_NAME'])?> METHOD=POST >
				<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
					<TR>
						<TD ALIGN=CENTER class=title>
							<?php print $MSG_526; ?>
						</TD>
					</TR>
					<TR>
						<TD>
		
			<TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
			<?php
			if(isset($ERR))
			{
			?>
				<TR BGCOLOR=yellow>
				<TD COLSPAN="2" ALIGN=CENTER><B>
				  <?php print $ERR; ?>
				  </B></TD>
			  </TR>
			 <?php
			}
			 ?>
			  <TR VALIGN="TOP">
				<TD COLSPAN="2"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH=169>
				  <?php print $MSG_527; ?>
				  </TD>
				<TD WIDTH="365"> 
				  <?php print $MSG_535; ?>
				  <BR>
				  <INPUT TYPE="text" NAME="sitename" SIZE="45" MAXLENGTH="255" VALUE="<?=stripslashes($SETTINGS[sitename])?>">
				</TD>
			  </TR>
			  <TR VALIGN="TOP" bgcolor="eeeeee">
				<TD COLSPAN="2"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH=169>
				  <?php print $MSG_528; ?>
				  </TD>
				<TD WIDTH="365"> 
				  <?php print $MSG_536; ?>
				  <BR>
				  <INPUT TYPE="text" NAME="siteurl" SIZE="45" MAXLENGTH="255" VALUE="<?=$SETTINGS[siteurl]?>">
				</TD>
			  </TR>
			  <TR VALIGN="TOP" bgcolor="eeeeee">
				<TD COLSPAN="2"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD WIDTH=169>
				  <?php print $MSG_540; ?>
				  </TD>
				<TD WIDTH="365"> &nbsp;
				   
				  <?php print $MSG_541; ?>
				  <BR>
				  <INPUT TYPE="text" NAME="adminmail" SIZE="45" MAXLENGTH="100" VALUE="<?=$SETTINGS[adminmail]?>">
				  &nbsp;
				   &nbsp;
				  </TD>
			  </TR>
			  <TR VALIGN="TOP">
				<TD COLSPAN="2"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
			  </TR>
			  <TR>
				<TD WIDTH=169>
				  <INPUT TYPE="hidden" NAME="action" VALUE="update">
				</TD>
				<TD WIDTH="365">
				  <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
				</TD>
			  </TR>
			  <TR>
				<TD WIDTH=169></TD>
				<TD WIDTH="365"> </TD>
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