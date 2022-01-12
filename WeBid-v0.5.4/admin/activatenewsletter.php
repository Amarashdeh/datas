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
include $include_path.'fonts.inc.php';


#//
$ERR = "";

#//
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	#// Handle logo upload
	if(!empty($_FILES[logo][tmp_name]) && $_FILES[logo][tmp_name] != "none")
	{
		$TARGET = $image_upload_path.$_FILES[logo][name];
		move_uploaded_file($_FILES['logo']['tmp_name'],$TARGET);
		chmod($TARGET,0666);
		
		$LOGOUPLOADED = TRUE;
	}
	
	$query = " UPDATE ".$DBPrefix."settings SET
				   newsletter=$_POST[newsletter]";
	$res_ = @mysql_query($query);
	if(!$res_)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	else
	{
		$SETTINGS = $_POST;
		$ERR = $MSG_30_0049;
	}
}

#//
$query = "SELECT * FROM ".$DBPrefix."settings";
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
          <td width="30"><img src="images/i_use.gif"></td>
          <td class=white><?=$MSG_25_0010?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_25_0079?></td>
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
<FORM NAME=conf ACTION="<?=basename($_SERVER['PHP_SELF'])?>" METHOD="POST"  ENCTYPE="multipart/form-data">
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
		<TR>
			<TD ALIGN=CENTER class=title>
				<?php print $MSG_25_0079; ?>
			</TD>
		</TR>
		<TR>
	<TD>
		<TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
		  <?php
		  if($ERR != "")
		  {
		?>
		  <TR>
			<TD class=error COLSPAN="2" ALIGN=CENTER bgcolor="yellow"><?php print $ERR; ?></TD>
		  </TR>
		  <?php
		  }
		?>
		  <tr valign="TOP">
			<td colspan="2"><img src="../images/transparent.gif" width="1" height="5"></td>
		  </tr>
		  <tr valign="TOP">
			<td width=169 height="61">
			  <?php print $MSG_603; ?>
			  </td>
			<td width="393" height="61">
			  <?php print $MSG_604; ?>
			  <br>
			  <input type="radio" name="newsletter" value="1"
					 <?php if($SETTINGS[newsletter] == 1) print " CHECKED";?>
					 >
			  <?php print $MSG_030; ?>
			  
			  <input type="radio" name="newsletter" value="2"
					 <?php if($SETTINGS[newsletter] == 2) print " CHECKED";?>
					 >
			  <?php print $MSG_029; ?>
			  <br>
			   </td>
		  </tr>
		  <TR>
			<TD WIDTH=169>
			  <INPUT TYPE="hidden" NAME="action" VALUE="update">
			</TD>
			<TD WIDTH="393">
			  <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
			</TD>
		  </TR>
		  <TR>
			<TD WIDTH=169></TD>
			<TD WIDTH="393"> </TD>
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
