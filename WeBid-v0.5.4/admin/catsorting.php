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
$ERR = "";

#//
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	$query = " UPDATE ".$DBPrefix."settings SET
				   catsorting='".addslashes($_POST['catsorting'])."',
				   catstoshow='".addslashes($_POST['catstoshow'])."'";
	$res_ = @mysql_query($query);
	if(!$res_)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	else
	{
		$SETTINGS['catsorting'] = $_POST['catsorting'];
		$SETTINGS['catstoshow'] = $_POST['catstoshow'];
		$ERR = $MSG_25_0150;
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
          <td width="30"><img src="images/i_gra.gif" width="19" height="19"></td>
          <td class=white><?=$MSG_25_0008?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_25_0146?></td>
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
				<?php print $MSG_25_0146; ?>
				</TD>
		</TR>
		<TR>
	<TD>
		<TABLE WIDTH=100% CELLPADDING=4 ALIGN="CENTER" BGCOLOR="#FFFFFF">
		  <?php
		  if($ERR != "")
		  {
		?>
		  <TR>
			<TD class=error COLSPAN="2" ALIGN=CENTER bgcolor="yellow">
			  <?php print $ERR; ?>
			  </TD>
		  </TR>
		  <?php
		  }
		?>
		  <tr valign="TOP">
			<td colspan="2"><img src="../images/transparent.gif" width="1" height="5"></td>
		  </tr>

		  <tr valign="TOP">
			<td width="100%"> 
			  <?php print $MSG_25_0147; ?>
			  <br><br>
			  &nbsp;&nbsp;<input type="radio" name="catsorting" value="alpha"
					 <?php if($SETTINGS['catsorting'] == 'alpha') print " CHECKED";?>
					 >
			  
			  <?php print $MSG_25_0148; ?>
			  
			  <BR>
			  &nbsp;&nbsp;<input type="radio" name="catsorting" value="counter"
					 <?php if($SETTINGS['catsorting'] == 'counter') print " CHECKED";?>
					 >
			  
			  <?php print $MSG_25_0149; ?>
			  <BR><BR>
			  <?=$MSG_30_0029?>
			  <BR>
			  <?=$MSG_30_0030?><INPUT SIZE=3 TYPE=TEXT NAME=catstoshow VALUE="<?=$SETTINGS['catstoshow']?>">
			   </td>
		  </tr>
		  <TR>
			<TD WIDTH="100%">
			<BR>
			  <INPUT TYPE="hidden" NAME="action" VALUE="update">
			  <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
			</TD>
		  </TR>
		  <TR>
			<TD WIDTH="100%"> </TD>
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