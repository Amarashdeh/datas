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
	if($_POST[https] == 'yes' && empty($_POST[httpsurl])) {
		$ERR = $ERR_047;
		$SETTINGS = $_POST;
	} else {
		#// Update database
		$query = "update ".$DBPrefix."https SET
							 https='$_POST[https]',
							 httpsurl='$_POST[httpsurl]'";
		$res = @mysql_query($query);
		if(!$res) {
			print "Error: $query<BR>".mysql_error();
			exit;
		} else {
			$ERR = $MSG_1054;
			$SETTINGS = $_POST;
		}
	}
} else {
	#//
	$query = "SELECT * FROM ".$DBPrefix."https";
	$res = @mysql_query($query);
	if(!$res) {
		print "Error: $query<BR>".mysql_error();
		exit;
	} elseif(mysql_num_rows($res) > 0) {
		$SETTINGS = mysql_fetch_array($res);
	}
}

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=Javascript>

function window_open(pagina,titulo,ancho,largo,x,y){
	var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
	open(pagina,titulo,Ventana);
}
</SCRIPT>
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_set.gif" width="21" height="19"></td>
          <td class_white><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_1050?></td>
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
					<?=$MSG_1050?>
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
	  <tr valign="TOP">
		<td width=123 height="31">
		  <?=$MSG_1050?></td>
		<td height="31" width="509">
		<?=$MSG_1051?>
		<br>
		  <input type="radio" name="https" value="yes"
		  <?php if($SETTINGS[https] == 'yes' || empty($SETTINGS[https])) PRINT " CHECKED"; ?>
		  >
		  <?=$MSG_030?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="https" value="no"
		  <?php if($SETTINGS[https] == 'no') PRINT " CHECKED"; ?>
		  >
		  <?=$MSG_029?>
		</td>
	  </tr>
	  <tr valign="TOP">
		<td colspan="2" height="7"><img src="../images/transparent.gif" width="1" height="5"></td>
	  </tr>
	  <tr valign="TOP">
		<td width=123 height="31">
		  <?=$MSG_1052?></td>
		<td height="31" width="509">
		 <?=$MSG_1053?><BR>
		 <?=$MSG_1055?><BR><br>
		  <input type=text name=httpsurl size=45 maxlength="255" VALUE="<?=$SETTINGS[httpsurl]?>">
		</td>
	  </tr>
	  <tr valign="TOP">
		<td colspan="2" height="7"><img src="../images/transparent.gif" width="1" height="5"></td>
	  </tr>
	  <TR VALIGN="TOP">
		<TD COLSPAN="2" HEIGHT="4"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
	  </TR>
	  <TR>
		<TD WIDTH=123>
		  <INPUT TYPE="hidden" NAME="action" VALUE="update">
		</TD>
		<TD WIDTH="509">
		  <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
		</TD>
	  </TR>
	  <TR>
		<TD WIDTH=123></TD>
		<TD WIDTH="509"> </TD>
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
