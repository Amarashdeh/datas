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

require('includes/config.inc.php');

#// Run cron according to SETTINGS
if($SETTINGS['cron'] == 2) {
	include_once "cron.php";
}

require("header.php");

$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);

/*
prepare data for templates/template
*/

/* prepare categories list for templates/template */
# Prepare categories sorting
if($SETTINGS['catsorting'] == 'alpha') {
	$catsorting = " ORDER BY t.cat_name ASC";
} else {
	$catsorting = " ORDER BY sub_counter DESC";
}
$TPL_categories_value = "";
$query = "select distinct * from ".$DBPrefix."categories c, ".$DBPrefix."cats_translated t
          WHERE c.parent_id=0
          AND t.cat_id=c.cat_id
          AND t.lang='".$language."'
          $catsorting";
$result = mysql_query($query);
if(!$result) {
	MySQLError($query);
	exit;
} else {
	$num_cat = mysql_num_rows($result);
	$i = 0;
	$TPL_categories_value = "<ul>\n";
	while($i < $num_cat && $i < $SETTINGS['catstoshow']) {
		$catlink="";
		$cat_id = mysql_result($result,$i,"cat_id");
		$cat_name = mysql_result($result,$i,"cat_name");
		$sub_count = intval(mysql_result($result, $i, "sub_counter"));
		$cat_colour = mysql_result($result, $i, "cat_colour");
		$cat_image = mysql_result($result, $i, "cat_image");
		$cat_counter = (int)mysql_result($result, $i, "counter" );
		if ($sub_count!=0)
			$cat_counter = "(".$sub_count.")";
		else {
			$cat_counter = "";
		}
		$cat_url = "./browse.php?id=$cat_id";
		if ( $cat_image != "") {
			$catlink = "<A HREF=\"$cat_url\"><IMG SRC=\"$cat_image\" BORDER=0></a>";
		}
		#//  Select the translated category name
		$cat_name = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=$cat_id AND lang='".$language."'"),0,"cat_name");
		$catlink .= "<A HREF=\"$cat_url\">$cat_name</A>"." $cat_counter";
		if ( $cat_colour != "") {
			$catlink = setsspan($catlink,"background-color:$cat_colour");
		}
		$TPL_categories_value .= "<li>".$catlink."</li>\n";
		$i++;
	}
	$TPL_categories_value .= "</ul>\n";
	$TPL_categories_value .= "<A HREF=\"browse.php?id=0\">$MSG_277</A>";
}


/* get last created auctions */
$query = "SELECT id,title,starts from ".$DBPrefix."auctions
         WHERE
         closed='0' AND
         suspended=0 AND ";
		 if($SETTINGS['adultonly']=='y' && !isset($_SESSION["PHPAUCTION_LOGGED_IN"])){
			 $query .= "adultonly='n' AND ";
		 }
         $query .= "starts<=".$NOW."
         ORDER BY starts DESC
         LIMIT ".$SETTINGS['lastitemsnumber'];
$result = mysql_query($query);
if ( $result )
	$num_auction = mysql_num_rows($result);
else
	$num_auction = 0;

$i = 0;
$bgcolor = "#FFFFFF";
$TPL_last_auctions_value = "";
while($i < $num_auction) {
	if($bgcolor == "#FFFFFF") {
		$bgcolor = $FONTCOLOR[$SETTINGS['headercolor']];
	} else {
		$bgcolor = "#FFFFFF";
	}
	$title = mysql_result($result,$i,"title");
	$id 	 = mysql_result($result,$i,"id");
	$date	 = mysql_result($result,$i,"starts");

	$year = substr($date,0,4);
	$month = substr($date,4,2);
	$day = substr($date,6,2);
	$hours = substr($date,8,2);
	$minutes = substr($date,10,2);
	$seconds = substr($date,12,2);

	#// Check bold and highlighted options

	$ISBOLD = FALSE;
	$ISHIGHLIGHTED = FALSE;

	$TPL_last_auctions_value .="<p style=\"background-color:$bgcolor;display:block\">".ArrangeDateNoCorrection($day,$month,$year,$hours,$minutes)."&nbsp;<A HREF=\"./item.php?id=$id\">";
	if($ISHIGHLIGHTED) {
		$TPL_last_auctions_value .= "<SPAN CLASS=hg>";
	}
	if($ISBOLD) {
		$TPL_last_auctions_value .= "<B>";
	}
	$TPL_last_auctions_value .= stripslashes($title);
	if($ISBOLD) {
		$TPL_last_auctions_value .= "</B>";
	}
	if($ISHIGHLIGHTED) {
		$TPL_last_auctions_value .= "</SPAN>";
	}
	$TPL_last_auctions_value .= "</A></p>";
	$i++;
}

