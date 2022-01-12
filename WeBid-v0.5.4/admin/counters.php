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
unset($ERR);

#//
if($_POST[action] == "update" && basename($HTTP_REFERER) == basename($PHP_SELF))
{
	if($_POST['auctions'] != 'y') $_POST['auctions'] = 'n';
	if($_POST['users'] != 'y') $_POST['users'] = 'n';
	if($_POST['online'] != 'y') $_POST['online'] = 'n';
	#// Update database
	$query = "update ".$DBPrefix."counterstoshow SET
				  auctions='".$_POST['auctions']."',
				  users='".$_POST['users']."',
				  online='".$_POST['online']."'";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	else
	{
		$ERR = $MGS_2__0063;
	}
}
#//
$query = "SELECT * FROM ".$DBPrefix."counterstoshow";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	$COUNTERSTOSHOW = mysql_fetch_array($res);
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
          <td width="30"><img src="images/i_pre.gif" width="16" height="19"></td>
          <td class=white><?=$MSG_25_0008?>&nbsp;&gt;&gt;&nbsp;<?=$MGS_2__0057?></td>
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
<FORM NAME=conf ACTION=<?=$_SERVER['PHP_SELF']?> METHOD=POST>
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
		<TR>
			<TD ALIGN=CENTER class=title>
				<?php print $MGS_2__0057; ?>
			</TD>
		</TR>
		<TR>
			<TD>
				<TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
				<?php
				if($ERR != "")
				{
				 ?>
					<TR BGCOLOR=yellow>
					 <TD class=error COLSPAN="2" ALIGN=CENTER>
					 <?php print $ERR; ?>
					</TD>
					   </TR>
				   <?php
				}
				?>
					<TR VALIGN="TOP">
					  <TD HEIGHT="31">&nbsp;</TD>
					  <TD HEIGHT="31">
					  <?=$MGS_2__0058;?>
					  </TD>
				  </TR>
					<TR VALIGN="TOP">
						<TD WIDTH=173 HEIGHT="31">
							<?=$MGS_2__0062;?>
						</TD>
						<TD HEIGHT="31" WIDTH="459">
							<INPUT NAME="auctions" TYPE="checkbox" ID="auctions" VALUE="y" <?if($COUNTERSTOSHOW['auctions'] == 'y') print " CHECKED";?>>
						  
						  <?=$MGS_2__0060;?>
						  <BR>
						  <INPUT NAME="users" TYPE="checkbox" ID="users" VALUE="y" <?if($COUNTERSTOSHOW['users'] == 'y') print " CHECKED"?>>
						  
						  <?=$MGS_2__0061;?>
						  <BR>
						  <INPUT NAME="online" TYPE="checkbox" ID="online" VALUE="y" <?if($COUNTERSTOSHOW['online'] == 'y') print " CHECKED"?>>
						  
						  <?=$MGS_2__0059;?>
						  </TD>
					</TR>

					<TR VALIGN="TOP">
						<TD COLSPAN="2" HEIGHT="7"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
					</TR>
					<TR>
						<TD WIDTH=173>
							<INPUT TYPE="hidden" NAME="action" VALUE="update">
							<INPUT TYPE="hidden" NAME="id" VALUE="<?=$id?>">
						</TD>
						<TD WIDTH="459">
							<INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
						</TD>
					</TR>
					<TR>
						<TD WIDTH=173></TD>
						<TD WIDTH="459"> </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
	</FORM>
</TD>
</TR>
</TABLE>

<!-- Closing external table (header.php) -->
</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>