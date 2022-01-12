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

include '../includes/config.inc.php';
include $include_path.'dates.inc.php';
include $include_path.'auction_types.inc.php';
include "loggedin.inc.php";


#// If $id is not defined -> error
if(!isset($_GET['id']))
{
	print $MSG__0164;
	exit;
}

#// Retrieve auction's data
$query = "SELECT * FROM ".$DBPrefix."auctions WHERE id=".intval($_GET['id']);
$res = @mysql_query($query);
if(!$res)
{
	print "$query<BR>".mysql_error();
	exit;
}
elseif(@mysql_num_rows($res) == 0)
{
	print $MSG__0165;
}
else
{
	$AUCTION = mysql_fetch_array($res);
}

#// Retrieve winners
$query = "SELECT * FROM ".$DBPrefix."winners WHERE auction=".intval($_GET['id']);
$res = @mysql_query($query);
//print $query;
if(!$res)
{
	print "$query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_array($res))
	{
		$WINNERS[$row['id']] = $row;
	}
}
#// Retrieve bids
$query = "SELECT * FROM ".$DBPrefix."bids WHERE auction=".intval($_GET['id']);
$res = @mysql_query($query);
//print $query;
if(!$res)
{
	print "$query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_array($res))
	{
		$BIDS[$row['id']] = $row;
	}
}

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<BODY>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_auc.gif"></td>
          <td class=white><?=$MSG_239?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_30_0176?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">

<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
	<TR>
		<TD ALIGN=CENTER class=title>
			<?php print $MSG_30_0176; ?>
		</TD>
	</TR>
	<TR>
		<TD>

    <TABLE WIDTH=100% CELPADDING=4 CELLSPACING=0 BORDER=0 ALIGN="CENTER" CELLPADDING="3">
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left><B><?=$MSG_113?>: </B> <?=intval($_GET['id'])?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left><B><?=$MSG_197?>: </B> <?=stripslashes($AUCTION['title'])?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left>
			<?$SELLER = @mysql_fetch_array(@mysql_query("SELECT name,nick FROM ".$DBPrefix."users WHERE id=".$AUCTION['user']));?>
			<B><?=$MSG_125?>: </B> <?=stripslashes($SELLER['nick'])." (".$SELLER['name'].")";?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left><B><?=$MSG_127?>: </B> <?=print_money($AUCTION['minimum_bid'])?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left><B><?=$MSG_111?>: </B> <?=FormatDate($AUCTION['starts'])?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left><B><?=$MSG_30_0177?>: </B> <?=FormatDate($AUCTION['ends'])?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left><B><?=$MSG_257?>: </B> <?=$auction_types[$AUCTION['auction_type']]?></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left>&nbsp;</TD>
	  </TR>
      <TR BGCOLOR="#FFCC00">
        <TD ALIGN=left><B><?=$MSG_453?></B></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left>
		<?php
		if(is_array($WINNERS)){
		?>
				<TABLE WIDTH=65% ALIGN=CENTER CELLPADDING=4 CELLSPACING=1 BORDER=0 BGCOLOR=#FFFFFF>
				<TR BGCOLOR=#DDDDDD align=center>
					<TD><B><?=$MSG_176?></B></TD>
					<TD><B><?=$MSG_30_0179?></B></TD>
					<TD><B><?=$MSG_284?></B></TD>
				</TR>
			<?php
				while(list($k,$v) = each($WINNERS)){
					$qty = @mysql_result(@mysql_query("SELECT quantity FROM ".$DBPrefix."bids WHERE bidder=".$v['winner']." AND auction=".intval($_GET['id'])),0,"quantity");
					$BIDDER = @mysql_fetch_array(@mysql_query("SELECT name,nick FROM ".$DBPrefix."users WHERE id=".$v['winner']));
			?>
				<TR>
					<TD><?=stripslashes($BIDDER['nick'])." (".stripslashes($BIDDER['name']).")"?></TD>
					<TD align=right><?=Print_money($v['bid'])?>&nbsp;</TD>
					<TD align=center><?if($qty==0) print "--"; else print $qty;?></TD>
				</TR>
			<?php
				}
			?>
				</TABLE>
			<?php
		}else{
			print $MSG_30_0178;
		}
		?>
		</TD>
	  </TR>
      <TR BGCOLOR="#FFCC00">
        <TD ALIGN=left><B><?=$MSG_30_0180?></B></TD>
	  </TR>
      <TR BGCOLOR="#FFFFFF">
        <TD ALIGN=left>
		<?php
		if(is_array($BIDS)){
		?>
				<TABLE WIDTH=65% ALIGN=CENTER CELLPADDING=4 CELLSPACING=1 BORDER=0 BGCOLOR=#FFFFFF>
				<TR BGCOLOR=#DDDDDD align=center>
					<TD><B><?=$MSG_176?></B></TD>
					<TD><B><?=$MSG_30_0179?></B></TD>
					<TD><B><?=$MSG_284?></B></TD>
				</TR>
			<?php
				while(list($k,$v) = each($BIDS)){
					$qty = @mysql_result(@mysql_query("SELECT quantity FROM ".$DBPrefix."bids WHERE bidder=".$v['bidder']." AND auction=".intval($_GET['id'])),0,"quantity");
					$BIDDER = @mysql_fetch_array(@mysql_query("SELECT name,nick FROM ".$DBPrefix."users WHERE id=".$v['bidder']));
			?>
				<TR>
					<TD><?=stripslashes($BIDDER['nick'])." (".stripslashes($BIDDER['name']).")"?></TD>
					<TD align=right><?=Print_money($v['bid'])?>&nbsp;</TD>
					<TD align=center><?if($qty==0) print "--"; else print $qty;?></TD>
				</TR>
			<?php
				}
			?>
				</TABLE>
			<?php
		}else{
			print $MSG_30_0178;
		}
		?>
		</TD>
	  </TR>
	  
    </TABLE>
</TR>
</TABLE>
</BODY>
<HTML>