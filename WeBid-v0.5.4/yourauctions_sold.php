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

//-- Genetares the temporary AUCTION's unique ID -----------------------------------------------
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

#// Delete entries for closed auctions not edited in this sesion
//@mysql_query("DELETE FROM ".$DBPrefix."tmp_closed_edited WHERE session<>'".session_id()."' AND seller='".$_SESSION['PHPAUCTION_LOGGED_IN']."'");

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
      @mysql_query("DELETE FROM ".$DBPrefix."auccounter WHERE auction_id='$v'");
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
}

/**
* NOTE: Retrieve closed auction data from the database
*/
$res=mysql_query("SELECT a.*  FROM ".$DBPrefix."auctions a, ".$DBPrefix."winners w
    WHERE a.user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' 
    AND a.closed=1 
    AND a.suspended<>8
    AND a.id=w.auction
    GROUP BY w.auction");
if(mysql_num_rows($res)>0)  $TOTALAUCTIONS = mysql_num_rows($res);
else $TOTALAUCTIONS=0;

if(!isset($PAGE) || $PAGE <= 1 || $PAGE == "") {
  $OFFSET = 0;
  $PAGE = 1;
} else {
  $OFFSET = ( $PAGE - 1) * $LIMIT;
}
$PAGES = ceil($TOTALAUCTIONS / $LIMIT);
if(!$PAGES) $PAGES = 1;
# Handle columns sorting variables
if(!isset($_SESSION['solda_ord']) && empty($_GET['solda_ord'])) {
  $_SESSION['solda_ord'] = "title";
  $_SESSION['solda_type'] = "asc";
} elseif(!empty($_GET['solda_ord'])) {
  $_SESSION['solda_ord'] = str_replace('..','',addslashes(htmlspecialchars($_GET['solda_ord'])));
  $_SESSION['solda_type'] = str_replace('..','',addslashes(htmlspecialchars($_GET['solda_type'])));
} elseif(isset($_SESSION['solda_ord']) && empty($_GET['solda_ord'])) {
  $_SESSION['solda_nexttype'] = $_SESSION['solda_type'];
}
if(  $_SESSION['solda_nexttype'] == "desc") {
  $_SESSION['solda_nexttype'] = "asc";
} else {
  $_SESSION['solda_nexttype'] = "desc";
}
if(  $_SESSION['solda_type'] == "desc") {
  $_SESSION['solda_type_img'] = "<img src=\"images/arrow_up.gif\" align=\"center\" hspace=\"2\" border=\"0\" alt=\"up\"/>";
} else {
  $_SESSION['solda_type_img'] = "<img src=\"images/arrow_down.gif\" align=\"center\" hspace=\"2\" border=\"0\" alt=\"down\"/>";
}

$query = "SELECT a.* FROM ".$DBPrefix."auctions a, ".$DBPrefix."winners w
    WHERE a.user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' 
    AND a.closed=1 
    AND a.suspended<>8
    AND a.id=w.auction
    GROUP BY w.auction
    ORDER BY ".$_SESSION['solda_ord']." ". $_SESSION['solda_type'] ." LIMIT $OFFSET,$LIMIT";
$res = mysql_query($query);
if(!$res) {
  print "Error: $query<br>".mysql_error();
  exit;
}

$C_IDS = array();
$C_TITLE = array();
$C_DURATION = array();
$C_ENDS = array();
$C_STARTS = array();
$C_STARTINGBID = array();
$C_BID = array();
$C_OK = array();
$C_BIDS = array();


#//Built array
while($item = mysql_fetch_array($res)) {
  $C_IDS[] = $item[0];
  $C_TITLE[] = stripslashes($item['title']);
  $C_DURATION[] = $item['duration'];
  $C_CLOSED[] = $item['closed'];
  
  #$ends = substr($item['ends'],6,2)."/".substr($item['ends'],4,2)."/".substr($item['ends'],0,4);
  $ends = $item['ends'];
  $C_ENDS[] = $ends;
  
  #$starts = substr($item['starts'],6,2)."/".substr($item['starts'],4,2)."/".substr($item['starts'],0,4);
  $starts = $item['starts'];
  $C_STARTS[] = $starts;
  $C_STARTINGBID[] = $item['minimum_bid'];
  $C_BID[] = $item['current_bid'];
  $current = $item['current_bid'];
  $reserve = $item['reserve_price'];
  $auction_type = $item['auction_type'];
  if($auction_type == 2){
    $C_OK[] = "1";
  }
  if(($reserve-$current) > 0)  {
    $C_OK[] = "1";
  } else {
    $C_OK[] = "0";
  }
  $C_BIDS[]      = $item['num_bids'];
  
}

#// Build durations array
$query = "select * from ".$DBPrefix."durations order by days";
$rd = mysql_query($query);
while($row = mysql_fetch_array($rd)) {
  $DURATIONS[$row['days']] = $row['description'];
}

include "header.php";
include phpa_include("template_yourauctions_sold_php.html");
include "footer.php";

?>