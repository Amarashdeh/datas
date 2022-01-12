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
if($_POST[action] == "search"  && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	#// 
	$query = "SELECT id FROM ".$DBPrefix."auctions WHERE id='".$_POST['auctionid']."'";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}elseif(mysql_num_rows($res) > 0){
		$query = "SELECT max(id) as id, bidder, bid FROM ".$DBPrefix."bids WHERE auction='".$_POST['auctionid']."' GROUP BY auction, bidder, bid ORDER BY id DESC";
		$res = @mysql_query($query);
		if(mysql_num_rows($res) > 0){
			$max_bid_id = mysql_result($res,0,"id");
			$max_bidder = mysql_result($res,0,"bidder");
			$max_bid = mysql_result($res,0,"bid");
			if(mysql_num_rows($res) > 1){
				$next_max_bid_id = mysql_result($res,1,"id");
				$next_max_bidder = mysql_result($res,1,"bidder");
				$next_max_bid = mysql_result($res,1,"bid");
			}else{
				$next_max_bid_id = 0;
				$next_max_bidder = 0;
				$next_max_bid = 0;
			}

			// Delete bid of higher bidder
			$query = "DELETE FROM ".$DBPrefix."bids WHERE id='".$max_bid_id."'";
			$res = @mysql_query($query);

			// Delete proxybid of higher bidder
      $res = @mysql_query("SELECT max(bid) as bid FROM ".$DBPrefix."proxybid WHERE itemid='".$_POST['auctionid']."' AND userid='".$max_bidder."'");
      $proxybid_to_delete = @mysql_result($res,0,"bid");
      $query = "DELETE FROM ".$DBPrefix."proxybid WHERE userid='".$max_bidder."' AND bid=".$proxybid_to_delete;
			$res = @mysql_query($query);

			// Update minimum_bid in auctions table
			$current_bid = $next_max_bid ? $next_max_bid : "minimum_bid";
			$query = "UPDATE ".$DBPrefix."auctions SET current_bid ='".$current_bid."'";
			$res = @mysql_query($query);
			
			$ERR = $MSG_30_0190."<br><br>
			<a href=".$SETTINGS[siteurl]."item.php?id=".$_POST['auctionid']." target=_blank>$MSG_138</a>";
		}
		
	}else{
		$ERR = $ERR_122;
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
          <td width="30"><img src="images/i_auc.gif" ></td>
          <td class=white><?=$MSG_30_0031?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_30_0032?></td>
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
				<?php print $MSG_30_0032; ?>
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
							<?php print $MSG_30_0033; ?>
							</TD>
					</TR>
					<TR VALIGN="TOP">
						<TD WIDTH=109 HEIGHT="22">
							<?php print $MSG_113; ?>
							</TD>
						<TD WIDTH="375" HEIGHT="22">
							<INPUT TYPE="text" SIZE=15 NAME="auctionid" VALUE="<?=$POST['auctionid']?>"></TD>
					</TR>
					<TR VALIGN="TOP">
						<TD WIDTH=109>&nbsp;</TD>
						<TD WIDTH="375">&nbsp;</TD>
					</TR>
					<TR>
						<TD WIDTH=109>
							<INPUT TYPE="hidden" NAME="action" VALUE="search">
						</TD>
						<TD WIDTH="375">
							<INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_30_0034; ?>">
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
