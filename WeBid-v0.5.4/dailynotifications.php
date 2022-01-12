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
// // Update currencies rates
include("./includes/config.inc.php");

#// Check if there are pending notifications to send to sellers
$query = "SELECT id FROM ".$DBPrefix."users WHERE endemailmode='cum'";
$res = @mysql_query($query);
if($res){
	while($row = mysql_fetch_array($res)){
		$query = "SELECT * FROM ".$DBPrefix."pendingnotif WHERE thisdate<'".date("Ymd")."' AND seller_id=".$row['id'];
		$res_ = @mysql_query($query);
		while($pending = mysql_fetch_array($res_)){
			$Auction = unserialize($pending['auction']);
			$Seller = unserialize($pending['seller']);
			$report .= "-------------------------------------------------------------------------\n".
						$Auction['title']."\n".
						"-------------------------------------------------------------------------\n";
			if(strlen($pending['winners']) > 0){
				$report .= $MSG_453.":\n".$pending['winners']."\n\n";
			}else{
				$report .= $MSG_30_0103."\n\n";
			}
			@mysql_query("DELETE FROM ".$DBPrefix."pendingnotif WHERE id=".$pending['id']);
		}
		
		include $include_path."endauction_cumulative.inc.php";
	}
}
?>