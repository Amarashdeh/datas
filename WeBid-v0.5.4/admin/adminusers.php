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

include $include_path.'status.inc.php';

#//
$ERR = "&nbsp;";

if(is_array($_POST[delete]) && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	while(list($k,$v) = each($_POST[delete]))
	{
		@mysql_query("delete from ".$DBPrefix."adminusers where id=$k");
	}
}

#//
$query = "SELECT * FROM ".$DBPrefix."adminusers order by username";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query<BR>".mysql_error();
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
          <td width="30"><img src="images/i_use.gif" ></td>
          <td class=white><?=$MSG_25_0010?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_525?></td>
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
<TD>
<CENTER>
<BR>
<FORM NAME=conf ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
<TR>
<TD ALIGN=CENTER class=title>
<?php print $MSG_525; ?>
</TD>
</TR>
<TR>
<TD>
<TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
<TR>
<TD COLSPAN="2"><A HREF="./increments.php">
</A>
<TABLE WIDTH="100%" BORDER="0" CELLSPACING="1" CELLPADDING="2">
<TR BGCOLOR="#EEEEEE">
		<TD COLSPAN="5" ALIGN=CENTER><A HREF=newadminuser.php><?=$MSG_367?></A></TD>
</TR>
<TR BGCOLOR="#999999">
		<TD WIDTH="30%">
				<CENTER>
					<B>
					<?php print $MSG_003; ?>
					</B>
				</CENTER>
		</TD>
		<TD WIDTH="16%">
				<CENTER>
					<B>
					<?php print $MSG_558; ?>
					</B>
				</CENTER>
		</TD>
		<TD WIDTH="19%">
				<CENTER>
					<B>
					<?php print $MSG_559; ?>
					</B>
				</CENTER>
		</TD>
		<TD WIDTH="12%">
				<CENTER>
					<B>
					<?php print $MSG_560; ?>
					</B>
				</CENTER>
		</TD>
		<TD WIDTH="23%">
				<CENTER>
					<B>
					<INPUT TYPE="submit" NAME="Submit" VALUE="<?=$MSG_561?>">
					</B>
				</CENTER>
		</TD>
</TR>
<?php
while($USER = mysql_fetch_array($res))
{
	$CREATED = substr($USER[created],4,2)."/".
	substr($USER[created],6,2)."/".
	substr($USER[created],0,4);
	if($USER[lastlogin] == 0)
	{
		$LASTLOGIN = $MSG_570;
	}
	else
	{
		$LASTLOGIN = substr($USER[lastlogin],4,2)."/".
		substr($USER[lastlogin],6,2)."/".
		substr($USER[lastlogin],0,4)." ".
		substr($USER[lastlogin],8,2).":".
		substr($USER[lastlogin],10,2).":".
		substr($USER[lastlogin],12,2);
	}
	
?>
<TR BGCOLOR="#EEEEEE">
		<TD WIDTH="30%">
				<A HREF=editadminuser.php?id=<?=$USER[id]?>>
				<?=$USER[username]?>
				</A></TD>
		<TD WIDTH="16%" ALIGN=CENTER>
				<?=$CREATED?>
				</TD>
		<TD WIDTH="19%" ALIGN=CENTER>
				<?=$LASTLOGIN?>
				</TD>
		<TD WIDTH="12%" ALIGN=CENTER>
				<?=$STATUS[$USER[status]]?>
				</TD>
		<TD WIDTH="23%">
				<CENTER>
				<INPUT TYPE="checkbox" NAME="delete[<?=$USER[id]?>]" VALUE="<?=$USER[id]?>">
				</CENTER>
		</TD>
</TR>
<?php
}
?>
</TABLE>
<A HREF="./increments.php" CLASS="links">
</A></TD>
</TR>
<TR>
<TD WIDTH=169>
<INPUT TYPE="hidden" NAME="action" VALUE="update">
</TD>
<TD WIDTH="365">&nbsp; </TD>
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