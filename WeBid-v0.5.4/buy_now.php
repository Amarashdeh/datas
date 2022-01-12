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

// Include messages file
// Connect to sql server & inizialize configuration variables
include './includes/config.inc.php';
include $include_path."membertypes.inc.php";
foreach($membertypes as $idm => $memtypearr) {
	$memtypesarr[$memtypearr['feedbacks']]=$memtypearr;
}

ksort($memtypesarr,SORT_NUMERIC);
$NOW = date("YmdHis",mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y")));
$query = "select * from ".$DBPrefix."auctions where id=".intval($_REQUEST['id']);
$result = mysql_query($query);
if (!$result) {
	MySQLError($query);
	exit;
}
if(mysql_result ( $result, 0, "closed" ) == '1') {
	header("Location: item.php?id=".$_REQUEST['id']);
	exit;
}
$user           = stripslashes(mysql_result ( $result, 0, "user" ));
$title          = stripslashes(mysql_result ( $result, 0, "title" ));
$buy_now_price  = mysql_result ( $result, 0, "buy_now" );
$reserve_price  = mysql_result ( $result, 0, "reserve_price" );
$category 	= mysql_result ( $result, 0, "category" );

#// If there are bids for this auction -> error
$query= "select max(bid) AS maxbid FROM ".$DBPrefix."proxybid WHERE itemid=".intval($_REQUEST['id']);
$res = @mysql_query($query);
$maxbid=mysql_result ( $res, 0, "maxbid" );
if ($maxbid>0 && $maxbid >= $reserve_price) {
	$ERR = "712";
}

require("header.php");

$TPL_seller = $user;
$TPL_title_value = $MGS_2__0025;
$TPL_title = $title;
$TPL_buy_now_price = print_money($buy_now_price);

/* get user's nick */
$query      = "select id,nick FROM ".$DBPrefix."users WHERE id=".intval($user);

$result_usr = mysql_query ( $query );
if ( !$result_usr ) {
	print $ERR_001;
	exit;
}

$user_nick			= mysql_result ( $result_usr, 0, "nick");
$user_id				= mysql_result ( $result_usr, 0, "id");
$TPL_user_nick_value = $user_nick;

/* Get current number of feedbacks */
$query          = "select rated_user_id FROM ".$DBPrefix."feedbacks WHERE rated_user_id=".intval($user_id);
$result         = mysql_query   ( $query );
$num_feedbacks  = mysql_num_rows ( $result );

/* Get current total rate value for user */
$query         = "select rate_sum FROM ".$DBPrefix."users WHERE nick='".addslashes($user_nick)."'";
$result        = mysql_query  ( $query );
if($result && mysql_num_rows($result) > 0)
$total_rate    = mysql_result ( $result, 0, "rate_sum" );

$TPL_vendetor_value = " <a href=\"profile.php?user_id=".$user_id."\"><b>".$TPL_user_nick_value."</b></a>";

$i=0;
foreach ($memtypesarr as $k=>$l) {
	if($k >= $total_rate || $i++==(count($memtypesarr)-1)) {
		$TPL_rate_radio="<img src=\"./images/icons/".$l['icon']."\" alt=\"".$l['icon']."\" />";
		break;
	}
}			
$TPL_num_feedbacks="<b>($total_rate)</b>";

if ($_GET['action'] == 'buy') {
	// check if nickname and password entered
	if ( strlen($_POST['nick'])==0 || strlen($_POST['password'])==0 )
	$ERR = "610";
	
	// check if nick is valid
	$query = "select * FROM ".$DBPrefix."users WHERE nick='".addslashes($_POST['nick'])."'";
	
	$result = mysql_query($query);
	
	$n = 0;
	if ($result) $n = mysql_num_rows($result);
	else $ERR = "001";
	
	if ($n==0) $ERR = "609";
	if($n > 0) {
		$bidder_id = mysql_result($result,0,"id");
		
		// check if password is correct
		$pwd = mysql_result($result,0,"password");
		if ($pwd != md5($MD5_PREFIX.$_POST['password'])) {
			$ERR = "611";
		} else {
			if(mysql_result($result,0,"suspended") > 0) {
				$ERR = "618";
			}
		}
	}
	// check if buyer is not the seller
	if ($_POST['nick'] == $user_nick) {
		$ERR = "711";
	}
	
	// perform final actions
	if ( isset($ERR) ) {
		$TPL_errmsg = ${"ERR_".$ERR};
	}

	if (empty($ERR)) {
		$query = "UPDATE ".$DBPrefix."auctions set starts=starts, ends='$NOW',num_bids=num_bids+1,current_bid=".doubleval($buy_now_price)." where id=".intval($_REQUEST['id']);
		$result = mysql_query($query);
		if (!$result) {
			MySQLError($query);
			exit;
		}
		$query = "INSERT INTO ".$DBPrefix."bids VALUES (NULL,
					".intval($_REQUEST['id']).", ".intval($bidder_id).", ".doubleval($buy_now_price).", '$NOW', 0)";
		$result = mysql_query($query);
		if (!$result)
		{
			MySQLError($query);
			exit;
		}
		$query = "update ".$DBPrefix."counters set bids = (bids+1)";
		$result = mysql_query($query);
		if (!$result) {
			MySQLError($query);
			exit;
		}
		
		include ("cron.php");
		$buy_done = 1;
	}
}
include phpa_include("template_buy_now_php.html");
require("./footer.php"); 
?>