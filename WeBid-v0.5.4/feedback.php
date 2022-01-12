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
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);

if (!isset($_POST['auction_id']) && !isset($_GET['auction_id'])) {
	$_REQUEST['auction_id'] = $_SESSION["CURRENT_ITEM"];
} else {
	$_SESSION["CURRENT_ITEM"]=$_REQUEST['auction_id'];
}
if (empty($_REQUEST["pg"])) {
	$pg=1;
} else {
  $pg = $_REQUEST["pg"]; 
}

if ($_SERVER['REQUEST_METHOD']=="POST") {
	if($_POST['TPL_rater_nick'] && $_POST['TPL_password'] && isset($_POST['TPL_rate']) && $_POST['TPL_feedback']) {
		
		$sql="SELECT winner, seller FROM ".$DBPrefix."winners WHERE auction =".intval($_REQUEST['auction_id']);
		$resids=mysql_query ($sql);
		if (mysql_num_rows($resids)>0) {
			while($wsell=mysql_fetch_assoc($resids)) {
				$winsell[$wsell['seller']]=$wsell['seller'];
				$winsell[$wsell['winner']]=$wsell['winner'];
			}
			$sql="SELECT id, nick FROM ".$DBPrefix."users WHERE nick=\"" .AddSlashes($_POST['TPL_nick_hidden'])."\"";
			$res=mysql_query ($sql);
			if($res) $secid = AddSlashes($_GET['id']);
			
			if ($_POST['TPL_rater_nick']!=$_POST['TPL_nick_hidden']) {
				$sql="SELECT id, nick, password FROM ".$DBPrefix."users WHERE nick=\"" .AddSlashes($_POST['TPL_rater_nick'])."\"";
				$resrater=mysql_query ($sql);
				
				if (mysql_num_rows($resrater)  > 0) {
					$arr=mysql_fetch_array ($resrater);
					
					if(in_array($arr['id'],$winsell)) {
						if ($arr['password']  == md5($MD5_PREFIX.$_POST['TPL_password'])) {
							$sql="SELECT rate_sum, rate_num FROM ".$DBPrefix."users WHERE id=".intval($secid);
							$res2=mysql_query ($sql);
							if ($res2) {
								$arr=mysql_fetch_array ($res2);
								$secTPL_rater_nick = AddSlashes ($_POST['TPL_rater_nick']);
								$secTPL_feedback = AddSlashes (ereg_replace("\n","<BR>",$_POST['TPL_feedback']));
								
								$sql = "SELECT * FROM ".$DBPrefix."feedbacks
										WHERE rated_user_id=".intval($_GET['id'])." 
										AND rater_user_nick='" .AddSlashes($secTPL_rater_nick)."' 
										AND auction_id =" .intval($_REQUEST['auction_id'])."";
								$resrater = mysql_query ($sql);
								if (mysql_num_rows($resrater) > 0) {
									$TPL_err=1;
									$TPL_errmsg="$ERR_705";
								} else {
									$sql = "SELECT * FROM ".$DBPrefix."feedbacks
											WHERE rated_user_id=".intval($_GET['id'])." 
											AND rater_user_nick='" .AddSlashes($secTPL_rater_nick)."' 
											AND rate=" .intval($_POST['TPL_rate']);
									$resrater = mysql_query ($sql);
									if ($resrater) {
										$arr['rate_sum'] += intval($_POST['TPL_rate']);
									}
									$arr['rate_num']++;
									$sql="UPDATE ".$DBPrefix."users SET rate_sum=".intval($arr['rate_sum']).", rate_num=".intval($arr['rate_num']).",reg_date=reg_date WHERE id=".intval($secid);
									
									mysql_query ($sql);
									$sql="INSERT INTO ".$DBPrefix."feedbacks (rated_user_id, rater_user_nick, feedback, rate, feedbackdate, auction_id) VALUES (
																".intval($secid).",
																'".addslashes($secTPL_rater_nick)."',
																'".addslashes($secTPL_feedback)."',
																".intval($_POST['TPL_rate']).", '$NOW',".intval($_REQUEST['auction_id']).")";
									mysql_query ($sql);
									$url = "Location:  buysellnofeedback.php";
									header ($url);
									exit;
								}
							}
						} else {
							$TPL_err=1;
							$TPL_errmsg=$ERR_101;
						}
					} else {
						$TPL_err=1;
						$TPL_errmsg=$ERR_703;
					}
				} else {
					$TPL_err=1;
					$TPL_errmsg=$ERR_102;
				}
			} else {
				$TPL_err=1;
				$TPL_errmsg=$ERR_103;
			}
		} else {
			$TPL_err=1;
			$TPL_errmsg=$ERR_704;
		}
	} else {
		$TPL_err=1;
		$TPL_errmsg=$ERR_104;
	}
	
}
if (($_SERVER['REQUEST_METHOD']=="GET" || $TPL_err) ) {
	$secid = AddSlashes($_GET['id']);
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
					$TPL_rate_ratio_value="<IMG src=\"./images/icons/".$l['icon']."\">";
					break;
				}
			}
			$TPL_feedbacks_num=$arr['rate_num'];
			$TPL_feedbacks_sum=$arr['rate_sum'];
		} else {
			$TPL_err=1;
			$TPL_errmsg=$ERR_105;
		}
	} else {
		$TPL_err=1;
		$TPL_errmsg=$ERR_106;
	}
}

