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
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
	#// Check if the specified user exists
	$query = "SELECT id FROM ".$DBPrefix."users WHERE nick='$_POST[superuser]'";
	$res_ = @mysql_query($query);
	if(!$res_) {
		print "Error: $query<BR>".mysql_error();
		exit;
	} elseif(mysql_num_rows($res_) == 0 && $_POST[active] == 'y') {
		$ERR = $ERR_025;
	} else {
		#// Update database
		$query = "UPDATE ".$DBPrefix."maintainance SET
					  superuser='$_POST[superuser]',
					  maintainancetext='".addslashes($_POST[maintainancetext])."',
					  active='$_POST[active]'";
		$res = @mysql_query($query);
		if(!$res) {
			print "Error: $query<BR>".mysql_error();
			exit;
		} else {
			$ERR = $MSG__0005;
		}
		
	}
}

#//
#// Check if the maintainance table exists
$result = mysql_list_tables($DbDatabase);

if (!$result) {
	print "DB Error, could not list tables\n";
	print 'MySQL Error: ' . mysql_error();
	exit;
}

while ($row = mysql_fetch_row($result)) {
	$TABLES[] = $row[0];
}
$query = "SELECT * FROM ".$DBPrefix."maintainance";
$res = @mysql_query($query);
if(!$res) {
	print "Error: $query<BR>".mysql_error();
	exit;
} elseif(mysql_num_rows($res) > 0) {
	$_POST = mysql_fetch_array($res);
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
          <td width="30"><img src="images/i_too.gif" ></td>
          <td class=white><?=$MSG_5436?>&nbsp;&gt;&gt;&nbsp;<?=$MSG__0001?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
<TABLE BORDER=0 WIDTH=95% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
<TR>
<TD>
<BR>
<FORM NAME=conf ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
	<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
		<TR>
			<TD ALIGN=CENTER class=title>
				<?php print $MSG__0001; ?>
			</TD>
		</TR>
		<TR>
			<TD>

<TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
  <?php
  if(isset($ERR)) {
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
	<TD WIDTH=109>&nbsp;</TD>
	<TD WIDTH="375">
	  <?php print $MSG__0002; ?>
	  </TD>
  </TR>
  <TR VALIGN="TOP">
	<TD WIDTH=109 HEIGHT="22">
	  <?php print $MSG__0006; ?>
	  </TD>
	<TD WIDTH="375" HEIGHT="22">
	  <INPUT TYPE="radio" NAME="active" VALUE="y" <?if($_POST[active] == 'y') print " checked"?>>
	  <?=$MSG_030?>
	  <INPUT TYPE="radio" NAME="active" VALUE="n" <?if($_POST[active] == 'n') print " checked"?>>
	  <?=$MSG_029?>
	  </TD>
  </TR>
  <TR VALIGN="TOP">
	<TD WIDTH=109 HEIGHT="22">
	  <?php print $MSG_003; ?>
	  </TD>
	<TD WIDTH="375" HEIGHT="22">
	  <INPUT TYPE="text" NAME="superuser" VALUE="<?=$_POST[superuser]?>">
	  </TD>
  </TR>
  <TR VALIGN="TOP">
	<TD WIDTH=109 HEIGHT="22">
	  <?php print $MSG__0004; ?>
	  </TD>
	<TD WIDTH="375" HEIGHT="22">
	  <textarea name="maintainancetext" cols="45" rows="15"><?=$_POST[maintainancetext]?></textarea>
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
