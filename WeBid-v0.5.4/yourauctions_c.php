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

//-- Genetares the AUCTION's unique ID -----------------------------------------------
function generate_id() {
  global $title, $description;
  $continue = true;
  
  $auction_id = md5(uniqid(rand()));
  
  return $auction_id;
}
#// ---------------------------------------------------------------------------------

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
  Header("Location: user_login.php");
  exit;
}

#// ADDED BY GIAN sept. 15
#// DELETE OPEN AUCTIONS
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);

#// Update
if($_POST['action'] == "update") {
  #// Delete auction
  if(is_array($_POST['delete'])) {
    while(list($k,$v) = each($_POST['delete'])) {
      $v = str_replace('..','',htmlspecialchars($v));
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
      $query = "SELECT photo_uploaded,pict_url FROM ".$DBPrefix."auctions where id=".intval($v);
      $res_ = @mysql_query($query);
      if(!$res_) {
        MySQLError($query);
        exit;
      }
      if(mysql_num_rows($res_)>0) {
        $pict_url = mysql_result($res_,0,"pict_url");
        $photo_uploaded = mysql_result($res_,0,"photo_uploaded");
        #// Uploaded picture
        if($photo_uploaded)  {
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
      @mysql_query("DELETE FROM ".$DBPrefix."auctioninvitedlists WHERE auction_id=".intval($v));
      @mysql_query("DELETE FROM ".$DBPrefix."auctionblacklists WHERE auction_id=".intval($v));
      @mysql_query("DELETE FROM ".$DBPrefix."auccounter WHERE auction_id=".intval($v));
      $query = "DELETE FROM ".$DBPrefix."auctions WHERE id=".intval($v);
      $res = @mysql_query($query);
      if(!res) {
        MySQLError($query);
        exit;
      }
      
      #// Bids
      $decremsql = mysql_query("select * FROM ".$DBPrefix."bids WHERE auction=".intval($v));
      $decrem=mysql_num_rows($decremsql);
      $query = "DELETE FROM ".$DBPrefix."bids WHERE auction=".intval($v);
      $res = @mysql_query($query);
      if(!$res) {
        MySQLError($query);
        exit;
      }
      #// Proxy Bids
      $query = "DELETE FROM ".$DBPrefix."proxybid WHERE itemid=".intval($v);
      $res = @mysql_query($query);
      if(!$res) {
        MySQLError($query);
        exit;
      }
    }
  }
  if(is_array($_POST['sell'])) {
    while(list($k,$v) = each($sell)) {
      @mysql_query("UPDATE ".$DBPrefix."auctions set sold='s' WHERE id=".intval($k));
    }
    include('cron.php');
  }
  /**
  * NOTE: Re-list auctions
  */
  if(is_array($_POST['relist'])) {
    unset($TOTALFEES);
    unset($RELISTED_TITLE);
    while(list($k,$v) = each($_POST['relist'])) {
      $AUCTION = @mysql_fetch_array(@mysql_query("SELECT * FROM ".$DBPrefix."auctions WHERE id=".intval($k)));
      
      $NEWID = generate_id();
      #//
      $TODAY = $NOW;
      // auction ends
      $WILLEND = $TIME + $_POST[duration][$k] * 24 * 60 * 60;
      $WILLEND = date("YmdHis", $WILLEND);
      
      $query = "UPDATE ".$DBPrefix."auctions 
                  set starts= '".$TODAY."',
                  ends= '".$WILLEND."',
                  duration= '".$_POST[duration][$k]."',
                  closed='0',
                  num_bids=0,
                  relisted=0,
                  current_bid=0,
                  sold='n'
                  WHERE id=$k";
      $res = mysql_query($query);
      //print $query; exit;
      if(!$res) {
        MySQLError($query);
        exit;
      }
      $NEWID=$k;
      /*
      * NOTE: Insert into relisted table
      */
      $query = "INSERT INTO ".$DBPrefix."closedrelisted VALUES(
             '$k',
             '".$NOWB."',
             '$NEWID')";
      $r_relisted = @mysql_query($query);
      if(!$r_relisted) {
        MySQLError($query);
        exit;
      }
      $query = "DELETE FROM ".$DBPrefix."bids WHERE auction='$k'";
      $res = @mysql_query($query);
      if(!$res) {
        MySQLError($query);
        exit;
      }
      #// Proxy Bids
      $query = "DELETE FROM ".$DBPrefix."proxybid WHERE itemid='$k'";
      $res = @mysql_query($query);
      if(!$res) {
        MySQLError($query);
        exit;
      }
      #// Winners: only in case of reserve not reached
      $query = "DELETE FROM ".$DBPrefix."winners WHERE auction='$k'";
      $res = @mysql_query($query);
      if(!$res) {
        MySQLError($query);
        exit;
      }

      #// Unset EDITED_AUCTIONS array (set in edit_auction.php)
      unset($_SESSION["EDITED_AUCTIONS"]);
      
      //-- Update COUNTERS table
      $query = "update ".$DBPrefix."counters set auctions=(auctions+1) ";
      $RR = mysql_query($query);
      if(!$RR) {
        print "Error: $query<BR>".mysql_error();
        exit;
      }
      
      #// Get category
      $CATEGORY = $AUCTION['category'];
      
      #// and increase category counters
      $ct = $CATEGORY;
      $row = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$ct"));
      $feesfree=$row['feesfree'];
      $counter = $row['counter']+1;
      $subcoun = $row['sub_counter']+1;
      $parent_id = $row['parent_id'];
      mysql_query("UPDATE ".$DBPrefix."categories SET counter=$counter, sub_counter=$subcoun WHERE cat_id=$ct");
      
      // update recursive categories
      while ( $parent_id!=0 )  {
        // update this parent's subcounter
        $rw = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$parent_id"));
        $feesfree=($rw['feesfree']=='y') ? 'y' : $feesfree;
        $subcoun = $rw['sub_counter']+1;
        mysql_query("UPDATE ".$DBPrefix."categories SET sub_counter=$subcoun WHERE cat_id=$parent_id");
        // get next parent
        $parent_id = intval($rw['parent_id']);
      }
    
      $RELISTED_TITLE[$AUCTION['id']] = $AUCTION['title'];
      unset($_SESSION['CLOSED_EDITED']);
    }
  }
}


/**
* NOTE: Retrieve closed auction data from the database
*/
$TOTALAUCTIONS = mysql_result(mysql_query("select count(id) as COUNT from ".$DBPrefix."auctions where user='".$_SESSION['PHPAUCTION_LOGGED_IN']."'
  AND closed=1 AND suspended<>8
  AND (num_bids=0 OR (num_bids>0 AND current_bid < reserve_price AND sold='n'))"),0,"COUNT");

if(!isset($_GET["PAGE"]) || $_GET["PAGE"] == 1) {
  $OFFSET = 0;
  $PAGE = 1;
} else {
  $PAGE = $_GET["PAGE"];
  $OFFSET = ($PAGE - 1) * $LIMIT;
}
$PAGES = ceil($TOTALAUCTIONS / $LIMIT);
if(!$PAGES) $PAGES = 1;
$_SESSION['backtolist_page'] = $PAGE;
# Handle columns sorting variables
if(!isset($_SESSION['ca_ord']) && empty($_GET['ca_ord'])) {
  $_SESSION['ca_ord'] = "title";
  $_SESSION['ca_type'] = "asc";
} elseif(!empty($_GET['ca_ord'])) {
  $_SESSION['ca_ord'] = str_replace('..','',addslashes(htmlspecialchars($_GET['ca_ord'])));
  $_SESSION['ca_type'] = str_replace('..','',addslashes(htmlspecialchars($_GET['ca_type'])));
} elseif(isset($_SESSION['ca_ord']) && empty($_GET['ca_ord'])) {
  $_SESSION['ca_nexttype'] = $_SESSION['ca_type'];
}
if(  $_SESSION['ca_nexttype'] == "desc") {
  $_SESSION['ca_nexttype'] = "asc";
} else {
  $_SESSION['ca_nexttype'] = "desc";
}
if(  $_SESSION['ca_type'] == "desc") {
  $_SESSION['ca_type_img'] = "<img src=\"images/arrow_up.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
} else {
  $_SESSION['ca_type_img'] = "<img src=\"images/arrow_down.gif\" align=\"center\" hspace=\"2\" border=\"0\" />";
}

$query = "SELECT *  FROM ".$DBPrefix."auctions
    WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' 
    AND closed=1 
    AND suspended<>8
    AND (num_bids=0 
      OR (num_bids>0 
        AND reserve_price > 0 
        AND current_bid < reserve_price 
        AND sold='n')) 
    ORDER BY ".$_SESSION['ca_ord']." ". $_SESSION['ca_type'] ." LIMIT $OFFSET,$LIMIT";
$res = mysql_query($query);
if(!$res) {
  print "Error: $query<BR>".mysql_error();
  exit;
}

$C_IDS = array();
$C_TITLE = array();
$C_DURATION = array();
$C_RELIST = array();
$C_RELISTED = array();
$C_ENDS = array();
$C_STARTS = array();
$C_STARTINGBID = array();
$C_BID = array();
$C_BIDS = array();
$C_OK = array();
$S_OK = array();

/**
* NOTE: Number of times auction has been relisted
*/
$query = "SELECT COUNT(auction) as COUNTER FROM ".$DBPrefix."closedrelisted WHERE auction='".$item['id']."'";
$R_ = @mysql_query($query);
if(!$R_) {
  MySQLError($query);
  exit;
} elseif(mysql_num_rows($R_) > 0) {
  $RELISTED[] = mysql_result($R_,0,"COUNTER");
}

#//Built array
while($item = mysql_fetch_array($res)) {
  $C_IDS[] = $item['id'];
  $C_TITLE[] = stripslashes($item['title']);
  $C_DURATION[] = $item['duration'];
  $C_RELIST[] = $item['relist'];
  $C_RELISTED[] = $item['relisted'];
  
  #$ends = substr($item['ends'],6,2)."/".substr($item['ends'],4,2)."/".substr($item['ends'],0,4);
  $ends = $item['ends'];
  $C_ENDS[] = $ends;
  
  #$starts = substr($item['starts'],6,2)."/".substr($item['starts'],4,2)."/".substr($item['starts'],0,4);
  $starts = $item['starts'];
  $C_STARTS[] = $starts;
  $C_STARTINGBID[] = $item['minimum_bid'];
  $C_BID[] = $item['current_bid'];
  $C_BIDS[]      = $item['num_bids'];
  if($item['auction_type'] == 2){
    $C_OK[] = "1";
  }
  if(($item['current_bid']-$item['reserve_price']) > 0)  {
    $C_OK[] = "1";
    $S_OK[] = "0";
  } else {
    $C_OK[] = "0";
    if($item['reserve_price'] > 0 && $item['num_bids']>0) $S_OK[] = "1";
    else $S_OK[] = "0";
  }
  
  /**
  * NOTE: Number of times auction has been relisted
  */
  $query = "SELECT COUNT(auction) as COUNTER FROM ".$DBPrefix."closedrelisted WHERE auction='".$item['id']."'";
  $R_ = @mysql_query($query);
  if(!$R_) {
    MySQLError($query);
    exit;
  } elseif(mysql_num_rows($R_) > 0) {
    $RELISTED[] = mysql_result($R_,0,"COUNTER");
  }
}

#// Build durations array
$query = "select * from ".$DBPrefix."durations order by days";
$rd = mysql_query($query);
while($row = mysql_fetch_array($rd)) {
  $DURATIONS[$row['days']] = $row['description'];
}

include "header.php";
include phpa_include("template_yourauctions_c_php.html");
include "footer.php";

?>