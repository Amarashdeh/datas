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

// Connect to sql server & inizialize configuration variables
include './includes/config.inc.php';
// Include messages file
include $include_path.'messages.inc.php';

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
  Header("Location: user_login.php");
  exit;
}

# Send buyer's request to the administrator
if(isset($_POST['requesttoadmin'])) {
  include $include_path."buyer_request.".$SETTINGS['defaultlanguage'].".inc.php";
  $request_sent = $MSG_25_0142;
  # Update user's status
  @mysql_query("UPDATE ".$DBPrefix."users SET accounttype='buyertoseller',reg_date=reg_date WHERE id=".$_SESSION['PHPAUCTION_LOGGED_IN']);
  $_SESSION["PHPAUCTION_LOGGED_ACCOUNT"] = 'buyertoseller';
}
switch($_GET['cptab']) {
default:
  case "account":
    $_SESSION['cptab'] = "account";
    break;
  case "selling":
    $_SESSION['cptab'] = "selling";
    break;
  case "buying":
    $_SESSION['cptab'] = "buying";
    break;
}
#// unset session variables related to About me page
unset($_SESSION['pagetitle']);
unset($_SESSION['welcome']);
unset($_SESSION['welcomemsg']);
unset($_SESSION['paragraph']);
unset($_SESSION['paragraphmsg']);
unset($_SESSION['picture']);
unset($_SESSION['auctions']);
unset($_SESSION['template']);

$prefix="";

// Build user's selling activity information
if($_SESSION['cptab'] == "selling") {
  $TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
  $NOW = date("YmdHis",$TIME);

  // Active auctions
  $query = "SELECT count(*) AS active_auctions FROM ".$DBPrefix."auctions WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' AND closed=0 AND starts<=".$NOW." AND suspended=0";
  $r__ = @mysql_query($query);
  if(!$r__) {
    MySQLError($query);
    exit;
  } else {
    $active_auctions = mysql_result($r__,0,"active_auctions");
  }

  // Closed auctions
  $query = "SELECT count(*) AS closed_auctions FROM ".$DBPrefix."auctions WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' AND closed=1 AND suspended<>8 AND (num_bids=0 OR (num_bids>0 AND reserve_price > 0 AND current_bid < reserve_price AND sold='n'))";
  $r__ = @mysql_query($query);
  if(!$r__) {
  //  MySQLError($query);/
  //  exit;
  } else {
    $closed_auctions = mysql_result($r__,0,"closed_auctions");
  }

  // Pending auctions
  $r__ = @mysql_query("SELECT COUNT(id) as COUNT FROM ".$DBPrefix."auctions WHERE user='".$_SESSION['PHPAUCTION_LOGGED_IN']."' AND starts>".$NOW." AND suspended=0");
  if(!$r__) {
    MySQLError($query);
    exit;
  } else {
    $pending_auctions =  @mysql_result($r__,0,"COUNT");;
  }

  // Suspended auctions
  $r__ = @mysql_query("SELECT count(id) as COUNT FROM ".$DBPrefix."auctions WHERE user=".$_SESSION['PHPAUCTION_LOGGED_IN']." AND closed= 0 AND suspended<>0");
  if(!$r__) {
    MySQLError($query);
    exit;
  } else {
    $suspended_auctions =  @mysql_result($r__,0,"COUNT");;
  }

  // Sold items
  $query = "SELECT DISTINCT auction FROM ".$DBPrefix."winners WHERE seller = '".$_SESSION['PHPAUCTION_LOGGED_IN']."'";
  $r__ = @mysql_query($query);
  if(!$r__) {
    MySQLError($query);
    exit;
  } else {
    $sold_items = $num_cat = mysql_num_rows($r__);
  }
}

require("header.php");
include phpa_include("template_user_menu_php.html");
include "./footer.php";

?>