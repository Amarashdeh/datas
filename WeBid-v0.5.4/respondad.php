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
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);

if($_POST['action']=='sendtoposter' && basename($HTTP_REFERER) == basename($PHP_SELF)) {
	if(empty($_POST['auction'])) {
		$TPL_errmsg = $MSG_30_0152;
	} else {
		#// Does the auction exist?
		if(!@mysql_result(@mysql_query("SELECT id FROM ".$DBPrefix."auctions WHERE id=".intval($_POST['auction'])." AND closed='0' AND user=".$_SESSION["PHPAUCTION_LOGGED_IN"]),0,"id")) {
			$TPL_errmsg = $MSG_30_0153;
		} else {
			#// Send notification
			$POSTER=@mysql_fetch_array(@mysql_query("SELECT email,nick FROM ".$DBPrefix."users WHERE id=".intval($_POST['poster'])));
			$USERLANG = @mysql_result(@mysql_query("SELECT language FROM ".$DBPrefix."userslanguage WHERE user=".intval($_POST['poster'])),0,"language");
			if(!isset($USERLANG)) $USERLANG = $SETTINGS['defaultlanguage'];
			include $include_path."wanteditem_notification.".$USERLANG.".inc.php";
			if(!mail($to,$subject,$message,$from)){
				$TPL_errmsg = $MSG_30_0154;
			}else{
				$TPL_errmsg = $MSG_30_0155;
				@mysql_query("UPDATE ".$DBPrefix."wanted SET answers=answers+1 WHERE id=".intval($_POST['adid']));
			}
		}
	}
}
include("header.php");
include(phpa_include("template_respondad_php.html"));
include("footer.php");

?>