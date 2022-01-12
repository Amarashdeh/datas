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
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"]))
{
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
	
	if(is_array($_POST['closenow'])) {
		while(list($k,$v) = each($_POST['closenow'])) {
			#// Update end time to "now"
			@mysql_query("UPDATE ".$DBPrefix."auctions SET ends='".$NOW."' WHERE id='$v'");
		}
		
		include "closeauctions.php";
	}
}
#// ############################################################################################

if($_POST['action'] == "sell")
{
	#// Delete auction
	if(is_array($_POST['delete'])) {
		while(list($k,$v) = each($_POST['delete'])) {
			
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
			
			#// Auction
			$query = "DELETE FROM ".$DBPrefix."auctions WHERE id='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
		}
	}
}

#// relist selected auction (if any)
if($_POST['action'] == "update")
{
	#// Delete auction
	if(is_array($_POST['delete'])) {
		while(list($k,$v) = each($_POST['delete'])) {	
			#// Pictures Gallery
			if(file_exists($image_upload_path."$v")) {
				if($dir = @opendir($image_upload_path."$v")) {
					while($file = readdir($dir)) {
						if($file != "." && $file != "..") {
							unlink($image_upload_path."$v/".$file);
						}
					}
					closedir($dir);
					
					@rmdir($image_upload_path."/$v");
				}
			}
			
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
			
			#//
			$query = "UPDATE ".$DBPrefix."counters SET closedauctions=(closedauctions-1)";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			
			#//
			$query = "DELETE FROM ".$DBPrefix."auctions WHERE id='$v'";
			$res = @mysql_query($query);
			if(!res) {
				MySQLError($query);
				exit;
			}
			
			#// Bids
			$decremsql = mysql_query("select * FROM ".$DBPrefix."bids WHERE auction='$v'");
			$decrem=mysql_num_rows($decremsql);
			$query = "DELETE FROM ".$DBPrefix."bids WHERE auction='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			#// Proxy Bids
			$query = "DELETE FROM ".$DBPrefix."proxybid WHERE itemid='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}			
		}
	}
	
	#// Re-list auctions
	if(is_array($_POST['relist'])) {
		while(list($k,$v) = each($relist)) {
			#//
			$TODAY = date("YmdHis",$TIME);
			// auction ends
			$WILLEND = $TIME + $duration[$k] * 24 * 60 * 60;
			$WILLEND = date("YmdHis", $WILLEND);
			$current_bid=input_money(0.00);
			$query = "update ".$DBPrefix."auctions set starts='$TODAY',
											  ends='$WILLEND',
											  duration=$duration[$k],
											  current_bid=$current_bid,
											  closed=0
											  where id='$k'";
			$res = mysql_query($query);
			//print $query;
			if(!$res) {
				MySQLError($query);
				exit;
			}
			#// Bids
			$decremsql = mysql_query("select * FROM ".$DBPrefix."bids WHERE auction='$v'");
			$decrem=mysql_num_rows($decremsql);
			$query = "DELETE FROM ".$DBPrefix."bids WHERE auction='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			
			#// Proxy Bids
			$query = "DELETE FROM ".$DBPrefix."proxybid WHERE itemid='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			
			#// Winners
			$query = "DELETE FROM ".$DBPrefix."winners WHERE auction='$v'";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			}
			#// Unset EDITED_AUCTIONS array (set in edit_auction.php)
			unset($_SESSION["EDITED_AUCTIONS"]);
			
			//-- Update COUNTERS table
			echo 'wot';
			$query = "update ".$DBPrefix."counters set auctions=(auctions+1),closedauctions=(closedauctions-1) ";
			$RR = mysql_query($query);
			if(!$RR) {
				print "Error: $query<BR>".mysql_error();
				exit;
			}
			
			#// Get category
			$query = "select category from ".$DBPrefix."auctions where id='$v'";
			$RRR = mysql_query($query);
			$CATEGORY = mysql_result($RRR,0,"category");
			
			#// and increase category counters
			$ct = $CATEGORY;
			$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$ct"));
			$counter = $row['counter']+1;
			$subcoun = $row['sub_counter']+1;
			$parent_id = $row['parent_id'];
			mysql_query("UPDATE ".$DBPrefix."categories SET counter=$counter, sub_counter=$subcoun WHERE cat_id=$ct");
			
			// update recursive categories
			while ( $parent_id!=0 ) {
				// update this parent's subcounter
				$rw = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$parent_id"));
				$subcoun = $rw['sub_counter']+1;
				mysql_query("UPDATE ".$DBPrefix."categories SET sub_counter=$subcoun WHERE cat_id=$parent_id");
				// get next parent
				$parent_id = intval($rw['parent_id']);
			}			
		}
	}
}

