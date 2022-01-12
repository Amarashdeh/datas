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

include "./includes/config.inc.php";
include $include_path."auctionstoshow.inc.php";

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);

#// ADDED BY GIAN sept. 15
#// DELETE OR CLOSE OPEN AUCTIONS
if($_POST['action'] == "delopenauctions") {
	if(is_array($_POST['O_delete'])) {
		while(list($k,$v) = each($_POST['O_delete'])) {
			$v = str_replace('..','',htmlspecialchars($v));
			#// Pictures Gallery
			if(file_exists($image_upload_path."$v")) {
				if($dir = @opendir($image_upload_path."$v")) {
					while($file = readdir($dir)) {
						if($file != "." && $file != "..") {
							@unlink($image_upload_path."$v/".$file);
						}
					}
					closedir($dir);
					
					@rmdir($image_upload_path."$v");
				}
			}
			
			$query = "SELECT photo_uploaded,pict_url FROM ".$DBPrefix."auctions where id=".intval($v);
			$res_ = @mysql_query($query);
			if(!$res_) {
				MySQLError($query);
				exit;
			}
			if(mysql_num_rows($res_)>0) {
				$pict_url = mysql_result($res_,0,"pict_url");
				$photo_uploaded = mysql_result($res_,0,"photo_uploaded");
				if($photo_uploaded) {
					@unlink($image_upload_path.$pict_url);
				}
			}
			
			#// Delete Invited Users List and Black Lists associated with this auction ---------------------------
			@mysql_query("DELETE FROM ".$DBPrefix."auccounter WHERE auction_id=".intval($v));
			
			#// Auction
			$query = "DELETE FROM ".$DBPrefix."auctions WHERE id=".intval($v);
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			
			#// Update counters
			include $include_path."updatecounters.inc.php";
		}
	}
	
	if(is_array($_POST['closenow'])) {
		while(list($k,$v) = each($_POST['closenow'])) {
			#// Update end time to "now"
			@mysql_query("UPDATE ".$DBPrefix."auctions SET ends='".$NOW."', starts=starts, relist=relisted WHERE id=".intval($v));
		}
		include "cron.php";
	}
}

#// Retrieve active auctions from the database
$TOTALAUCTIONS = mysql_result(mysql_query("SELECT count(id) AS COUNT FROM ".$DBPrefix."auctions WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' AND closed=0 AND starts<=".$NOW." AND suspended=0"),0,"COUNT");

if(!isset($_GET["PAGE"]) || $_GET["PAGE"] <= 1 || $_GET["PAGE"] == "") {
  $OFFSET = 0;
  $PAGE = 1;
} else {
  $OFFSET = ($_GET["PAGE"] - 1) * $LIMIT;
  $PAGE = $_GET["PAGE"];
}
$PAGES = ceil($TOTALAUCTIONS / $LIMIT);
if(!$PAGES) $PAGES = 1;
$_SESSION['backtolist_page'] = $PAGE;

# Handle columns sorting variables
if(!isset($_SESSION['oa_ord']) && empty($_GET['oa_ord'])) {
	$_SESSION['oa_ord'] = "title";
	$_SESSION['oa_type'] = "asc";
} elseif(!empty($_GET['oa_ord'])) {
	$_SESSION['oa_ord'] = str_replace('..','',addslashes(htmlspecialchars($_GET['oa_ord'])));
	$_SESSION['oa_type'] = str_replace('..','',addslashes(htmlspecialchars($_GET['oa_type'])));
} elseif(isset($_SESSION['oa_ord']) && empty($_GET['oa_ord'])) {
	$_SESSION['oa_nexttype'] = $_SESSION['oa_type'];
}
if(	$_SESSION['oa_nexttype'] == "desc") {
	$_SESSION['oa_nexttype'] = "asc";
} else {
	$_SESSION['oa_nexttype'] = "desc";
}
if(	$_SESSION['oa_type'] == "desc") {
	$_SESSION['oa_type_img'] = "<img src=\"images/arrow_up.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
} else {
	$_SESSION['oa_type_img'] = "<img src=\"images/arrow_down.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
}

$query = "SELECT DISTINCT id,title,current_bid,starts,ends,minimum_bid,duration,relist,relisted,num_bids,suspended
			FROM ".$DBPrefix."auctions
			WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' 
			AND closed=0 
			AND starts<='".$NOW."'
			AND suspended=0 
			ORDER BY ".$_SESSION['oa_ord']." ". $_SESSION['oa_type'] ." LIMIT ".intval($OFFSET).",".intval($LIMIT);
//print $query;
$res = mysql_query($query);
if(!$res) {
	print "Error: $query<BR>".mysql_error();
	exit;
}
//print $query;
unset($BIDS);
unset($ENDS);

$IDS = array();
$TITLE = array();
$DURATION = array();
$RELIST = array();
$RELISTED = array();
$ENDS = array();
$STARTS = array();
$STARTINGBID = array();
$BID = array();
$BIDS = array();
$BIDDERID = array();
$BIDDER = array();
$COUNTER = array();

#//Built array
while($item = mysql_fetch_array($res)) {
	$IDS[] = $item['id'];
	$TITLE[] = stripslashes($item['title']);
	$DURATION[] = $item['duration'];
	$RELIST[] = $item['relist'];
	$RELISTED[] = $item['relisted'];
	
	#$ends = substr($item['ends'],6,2)."/".substr($item['ends'],4,2)."/".substr($item['ends'],0,4);
	$ENDS[] = $item['ends'];
	
	#$starts 		= substr($item['starts'],6,2)."/".substr($item['starts'],4,2)."/".substr($item['starts'],0,4);
	$starts 		= $item['starts'];
	$STARTS[] 		= $starts;
	$STARTINGBID[] 	= $item['minimum_bid'];
	$BID[]	 		= $item['current_bid'];
	$BIDS[]  		= $item['num_bids'];
	$SUSPENDED[]  	= $item['suspended'];

	#//
	if($item['num_bids']>0){
		$query = "SELECT MAX(bid) AS maxbid,bidder FROM ".$DBPrefix."bids WHERE auction=".intval($item['id'])." GROUP BY auction, bidder ORDER BY id DESC";
		$result_ = @mysql_query ( $query) ;
		if ( mysql_num_rows($result_ ) > 0) {
			$high_bid       = mysql_result ( $result_, 0, "maxbid" );
			$query          = "select bidder from ".$DBPrefix."bids where bid=".doubleval($high_bid)." and auction=".intval($item['id']);
			$result_bidder  = mysql_query ( $query );
			$high_bidder_id = mysql_result ( $result_bidder, 0, "bidder" );

			$BIDDERID[] = $high_bidder_id;
			$BIDDER[] = @mysql_result(@mysql_query("SELECT nick FROM ".$DBPrefix."users WHERE id=".intval($high_bidder_id)),0,"nick");
		}
	}else{
		$BIDDER[] = '';
		$BIDDERID[]='';
	}
	#// Retrieve counter
	$query = "SELECT counter FROM ".$DBPrefix."auccounter WHERE auction_id=".intval($item['id']);
	$res_c = @mysql_query($query);
	if(@mysql_num_rows($res_c) > 0){
		$COUNTER[] = @mysql_result($res_c,0,"counter");
	}else{
		$COUNTER[] = 0;
	}
}

#// Build durations array
$query = "select * from ".$DBPrefix."durations order by days";
$rd = mysql_query($query);
while($row = mysql_fetch_array($rd)) {
	$DURATIONS[$row['days']] = $row['description'];
}

include "header.php";
include phpa_include("template_yourauctions_php.html");
include "footer.php";

?>
