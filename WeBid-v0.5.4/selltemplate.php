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
include $include_path.'auction_types.inc.php';
include $include_path."countries.inc.php";
include "header.php";


foreach($_POST as $k=>$v){
  $var = $k;
  $$var = $v; 
}

//-- Data check
$user=$_SESSION['PHPAUCTION_LOGGED_IN'];
if($_GET['actionreset']=='y' && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
	@mysql_query("DELETE FROM ".$DBPrefix."selltemplates WHERE user=".intval($user));
}

if($_POST['action'] && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
	// Check that all the fields are not NULL
	$numchild = mysql_result(mysql_query("SELECT count(cat_id) as childs FROM ".$DBPrefix."categories WHERE parent_id=".intval($category)),0,"childs");
	if (	($reserve_price > 0 && $reserve_price < $minimum_bid) 
		|| 	($buy_now > 0 && ($minimum_bid > $buy_now || $reserve_price > $buy_now))) {
		$ERR = $ERR_25_0000;
	} elseif($numchild>0) {
		$ERR=$ERR_25_0001;
	} else {
		#// Retrieve auction's data
		$featured= empty($featured) ? 'n':$featured;
		$catfeatured= empty($catfeatured) ? 'n':$catfeatured;
		$bold= empty($bold) ? 'n':$bold;
		$highlighted= empty($highlighted) ? 'n':$highlighted;
		$payment_text=@join("/n",$payment);
		$minumum_bid=input_money($minimum_bid);
		$reserve_price=input_money($reserve_price);
		$buy_now=input_money($buy_now);
		$increment=input_money($increment);
		$sql="REPLACE ".$DBPrefix."selltemplates SET user=".intval($user).",
				title='".AddSlashes($title)."',
				description='".AddSlashes($description)."',
				category='".AddSlashes($category)."',
				minimum_bid='".AddSlashes($minimum_bid)."',
				buy_now='".AddSlashes($buy_now)."',
				reserve_price='". AddSlashes($reserve_price)."',
				duration='".AddSlashes($duration)."',
				location='".AddSlashes($country)."',
				location_zip='".AddSlashes($location_zip)."',
				auction_type='".AddSlashes($auction_type)."',
				shipping='".AddSlashes($shipping)."',
				payment='".AddSlashes($payment_text)."',
				international='".AddSlashes($international)."',
				quantity='".AddSlashes($quantity)."',
				increment='".AddSlashes($increment)."',
				relist='".AddSlashes($relist)."',
				highlighted='".AddSlashes($highlighted)."',
				bold='".AddSlashes($bold)."',
				featured='".AddSlashes($featured)."',
				catfeatured='".AddSlashes($catfeatured)."',
				shipping_terms='".AddSlashes(strip_tags($shipping_terms))."',
				bn_only='".AddSlashes(strip_tags($buy_now_only))."'";								
		$res=mysql_query($sql);
		if (!$res) {
			print "Database error on update: " . mysql_error();
			exit;
		} 
		$updated=true;
	}
}

	
/*
*        Make a large SQL query getting values from the "auctions"
*        table and corresponding values that are indexed in other tables
*         and displaying them both (and allowing the admin to change
*        only the proper indexed values.
*/
$query = "SELECT a.* FROM ".$DBPrefix."selltemplates a WHERE a.user=".intval($user);
$result = mysql_query($query);
if(!$result) {
	print "Database access error: abnormal termination".mysql_error();
	exit;
} else {
	$found=true;
	$selltemp=mysql_fetch_assoc($result);
}

$title = $found ? stripslashes($selltemp["title"]):"";
$description = $found ? stripslashes($selltemp["description"]):"";
$duration = $found ? $selltemp["duration"]:"";
$category = $found ? $selltemp["category"]:"";
$auction_type = $found ? $selltemp["auction_type"]:'';
$minimum_bid = $found ? print_money_nosymbol($selltemp["minimum_bid"]):0;
$reserve_price = $found ? print_money_nosymbol($selltemp["reserve_price"]):0;
$buy_now = $found ? print_money_nosymbol($selltemp["buy_now"]):0;
$quantity = $found ? $selltemp["quantity"]:0;
$country = $found ? stripslashes($selltemp["location"]):"";
$location_zip = $found ? stripslashes($selltemp["location_zip"]):"";
$shipping = $found ? $selltemp["shipping"]:'';
$payment = $found ? explode("/n",$selltemp["payment"]):array();
$international = $found ? $selltemp["international"]:"";
$relist = $found ? $selltemp["relist"]:0;
$increment = $found ? print_money_nosymbol($selltemp["increment"]):0;
$highlighted = $found ? $selltemp["highlighted"]:"";
$bold = $found ? $selltemp["bold"]:"";
$featured = $found ? $selltemp["featured"]:"";
$catfeatured = $found ? $selltemp["catfeatured"]:"";
$buy_now_only = $found ? $selltemp["bn_only"]:"";
$TPL_shipping_terms=stripslashes($selltemp["shipping_terms"]);