#// Retrieve active auctions from the database
$TOTALAUCTIONS = mysql_result(mysql_query("select count(id) as COUNT from ".$DBPrefix."auctions where user=".$_SESSION['PHPAUCTION_LOGGED_IN']." and suspended<>0"),0,"COUNT");

if(!isset($PAGE) || $PAGE == 1) {
	$OFFSET = 0;
	$PAGE = 1;
} else {
	$OFFSET = ( $PAGE - 1) * $LIMIT;
}
$PAGES = ceil($TOTALAUCTIONS / $LIMIT);
if(!$PAGES) $PAGES = 1;
$_SESSION['backtolist_page'] = $PAGE;
$_SESSION['backtolist'] = 'yourauctions_s.php';

# Handle columns sorting variables
if(!isset($_SESSION['sa_ord']) && empty($_GET['sa_ord'])) {
	$_SESSION['sa_ord'] = "title";
	$_SESSION['sa_type'] = "asc";
} elseif(!empty($_GET['sa_ord'])) {
	$_SESSION['sa_ord'] = str_replace('..','',addslashes(htmlspecialchars($_GET['sa_ord'])));
	$_SESSION['sa_type'] = str_replace('..','',addslashes(htmlspecialchars($_GET['sa_type'])));
} elseif(isset($_SESSION['sa_ord']) && empty($_GET['sa_ord'])) {
	$_SESSION['sa_nexttype'] = $_SESSION['sa_type'];
}
if(	$_SESSION['sa_nexttype'] == "desc") {
	$_SESSION['sa_nexttype'] = "asc";
} else {
	$_SESSION['sa_nexttype'] = "desc";
}
if(	$_SESSION['sa_type'] == "desc") {
	$_SESSION['sa_type_img'] = "<img src=\"images/arrow_up.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
} else {
	$_SESSION['sa_type_img'] = "<img src=\"images/arrow_down.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
}

$query = "SELECT id,title,current_bid,starts,ends,minimum_bid,duration,relist,relisted 
			FROM ".$DBPrefix."auctions 
			WHERE user=".$_SESSION['PHPAUCTION_LOGGED_IN']." 
			AND suspended<>0 order by ".$_SESSION['sa_ord']." ". $_SESSION['sa_type'] ."
			LIMIT $OFFSET,$LIMIT";
//print $query;
$res = mysql_query($query);
if(!$res) {
	print "Error: $query<br>".mysql_error();
	exit;
}
//print $query;
unset($BIDS);

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
	
	#$ends = substr($item[ends],6,2)."/".substr($item[ends],4,2)."/".substr($item[ends],0,4);
	$ENDS[] = $item['ends'];
	
	#$starts 		= substr($item[starts],6,2)."/".substr($item[starts],4,2)."/".substr($item[starts],0,4);
	$STARTS[] 		= $item['starts'];
	$STARTINGBID[] 	= $item['minimum_bid'];
	$BID[]	 		= $item['current_bid'];
	$BIDS[]  		= $item['num_bids'];
}

#// Build durations array
$query = "select * from ".$DBPrefix."durations order by days";
$rd = mysql_query($query);
while($row = mysql_fetch_array($rd)) {
	$DURATIONS[$row['days']] = $row['description'];
}

include "header.php";
include phpa_include("template_yourauctions_s_php.html");
include "footer.php";

?>