/* get ending soon auctions */
$TPL_ending_soon_value = "";
$query = "select ends,id,title from ".$DBPrefix."auctions
         WHERE closed='0' AND
         suspended='0' AND ";
         $query .= "starts<=".$NOW."
         order by ends LIMIT ".$SETTINGS['endingsoonnumber'];
$result = mysql_query($query);
if(!$result) {
	MySQLError($query);
	exit;
} else
	$num_auction = mysql_num_rows($result);

$i = 0;
$bgcolor = "#FFFFFF";
while($i < $num_auction) {
	if($bgcolor == "#FFFFFF") {
		$bgcolor = $FONTCOLOR[$SETTINGS['headercolor']];
	} else {
		$bgcolor = "#FFFFFF";
	}
	$title 	= mysql_result($result,$i,"title");
	$id 	= mysql_result($result,$i,"id");
	$ends 	= mysql_result($result,$i,"ends");
	$nowt	= $TIME;
	$difference = mktime(	substr ($ends, 8, 2),
	                      substr ($ends, 10, 2),
	                      substr ($ends, 12, 2),
	                      substr ($ends, 4, 2),
	                      substr ($ends, 6, 2),
	                      substr ($ends, 0, 4))-$nowt;
	if ($difference > 0) {
		$days_difference = floor($difference / 86400);
		$difference = $difference % 86400;
		$hours_difference = floor($difference / 3600);
		$difference = $difference % 3600;
		$minutes_difference = floor($difference / 60);
		$seconds_difference = $difference % 60;
		$ends_string = sprintf("%d%s %02dh:%02dm:%02ds",$days_difference,$MSG_126, $hours_difference,$minutes_difference,$seconds_difference);
	} else {
		$ends_string = $MSG_911;
	}

	#// Check bold and highlighted options
	$ISBOLD = FALSE;
	$ISHIGHLIGHTED = FALSE;

	$TPL_ending_soon_value .= "
	                          <p style=\"background-color:$bgcolor;display:block\">".$ends_string."&nbsp;<A HREF=\"./item.php?id=$id\">";
	if($ISHIGHLIGHTED) {
		$TPL_ending_soon_value .= "<SPAN CLASS=hg>";
	}
	if($ISBOLD) {
		$TPL_ending_soon_value .= "<B>";
	}

	$TPL_ending_soon_value .= stripslashes($title);
	if($ISBOLD) {
		$TPL_ending_soon_value .= "</B>";
	}
	if($ISHIGHLIGHTED) {
		$TPL_ending_soon_value .= "</SPAN>";
	}

	$TPL_ending_soon_value .= "</A></p>";
	$i++;
}

/**
* NOTE: get higher bids
*/
$TPL_maximum_bids = "";
$query = "select auction,max(bid) AS max_bid
         FROM ".$DBPrefix."bids b, ".$DBPrefix."auctions a WHERE a.suspended=0 AND a.closed=0 AND a.id=b.auction GROUP BY b.bid,b.auction ORDER BY max_bid desc";
$result = mysql_query($query);

if ($result)
	$num_auction = mysql_num_rows($result);
else
	$num_auction = 0;

$i = 0;
$j = 0;
$bgcolor = "#FFFFFF";
$AU = array();

