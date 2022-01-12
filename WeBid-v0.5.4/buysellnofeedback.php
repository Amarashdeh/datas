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
require('./includes/messages.inc.php');
#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}

#// Get closed auctions with winners
$query = "SELECT a.auction, a.seller,  a.winner, a.bid, a.fee, b.id, b.current_bid,
					b.title
			  FROM 	".$DBPrefix."winners a, ".$DBPrefix."auctions b
			  WHERE a.auction=b.id 
				AND (b.closed='1' OR b.closed='-1')
				AND b.suspended=0
				AND (a.fee in (0,3) OR '".$SETTINGS['invoicing']."'='y')
				AND a.winner='".$_SESSION['PHPAUCTION_LOGGED_IN']."'";
$res = @mysql_query($query);
$i=0;
if(!$res) {
	MySQLError($query);
	exit;
} else {
	while($row = mysql_fetch_array($res)) {
		$query = "SELECT * FROM ".$DBPrefix."feedbacks
					WHERE auction_id =".$row['id']."
					AND rated_user_id =". $row['seller']."
					AND (rater_user_nick ='".$_SESSION['PHPAUCTION_LOGGED_IN_USERNAME']."'
						OR rater_user_nick='autofeedback')";
		$resfeed=mysql_query($query);
		$hasfeed=mysql_num_rows($resfeed);
		if($hasfeed==0) {
			$AUCTIONIDS[$i]=$row['auction'];
			$AUCTIONS[$i] = $row['title'];
		
		#// Get seller's details
		$query = "SELECT nick,email FROM ".$DBPrefix."users WHERE id=".$row['seller'];
		$re_ = @mysql_query($query);
		if(!$re_) {
			MySQLError($query);
			exit;
		}
		$query = "SELECT quantity FROM ".$DBPrefix."bids
					  WHERE  bidder=".$_SESSION['PHPAUCTION_LOGGED_IN']."
					  AND  auction=".$row['auction']."
					  ORDER BY id DESC";
		$resq = @mysql_query($query);
		if(!$resq) {
			MySQLError($query);
			exit;
		}
		$WINORSELL[$i] = $MSG_25_0002;
		$WINNERORSELLER[$i] = $row['seller'];
		$BID[$i] = $row['bid'];
		$QTY[$i] = mysql_result($resq,0,"quantity");
		$WINNERORSELLER_NICK[$i] = mysql_result($re_,0,"nick");
		$WINNERORSELLER_EMAIL[$i++] = mysql_result($re_,0,"email");
		}
	}
}
$query = "SELECT a.auction, a.seller,  a.winner, a.bid, a.fee, b.id, b.current_bid,
					b.title
		  		FROM ".$DBPrefix."winners a,".$DBPrefix."auctions b
			  WHERE a.auction=b.id 
				AND (b.closed='1' OR b.closed='-1')
				AND b.suspended=0
				AND (a.fee in (0,2) OR '".$SETTINGS['invoicing']."'='y')
				AND a.seller=".$_SESSION['PHPAUCTION_LOGGED_IN'];
$res = @mysql_query($query);
if(!$res) {
	MySQLError($query);
	exit;
} else {
	while($row = mysql_fetch_array($res)) {
		$query = "SELECT * FROM ".$DBPrefix."feedbacks
					WHERE auction_id =".$row['id']."
					AND rated_user_id = ".$row['winner']."
					AND (rater_user_nick = '".$_SESSION['PHPAUCTION_LOGGED_IN_USERNAME']."'
						OR rater_user_nick='autofeedback')";
		$resfeed=mysql_query($query);
		$hasfeed=mysql_num_rows($resfeed);
		if($hasfeed==0) {
			$AUCTIONIDS[$i]=$row['auction'];
			$AUCTIONS[$i] = $row['title'];
			
			#// Get seller's details
			$query = "SELECT nick,email FROM ".$DBPrefix."users WHERE id=".$row['winner'];
			$re_ = @mysql_query($query);
			if(!$re_) {
				MySQLError($query);
				exit;
			}
			$query = "SELECT quantity FROM ".$DBPrefix."bids
					  WHERE  bidder=".$row['winner']."
					  AND  auction=".$row['auction']."
					  ORDER BY id DESC";
			$resq = @mysql_query($query);
			if(!$resq) {
				MySQLError($query);
				exit;
			}elseif(mysql_num_rows($resq) > 0) {
				$WINORSELL[$i] = $MSG_25_0001;
				$WINNERORSELLER[$i] = $row['winner'];
				$BID[$i] = $row['bid'];
				$QTY[$i] = mysql_result($resq,0,"quantity");
				$WINNERORSELLER_NICK[$i] = mysql_result($re_,0,"nick");
				$WINNERORSELLER_EMAIL[$i++] = mysql_result($re_,0,"email");
			}
		}
	}
}
$TPL_rater_nick=$_SESSION["PHPAUCTION_LOGGED_IN_USERNAME"];
require("header.php");
include phpa_include("template_sellbuyfeedback_php.html");
include "./footer.php";

?>
