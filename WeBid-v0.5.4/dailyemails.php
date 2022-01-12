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
include("./includes/config.inc.php");

#// Check for auctions (closed today) for which a cumulative e-mail must be sent
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);
$yesterday = date("YmdHis",mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"),date("d")-1,date("Y")));
$today = $NOW;

$query = "SELECT a.user FROM ".$DBPrefix."auctions a, ".$DBPrefix."users u 
		  WHERE a.closed=1 AND 
		  a.ends<='$today' AND
		  a.ends>=$yesterday AND
		  a.user=u.id AND
		  u.emailmode='cum'
		  GROUP BY user";
$res = @mysql_query($query);
if($res && @mysql_num_rows($res) > 0) {
	#// Loop through sellers and send the e-mail
	while($seller = mysql_fetch_array($res)) {
		unset($titles);
		$Seller = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."users WHERE id=".$seller['user']));
		$query = "SELECT id,title,ends FROM ".$DBPrefix."auctions 
				  WHERE 
				  closed=1 AND 
				  ends<='$today' AND
				  ends>=$yesterday AND
				  user=".$seller['user']."";
		$res_auc = @mysql_query($query);
		if($res_auc && mysql_num_rows($res_auc) > 0) {
			while($Auction = mysql_fetch_array($res_auc)) {
				$titles .= sprintf("%-20d %-50s", $Auction['id'], $Auction['title'])."\n";
			}
			#// Send e-mail
			include $include_path."endauction_cumulative.inc.php";
		}
	}
}
?>