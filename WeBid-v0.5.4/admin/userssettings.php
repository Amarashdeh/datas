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

// Check for HTTPS settings
$R = @mysql_query("SELECT * FROM ".$DBPrefix."https");
if(!$R) {
	MySQLError($query);
	exit;
} else {
	$HTTPS = @mysql_fetch_array($R);
}

#// Update credit card settings
if($_POST['action'] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
	$query = "UPDATE ".$DBPrefix."usersettings SET 
				requested_fields='".serialize($_POST['requested_fields'])."',
				mandatory_fields='".serialize($_POST['mandatory_fields'])."'";
	$res = @mysql_query($query);
	#// Update database
	$query = "update ".$DBPrefix."settings set
			      userscreditcard ='".$_POST['userscreditcard']."'";
	$res = mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	else
	{
		#// Update discount
		$query = "UPDATE ".$DBPrefix."usersettings set discount=".doubleval(input_money($_POST['bonus']));
		$RES = mysql_query($query);
		if(!$RES)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		else
		{
			$ERR = $MSG_5271;
		}
	}
	
}

#//
$query = "SELECT * FROM ".$DBPrefix."usersettings";
$rr = mysql_query($query);
if(mysql_num_rows($rr) > 0)
{
	$SETTINGS['discount'] = mysql_result($rr,0,"discount");
	$SETTINGS['requested_fields'] = unserialize(mysql_result($rr,0,"requested_fields"));
	$SETTINGS['mandatory_fields'] = unserialize(mysql_result($rr,0,"mandatory_fields"));
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
          <td class=white><?=$MSG_25_0010?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5268?></td>
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
					<?php print $MSG_5268; ?>
				</TD>
			</TR>
			<TR>
				<TD>

	<TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
	  <?php
	  if(isset($ERR))
	  {
					?>
	  <TR>
		<TD COLSPAN="2" ALIGN=CENTER class=error bgcolor="yellow">
		  <?php print $ERR; ?>
		</TD>
	  </TR>
	  <?php
	  }
					 ?>
	  <TR VALIGN="TOP">
		<TD WIDTH=109>&nbsp;</TD>
		<TD WIDTH="375">
		  <?php print $MSG_5269; ?>
		  <?php
		  if($HTTPS[https] == 'yes')
		  {
			print $MSG_5274;
		  }
		  else
		  {
			print $MSG_5275;
		  }
   ?>
		  </TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=109 HEIGHT="22">
		  <?php print $MSG_5270; ?>
		  </TD>
		<TD WIDTH="375" HEIGHT="22">
		  <INPUT TYPE="radio" NAME="userscreditcard" VALUE="y" <?if($SETTINGS['userscreditcard'] == "y") print " CHECKED"?>>
		  <?php print $MSG_030; ?>
		  <INPUT TYPE="radio" NAME="userscreditcard" VALUE="n" <?if($SETTINGS['userscreditcard'] == "n") print " CHECKED"?>>
		  <?php print $MSG_029; ?>
		  </TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=109>&nbsp;</TD>
		<TD WIDTH="375">&nbsp;</TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=109>&nbsp;</TD>
		<TD WIDTH="375">
			
			<?=$MSG_5487?>
		</TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=109 HEIGHT="22">
		  <?php print $MSG_5486; ?>
		  </TD>
		<TD WIDTH="375" HEIGHT="22">
		  <INPUT TYPE="text" NAME="bonus" SIZE="5" VALUE="<?=print_money_nosymbol(doubleval($SETTINGS['discount']))?>">&nbsp;<?=$SETTINGS['currency']?>
		  </TD>
	  </TR>
	  <TR VALIGN="TOP">
		<TD WIDTH=109>&nbsp;</TD>
		<TD WIDTH="375">&nbsp;</TD>
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