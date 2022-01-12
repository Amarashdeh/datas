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

require('./includes/config.inc.php');

/* get active bids for this user */

$result = mysql_query("select a.current_bid, a.id, a.title, a.ends, b.bid FROM ".$DBPrefix."auctions a, ".$DBPrefix."bids b WHERE a.id=b.auction AND a.closed='0' AND b.bidder='$_SESSION[PHPAUCTION_LOGGED_IN]' order by a.ends asc, b.bidwhen desc");
$idcheck= "";
if ($result) {
	$tplv = "";
	$bgColor = "#EBEBEB";
	while ($row=mysql_fetch_array($result)) {

		$rowid = $row[id];
		if ($idcheck != $rowid) {
			$bid = $row[bid];

			/* prepare some data */

			$ends_date = strval($row["ends"]);
			$ends_y =	substr ($ends_date, 0, 4);
			$ends_m =	substr ($ends_date, 4, 2);
			$ends_d =	substr ($ends_date, 6, 2);
			$ends_h =	substr ($ends_date, 8, 2);
			$ends_min =	substr ($ends_date, 10, 2);
			$ends_sec =	substr ($ends_date, 12, 2);

			if($bgColor == "#EBEBEB") {
				$bgColor = "#FFFFFF";
			} else {
				$bgColor = "#EBEBEB";
			}
			#// Outbidded or winning bid
			if($row['current_bid']!=$row['bid']) $bgColor='#FFFF00';

			$tplv .= "<tr VALIGN=MIDDLE BGCOLOR=\"$bgColor\">";

			/* this subastas title and link to details */
			$difference = time()-mktime($h,$min,$sec,$m,$d,$y);

			$tplv .=
			"<td ALIGN=LEFT><a href=\"item.php?id=".$rowid."\">".
			stripslashes(htmlspecialchars($row[title])).
			"</a></td>";

			/* current bid of this subastas */
			if($bid == 0) {
				$bid = $starting_price;
			}
			$bid = print_money($bid);

			$tplv .=
			"<td>".
			"<table CELLSPACING=0 CELLPADDING=0 BORDER=0 WIDTH=\"100%\">".
			"<tr VALIGN=TOP><td ALIGN=LEFT>".
			"</td><td align=right>".
			$bid.
			"</td></tr></table>".
			"</td>";


			/* time left till the end of this subastas */
			$difference = mktime($ends_h,$ends_min,$ends_sec,$ends_m,$ends_d,$ends_y)-time();
			$days_difference = intval($difference / 86400);
			$difference = $difference - ($days_difference * 86400);

			$hours_difference = intval($difference / 3600);
			if(strlen($hours_difference) == 1) {
				$hours_difference = "0".$hours_difference;
			}

			$difference = $difference - ($hours_difference * 3600);
			$minutes_difference = intval($difference / 60);
			if(strlen($minutes_difference) == 1) {
				$minutes_difference = "0".$minutes_difference;
			}

			$difference = $difference - ($minutes_difference * 60);
			$seconds_difference = $difference;
			if(strlen($seconds_difference) == 1) {
				$seconds_difference = "0".$seconds_difference;
			}

			$tplv .= "<td align=center>$days_difference $MSG_126 $hours_difference:$minutes_difference:$seconds_difference</td>";

			$tplv .= "</tr>";
			++$auctions_count;

			$idcheck = $rowid;
		}
		$TPL_auctions_list_value = $tplv;

	}
} else {
  $auctions_count = 0;
}

if ($auctions_count==0) {
	$TPL_auctions_list_value = "	<tr ALIGN=CENTER><td COLSPAN=5>&nbsp;</td></tr>";
}

include "header.php";
include phpa_include("template_yourbids_php.html");
include "footer.php";

?>