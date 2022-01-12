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
require('./includes/config.inc.php');

require("header.php");

$query = "SELECT * from ".$DBPrefix."news where id=".intval($_GET['id'])." AND suspended!=1";
$res = mysql_query($query);
if(!$res) {
	MySQLError($query);
	exit;
}
$new = mysql_fetch_array($res);
$TR = @mysql_fetch_array(@mysql_query("SELECT title,content FROM ".$DBPrefix."news_translated WHERE id=".intval($new['id'])." AND lang='".addslashes($language)."'"));
$new['title']=$TR['title'];
$new['content']=$TR['content'];
#// Build news index
$query = "SELECT * FROM ".$DBPrefix."news WHERE id<>".intval($_GET['id'])." AND suspended!=1 ORDER BY new_date DESC";
$res_ = mysql_query($query);
if(!$res_) {
	MySQLError($query);
	exit;
} elseif(mysql_num_rows($res_) > 0) {
	while($row = mysql_fetch_array($res_)) {
		$row['title'] = @mysql_result(@mysql_query("SELECT title FROM ".$DBPrefix."news_translated WHERE id=".intval($row['id'])." AND lang='".addslashes($language)."'"),0,"title");
		$NEWSINDEX[$row[id]] = $row[title];
		$NEWSDATE[$row[id]] = $row[new_date];
	}
}
if(!empty($_GET['id'])){
	$TPL_title = stripslashes($new[title])." ".FormatDate($new[new_date]);
}else{
	$TPL_title = $MSG_282;
}
include phpa_include("template_view_new_php.html");
require("./footer.php");

?>
