<?php

require('./includes/config.inc.php');
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);

#// ################################################
#// Is the seller logged in?
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	$_SESSION["REDIRECT_AFTER_LOGIN"]="select_category.php";
	Header("Location: user_login.php");
	exit;
}

$query = "SELECT id from ".$DBPrefix."bids where auction=".intval($_GET[id]);
$result___ = mysql_query($query);
if (mysql_num_rows($result___) > 0) {
  Header("Location: index.php");
  exit;
}

#// ################################################

if(!isset($_POST['action'])) //already closed auctions
{
	#// Get Closed auctions data
	unset($_SESSION["sessionVars"]);
	unset($sessionVars);
	unset($_SESSION['RELISTEDAUCTION']);
	unset($RELISTEDAUCTION);
	unset($_SESSION['FEATURED']);
	unset($FEATURED);
	unset($_SESSION["UPLOADED_PICTURES"]);
	unset($_SESSION["UPLOADED_PICTURES_SIZE"]);
	unset($_SESSION["GALLERY_UPDATED"]);
	unset($UPLOADED_PICTURES);
	unset($UPLOADED_PICTURES_SIZE);
	unset($GALLERY_UPDATED);
	$RELISTEDAUCTION = mysql_fetch_array(@mysql_query("SELECT * FROM ".$DBPrefix."auctions WHERE id=".intval($_GET['id'])." AND user='".$_SESSION["PHPAUCTION_LOGGED_IN"]."'"));
	
	$sessionVars=array();
	$sessionVars["SELL_auction_id"] 		= $RELISTEDAUCTION['id'];
	$sessionVars["SELL_starts"] 			= $RELISTEDAUCTION['starts'];
	$sessionVars["SELL_ends"] 				= $RELISTEDAUCTION['ends'];
	$sessionVars["SELL_title"] 				= $RELISTEDAUCTION['title'];
	$sessionVars["SELL_description"] 		= $RELISTEDAUCTION['description'];
	$sessionVars["SELL_atype"] 				= $RELISTEDAUCTION['auction_type'];
	$sessionVars["SELL_adultonly"] 			= $RELISTEDAUCTION['adultonly'];
	$sessionVars["SELL_buy_now_only"] 		= $RELISTEDAUCTION['bn_only'];
	$sessionVars["SELL_suspended"] 			= $RELISTEDAUCTION['suspended'];
	$sessionVars["SELL_iquantity"]			= $RELISTEDAUCTION['quantity'];
	
	$sessionVars["SELL_minimum_bid"] 		= doubleval($RELISTEDAUCTION['minimum_bid']);
	if(doubleval($RELISTEDAUCTION['reserve_price']) > 0) {
		$sessionVars["SELL_reserve_price"] 	= doubleval($RELISTEDAUCTION['reserve_price']);
		$sessionVars["SELL_with_reserve"]	= 'yes';
		if($SETTINGS["reservefee"] == 1) {
			if($SETTINGS["reservetype"] == 1)	{
				$RESERVEFEE = doubleval(($sessionVars["SELL_reserve_price"] / 100) * $SETTINGS["reservevalue"]);
			} elseif($SETTINGS[reservetype] == 2) {
				$RESERVEFEE  = $SETTINGS["reservevalue"];
			}
			$sessionVars['OLD_RESERVEFEE']=$RESERVEFEE;
		}
	} else {
		$sessionVars["SELL_reserve_price"] 	= '';
		$sessionVars["SELL_with_reserve"]	= 'no';
		$sessionVars['OLD_RESERVEFEE']=0;
	}
	
	$_SESSION["sellcat"] 					= $RELISTEDAUCTION['category'];
	$sessionVars["SELL_sellcat"]			= $RELISTEDAUCTION['category'];

	$row=mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".intval($_SESSION['sellcat'])));
	$feesfree=$row['feesfree'];
	while($row["parent_id"]!=0)	{
		// get info about this parent
		$row=mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".$row["parent_id"]));
		$feesfree=($row['feesfree']=='y') ? 'y' : $feesfree;
	}
	$sessionVars["old_feesfree"] = $feesfree;

	
	if(doubleval($RELISTEDAUCTION['buy_now']) > 0) {
		$sessionVars["SELL_buy_now_price"] 	= doubleval($RELISTEDAUCTION['buy_now']);
		$sessionVars["SELL_with_buy_now"]	= 'yes';
	} else {
		$sessionVars["SELL_buy_now_price"] 	= '';
		$sessionVars["SELL_with_buy_now"]	= 'no';
	}
	$sessionVars["SELL_duration"] 			= $RELISTEDAUCTION['duration'];
	$sessionVars["SELL_relist"] 			= $RELISTEDAUCTION['relist'];
	if(doubleval($RELISTEDAUCTION['increment']) > 0) {
		$sessionVars["SELL_increment"] 			= "2";
		$sessionVars["SELL_customincrement"] 	= $RELISTEDAUCTION['increment'];
	} else {
		$sessionVars["SELL_increment"] 			= "1";
		$sessionVars["SELL_customincrement"] 	= '';
	}
	$sessionVars["SELL_country"] 			= $RELISTEDAUCTION['location'];
	$sessionVars["SELL_location_zip"] 		= $RELISTEDAUCTION['location_zip'];
	$sessionVars["SELL_shipping"] 			= $RELISTEDAUCTION['shipping'];
	$sessionVars["SELL_shipping_terms"]		= $RELISTEDAUCTION['shipping_terms'];
	$sessionVars["SELL_payment"] 			= explode("\n",$RELISTEDAUCTION['payment']);		
	$sessionVars["SELL_international"] 		= $RELISTEDAUCTION['international'];
	$sessionVars["SELL_imgtype"] 			= $RELISTEDAUCTION['imgtype'];
	$sessionVars["SELL_file_uploaded"] 		= $RELISTEDAUCTION['photo_uploaded'];
	$sessionVars["SELL_pict_url"] 			= $RELISTEDAUCTION['pict_url'];	
	$sessionVars["SELL_private"] 			= $RELISTEDAUCTION['private'];
	if($private != 'y') $private = 'n';
	$sessionVars["SELL_sendemail"] 			= $RELISTEDAUCTION['sendemail'];
	
	#// are there featured options selected
	$FEATURED = @mysql_fetch_array(@mysql_query("SELECT* FROM ".$DBPrefix."featured WHERE auction=".intval($_GET['id'])));
	if(@is_array($FEATURED))
	{
		$_SESSION['FEATURED']=$FEATURED;
		$sessionVars['highlighteditem'] 	= $FEATURED['highlighted'];
		$sessionVars['bolditem']			= $FEATURED['bold'];
		$sessionVars['catfeatureditem'] 	= $FEATURED['catfeatured'];
		$sessionVars['featureditem'] 		= $FEATURED['featured'];
	}
	$sessionVars['SELL_action']="edit";	
		if($sessionVars["SELL_starts"]>$NOW) {
		$sessionVars['editstartdate']= TRUE;
	}else{
		$sessionVars['editstartdate']= FALSE;
	}
	$_SESSION["sessionVars"]=$sessionVars;
	header("Location: sell.php?mode=recall");
}

?>