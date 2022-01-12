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

if (!ini_get('register_globals')) {
   $superglobales = array($_SERVER, $_ENV,
       $_FILES, $_COOKIE, $_POST, $_GET);
   /*if (isset($_SESSION)) {
       array_unshift($superglobales, $_SESSION);
   }*/
   foreach ($superglobales as $superglobal) {
       extract($superglobal, EXTR_SKIP);
   }
}

unset($MAXLENGTH);
 
#// ################################################
#// Is the seller logged in?
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	$_SESSION["REDIRECT_AFTER_LOGIN"] = "select_category.php";
	Header("Location: user_login.php");
	exit;
}
if($SETTINGS['accounttype'] == 'sellerbuyer' && $_SESSION['PHPAUCTION_LOGGED_ACCOUNT'] != 'seller' ) {
	Header("Location: user_menu.php?cptab=selling");
	exit;
}
if($SETTINGS['uniqueseller']>0 && $_SESSION["PHPAUCTION_LOGGED_IN"]!=$SETTINGS['uniqueseller']){
	Header("Location: index.php");
	exit;
}
	
#// ################################################

/**
* NOTE: Process category selection
*
*/
if($_POST['action'] == 'process' && isset($_POST['submitit']))	{
	$_SESSION['cat0'] = $_POST['cat0'];
	$_SESSION['cat1'] = $_POST['cat1'];
	$_SESSION['cat2'] = $_POST['cat2'];
	$_SESSION['cat3'] = $_POST['cat3'];
	$_SESSION['cat4'] = $_POST['cat4'];
	$_SESSION['cat5'] = $_POST['cat5'];
	$_SESSION['cat6'] = $_POST['cat6'];
	$_SESSION['cat7'] = $_POST['cat7'];
	
	$IDX = 7;
	while($IDX >= 0) {
		$VARNAME = 'cat'.$IDX;
		if(isset($_POST[$VARNAME]) && !empty($_POST[$VARNAME]))	{
			$_SESSION['sellcat'] = $_POST[$VARNAME];
			$numchild = mysql_result(mysql_query("SELECT count(cat_id) as childs FROM ".$DBPrefix."categories
						WHERE parent_id=".addslashes($_POST[$VARNAME])),0,"childs");
			if($numchild==0) {
				if(isset($_SESSION['sessionVars']) && count($_SESSION['sessionVars']) > 1)	{
					Header("Location: sell.php?mode=recall");
				} else {
					Header("Location: sell.php");
				}
				exit;
			} else {
				$_POST['box']=$IDX+1;
				$ERR=$ERR_25_0001;
				break;
			}
		}
		$IDX--;
	}
}

/**
* NOTE: Process change mode
*/
if($_GET['change'] == 'yes') {
	for($i=0;$i<8;$i++)	{
		$IDX = 'cat'.$i;
		$_POST[$IDX] = $_SESSION[$IDX];
		if($_SESSION[$IDX] == '') {
			$_POST['box'] = $i + 1;
		}
	}
} elseif(count($_POST)==0) {
	unset($_SESSION['feesfree']);
	unset($_SESSION['cattree']);
	unset($feesfree);
	unset($cattree);
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
	$TEMPLATE = @mysql_fetch_array(@mysql_query("SELECT* FROM ".$DBPrefix."selltemplates WHERE 
				user=".intval($_SESSION["PHPAUCTION_LOGGED_IN"])));
	if(is_array($TEMPLATE)) {
		$sessionVars["SELL_starts"]				= date("YmdHis",time()+$SETTINGS['timecorrection']*3600);		
		$sessionVars["SELL_title"] 				= $TEMPLATE['title'];
		$sessionVars["SELL_description"] 		= $TEMPLATE['description'];
		$sessionVars["SELL_atype"] 				= $TEMPLATE['auction_type'];
		$sessionVars["SELL_iquantity"]			= $TEMPLATE['quantity'];
		$sessionVars["SELL_minimum_bid"] 		= $TEMPLATE['minimum_bid'];
		if(doubleval($TEMPLATE['reserve_price']) > 0)
		{
			$sessionVars["SELL_reserve_price"] 	= $TEMPLATE['reserve_price'];
			$sessionVars["SELL_with_reserve"]	= 'yes';
		} else {
			$sessionVars["SELL_reserve_price"] 	= '';
			$sessionVars["SELL_with_reserve"]	= 'no';
		}
		
		$sessionVars["SELL_sellcat"]			= $TEMPLATE['category'];
		if(doubleval($TEMPLATE['buy_now']) > 0)
		{
			$sessionVars["SELL_buy_now_price"] 	= $TEMPLATE['buy_now'];
			$sessionVars["SELL_with_buy_now"]	= 'yes';
		} else {
			$sessionVars["SELL_buy_now_price"] 	= '';
			$sessionVars["SELL_with_buy_now"]	= 'no';
		}
		$sessionVars["SELL_duration"] 			= $TEMPLATE['duration'];
		$sessionVars["SELL_relist"] 			= $TEMPLATE['relist'];
		if(doubleval($TEMPLATE['increment']) > 0)
		{
			$sessionVars["SELL_increment"] 			= "2";
			$sessionVars["SELL_customincrement"] 	= $TEMPLATE['increment'];
		} else {
			$sessionVars["SELL_increment"] 			= "1";
			$sessionVars["SELL_customincrement"] 	= '';
		}
		$sessionVars["SELL_country"] 			= $TEMPLATE['location'];
		$sessionVars["SELL_location_zip"] 		= $TEMPLATE['location_zip'];
		$sessionVars["SELL_shipping"] 			= $TEMPLATE['shipping'];
		$sessionVars["SELL_shipping_terms"]		= $TEMPLATE['shipping_terms'];
		$sessionVars["SELL_payment"] 			= explode("/n",$TEMPLATE['payment']);
		$sessionVars["SELL_international"] 		= $TEMPLATE['international'];
		$sessionVars['highlighteditem'] 		= $TEMPLATE['highlighted'];
		$sessionVars['bolditem']				= $TEMPLATE['bold'];
		$sessionVars['catfeatureditem'] 		= $TEMPLATE['catfeatured'];
		$sessionVars['featureditem'] 			= $TEMPLATE['featured'];
		$sessionVars["SELL_buy_now_only"] 		= $TEMPLATE['bn_only'];
		$_SESSION['sessionVars']				= $sessionVars;
		$_SESSION["sellcat"] 					= $TEMPLATE['category'];
		Header("Location: sell.php?mode=recall");
		exit;
	}
}
unset($_SESSION['CATSTRING']);
unset($_SESSION['CATEGORY']);


$_SESSION['cat0'] = $_POST['cat0'];
$_SESSION['cat1'] = $_POST['cat1'];
$_SESSION['cat2'] = $_POST['cat2'];
$_SESSION['cat3'] = $_POST['cat3'];
$_SESSION['cat4'] = $_POST['cat4'];
$_SESSION['cat5'] = $_POST['cat5'];
$_SESSION['cat6'] = $_POST['cat6'];
$_SESSION['cat7'] = $_POST['cat7'];


/**
* NOTE: Build the categories arrays
*
*/
$query = "SELECT cat_id,cat_name FROM ".$DBPrefix."categories WHERE parent_id=0 ORDER BY cat_name";
$res = @mysql_query($query);
if(!$res) {
	MySQLError($query);
	exit;
} elseif(mysql_num_rows($res) > 0) {
	while($row = mysql_fetch_array($res)) {
		#// Check to see if this category has subcategoryes
		$CHILDRENS = mysql_num_rows(mysql_query("SELECT cat_id FROM ".$DBPrefix."categories WHERE parent_id=".$row['cat_id']));
		#//  Select the translated category name
		$row['cat_name'] = stripslashes(@mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$row['cat_id']." AND lang='".$language."'"),0,"cat_name"));

		$CATS0[$row['cat_id']] = stripslashes($row['cat_name']);
		if(strlen($row['cat_name']) > $MAXLENGTH) $MAXLENGTH = strlen($row['cat_name']);
		if($CHILDRENS > 0) {
			$CATS0[$row['cat_id']] .= "&nbsp;->";
			$DONTSUBMIT[$row['cat_id']] = 0;
		} else {
			$DONTSUBMIT[$row['cat_id']] = 1;
		}
		
	}
}

/**
* NOTE: Build sub-boxes
*
*/
$TMP = "cat".($_POST['box']-1);
$YY = "S".$$TMP;
$SHOWBUTTON = $$YY;
if($_GET['change'] == 'yes') $SHOWBUTTON = 1;
if($_POST['box'] > 0) {
	$I = 1;
	while($I <= $_POST['box']) {
		$IDX = $I-1;
		$NAME = "cat".$IDX;
		
		if($$NAME != '') {
			$query = "SELECT cat_id,cat_name FROM ".$DBPrefix."categories WHERE parent_id=".$$NAME."  ORDER BY cat_name";
			$res = @mysql_query($query);
			if(!$res) {
				MySQLError($query);
				exit;
			} elseif(mysql_num_rows($res) > 0) {
				unset($row);
				while($row = mysql_fetch_array($res)) {
					$ARRAYNAME = "CATS".$I;
					#// Check to see if this category has subcategoryes
					$CHILDRENS = mysql_num_rows(mysql_query("SELECT cat_id FROM ".$DBPrefix."categories WHERE parent_id=".$row['cat_id']));
					#//  Select the translated category name
					$row['cat_name'] = stripslashes(@mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$row['cat_id']." AND lang='".$language."'"),0,"cat_name"));
					${$ARRAYNAME}[$row['cat_id']] = stripslashes($row['cat_name']);
					if(strlen($row['cat_name']) > $MAXLENGTH) $MAXLENGTH = strlen($row['cat_name']);
					if($CHILDRENS > 0) {
						${$ARRAYNAME}[$row['cat_id']] .= "&nbsp;->";
						$DONTSUBMIT[$row['cat_id']] = 0;
					} else {
						$DONTSUBMIT[$row['cat_id']] = 1;
					}
				}
			}
		}
		$I++;
	}
}

include "header.php";

?>
	<style type="text/css">.box {hight: 100; width:300;}</style>

	<script type="text/javascript">
	function SubmitBoxes(N,BOX) {
		SELECTION = eval("document.catform."+BOX+".selectedIndex");
		SELECTNAME = "document.catform."+BOX+".options["+SELECTION+"].value";
		DONTSUBMIT = "document.catform.S"+eval(SELECTNAME)+".value";
		document.catform.box.value = N;
		document.catform.submit();
		
		/*
		if(eval(SELECTNAME) != '' && eval(DONTSUBMIT) == 0)
		{
		document.catform.box.value = N;
		document.catform.submit();
		}
		*/
	}
	</script>
<?php
include phpa_include("template_select_category_php.html");
include "footer.php";
?>
