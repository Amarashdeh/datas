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
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}

#// ADDED BY GIAN sept. 15
#// DELETE OR CLOSE OPEN AUCTIONS
if($_POST['action'] == "delopenauctions") {
	if(is_array($_POST['O_delete'])) {
		while(list($k,$v) = each($_POST['O_delete'])) {		
			$v = str_replace('..','',htmlspecialchars($v));
			#// Pictures Gallery
			if(file_exists($image_upload_path."/$v")) {
				if($dir = @opendir($image_upload_path."/$v")) {
					while($file = readdir($dir)) {
						if($file != "." && $file != "..") {
							@unlink($image_upload_path."/$v".$file);
						}
					}
					closedir($dir);
					
					@rmdir($image_upload_path."/$v");
				}
			}
			
			#//
			$query = "SELECT photo_uploaded,pict_url FROM ".$DBPrefix."auctions where id='$v'";
			$res_ = @mysql_query($query);
			if(!$res_) {
				MySQLError($query);
				exit;
			}
			if(mysql_num_rows($res_)>0) {
				$pict_url = mysql_result($res_,0,"pict_url");
				$photo_uploaded = mysql_result($res_,0,"photo_uploaded");
				#// Uploaded picture
				if($photo_uploaded)	{
					@unlink($image_upload_path.$pict_url);
				}
			}
			
			#// Delete Invited Users List and Black Lists associated with this auction ---------------------------
			@mysql_query("DELETE FROM ".$DBPrefix."auctioninvitedlists WHERE auction_id='$v'");
			@mysql_query("DELETE FROM ".$DBPrefix."auccounter WHERE auction_id='$v'");
			#// Auction
			$query = "DELETE FROM ".$DBPrefix."auctions WHERE id='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			
			#// Update counters
			include $include_path."updatecounters.inc.php";
		}
	}
	
	if(is_array($_POST['startnow'])) {
		while(list($k,$v) = each($_POST['startnow'])) {
			#// Update end time to "now"
			@mysql_query("UPDATE ".$DBPrefix."auctions SET starts='".$NOW."' WHERE id='$v'");
		}
	}
}



#// Retrieve active auctions from the database
$TOTALAUCTIONS = mysql_result(mysql_query("select count(id) as COUNT from ".$DBPrefix."auctions where user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' and starts>".$NOW." AND suspended=0"),0,"COUNT");

if(!isset($PAGE) || $PAGE == 1) {
	$OFFSET = 0;
	$PAGE = 1;
} else {
	$OFFSET = ( $PAGE - 1) * $LIMIT;
}
$PAGES = ceil($TOTALAUCTIONS / $LIMIT);
if(!$PAGES) $PAGES = 1;
$_SESSION['backtolist_page'] = $PAGE;
$_SESSION['backtolist'] = 'yourauctions_p.php';
# Handle columns sorting variables
if(!isset($_SESSION['pa_ord']) && empty($_GET['pa_ord'])) {
	$_SESSION['pa_ord'] = "title";
	$_SESSION['pa_type'] = "asc";
} elseif(!empty($_GET['pa_ord'])) {
	$_SESSION['pa_ord'] = str_replace('..','',addslashes(htmlspecialchars($_GET['pa_ord'])));
	$_SESSION['pa_type'] = str_replace('..','',addslashes(htmlspecialchars($_GET['pa_type'])));
} elseif(isset($_SESSION['pa_ord']) && empty($_GET['pa_ord'])) {
	$_SESSION['pa_nexttype'] = $_SESSION['pa_type'];
}
if($_SESSION['pa_nexttype'] == "desc") {
	$_SESSION['pa_nexttype'] = "asc";
} else {
	$_SESSION['pa_nexttype'] = "desc";
} 
	
if(	$_SESSION['pa_type'] == "desc") {
	$_SESSION['pa_type_img'] = "<img src=\"images/arrow_up.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
} else {
	$_SESSION['pa_type_img'] = "<img src=\"images/arrow_down.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
}
$query = "SELECT DISTINCT id,title,current_bid,starts,ends,minimum_bid,duration,relist,relisted 
			FROM ".$DBPrefix."auctions au
			WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' 
				AND starts > '".$NOW."' 
				AND (suspended=0 OR suspended=-1)
			ORDER BY ".$_SESSION['pa_ord']." ". $_SESSION['pa_type'] ." LIMIT $OFFSET,$LIMIT";
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
	#//
	$query = "select count(bid) as count from ".$DBPrefix."bids where auction='".$item['id']."'";
	$res_ = @mysql_query($query);
	if(!$res_) {
		print "Error: $query<BR>".mysql_error();
		exit;
	} elseif(mysql_num_rows($res_) > 0) {
		$BIDS[] = mysql_result($res_,0,"count");
	}
}

#// Build durations array
$query = "select * from ".$DBPrefix."durations order by days";
$rd = mysql_query($query);
while($row = mysql_fetch_array($rd)) {
	$DURATIONS[$row['days']] = $row['description'];
}

include "header.php";
include phpa_include("template_yourauctions_p_php.html");
include "footer.php";

?>