while($i < $num_auction && $j < $SETTINGS['higherbidsnumber']) {
	$max_bid  = mysql_result($result,$i,"max_bid");
	$auction  = mysql_result($result,$i,"auction");

	//-- Get auction data

	$query = "SELECT title,closed,id from ".$DBPrefix."auctions
	         WHERE id=\"$auction\" AND";
			 $query .= "'".$NOW."'>=starts";
	//print $query;
	$result_bid = mysql_query($query);
	if(mysql_num_rows($result_bid) > 0) {
		$title = mysql_result($result_bid,0,"title");
		$closed = mysql_result($result_bid,0,"closed");
		$auc_id = mysql_result($result_bid,0,"id");
	}

	if($closed == "0" && !in_array($auction,$AU)) {
		#// Check bold and highlighted options
		$ISBOLD = FALSE;
		$ISHIGHLIGHTED = FALSE;

		$TPL_maximum_bids .="
		                    <p style=\"background-color:$bgcolor;display:block\"><A HREF=javascript:window_open('converter.php?AMOUNT=$max_bid','incre',650,200,30,30)>"
		                    .print_money ($max_bid)."&nbsp;<A HREF=\"./item.php?id=$auc_id\">";
		if($ISHIGHLIGHTED) {
			$TPL_maximum_bids .= "<SPAN CLASS=hg>";
		}
		if($ISBOLD) {
			$TPL_maximum_bids .= "<B>";
		}
		$TPL_maximum_bids .= stripslashes($title);
		if($ISBOLD) {
			$TPL_maximum_bids .= "</B>";
		}
		if($ISHIGHLIGHTED) {
			$TPL_maximum_bids .= "</SPAN>";
		}
		$TPL_maximum_bids .= "</A></p>";
		if($bgcolor == "#FFFFFF") {
			$bgcolor = $FONTCOLOR[$SETTINGS['headercolor']];
		} else {
			$bgcolor = "#FFFFFF";
		}
		$AU[] = $auction;
		$j++;
	}
	$i++;
}
// Build list of help topics
$query = "SELECT * FROM ".$DBPrefix."faqscategories";
$r_h = @mysql_query($query);
if(!$r_h) {
	MySQLError($query);
	exit;
}
if(mysql_num_rows($r_h) > 0) {
	$TPL_helptopics = "<ul>";
	while($faqscat = mysql_fetch_array($r_h)) {
		$faqscat['category'] = stripslashes(@mysql_result(mysql_query("SELECT category FROM ".$DBPrefix."faqscat_translated WHERE id=".$faqscat['id']." AND lang='".$language."'"),0,"category"));
		//$faqscat['category']=stripslashes($faqscat['category']);
		$TPL_helptopics .= "<li><a href=\"javascript: window_open('viewfaqs.php?cat=".$faqscat['id']."','faqs',500,400,20,20)\">".$faqscat['category']."</a></li>";
	}
	$TPL_helptopics .= "</ul>";
} else {
	$TPL_helptopics = "";
}

//-- Build news list
if($SETTINGS['newsbox'] == 1) {
	$query = "SELECT title,id,new_date from ".$DBPrefix."news where suspended=0 order by new_date DESC limit ".$SETTINGS['newstoshow'];
	$res = mysql_query($query);
	if(!$res) {
		MySQLError($query);
		exit;
	}
	$TPL_news_list = "<ul>";
	while($new = mysql_fetch_array($res)) {
		$new['title'] = @mysql_result(@mysql_query("SELECT title FROM ".$DBPrefix."news_translated WHERE id=".$new['id']." AND lang='".$language."'"),0,"title");
		$new_date= $new['new_date'];
		$F_date = FormatDate($new_date);
		$TPL_news_list .= "<li>$F_date - <a href=\"viewnew.php?id=".$new['id']."\">".$new['title']."</a></li>";
	}
	$TPL_news_list .= "</ul>";
} else {
	$TPL_news_list = "&nbsp;";
}

require(phpa_include("template_index_php.html"));
require('./footer.php');
?>