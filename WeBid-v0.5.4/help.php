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

if (!$topic) { $topic = 'General'; }
$query = "select helptext from ".$DBPrefix."help where topic=".intval($topic);
$result = mysql_query($query);
if (!$result)
{
	MySQLError($query);
	exit;
}
if (mysql_num_rows($result) > 0) {
	$helptext=stripslashes(mysql_result($result,0,"helptext"));
	$TPL_helptext = $helptext;
} else {
	$TPL_helptext = $ERR_116;
}
$TPL_topic = $topic;


$query = "select topic from ".$DBPrefix."help order by topic";
$result = mysql_query($query);
if (!$result)
{
	MySQLError($query);
	exit;
}
if (mysql_num_rows($result) > 0 ) {
	$TPL_otherhelp = "<b>" . $MSG_918 . "</b><br>";
	$num_topics = mysql_num_rows($result);
	$i = 0;
	while($i < $num_topics){
		$this_topic = mysql_result($result, $i, "topic");

		$TPL_otherhelp .= "<a href=\"help.php?topic=".urlencode($this_topic)."";
		$TPL_otherhelp .= "\">";
		$TPL_otherhelp .= $this_topic;
		$TPL_otherhelp .="</a>";
		$TPL_otherhelp .= "<br>";
		$i++;
	}
} else {
	$TPL_otherhelp = "";
}

include phpa_include("template_view_help_php.html");

?>

<?php require("./footer.php"); ?>