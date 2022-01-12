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
include $include_path."dates.inc.php";
include $include_path."membertypes.inc.php";
foreach($membertypes as $idm => $memtypearr) {
  $memtypesarr[$memtypearr['feedbacks']]=$memtypearr;
}
ksort($memtypesarr,SORT_NUMERIC);

if (($_SERVER["REQUEST_METHOD"]=="GET" || !$_SERVER["REQUEST_METHOD"])) {
  $secid = $_SESSION['PHPAUCTION_LOGGED_IN'];
  $TPL_rater_nick=$_SESSION['PHPAUCTION_LOGGED_IN_USERNAME'];
  $sql="SELECT nick, rate_sum, rate_num FROM ".$DBPrefix."users WHERE id=".intval($secid);
  $res=mysql_query ($sql);
  if ($res) {
    if (mysql_num_rows($res)>0) {
      $arr=mysql_fetch_array ($res);
      $TPL_nick=$arr['nick'];
      $i=0;
      foreach ($memtypesarr as $k=>$l) {
        if($k >= $arr['rate_sum'] || $i++==(count($memtypesarr)-1)) {
          $TPL_rate_ratio_value="<img src=\"./images/icons/".$l['icon']."\" alt=\"".$l['icon']."\" />";
          break;
        }
      }
      $TPL_feedbacks_num=$arr['rate_num'];
      $TPL_feedbacks_sum=$arr['rate_sum'];
    } else {
      $TPL_err=1;
      $TPL_errmsg="$ERR_105";
    }
  } else {
    $TPL_err=1;
    $TPL_errmsg="$ERR_106";
  }

  if ($_GET[pg]==0)  $pg = 1;
  $lines = (int)$lines;
  if ($lines==0)  $lines = 5;
  $left_limit = ($_GET[pg]-1)*$lines;
  $rsl = mysql_query ( "SELECT count(*) FROM ".$DBPrefix."feedbacks WHERE rated_user_id=".intval($secid));
  if ($rsl) {
    $hash = mysql_fetch_array($rsl);
    $total = (int)$hash[0];
  } else $total = 0;
  $TPL_feedbacks_num=$total;
  
  /* get number of pages */
  $pages = ceil($total/$lines);
  
  $left_limit = ($left_limit < 0) ? 0 : $left_limit;
  
  $sql="SELECT f.*,a.title FROM ".$DBPrefix."feedbacks f
      LEFT OUTER JOIN ".$DBPrefix."auctions a
      ON a.id=f.auction_id
      WHERE rated_user_id='$secid' 
      ORDER by feedbackdate DESC 
      LIMIT $left_limit,$lines";
  $res=mysql_query ($sql) or die(mysql_error().$sql);
  $i=0;
  $feed_disp=array();
  while ($arrfeed = mysql_fetch_array($res)) {
    $feed_disp[$i]["username"]=$arrfeed['rater_user_nick'];
    $feed_disp[$i]["auctionurl"]=(($arrfeed['title']) ? "<a href='item.php?id=".$arrfeed['auction_id']."'>".$arrfeed['title']."</a>":$MSG_113.$arrfeed['auction_id']);
    $feed_disp[$i]["feedback"]=nl2br(stripslashes($arrfeed['feedback']));
    $feed_disp[$i]["rate"]=$arrfeed['rate'];
    $feed_disp[$i]["feedbackdate"] = FormatDate($arrfeed['feedbackdate']);    
    $sql="SELECT id,rate_num,rate_sum FROM ".$DBPrefix."users WHERE nick='".$feed_disp[$i]["username"]."'";
    $usarr=mysql_fetch_array(mysql_query ($sql));
    $feed_disp[$i]['usfeed']=$usarr['rate_sum'];
    $feed_disp[$i]['usflink']="profile.php?user_id=".$usarr['id']."&auction_id=".$arrfeed['auction_id'];
    $j=0;
    foreach ($memtypesarr as $k=>$l) {
      if($k >= $usarr['rate_sum'] || $j++==(count($memtypesarr)-1)) {
        $feed_disp[$i]['usicon']="<img src=\"./images/icons/".$l['icon']."\" alt=\"".$l['icon']."\" />";
        break;
      }
    }
    switch($feed_disp[$i]['rate']) {
      case 1 : $feed_disp[$i]['img']="./images/positive.gif";
      break;
      case -1: $feed_disp[$i]['img']="./images/negative.gif";
          $sql="SELECT * FROM ".$DBPrefix."feedforum WHERE feed_id=".$arrfeed['id']." ORDER BY seqnum ASC";
          $res_=@mysql_query ($sql);
          if($res_ && mysql_num_rows($res_)>0) {
            while($feedfor=mysql_fetch_array($res_)) {
              $feedfor["commentdate"] = FormatDate($feedfor['commentdate']);    
              $feedfor['username']=($feedfor['user_id']==$secid) ? $TPL_nick : $arrfeed['rater_user_nick']; 
              $feedfor['comment']=nl2br(strip_tags(stripslashes(($feedfor['comment'])))); 
              $feed_disp[$i]['feedforum'][$feedfor['seqnum']]=$feedfor;
            }
            $nextfeedlink=end($feed_disp[$i]['feedforum']);
            if((($_SESSION['PHPAUCTION_LOGGED_IN']==$arrfeed['rated_user_id'] && $nextfeedlink['user_id']==$usarr['id'])
              || ($_SESSION['PHPAUCTION_LOGGED_IN']==$usarr['id'] && $nextfeedlink['user_id']==$arrfeed['rated_user_id'])) && $nextfeedlink['seqnum']<2)
              $feed_disp[$i]['nextfeedforum']="<a href='addfeedforum.php?feed_id=".$nextfeedlink['feed_id']."&seqnum=".$nextfeedlink['seqnum']."'>".$MSG_25_0201."</a>";
            else
              $feed_disp[$i]['nextfeedforum']="";
          } else {
            if($_SESSION['PHPAUCTION_LOGGED_IN']==$arrfeed['rated_user_id'])
              $feed_disp[$i]['nextfeedforum']="<a href='addfeedforum.php?feed_id=".$arrfeed['id']."&seqnum=0'>".$MSG_25_0201."</a>";
            else
              $feed_disp[$i]['nextfeedforum']="";
          }
          break;
      case 0 : $feed_disp[$i]['img']="./images/neutral.gif";
      break;
    }
    $i++;    
  }
  $echofeed="";
  for ($ind2=1; $ind2<=$pages; $ind2++) {
    if ($_GET[pg]!=$ind2) {
      $echofeed .="<a href=\"yourfeedback.php?pg=$ind2\">
                       $ind2</a>";
      if($ind2 != $pages) {
        $echofeed .= " | ";
      }
      
    } else {
      $echofeed .="$ind2";
      if($ind2 != $pages){
        $echofeed .= " | ";
      }
    }
  }
  $echofeed.="";
}

// Calls the appropriate templates

  include "header.php";
  include phpa_include("template_yourfeedback_php.html");
  include "footer.php";
?>
