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
include $include_path.'time.inc.php';

unset($ERR);

#//
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	#// Update database
	$query = "update ".$DBPrefix."settings SET
				  aboutus='$_POST[aboutus]',
				  aboutustext='".nl2br(addslashes($_POST[aboutustext]))."'";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	else
	{
		$ERR = $MSG_5079;
		$SETTINGS = $_POST;
	}
}


#//
$query = "SELECT aboutus,aboutustext FROM ".$DBPrefix."settings";
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
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5074?></td>
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
				<?php print $MSG_5074; ?>
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
	<TD class=error COLSPAN="2" ALIGN=CENTER><?php print $ERR; ?></TD>
  </TR>
  <?php
  }
  ?>
  <TR VALIGN="TOP">
	<TD WIDTH=109 HEIGHT="22">
	  <?=$MSG_5077?></TD>
	<TD WIDTH="375" HEIGHT="22">
	  <?=$MSG_5076?><BR>
	  <INPUT TYPE="radio" NAME="aboutus" VALUE="y" <?if($SETTINGS[aboutus] == "y") print " CHECKED"?>>
	  <?php print $MSG_030; ?>
	  <INPUT TYPE="radio" NAME="aboutus" VALUE="n" <?if($SETTINGS[aboutus] == "n") print " CHECKED"?>>
	  <?php print $MSG_029; ?>
	  </TD>
  </TR>
  <TR VALIGN="TOP">
	<TD WIDTH=109 HEIGHT="22">
	  <?php print $MSG_5078; ?>
	  </TD>
	<TD WIDTH="375" HEIGHT="22">
	  <?=$MSG_5080?><BR>
	  <textarea name="aboutustext" cols="45"
	  rows="15"><?=stripslashes(str_replace("<br>","",stripslashes($SETTINGS[aboutustext])))?></textarea>
	  </TD>
  </TR>
  <TR VALIGN="TOP">
	<TD WIDTH=109 HEIGHT="22">&nbsp;</TD>
	<TD WIDTH="375" HEIGHT="22">&nbsp;</TD>
  </TR>
  <TR>
	<TD WIDTH=109>
	  <INPUT TYPE="hidden" NAME="action" VALUE="update">
	</TD>
	<TD WIDTH="375">
	  <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
	</TD>
  </TR>
  <TR>
	<TD WIDTH=109></TD>
	<TD WIDTH="375"> </TD>
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