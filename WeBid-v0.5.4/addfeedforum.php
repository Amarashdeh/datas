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
include $include_path."messages.inc.php";
include $include_path."dates.inc.php";
include $include_path."html.inc.php";
include $include_path.'wordfilter.inc.php';
include $include_path."membertypes.inc.php";
foreach($membertypes as $idm => $memtypearr) {
	$memtypesarr[$memtypearr['feedbacks']]=$memtypearr;
}
ksort($memtypesarr,SORT_NUMERIC);

#// ################################################
#// Is the seller logged in and it's defined feedback id ?
#// ################################################

if(empty($_REQUEST['feed_id'])  || !isset($_SESSION['PHPAUCTION_LOGGED_IN'])) {
	Header("Location: index.php");
	exit;
}

$sql="SELECT f.*,u.nick,a.title
		FROM ".$DBPrefix."feedbacks f,
		".$DBPrefix."users u
		LEFT OUTER JOIN ".$DBPrefix."auctions a
		ON a.id=f.auction_id
		WHERE u.id=f.rated_user_id
		AND f.id=".intval($feed_id);
$res=mysql_query ($sql);
if($res && mysql_num_rows($res)>0) {
	$arrfeed=mysql_fetch_array($res);
}
$feed_disp["username"]=$arrfeed['rater_user_nick'];
$feed_disp["auctionurl"]=(($arrfeed['title']) ? "<A HREF='item.php7id=".$arrfeed['auction_id']."'>".$arrfeed['title']."</A>":$MSG_113.$arrfeed['auction_id']);
$feed_disp["feedback"]=nl2br(stripslashes($arrfeed['feedback']));
$feed_disp["rate"]=$arrfeed['rate'];
$feed_disp["feedbackdate"] = FormatDate($arrfeed['feedbackdate']);
$feed_disp['img']="./images/negative.gif";
$sql="SELECT id,rate_num,rate_sum FROM ".$DBPrefix."users WHERE nick='".$feed_disp["username"]."'";
$usarr=mysql_fetch_array(mysql_query ($sql));
$feed_disp['usfeed']=$usarr['rate_sum'];
$feed_disp['usflink']="profile.php?id=".$usarr['id']."&auction_id=".$arrfeed['auction_id'];
$j=0;
foreach ($memtypesarr as $k=>$l) {
	if($k >= $usarr['rate_sum'] || $j++==(count($memtypesarr)-1)) {
		$feed_disp['usicon']="<IMG src=\"./images/icons/".$l['icon']."\">";
		break;
	}
}
$sql="SELECT * FROM ".$DBPrefix."feedforum WHERE feed_id=".intval($_REQUEST['feed_id'])." ORDER BY seqnum ASC";
$res_=@mysql_query($sql);
if($res_ && mysql_num_rows($res_)>0) {
	while($feedfor=mysql_fetch_array($res_)) {
		$feedfor["commentdate"] = FormatDate($feedfor['commentdate']);		
		$feedfor['username']=($feedfor['user_id']==$arrfeed['rated_user_id']) ? $arrfeed['nick'] : $arrfeed['rater_user_nick']; 
		$feedfor['comment']=nl2br(strip_tags(stripslashes(($feedfor['comment'])))); 
		$feed_disp['feedforum'][$feedfor['seqnum']]=$feedfor;
	}
	$nextfeedlink=end($feed_disp['feedforum']);
	if(!(($_SESSION['PHPAUCTION_LOGGED_IN']==$arrfeed['rated_user_id'] && $nextfeedlink['user_id']==$usarr['id'])
	|| ($_SESSION['PHPAUCTION_LOGGED_IN']==$usarr['id'] && $nextfeedlink['user_id']==$arrfeed['rated_user_id'])) || $nextfeedlink['seqnum']>=2) {
		Header("Location: index.php");
		exit;
	}
} else {
	if(!($_SESSION['PHPAUCTION_LOGGED_IN']==$arrfeed['rated_user_id'])) {
		Header("Location: index.php");
		exit;
	}
}
if($_REQUEST['seqnum'] > 0 && $nextfeedlink['seqnum']>$_REQUEST['seqnum']) {
	Header("Location: feedback.php?id=".$arrfeed['rated_user_id']."&faction=show");
	exit;
}
if(!empty($_POST['comment']) && 
	!empty($_REQUEST['seqnum']) && 
	!empty($_REQUEST['feed_id'])) {
	$sql="INSERT INTO ".$DBPrefix."feedforum values(NULL,".intval($_REQUEST['feed_id']).",".$_SESSION['PHPAUCTION_LOGGED_IN'].",".intval($_REQUEST['seqnum']).",NULL,'".addslashes(strip_tags($_POST['comment']))."')";
	$res=@mysql_query ($sql);
	Header("Location: feedback.php?id=".$arrfeed['rated_user_id']."&faction=show");
	exit;
}
include "header.php";
include phpa_include("template_addfeedforum_php.html");
include "footer.php";

?>
