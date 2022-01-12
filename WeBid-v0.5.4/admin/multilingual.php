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

if($_POST['action'] == 'updatelanguage' && basename($HTTP_REFERER) == basename($PHP_SELF))
{
	@mysql_query("UPDATE ".$DBPrefix."settings SET defaultlanguage='".$_POST['deflang']."'");
}

#// Retrieve default language
$DEFAULTLANGUAGE = mysql_result(@mysql_query("SELECT defaultlanguage FROM ".$DBPrefix."settings"),0,"defaultlanguage");

#// Retrieve available languages
?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php print  $TPL_info_err . ""?><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_pre.gif" width="16" height="19"></td>
          <td class=white><?=$MSG_25_0008?>&nbsp;&gt;&gt;&nbsp;<?=$MGS_2__0002?></td>
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
	<FORM NAME=conf ACTION="<?=$_SERVER['PHP_SELF']?>" METHOD=POST>
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
		<TR>
			<TD ALIGN=CENTER class=title>
				<?php print $MGS_2__0002; ?>
			</TD>
		</TR>
		<TR>
			<TD><TABLE WIDTH="100%" BORDER="0" CELLPADDING="2" CELLSPACING="0" BGCOLOR="#FFFFFF">
			  <TR>
				<TD WIDTH="19%">&nbsp;</TD>
				<TD WIDTH="81%"><?=$MGS_2__0003?></TD>
			  </TR>
			  <TR>
				<TD>&nbsp;</TD>
				<TD>&nbsp;</TD>
			  </TR>
			  <TR>
				<TD VALIGN=top><?=$MGS_2__0004?></TD>
				<TD>
				<?php
				if(is_array($LANGUAGES))
				{
					reset($LANGUAGES);
					while(list($k,$v) = each($LANGUAGES))
					{
				?>
						<INPUT TYPE=radio NAME=deflang value=<?=$k?> <?if($DEFAULTLANGUAGE == $k) print " CHECKED";?>>
						<IMG SRC=../includes/flags/<?=$k?>.gif HSPACE=2>
						<?=$v?>
						<?php
						if($DEFAULTLANGUAGE == $k)
						{
							print "&nbsp;".$MGS_2__0005;
						}
						?>
						<BR>
				<?php
					}
				}
				?>
				</TD>
			  </TR>
			  <TR>
				<TD VALIGN=top>&nbsp;</TD>
				<TD>&nbsp;</TD>
			  </TR>
			  <TR>
				<TD VALIGN=top>&nbsp;</TD>
				<TD>
					<INPUT TYPE="hidden" NAME="action" VALUE="updatelanguage">
					<INPUT TYPE="submit" NAME="Submit" VALUE="<?=$MSG_530?>">
				</TD>
			  </TR>
			  <TR>
				<TD VALIGN=top>&nbsp;</TD>
				<TD>&nbsp;</TD>
			  </TR>
			  </TABLE>
		</TD>
		</TR>
	</TABLE>
	</FORM>
<CENTER>
	</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>
