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
if($_POST[action] == "update"  && basename($_SERVER[HTTP_REFERER]) == basename($_SERVER[PHP_SELF]))
{
	if(empty($_POST[sizetype]))
	{
		$ERR = $ERR_047;
		$SETTINGS = $_POST;
	}
	elseif($_POST[sizetype] == 'fix' &&
	(empty($_POST[width] ) || empty($_POST[height])))
	{
		$ERR = $ERR_047;
		$SETTINGS = $_POST;
	}
	elseif($_POST[sizetype] == 'fix' &&
	(!ereg("^[0-9]+$",$_POST[width]) || !ereg("^[0-9]+$",$_POST[height])))
	{
		$ERR = $MSG__0020;
		$SETTINGS = $_POST;
	}
	else
	{
		#// Update database
		$query = "update ".$DBPrefix."bannerssettings
					  SET
					  sizetype='$_POST[sizetype]',
					  width=".intval($_POST[width]).",
					  height=".intval($_POST[height]);
		$res = @mysql_query($query);
		if(!$res)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		else
		{
			$ERR = $MSG_600;
			$SETTINGS = $_POST;
		}
	}
}
else
{
	#//
	$query = "SELECT * FROM ".$DBPrefix."bannerssettings";
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
          <td width="30"><img src="images/i_ban.gif" ></td>
          <td class=white><?=$MSG_25_0011?>&nbsp;&gt;&gt;&nbsp;<?=$MSG__0013?></td>
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
					<?php print $MSG__0013; ?>
					</B></TD>
			</TR>
			<TR>
				<TD>

                <TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
                  <?php
                  if(!empty($ERR))
                  {
						?>
                  <TR>
                    <TD class=error COLSPAN="2" ALIGN=CENTER BGCOLOR=yellow>
                      <?=$ERR?>
                     </TD>
                  </TR>
                  <?php
                  }
						?>
                  <TR VALIGN="TOP">
                    <TD COLSPAN="2">
                      <?php print $MSG__0014; ?>
                      </TD>
                  </TR>
                  <TR VALIGN="TOP" BGCOLOR="#dddddd">
                    <TD WIDTH="73" HEIGHT="22">
                      <INPUT TYPE="radio" NAME="sizetype" VALUE="any"
								<?php if($SETTINGS[sizetype] == 'any') print " CHECKED";?>
								>
                      </TD>
                    <TD HEIGHT="22" WIDTH="559">
                      <?=$MSG__0015?>
                      </TD>
                  </TR>
                  <TR VALIGN="TOP">
                    <TD WIDTH="73" HEIGHT="22" BGCOLOR="#eeeeee">
                      <INPUT TYPE="radio" NAME="sizetype" VALUE="fix"
								<?php if($SETTINGS[sizetype] == 'fix') print " CHECKED";?>
								>
                      </TD>
                    <TD HEIGHT="22" WIDTH="559" BGCOLOR="#eeeeee">
                      <?=$MSG__0016?>
                      </TD>
                  </TR>
                  <TR VALIGN="TOP">
                    <TD WIDTH="73" HEIGHT="22" BGCOLOR="#eeeeee">
                      <?=$MSG__0017?>
                      </TD>
                    <TD WIDTH="559" HEIGHT="22" BGCOLOR="#eeeeee">
                      <INPUT TYPE=text NAME=width VALUE="<?=$SETTINGS[width]?>">
					  <?=$MSG_5224?>
                      </TD>
                  </TR>
                  <TR VALIGN="TOP">
                    <TD WIDTH="73" HEIGHT="22" BGCOLOR="#eeeeee">
                      <?=$MSG__0018?>
                      </TD>
                    <TD HEIGHT="22" WIDTH="559" BGCOLOR="#eeeeee">
                      <INPUT TYPE=text NAME=height VALUE="<?=$SETTINGS[height]?>">
					  <?=$MSG_5224?>
                      </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="73">&nbsp; </TD>
                    <TD WIDTH="559">
                      <INPUT TYPE="hidden" NAME="action" VALUE="update">
                      <INPUT TYPE="hidden" NAME="id" VALUE="<?=$id?>">
                      <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
                    </TD>
                  </TR>
                  <TR>
                    <TD COLSPAN="2"> </TD>
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