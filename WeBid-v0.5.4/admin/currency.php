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

#// Create currencies array
$query = "SELECT id,valuta,symbol,ime FROM ".$DBPrefix."rates ORDER BY ime";
$res_ = @mysql_query($query);
if(!$res_)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}
elseif(@mysql_num_rows($res_) > 0)
{
	while($row = mysql_fetch_array($res_))
	{
		$CURRENCIES[$row[id]] = "$row[symbol]&nbsp;$row[ime]&nbsp($row[valuta]) ";
		$CURRENCIES_SYMBOLS[$row[id]] = "$row[symbol]";
	}
}


#//
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	#// Data check
	if(empty($_POST[defaultcurrency]) ||
	empty($_POST[moneyformat]) ||
	empty($_POST[moneysymbol]))
	{
		$ERR = $ERR_047;
		$SETTINGS = $_POST;
	}
	elseif(!empty($_POST[moneydecimals]) && !ereg("^[0-9]+$",$_POST[moneydecimals]))
	{
		$ERR = $ERR_051;
		$SETTINGS = $_POST;
	}
	else
	{
		#// Update database
		$query = "update ".$DBPrefix."settings set currency='".addslashes($CURRENCIES_SYMBOLS[$_POST[defaultcurrency]])."',
								          moneyformat=$_POST[moneyformat],
								          moneydecimals=".intval($_POST[moneydecimals]).",
								          moneysymbol=$_POST[moneysymbol]";
		$res = @mysql_query($query);
		if(!$res)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		else
		{
			$ERR = $MSG_553;
			$SETTINGS = $_POST;
		}
	}
	
	if(is_array($_POST[othercurrencies]))
	{
		@mysql_query("DELETE FROM ".$DBPrefix."currencies");
		while(list($k,$v) = each($_POST[othercurrencies]))
		{
			$query = "INSERT INTO ".$DBPrefix."currencies VALUES (NULL,'$v')";
			//print $query;
			$res = @mysql_query($query);
			if(!$res)
			{
				print "Error: $query<BR>".mysql_error();
				exit;
			}
		}
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


$OTHERCURRENCIES = array();
$query = "SELECT * FROM ".$DBPrefix."currencies";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_array($res))
	{
		$OTHERCURRENCIES[$row[id]] = $row[currency];
	}
}



?>
<HEAD>

<SCRIPT Language=Javascript>
function window_open(pagina,titulo,ancho,largo,x,y){
	
	var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
	open(pagina,titulo,Ventana);
	
}
</SCRIPT>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_pre.gif" width="16" height="19"></td>
          <td class=white><?=$MSG_25_0008?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5004?></td>
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
	<FORM NAME=conf ACTION=currency.php METHOD=POST>
		<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
			<TR>
				<TD ALIGN=CENTER class=title>
					<?php print $MSG_076; ?>
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
						 <TD class=error COLSPAN="2" ALIGN=CENTER>
						 <?php print $ERR; ?>
						 </TD>
						 </TR>
					   <?php
					}
					?>
						<TR VALIGN="TOP">
							<TD WIDTH=173 HEIGHT="31">
								<?=$MSG_5008;?>
								</TD>
							<TD HEIGHT="31" WIDTH="459">
							<SELECT NAME=defaultcurrency>
							<OPTION VALUE=""></OPTION>
							<?php
							reset($CURRENCIES);
							while(list($k,$v) = each($CURRENCIES))
							{print "$k, $SETTINGS[currency]<br>";
							?>
								<OPTION VALUE="<?=$k?>" <?if($CURRENCIES_SYMBOLS[$k] == $SETTINGS[currency]) print " SELECTED"?>><?=$v?></OPTION>
							<?php
							}
							?>
							</SELECT>
								<!--<INPUT TYPE=text NAME=currency VALUE="<?=$SETTINGS[currency]?>" SIZE=5 MAXLENGTH="10">-->
							<BR>
							<?=$MSG_5138?>
							<BR>
							[&nbsp;<A HREF=javascript:window_open('converter.php','incre',650,200,30,30)><?=$MSG_5010?></A>&nbsp;]
							</TD>
						</TR>

						<TR VALIGN="TOP">
							<TD COLSPAN="2" HEIGHT="7"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
						</TR>
						<TR VALIGN="TOP">
							<TD WIDTH=173 HEIGHT="31">
								<?=$MSG_544;?>
								</TD>
							<TD HEIGHT="31" WIDTH="459">
								<INPUT TYPE="radio" NAME="moneyformat" VALUE="1"
							<?php if($SETTINGS[moneyformat] == 1) print " CHECKED";?>
							>
								
								<?=$MSG_545;?>
								<BR>
								<INPUT TYPE="radio" NAME="moneyformat" VALUE="2"
							<?php if($SETTINGS[moneyformat] == 2) print " CHECKED";?>
							>
								
								<?=$MSG_546;?>
								 </TD>
						</TR>
						<TR VALIGN="TOP">
							<TD COLSPAN="2" HEIGHT="4"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
						</TR>
						<TR VALIGN="TOP">
							<TD WIDTH=173 HEIGHT="31">
								<?=$MSG_548;?>
								</TD>
							<TD HEIGHT="31" WIDTH="459"> 
								<?=$MSG_547;?>
								<BR>
								<INPUT TYPE=text NAME=moneydecimals VALUE="<?=$SETTINGS[moneydecimals]?>" SIZE=5 MAXLENGTH="10">
							</TD>
						</TR>
						<TR VALIGN="TOP">
							<TD COLSPAN="2" HEIGHT="6"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
						</TR>
						<TR VALIGN="TOP">
							<TD WIDTH=173 HEIGHT="31">
								<?=$MSG_549;?>
								</TD>
							<TD HEIGHT="31" WIDTH="459">
								<INPUT TYPE="radio" NAME="moneysymbol" VALUE="1"
					<?php if($SETTINGS[moneysymbol] == 1) print " CHECKED";?>
					>
								
								<?=$MSG_550;?>
								<BR>
								<INPUT TYPE="radio" NAME="moneysymbol" VALUE="2"
					<?php if($SETTINGS[moneysymbol] == 2) print " CHECKED";?>
					>
								
								<?=$MSG_551;?>
								 </TD>
						</TR>
						<TR VALIGN="TOP">
							<TD COLSPAN="2" HEIGHT="4"><IMG SRC="../images/transparent.gif" WIDTH="1" HEIGHT="5"></TD>
						</TR>
						<TR>
							<TD WIDTH=173>
								<INPUT TYPE="hidden" NAME="action" VALUE="update">
								<INPUT TYPE="hidden" NAME="id" VALUE="<?=$id?>">
							</TD>
							<TD WIDTH="459">
								<INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
							</TD>
						</TR>
						<TR>
							<TD WIDTH=173></TD>
							<TD WIDTH="459"> </TD>
						</TR>
					</TABLE>
				</TD>
			</TR>
		</TABLE>
		</FORM>
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