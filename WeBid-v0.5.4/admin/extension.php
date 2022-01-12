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
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	#// Data check
	if($_POST[status] == 'enabled' && (!is_numeric($_POST['timebefore']) || !is_numeric($_POST['extend'])))
	{
		$ERR = $MSG_2_0038;
		$SETTINGS = $_POST;
	}
	else
	{
		$query = "update ".$DBPrefix."auctionextension SET
				  status='".$_POST['status']."',
				  timebefore=".intval($_POST['timebefore']).",
				  extend=".intval($_POST['extend']);
		$res = @mysql_query($query);
		if(!$res)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		else
		{
			$ERR = $MSG_2_0039;
			$SETTINGS = $_POST;
		}
	}
}

#//
$query = "SELECT * FROM ".$DBPrefix."auctionextension";
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
          <td width="30"><img src="images/i_auc.gif" ></td>
          <td class=white><?=$MSG_239?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_2_0032?></td>
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
	<FORM NAME=conf ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
		<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
			<TR>
				<TD ALIGN=CENTER class=title>
					<?php print $MSG_2_0032; ?>
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
		<TD COLSPAN="2" ALIGN=CENTER><B>
		  <?php print $ERR; ?>
		  </B></TD>
	  </TR>
	  <?php
			}
		?>
	  <TR VALIGN="TOP">
		<TD HEIGHT="7">&nbsp;</TD>
		<TD HEIGHT="7">
		  <?=$_CUSTOM_0032;?>
		  </TD>
	  </TR>

	  <TR VALIGN="TOP">
		<TD COLSPAN="2" HEIGHT="7"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=214 HEIGHT="31">
		  <?=$MSG_2_0034;?>
		  </TD>
		<TD HEIGHT="31" WIDTH="418">
		  <input type="radio" name="status" value="enabled" <?if($SETTINGS['status'] == 'enabled') print " CHECKED";?>>
		  
		  <?=$MSG_030;?>
		  
		  <input type="radio" name="status" value="disabled" <?if($SETTINGS['status'] == 'disabled') print " CHECKED";?>>
		  
		  <?=$MSG_029;?>
		   </TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD COLSPAN="2" HEIGHT="4"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=214 HEIGHT="31">&nbsp;
		  </TD>
		<TD HEIGHT="31" WIDTH="418">
		  <?=$MSG_2_0035;?>
		   &nbsp;
		  <input type=text name=extend value="<?=$SETTINGS['extend']?>" size=5>
		  &nbsp; &nbsp;
		   
		  <?=$MSG_2_0036;?>
		   &nbsp;
		  <input type=text name=timebefore value="<?=$SETTINGS['timebefore']?>" size=5>
		  &nbsp; &nbsp;
		   
		  <?=$MSG_2_0037;?>
		   </TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD COLSPAN="2" HEIGHT="6"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
	  </TR>
	  <TR>
		<TD WIDTH=214>
		  <INPUT TYPE="hidden" NAME="action" VALUE="update">
		  <INPUT TYPE="hidden" NAME="id" VALUE="<?=$id?>">
		</TD>
		<TD WIDTH="418">
		  <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
		</TD>
	  </TR>
	  <TR>
		<TD WIDTH=214></TD>
		<TD WIDTH="418"> </TD>
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