if($buy_now_only == 'n') $TPL_without_buy_now_only = " CHECKED";
if($buy_now_only == 'y') $TPL_with_buy_now_only = " CHECKED";
/*
*         For all list-like items we create drop-down
*        lists and select the index listed in the auction table.
*        for this auction.
*/
// -------------------------------------- country
$TPL_countries_list="<select name='country'>\n";
reset($countries);
foreach ($countries as $key=>$val)	{
	$TPL_countries_list.= "	<option VALUE='$val'";
	if($val==$country && $val != '') {
		$TPL_countries_list.= " SELECTED='true'";
	} elseif($SETTINGS["defaultcountry"] == $val && $country=="") {
		$TPL_countries_list.= " SELECTED='true'";
	}
	$TPL_countries_list.= " >".$val."</option>\n";
}
$TPL_countries_list.="</select>\n";

// ------------------------------------- auction type
$TPL_auction_type=	"<select NAME=\"auction_type\">\n";
reset($auction_types);
while(list($key,$val)=each($auction_types)){
	$TPL_auction_type.="	<option VALUE=\"".$key."\" ".(($key==$aauction_type)?"SELECTED":"").">".$val."</OPTION>\n";
}
$TPL_auction_type.="</select>\n";

// DURATIONS	
$dur_list = ""; // empty string to begin HTML list
$dur_query = "select days, description from ".$DBPrefix."durations";
$res_d = mysql_query($dur_query);
if(!$res_d) {
	print "Database access error: abnormal termination".mysql_error();
	exit;
}
while ($row = mysql_fetch_assoc($res_d)) {
	// 0 is days, 1 is description
	// Append to the list
	$dur_list .= "<option value='".$row['days']."'";
	// If this Durations # of days coresponds to the duration of this
	// auction, select it
	if ($row['days'] == $duration) {
		$dur_list .= " selected ";
	}
	$dur_list .= ">".$row['description']."</option>";
}

// CATEGORIES

$TPL_categories_list=        "<select NAME=\"category\">\n";
$categ = mysql_query("SELECT * FROM ".$DBPrefix."categories_plain");
if($categ) {
	while($categ_result=mysql_fetch_array($categ)) {
		#//  Select the translated category name
		$spaces=substr_count($categ_result['cat_name'],'&nbsp;');
		unset($tmp);
		while($spaces>0){
			$tmp .= "&nbsp;";
			$spaces--;
	}
	$categ_result['cat_name'] = $tmp.@mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$categ_result['cat_id']." AND lang='".$language."'"),0,"cat_name");
	$TPL_categories_list.=
		"        <option VALUE=\"".
		$categ_result['cat_id'].
		"\" ".
		(($categ_result['cat_id']==$category)?"SELECTED":"")
		.">".$tmp.$categ_result['cat_name']."</option>\n";
	}
}
$TPL_categories_list.="</select>\n";

$country_list="";
while (list ($code, $descr) = each ($countries)) {
	$country_list .= "<option value=\"$descr\"";
	if ($descr == $country) {
		$country_list .= " selected";
	}
	$country_list .= ">$descr</option>\n";
}

// -------------------------------------- payment
$query = "select * from ".$DBPrefix."payments";
$res = mysql_query($query);
if(!$res) {
	MySQLError($query);
	exit;
}
$TPL_payments_list = "";
while($row=mysql_fetch_assoc($res))	{
	$TPL_payments_list.="<input type=checkbox name='payment[]' value='".$row["description"]."'";
	if(is_array($payment)) {
		foreach ($payment as $k=>$v) {
			if(trim($v)==trim($row["description"])) {
				$TPL_payments_list .= " checked=true";
				break;
			}
		}
	}
	$TPL_payments_list .= " />".$row["description"]."<br>";
}
if ( intval($shipping)==1 )	$TPL_shipping1_value = " checked=true";
if ( intval($shipping)==2 )	$TPL_shipping2_value = " checked=true";
if ( !empty($international) ) $TPL_international_value = " checked=true";
	
include phpa_include("template_selltemplate_php.html");
include "./footer.php"; 
?>
