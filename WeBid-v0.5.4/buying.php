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

require('./includes/config.inc.php');

#// Retrieve final value fees
#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"]))
{
	Header("Location: user_login.php");
	exit;
}

#// Get closed auctions with winners
$query = "SELECT
			  a.auction,
			  a.seller,
			  a.winner,
			  a.bid,
			  a.fee,
			  b.id,
			  b.current_bid
			  FROM
			  ".$DBPrefix."winners a, ".$DBPrefix."auctions b
			  WHERE
			  a.auction=b.id AND
			   (b.closed='1' OR b.closed='-1') AND b.suspended=0 AND
			  a.winner='$_SESSION[PHPAUCTION_LOGGED_IN]'
			 ORDER BY a.closingdate DESC";
$res = @mysql_query($query);
if(!$res)
{
	MySQLError($query);
	exit;
}
else
{
	while($row = mysql_fetch_array($res))
	{
		$query = "SELECT title,ends FROM ".$DBPrefix."auctions WHERE id='$row[auction]'";
		$r = @mysql_query($query);
		if(!$r)
		{
			MySQLError($query);
			exit;
		}
		$AUCTIONS[$row[auction]] = stripslashes(mysql_result($r,0,"title"));
		$AUCTIONS_ENDS[$row[auction]] = stripslashes(mysql_result($r,0,"ends"));
		
		#// Get seller's details
		$query = "SELECT nick,email,payment_details FROM ".$DBPrefix."users WHERE id='$row[seller]'";
		$re_ = @mysql_query($query);
		if(!$re_)
		{
			MySQLError($query);
			exit;
		}
		$query = "SELECT quantity FROM ".$DBPrefix."bids
					  WHERE
					  bidder='$_SESSION[PHPAUCTION_LOGGED_IN]'
					  AND
					  auction='$row[auction]'";
		$resq = @mysql_query($query);
		if(!$resq)
		{
			MySQLError($query);
			exit;
		}
		$SELLER[$row[auction]] = $row['seller'];
		$BID[$row[auction]] = $row['bid'];
		$QTY[$row[auction]] = mysql_result($resq,0,"quantity");
    if($QTY[$row[auction]] <= '0')
    $QTY[$row[auction]] = '1';
		$SELLER_NICK[$row[auction]] = mysql_result($re_,0,"nick");
		$SELLER_EMAIL[$row[auction]] = mysql_result($re_,0,"email");
		$SELLER_PAYMENT[$row[auction]] = mysql_result($re_,0,"payment_details");
		$query = "SELECT * FROM ".$DBPrefix."feedbacks
					WHERE auction_id =".$row['auction']."
					AND rated_user_id = ".$row['seller']."
					AND (rater_user_nick = '".$_SESSION['PHPAUCTION_LOGGED_IN_USERNAME']."'
					OR rater_user_nick='autofeedback')";
		$resfeed=mysql_query($query);
		$hasfeed=mysql_num_rows($resfeed);
		if($hasfeed==0) {
			$SELL_FDB[$row['auction']] = $row['seller'];
		} else {
			$SELL_FDB[$row['auction']] = "";
		}

	}
}

require("header.php");
include phpa_include("template_buying_php.html");
include "./footer.php";

?>
