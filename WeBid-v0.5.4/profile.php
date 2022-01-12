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
include "header.php";
include $include_path."membertypes.inc.php";
foreach($membertypes as $idm => $memtypearr) {
  $memtypesarr[$memtypearr['feedbacks']]=$memtypearr;
}
ksort($memtypesarr,SORT_NUMERIC);

if (!isset($_REQUEST['auction_id'])) {
  $_GET['auction_id'] = $_SESSION["CURRENT_ITEM"];
} else {
  $_SESSION["CURRENT_ITEM"]=intval($_REQUEST['auction_id']);
}

if ( empty($_GET["user_id"]) )  $_GET["user_id"] = $_GET['user_id'];

if (!empty($_GET["user_id"])) {
  $sql="SELECT id FROM ".$DBPrefix."users WHERE nick=\"".AddSlashes($_GET["user_id"])."\"";
  $res=mysql_query ($sql);
  $arr=mysql_fetch_array ($res);
  $TPL_user_id=$arr['id'];
}
if (!empty($_GET["user_id"])) {
  $TPL_user_id=$_GET["user_id"];
}

$sql="SELECT * FROM ".$DBPrefix."users WHERE id=".intval($_GET["user_id"]);
$res=mysql_query($sql);
if ($res) {
  if ($arr=mysql_fetch_array($res)) {
    $TPL_num_feedbacks    =$arr['rate_num'];
    $TPL_feedback_rate    =$arr['rate_sum'];
    $TPL_user_value      =$arr['nick'];
    if($arr['trusted'] == 'y'){
      $TPL_user_trusted = "&nbsp;<IMG SRC=\"images/trusted.gif\">";
    }else{
      $TPL_user_trusted = "";
    }
    $i=0;
    $TPL_rate_ratio_value  ="";
    foreach ($memtypesarr as $k=>$l) {
      if($k >= $arr['rate_sum'] || $i++==(count($memtypesarr)-1)) {
        $TPL_rate_ratio_value="<img src=\"./images/icons/".$l['icon']."\" alt=\"".$l['icon']."\" />";
        break;
      }
    }
    $sql="SELECT max(rate) as ratename,count(rate) as ratesum FROM ".$DBPrefix."feedbacks WHERE rated_user_id=".intval($TPL_user_id)."
        GROUP BY rate";
    if(($res_=mysql_query($sql)) && (mysql_num_rows($res_)>0)) {
      while ($ratesum=mysql_fetch_array($res_)) {
        $TPL_rate_ratesum[$ratesum['ratename']]=$ratesum['ratesum'];
      }
      ksort($TPL_rate_ratesum,SORT_NUMERIC);
    }
    $tmp_date=$arr['reg_date'];
    if (mysql_get_client_info() < 4.1 || !strstr($tmp_date,"-")){
      $day = intval(substr($tmp_date,6,2));
      $month = intval(substr($tmp_date,4,2));
      $year = intval(substr($tmp_date,0,4));
    }else{
      $day = intval(substr($tmp_date,8,2));
      $month = intval(substr($tmp_date,5,2));
      $year = intval(substr($tmp_date,0,4));
      $hour=intval(substr($tmp_date,11,2));
      $min=intval(substr($tmp_date,14,2));
    }
    $TPL_ADC_value = ArrangeDateNoCorrection($day,$month,$year,$hour,$min);

    $sql="SELECT * FROM ".$DBPrefix."winners WHERE auction=".intval($_GET['auction_id'])." AND winner=".$_SESSION["PHPAUCTION_LOGGED_IN"]." AND seller=".intval($_GET["user_id"]);
    $res=mysql_query($sql);

    if ($res && mysql_num_rows($res) > 0) {
      $should_feedback = TRUE;
    } else {
      $should_feedback = FALSE;
    }

  } else {
    $TPL_err=1;
    $TPL_errmsg="Such users wasn't found in database";
  }
} else {
  $TPL_err=1;
  $TPL_errmsg="Error quering database";
}
include phpa_include("template_profile_php.html");
include "./footer.php";
?>