if ($_SERVER['REQUEST_METHOD']=="GET" && $_GET['faction']=="show") {
	/* determine limits for SQL query */
	if ($pg==0)	$pg = 1;
	$lines = (int)$lines;
	if ($lines==0)	$lines = 5;
	$left_limit = ($pg-1)*$lines;
	$rsl = mysql_query ( "SELECT rate_sum FROM ".$DBPrefix."users WHERE id=".intval($secid));
	if ($rsl) {
		$hash = mysql_fetch_array($rsl);
		$total = (int)$hash[0];
	} else $total = 0;
	$TPL_feedbacks_num=$total;
	
	/* get number of pages */
	$pages = ceil($total/$lines);
	
	$sql="SELECT f.*,a.title FROM ".$DBPrefix."feedbacks f
			LEFT OUTER JOIN ".$DBPrefix."auctions a
			ON a.id=f.auction_id
			WHERE rated_user_id=".intval($secid)." 
			ORDER by feedbackdate DESC 
			LIMIT ".intval($left_limit).",".intval($lines);
	$res=mysql_query ($sql);
	$i=0;
	$feed_disp=array();
	while ($arrfeed = mysql_fetch_array($res)) {
		$feed_disp[$i]["username"]=$arrfeed['rater_user_nick'];
		$feed_disp[$i]["auctionurl"]=(($arrfeed['title']) ? "<A HREF='item.php?id=".$arrfeed['auction_id']."'>".$arrfeed['title']."</A>":$MSG_113.$arrfeed['auction_id']);
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
				$feed_disp[$i]['usicon']="<IMG src=\"./images/icons/".$l['icon']."\" alt=\"".$l['icon']."\" />";
				break;
			}
		}
		switch($feed_disp[$i]['rate']) {
			case 1 : $feed_disp[$i]['img']="./images/positive.gif";
			break;
			case -1: $feed_disp[$i]['img']="./images/negative.gif";
					$sql="SELECT * FROM ".$DBPrefix."feedforum WHERE feed_id=".intval($arrfeed['id'])." ORDER BY seqnum ASC";
					$res_=@mysql_query ($sql);
					if($res_ && mysql_num_rows($res_)>0) {
						while($feedfor=mysql_fetch_array($res_)) {
							$feedfor["commentdate"] = FormatDate($feedfor['commentdate']);		
							$feedfor['username']=($feedfor['user_id']==$secid) ? $TPL_nick : $arrfeed['rater_user_nick']; 
							$feedfor['comment']=nl2br(strip_tags(stripslashes(($feedfor['COMMENT'])))); 
							$feed_disp[$i]['feedforum'][$feedfor['seqnum']]=$feedfor;
						}
						$nextfeedlink=end($feed_disp[$i]['feedforum']);
						if((($_SESSION['PHPAUCTION_LOGGED_IN']==$arrfeed['rated_user_id'] && $nextfeedlink['user_id']==$usarr['id'])
							|| ($_SESSION['PHPAUCTION_LOGGED_IN']==$usarr['id'] && $nextfeedlink['user_id']==$arrfeed['rated_user_id'])) && $nextfeedlink['seqnum']<2)
							$feed_disp[$i]['nextfeedforum']="<A HREF='addfeedforum.php?feed_id=".$nextfeedlink['feed_id']."&seqnum=".$nextfeedlink['seqnum']."'>".$MSG_25_0201."</A>";
						else
							$feed_disp[$i]['nextfeedforum']="";
					} else {
						if($_SESSION['PHPAUCTION_LOGGED_IN']==$arrfeed['rated_user_id'])
							$feed_disp[$i]['nextfeedforum']="<A HREF='addfeedforum.php?feed_id=".$arrfeed['id']."&seqnum=0'>".$MSG_25_0201."</A>";
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
		if ($pg!=$ind2) {
			$echofeed .="<a href=\"feedback.php?id=".$_GET['id']."&pg=$ind2&faction=show\">
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

// Calls the appropriate templates/templates

if (($_SERVER['REQUEST_METHOD']=="GET" || $TPL_err) && !$_GET['faction']) {
	include "header.php";
	include phpa_include("template_feedback_php.html");
	include "footer.php";
}

if ($_SERVER['REQUEST_METHOD']=="GET" && $_GET['faction']=="show"){
	include "header.php";
	include phpa_include("template_show_feedback.html");
	include "footer.php";
}

$TPL_err=0;
$TPL_errmsg="";
?>
