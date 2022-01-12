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

include './includes/config.inc.php';
include $include_path.'dates.inc.php';
include $include_path.'auction_types.inc.php';
include $include_path.'countries.inc.php';
include $include_path.'datacheck.inc.php';
include $include_path.'wordfilter.inc.php';
include $include_path.'converter.inc.php';
include "fck/fckeditor.php";

if (!ini_get('register_globals')) {
   $superglobales = array($_SERVER, $_ENV,
       $_FILES, $_COOKIE, $_POST, $_GET);
   if (isset($_SESSION)) {
       array_unshift($superglobales, $_SESSION);
   }
   foreach ($superglobales as $superglobal) {
       extract($superglobal, EXTR_SKIP);
   }
}

#//
if(!isset($_SESSION["FEE"])) {
    $_SESSION["FEE"] = 0;
}
/**
* NOTE: check category selection
* Category must be pre-selected in select_category.php
* and it must be stored in a session variable ($_SESSION['category']
*/
if(!isset($_SESSION['sellcat']) || !is_numeric($_SESSION['sellcat'])) {
  Header("Location: select_category.php");
  exit;
}
#// ################################################
#// Is the seller logged in?
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
  $_SESSION["REDIRECT_AFTER_LOGIN"]= "sell.php";
  
  Header("Location: user_login.php");
  exit;
}
if($SETTINGS['accounttype'] == 'sellerbuyer' && $_SESSION['PHPAUCTION_LOGGED_ACCOUNT'] != 'seller' ) {
  Header("Location: user_menu.php?cptab=selling");
  exit;
}
#// ################################################

#// #############################################################################
function getsubtree($catsubtree,$i) {
  global $catlist;
  $res=mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE parent_id=".$catsubtree[$i]);
  while($row=mysql_fetch_assoc($res)) {
    // get info about this parent
    $catlist[]=$row['cat_id'];
    $catsubtree[$i+1]=$row['cat_id'];
    getsubtree($catsubtree,$i+1);
  }
}

//-- Genetares the AUCTION's unique ID -----------------------------------------------
function generate_id() {
  if(!isset($_SESSION["sessionVars"]["SELL_auction_id"])) {
    $auction_id = md5(uniqid(rand()));
    $_SESSION["sessionVars"]["SELL_auction_id"] = $auction_id;
  } else {
    $auction_id = $_SESSION["sessionVars"]["SELL_auction_id"];
  }
  return $auction_id;
}
#// ---------------------------------------------------------------------------------
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);
$minimum_bid = 0.99;

if (empty($action)) {
  $_SESSION["FEE"]=0;
  /**
  * NOTE: Retrieve selected category
  *
  */
  // category name
  $cattree=array();
  $row=mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".intval($_SESSION['sellcat'])));
  $feesfree=$row['feesfree'];
  $cattree[]=$_SESSION['sellcat'];
  #//  Select the translated category name
  $row['cat_name'] = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$_SESSION['sellcat']." AND lang='".$language."'"),0,"cat_name");
  $TPL_categories_list = $row["cat_name"];

  while($row["parent_id"]!=0)  {
    $P = $row['parent_id'];
  // get info about this parent
    $row=mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".$row["parent_id"]));
    $feesfree=($row['feesfree']=='y') ? 'y' : $feesfree;
    $cattree[]=$row['cat_id'];
    #//  Select the translated category name
    $row['cat_name'] = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$P." AND lang='".$language."'"),0,"cat_name");
    $TPL_categories_list = $row["cat_name"]." &gt; ".$TPL_categories_list;
  }
  $_SESSION['feesfree']=$feesfree;
  $_SESSION['cattree']=$cattree;
  // initialize some variables here
  
  if ($mode=="recall") {
    // recall the variables from current session
    $sessionVars = $_SESSION["sessionVars"];
    if(isset($RELISTEDAUCTION) && !isset($sessionVars["SELL_auction_id"])) {
      // if first time generates a new auction id
      $auction_id = generate_id();
      // copy uploaded image and uploaded gallery
      if($sessionVars["SELL_file_uploaded"]) {
        copy($image_upload_path.$sessionVars["SELL_pict_url"],$image_upload_path.$auction_id.substr($sessionVars["SELL_pict_url"],-4));
        $sessionVars["SELL_pict_url"]=$auction_id.substr($sessionVars["SELL_pict_url"],-4);
      }
      unset($UPLOADED_PICTURES);
      unset($UPLOADED_PICTURES_SIZE);
      unset($GALLERY_UPDATED);
      unset($_SESSION["UPLOADED_PICTURES"]);
      unset($_SESSION["UPLOADED_PICTURES_SIZE"]);
      unset($_SESSION["GALLERY_UPDATED"]);
      if(is_dir($image_upload_path.$sessionVars["SELL_auction_id_old"])) {
        umask();
        if(!file_exists($image_upload_path.session_id())) {
          umask();
          mkdir($image_upload_path.session_id(),0777);
        }
        #// Move uploaded file into TMP directory
        $dir=@opendir($image_upload_path.$sessionVars["SELL_auction_id_old"]);
        while ($file=readdir($dir)) {
          if(!is_dir($image_upload_path.$sessionVars["SELL_auction_id_old"]."/".$file)) {
            copy($image_upload_path.$sessionVars["SELL_auction_id_old"]."/".$file,
            $image_upload_path.session_id()."/".$file);
            chmod($image_upload_path.session_id()."/".$file,0777);
            #//Populate arrays
            $UPLOADED_PICTURES[] = $file;
            $UPLOADED_PICTURES_SIZE[] = filesize($image_upload_path.session_id()."/".$file);
          }
        }
        $_SESSION["UPLOADED_PICTURES"] = $UPLOADED_PICTURES;
        $_SESSION["UPLOADED_PICTURES_SIZE"] = $UPLOADED_PICTURES_SIZE;
        $_SESSION["GALLERY_UPDATED"]=true;
      }
    } else {
      if($sessionVars['SELL_action']=='edit') {
        $sessionVars['OLD_MINBID'] = $sessionVars["SELL_minimum_bid"];
        unset($_SESSION['RELISTEDAUCTION']);
        unset($RELISTEDAUCTION);
        $auction_id = $sessionVars["SELL_auction_id"];
      } else {
        $sessionVars['OLD_MINBID'] = 0;
      }
      if(!isset($_SESSION["UPLOADED_PICTURES"])) {
        unset($UPLOADED_PICTURES);
        unset($UPLOADED_PICTURES_SIZE);
        unset($GALLERY_UPDATED);
        unset($_SESSION["UPLOADED_PICTURES"]);
        unset($_SESSION["UPLOADED_PICTURES_SIZE"]);
        unset($_SESSION["GALLERY_UPDATED"]);
        if(isset($sessionVars["SELL_auction_id"]) && is_dir($image_upload_path.$sessionVars["SELL_auction_id"])) {
          umask();
          if(!file_exists($image_upload_path.session_id())) {
            umask();
            mkdir($image_upload_path.session_id(),0777);
          }
          #// Move uploaded file into TMP directory
          $dir=@opendir($image_upload_path.$sessionVars["SELL_auction_id"]);
          while ($file=readdir($dir)) {
            if(!is_dir($image_upload_path.$sessionVars["SELL_auction_id"]."/".$file)) {
              $isz=@getimagesize($image_upload_path.$sessionVars["SELL_auction_id"]."/".$file);
              if(is_array($isz)) {
                copy($image_upload_path.$sessionVars["SELL_auction_id"]."/".$file,
                $image_upload_path.session_id()."/".$file);
                chmod($image_upload_path.session_id()."/".$file,0777);
                #//Populate arrays
                $UPLOADED_PICTURES[] = $file;
                $UPLOADED_PICTURES_SIZE[] = filesize($image_upload_path.session_id()."/".$file);
              }
            }
          }
          $_SESSION["UPLOADED_PICTURES"] = $UPLOADED_PICTURES;
          $_SESSION["UPLOADED_PICTURES_SIZE"] = $UPLOADED_PICTURES_SIZE;
          $_SESSION["GALLERY_UPDATED"]=true;
          if($sessionVars['SELL_action']=='edit') {
            $sessionVars["OLD_GALLERYFEE"] = $SETTINGS["picturesgalleryvalue"] * count($UPLOADED_PICTURES);
          } else {
            $sessionVars["OLD_GALLERYFEE"] = 0;
          }
        }
      }
    }
    $with_reserve = $sessionVars["SELL_with_reserve"];
    $reserve_price = $sessionVars["SELL_reserve_price"];
    $minimum_bid = $sessionVars["SELL_minimum_bid"];
    $pict_url=$sessionVars["SELL_pict_url"];
    $imgtype = $sessionVars["SELL_file_uploaded"];
    $title = $sessionVars["SELL_title"];
    $description = stripslashes($sessionVars["SELL_description"]);
    $pict_url = $sessionVars["SELL_pict_url"];
    $atype = $sessionVars["SELL_atype"];
    $adultonly = $sessionVars["SELL_adultonly"];
    $iquantity = $sessionVars["SELL_iquantity"];
    $buy_now = $sessionVars["SELL_with_buy_now"];
    $buy_now_price = $sessionVars["SELL_buy_now_price"];
    $duration = $sessionVars["SELL_duration"];
    $relist = $sessionVars["SELL_relist"];
    $increments = $sessionVars["SELL_increments"];
    $customincrement = $sessionVars["SELL_customincrement"];
    $shipping = $sessionVars["SELL_shipping"];
    $shipping_terms = $sessionVars["SELL_shipping_terms"];
    $payment = $sessionVars["SELL_payment"];
    $international = ($sessionVars["SELL_international"])?"on":"";
    $sellcat = $_SESSION['sellcat'];
    $private = $sessionVars["SELL_private"];
    if($private != 'y') $private = 'n';
    $sendemail = $sessionVars["SELL_sendemail"];
    $txt = $sessionVars["SELL_txt"];
    $num = $sessionVars["SELL_num"];
    $buy_now_only = $sessionVars["SELL_buy_now_only"];
    
    // auction starts
    $time = mktime(  substr($sessionVars["SELL_starts"], 8, 2),
    substr($sessionVars["SELL_starts"], 10, 2),
    substr($sessionVars["SELL_starts"], 12, 2),
    substr($sessionVars["SELL_starts"], 4, 2),
    substr($sessionVars["SELL_starts"], 6, 2),
    substr($sessionVars["SELL_starts"], 0, 4));
    $a_starts = date("Y-m-d H:i:s",$time);
  } else {
    // auction type
    unset($_SESSION["sessionVars"]);
    unset($sessionVars);
    unset($_SESSION['RELISTEDAUCTION']);
    unset($RELISTEDAUCTION);
    unset($_SESSION['FEATURES']);
    unset($FEATURES);
    unset($_SESSION["UPLOADED_PICTURES"]);
    unset($_SESSION["UPLOADED_PICTURES_SIZE"]);
    unset($_SESSION["GALLERY_UPDATED"]);
    unset($UPLOADED_PICTURES);
    unset($UPLOADED_PICTURES_SIZE);
    unset($GALLERY_UPDATED);
    reset($auction_types);
    list($atype,) = each($auction_types);
    $sessionVars["categoriesList"] = $TPL_categories_list;
    // quantity of items
    $iquantity = 1;
    // shipping
    $shipping = 1;
    $time = time()+$SETTINGS['timecorrection']*3600;
    $a_starts = date("Y-m-d H:i:s",$time);
    // image type
    $imgtype = 1;
    $with_reserve = "no";
  }
} elseif($action=='first') {
  $TPL_categories_list = $sessionVars['categoriesList'];
  $_SESSION["FEE"] = 0;
  /* generate a auction ID on this step */
  $auction_id = generate_id();
  //  $sessionVars=array();
  if(isset($upd_pict_url)) {
    $sessionVars["SELL_pict_url"] = $upd_pict_url;
    $sessionVars["SELL_file_uploaded"] = $imgtype;
  }
  $sessionVars['SELL_varval'] = array();
  if(isset($ntxt)) {
    foreach($ntxt as $k=>$v) {
      if(empty($v) && isset($txt[$k]) && !empty($txt[$k])) {
        $ntxt[$k]=urldecode($txt[$k]);
      }
      $sessionVars["SELL_varval"]["txt$k"] = stripslashes($ntxt[$k]);
    }
  }
  if(isset($nnum)) {
    foreach($nnum as $k=>$v) {
      if(empty($v) && isset($num[$k]) && !empty($num[$k])) {
        $nnum[$k] = $num[$k];
      }
      $sessionVars["SELL_varval"]["num$k"] = $nnum[$k];
    }
  }
  
  if($imgtype==1 && !empty($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "none") {
    // move uploaded file in right place
    //set uploaded file path session variable
    //empty linked file path session variable
    $inf = GetImageSize ($_FILES['userfile']['tmp_name']);
    $er = false;
    // make a check
    if ($inf) {
      $inf[2] = intval($inf[2]); // check for uploaded file type
      if ( $inf[2]<1 || $inf[2]>3 ) {
        $er = true;
        $ERR = "ERR_602";
      } elseif ( intval($userfile_size) > $SETTINGS['maxuploadsize'] ) {
        $er = true;
        $ERR = "ERR_603";
      } else {
        switch($inf[2]) {
          case 1: $ext = ".gif";
          break;
          case 2: $ext = ".jpg";
          break;
          case 3: $ext = ".png";
          break;
        }
        $uploaded_filename = $auction_id.$ext;
        $fname = $image_upload_path.$uploaded_filename;
        if (file_exists($fname)) {
          unlink ($fname);
        }
        move_uploaded_file($_FILES['userfile']['tmp_name'],$fname);
        chmod($fname,0777);
        $sessionVars["SELL_pict_url"] = $uploaded_filename;
        $sessionVars["SELL_file_uploaded"] = $imgtype;
      }
    } else {
      $ERR = "ERR_602";
      $er = true;
    }
  } elseif($imgtype==0 && !empty($pict_url)) {
    //control if uploaded file path session variable
    //if yes delete already uploaded files
    //empty uploaded file path session variable
    if ($sessionVars["SELL_file_uploaded"]) {
      unlink($image_upload_path.$sessionVars["SELL_pict_url"]);
    }
    $ext=strtolower(substr($pict_url,-3));
    if($ext!="gif" && $ext!="jpg" && $ext!="png") {
      $ERR = "ERR_602";
    } else {
      $sessionVars["SELL_pict_url"] = $pict_url;
      $sessionVars["SELL_file_uploaded"] = $imgtype;
    }
  }
  // perform data check here
  if(!$ERR)  $ERR = "ERR_".CheckSellData();
}

/*  if script called the first time OR
an error occured THEN
display form
*/
if ( empty($action) || (($action=='first') && ($$ERR)) ) {
  // display form here
  include "header.php";
  
  // simple fields
  $titleH =  htmlspecialchars($title);
  $descriptionH = stripslashes($description);
  $pict_urlH = ($imgtype)? '': htmlspecialchars($pict_url);
  if( intval($imgtype)==0 ) {
    // URL specified
    if ( strlen($sessionVars["SELL_pict_url"])==0 ) {
      $TPL_pict_URL_value = $MSG_114;
    } else {
      $TPL_pict_URL_value = "<img src=\"".$sessionVars["SELL_pict_url"]."\" alt=\"picture\" /><br>(".$sessionVars["SELL_pict_url"].")";
    }
  } else {
    // a file uploaded
    if ( empty($sessionVars["SELL_pict_url"]) ) {
      $TPL_pict_URL_value = $MSG_114;
    } else {
      $TPL_pict_URL_value = "<img src=\"".$uploaded_path.$sessionVars["SELL_pict_url"]."\" alt=\"picture\" /><br>( $MSG_2__0084 ".$sessionVars["SELL_pict_url"].")";
    }
  }
  
  // ------------------------------------- auction type
  $TPL_auction_type=  "<select name=\"atype\">\n";
  reset($auction_types);
  while(list($key,$val)=each($auction_types)){
    $TPL_auction_type.="\t<option value=\"".$key."\" ".(($key==$atype)?"SELECTED":"").">".$val."</option>\n";
  }
  $TPL_auction_type.="</select>\n";
  if($sessionVars['SELL_adultonly']=='y'){
    $TPL_adultonly = $MSG_030;
  }else{
    $TPL_adultonly = $MSG_029;
  }
  // ------------------------------------- duration
  $query = "select * from ".$DBPrefix."durations order by days";
  $res = mysql_query($query);
  if(!$res)  {
    MySQLError($query);
    exit;
  }
  $TPL_start_date=$a_starts;
  $TPL_durations_list="<select name=\"duration\">\n";
  while($row = mysql_fetch_assoc($res)){
    $TPL_durations_list.= "\t<option value='".$row["days"]."' ".(($row["days"] == $duration)?"selected":"").">".$row["description"]."</option>\n";
  }
  $TPL_durations_list.="</select>\n";
  
  // -------------------------------------- payment
  $query = "select * from ".$DBPrefix."payments";
  $res = mysql_query($query);
  if(!$res) {
    MySQLError($query);
    exit;
  }
  $TPL_payments_list = "";
  while($row=mysql_fetch_assoc($res))  {
    $TPL_payments_list.="<input type='checkbox' name='payment[]' value='".$row["description"]."'";
    if(is_array($payment)) {
      foreach ($payment as $k=>$v) {
        if(trim($v)==trim($row["description"])) {
          $TPL_payments_list .= " CHECKED";
          break;
        }
      }
    }
    $TPL_payments_list .= ">".$row["description"]."<br>";
  }
  
  // -------------------------------------- shipping
  if ( intval($shipping)==1 )  $TPL_shipping1_value = "CHECKED";
  if ( intval($shipping)==2 )  $TPL_shipping2_value = "CHECKED";
  if ( !empty($international) ) $TPL_international_value = "CHECKED";
  $TPL_shipping_terms=stripslashes($shipping_terms);
  
  // -------------------------------------- reserved price
  if ( $with_reserve=="yes" )
  $TPL_with_reserve_selected = "CHECKED";
  else
  $TPL_without_reserve_selected = "CHECKED";
  // -------------------------------------- adult only
  if ( $adultonly=="y" )
  $TPL_adultonly = " CHECKED";
  else
  $TPL_no_adultonly = " CHECKED";
  // -------------------------------------- buy now
  if ( $buy_now=="yes" )
  $TPL_with_buy_now_selected = "CHECKED";
  else
  $TPL_without_buy_now_selected = "CHECKED";

  if ( $buy_now_only=='y' )
  $TPL_with_buy_now_only = " CHECKED";
  else
  $TPL_without_buy_now_only = " CHECKED";
  
  // -------------------------------------- photo source
  if (intval($imgtype)==1)
  $TPL_imgtype2_SELECTED = "CHECKED";
  else
  $TPL_imgtype1_SELECTED = "CHECKED";
  
  $TPL_error_value = $$ERR;
  
  // update current session
  if ( isset($sessionVars["SELL_DATA_CORRECT"]) )
  unset($sessionVars["SELL_DATA_CORRECT"]);
  $_SESSION["sessionVars"] = $sessionVars;
  
  // include corresponding templates/template and exit
  include phpa_include("template_sell_php.html");
  include "footer.php";
  exit;
}

/*  all data are ok.
TODO: update current session variables and proceed further
*/
if ($action == "first" && ($ERR == 'ERR_' || !isset($ERR))) {
  // auction title
  if($SETTINGS['wordsfilter'] == 'y') {
    $sessionVars["SELL_title"] = strip_tags(Filter($title));
  } else {
    $sessionVars["SELL_title"] = strip_tags($title);
  }
  
  // auction description
  if($SETTINGS['wordsfilter'] == 'y') {
    $sessionVars["SELL_description"] = Filter(stripslashes($description));
  } else {
    $sessionVars["SELL_description"] = stripslashes($description);
  }
  // auction variants
  $sessionVars['SELL_varval'] = array();
  if(isset($ntxt)) {
    foreach($ntxt as $k=>$v) {
      if(empty($v) && isset($txt[$k]) && !empty($txt[$k])) {
        $ntxt[$k]=urldecode($txt[$k]);
      }
      $sessionVars["SELL_varval"]["txt$k"] = $ntxt[$k];
    }
    $sessionVars["SELL_txt"] = $ntxt;
  }
  if(isset($nnum)) {
    foreach($nnum as $k=>$v) {
      if(empty($v) && isset($num[$k]) && !empty($num[$k])) {
        $nnum[$k]=$num[$k];
      }
      $sessionVars["SELL_varval"]["num$k"] = $nnum[$k];
    }
    $sessionVars["SELL_num"] = $nnum;
  }
  // data from "picture URL" input field
  //  $sessionVars["SELL_pict_url_original"] = $pict_url;
  // auction type
  $sessionVars["SELL_atype"] = $atype;
  $sessionVars["SELL_adultonly"] = $adultonly;
  // quantity of items for sale
  $sessionVars["SELL_iquantity"] = $iquantity;
  // minimum bid
  $sessionVars["SELL_minimum_bid"] = $minimum_bid;
  // increments information
  $sessionVars["SELL_increments"] = $increments;
  $sessionVars["SELL_customincrement"] = input_money($customincrement);
  // reserved price flag
  $sessionVars["SELL_with_reserve"] = $with_reserve;
  // reserved price value
  $sessionVars["SELL_reserve_price"] = $reserve_price;
  // buy now
  $sessionVars["SELL_with_buy_now"] = $buy_now;
  $sessionVars["SELL_buy_now_only"] = $buy_now_only;
  
  // buy now price value
  $sessionVars["SELL_buy_now_price"] = $buy_now_price;
  // auction start
  $time = mktime(  substr($a_starts, 11, 2),
  substr($a_starts, 14, 2),
  substr($a_starts, 17, 2),
  substr($a_starts, 5, 2),
  substr($a_starts, 8, 2),
  substr($a_starts, 0, 4));
  
  $sessionVars["SELL_starts"] = date('YmdHis',$time);
  // auction duration
  $sessionVars["SELL_duration"] = $duration;
  // auction relist
  $sessionVars["SELL_relist"] = $relist;
  // shipping method
  $sessionVars["SELL_shipping"] = $shipping;
  $sessionVars["SELL_shipping_terms"] = $shipping_terms;
  // international shipping
  $sessionVars["SELL_international"] = (strlen($international)==0) ? false : true;
  // payment methods: text and index
  reset($payment);
  while(list($key,$val) = each($payment))  {
    $SELL_payment[$key] = $payment[$key];
  }
  $sessionVars["SELL_payment"] = $payment;
  // category ID
  $sessionVars["SELL_sellcat"] = $_SESSION['sellcat'];
  // image type
  //  $sessionVars["SELL_imgtype"] = $imgtype;
  
  if($sendemail == 'y') {
    $sessionVars["SELL_sendemail"] = $sendemail;
  } else {
    $sessionVars["SELL_sendemail"] = 'n';
  }
  
  // set that first step is passed
  $sessionVars["SELL_DATA_CORRECT"] = true;
  $_SESSION["sessionVars"] = $sessionVars;
}

// check second data - login and password
if ( $action=="second") {
  $nickH = htmlspecialchars($nick);
  $FEE=0;
  $result = mysql_query("SELECT * FROM ".$DBPrefix."users WHERE nick='".AddSlashes($nick)."'");
  if ($result) {
    $num = mysql_num_rows($result);
  } else {
    $num = 0;
    $ERR = "ERR_025";
  }
  if ($num>0 || ($num == 0 && $SETTINGS['usersauth']))  {
    $userrec=mysql_fetch_assoc($result);
    if ((md5($MD5_PREFIX.$password) != $userrec["password"]) && $SETTINGS['usersauth'] == 'y')  {
      $ERR = "ERR_026";
    } else {
      if($userrec["suspended"] > 0) {
        $ERR = "ERR_618";
      }
    }
  }
  $_SESSION["FEE"]=$FEE;
}


if ( ($action=="first" && !$$ERR) || ($action=="second" && $$ERR) ) {
  // error text
  $TPL_error = $$ERR;
  // title text
  $TPL_title_value = strip_tags($sessionVars["SELL_title"]);
  // description text
  $TPL_description_shown_value = stripslashes(nl2br($sessionVars["SELL_description"]));
  // picture URL
  if( intval($sessionVars["SELL_file_uploaded"])==0 ) {
    // URL specified
    if ( strlen($sessionVars["SELL_pict_url"])==0 ) {
      $TPL_pict_URL_value = $MSG_114;
    } else {
      $TPL_pict_URL_value = "<img src=\"".$sessionVars["SELL_pict_url"]."\" alt=\"picture\" />";
    }
  } else {
    // a file uploaded
    if ( empty($sessionVars["SELL_pict_url"]) ) {
      $TPL_pict_URL_value = $MSG_114;
    } else {
      $TPL_pict_URL_value = "<img src=\"".$uploaded_path.$sessionVars["SELL_pict_url"]."\" alt=\"picture\" />";
    }
  }
  // minimum bid
  $TPL_minimum_bid_value = print_money($sessionVars["SELL_minimum_bid"]);
  
  $TPL_setup_fee = "";
  $TPL_gallery_fee = "";

  // reserved price
  if ($sessionVars["SELL_with_reserve"]=="yes") {
    $TPL_reserve_price_displayed = print_money($sessionVars["SELL_reserve_price"]);
    
    if($feesfree=='n') {
      $TPL_reserve_fee = "<br><table width='100%' CELLPADDING=2 CELLSPACING=0 BORDER=0 BGCOLOR='#FFEB6B'>
                          <tr><td>$MSG_9005".print_money($sessionVars["RESERVEFEE"])."</td></tr></table>";
    } else {
      $TPL_reserve_fee = "<br><table width='100%' CELLPADDING=2 CELLSPACING=0 BORDER=0 BGCOLOR='#FFEB6B'>
                          <tr><td class=errfont >$MSG_9005".print_money(0)." (".$MSG_25_0222 ." ".print_money($sessionVars["RESERVEFEE"]).")</td></tr></table>";
    }
  } else {
    $TPL_reserve_price_displayed = "no ";
  }
  // buy now
  if ($sessionVars["SELL_with_buy_now"]=="yes") {
    $TPL_buy_now_price_displayed = print_money($sessionVars["SELL_buy_now_price"]);
  } else {
    $TPL_buy_now_price_displayed = "no ";
  }
  // buy now only
  if ($sessionVars["SELL_buy_now_only"]=="y") {
    $TPL_buy_now_only_displayed = $MSG_030;
  } else {
    $TPL_buy_now_only_displayed = " No";
  }
  
  // auction duration
  //--
  $query = "select description from ".$DBPrefix."durations where days = " . $sessionVars["SELL_duration"];
  $res = mysql_query($query) or die(__LINE__.mysql_error().$query);
  $time = mktime(  substr($sessionVars["SELL_starts"], 8, 2),
  substr($sessionVars["SELL_starts"], 10, 2),
  substr($sessionVars["SELL_starts"], 12, 2),
  substr($sessionVars["SELL_starts"], 4, 2),
  substr($sessionVars["SELL_starts"], 6, 2),
  substr($sessionVars["SELL_starts"], 0, 4));
  $a_starts = FormatDate(date("YmdHis",$time));
  $TPL_start_date = $a_starts;
  $TPL_durations_list = mysql_result($res,0,"description");
  $TPL_relist = $sessionVars["SELL_relist"];
  
  #// Bids increment
  if($sessionVars["SELL_increments"] == 1) {
    $TPL_increments = $MSG_614;
  } else {
    $TPL_increments = print_money($sessionVars["SELL_customincrement"]);
  }
  // auction type
  $TPL_auction_type = $auction_types[$sessionVars["SELL_atype"]];
  if ( intval($sessionVars["SELL_atype"])==2 ) {
    $TPL_auction_type .= "</td></tr><tr><td ALIGN=RIGHT><B>Quantity:</B> </td><td>".$sessionVars["SELL_iquantity"]."</td></tr>";
  }
  if($sessionVars['SELL_adultonly']=='y'){
    $TPL_adultonly = $MSG_030;
  }else{
    $TPL_adultonly = $MSG_029;
  }
  
  // shipping
  if ( intval($sessionVars["SELL_shipping"]) == 1 ) {
    $TPL_shipping_value = $MSG_031;
  } else {
    $TPL_shipping_value = $MSG_032;
  }
  if ( $sessionVars["SELL_international"] ) {
    $TPL_international_value  = "<br>$MSG_033";
  } else {
    $TPL_international_value  = "<br>$MSG_043";
  }
  $TPL_shipping_terms=nl2br(stripslashes($sessionVars["SELL_shipping_terms"]));
  // payment methods
  $query = "select * from ".$DBPrefix."payments";
  $res_payments = mysql_query($query);
  if(!$res_payments)  {
    MySQLError($query);
    exit;
  }
  while($pay = mysql_fetch_array($res_payments))  {
    if(in_array($pay['description'], $sessionVars["SELL_payment"])) {
      $TPL_payment_methods .= $pay["description"]."<br>";
    }
  }
  // category name
  $row=mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".intval($sessionVars["SELL_sellcat"])));
  $TPL_categories_list = $row["cat_name"];
  while($row["parent_id"]!=0)  {
    // get info about this parent
    $row=mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".$row["parent_id"]));
    $TPL_categories_list = $row["cat_name"]." &gt; ".$TPL_categories_list;
  }
  $sessionVars["categoriesList"] = $TPL_categories_list;

  $TPL_feat_fee = "";
  $TPL_catfeat_fee = "";
  $TPL_high_fee = "";
  $TPL_bold_fee = "";
  
  $_SESSION["sessionVars"] = $sessionVars;
  include "header.php";
  include phpa_include("template_sell_preview_php.html");
  include "footer.php";
  exit;
}

if ($action=='second' && !$$ERR)
{
  //-- If a suggested category is present send an e-mail
  //-- to the site administrator
  if($suggested_category) {
    $to     = $SETTINGS['adminmail'];
    $subject  = $MSG_254;
    $message  = $suggested_category."\n".
    $MSG_255.
    $sessionVars["SELL_auction_id"];
    mail($to,$subject,$message,"From: ".$SETTINGS[sitename]." <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");
    
  }
  // really add item to database and display confirmation message
  if ( !$sessionVars["SELL_DATA_CORRECT"] )
  header ( "Location: sell.php" );
  
  // prepare some things
  $query = "select * from ".$DBPrefix."payments";
  $res_payments = mysql_query($query);
  if(!$res_payments) {
    MySQLError($query);
    exit;
  }
  // payments list
  $payment_text = "";
  while($paym=mysql_fetch_assoc($res_payments)) {
    if (in_array($paym["description"],$sessionVars["SELL_payment"]))
    $payment_text .= $paym["description"]."\n";
  }
  // auction starts
  /*
  if($sessionVars["SELL_action"]=='edit'){
  */
  $time = mktime(  substr($sessionVars["SELL_starts"], 8, 2),
  substr($sessionVars["SELL_starts"], 10, 2),
  substr($sessionVars["SELL_starts"], 12, 2),
  substr($sessionVars["SELL_starts"], 4, 2),
  substr($sessionVars["SELL_starts"], 6, 2),
  substr($sessionVars["SELL_starts"], 0, 4));
  $a_starts = date("YmdHis",$time);
  // auction ends
  $a_ends = $time+($sessionVars["SELL_duration"]*24*60*60);
  $a_ends = date("YmdHis", $a_ends);
  #//======================================================
  #
  #//======================================================
  unset($SUSPENDED);
  $SUSPENDED = 0;

  if($sessionVars['SELL_suspended']==1) $SUSPENDED = -1;
  if($sessionVars["SELL_buy_now_only"]!='y'){
    $sessionVars["SELL_buy_now_only"] = 'n';
  }
  if($SETTINGS['adultonly']=='n'){
    $sessionVars['SELL_adultonly'] = 'n';
  }
  if ($sessionVars["SELL_suspended"] == 8 || $sessionVars["SELL_action"] == "edit") {
    $query =
    "UPDATE ".$DBPrefix."auctions set
       title = '".addslashes($sessionVars["SELL_title"])."',
       starts = '".$a_starts."',
       description = '".addslashes($sessionVars["SELL_description"])."',
       pict_url = '".addslashes($sessionVars["SELL_pict_url"])."',
       category = ".$sessionVars["SELL_sellcat"].",
       minimum_bid = '".$sessionVars["SELL_minimum_bid"]."',
       reserve_price = '".(($sessionVars["SELL_with_reserve"]=="yes")?$sessionVars["SELL_reserve_price"]:"0")."',
       buy_now = '".(($sessionVars["SELL_with_buy_now"]=="yes")?$sessionVars["SELL_buy_now_price"]:"0")."',
       bn_only = '".$sessionVars["SELL_buy_now_only"]."',
       auction_type = '".$sessionVars["SELL_atype"]."',
       adultonly = '".$sessionVars["SELL_adultonly"]."',
       duration = '".$sessionVars["SELL_duration"]."',
       increment = ".doubleval($sessionVars["SELL_customincrement"]).",
       shipping = '".$sessionVars["SELL_shipping"]."',
       payment = '".$payment_text."',
       international = '".(($sessionVars["SELL_international"])?"1":"0")."',
       ends = '".$a_ends."',
       closed = '0',
       photo_uploaded = ".(($sessionVars["SELL_file_uploaded"])?"1":"0").",
       quantity = ".$sessionVars["SELL_iquantity"].",
       relist=".intval($sessionVars["SELL_relist"]).",
       private='n',
       suspended='".$SUSPENDED."',";
       $query .= "shipping_terms='".addslashes(strip_tags($sessionVars["SELL_shipping_terms"]))."'
       WHERE id = '".$sessionVars["SELL_auction_id"]."'";
    $backtosuspended=true;
    $res=mysql_query($query);
    if (!$res) {
      MySQLError($query);
      exit;
    }
    $auction_id=$sessionVars['SELL_auction_id'];
  } elseif ($sessionVars["SELL_action"] == "reopen") {
    $query =
    "UPDATE ".$DBPrefix."auctions set
       title = '".addslashes($sessionVars["SELL_title"])."',
       starts = '".$a_starts."',
       description = '".addslashes($sessionVars["SELL_description"])."',
       pict_url = '".addslashes($sessionVars["SELL_pict_url"])."',
       category = ".$sessionVars["SELL_sellcat"].",
       minimum_bid = '".$sessionVars["SELL_minimum_bid"]."',
       reserve_price = '".(($sessionVars["SELL_with_reserve"]=="yes")?$sessionVars["SELL_reserve_price"]:"0")."',
       buy_now = '".(($sessionVars["SELL_with_buy_now"]=="yes")?$sessionVars["SELL_buy_now_price"]:"0")."',
       bn_only = '".$sessionVars["SELL_buy_now_only"]."',
       auction_type = '".$sessionVars["SELL_atype"]."',
       adultonly = '".$sessionVars["SELL_adultonly"]."',
       duration = '".$sessionVars["SELL_duration"]."',
       increment = ".doubleval($sessionVars["SELL_customincrement"]).",
       shipping = '".$sessionVars["SELL_shipping"]."',
       payment = '".$payment_text."',
       international = '".(($sessionVars["SELL_international"])?"1":"0")."',
       ends = '".$a_ends."',
       photo_uploaded = ".(($sessionVars["SELL_file_uploaded"])?"1":"0").",
       quantity = ".$sessionVars["SELL_iquantity"].",
         relist=".intval($sessionVars["SELL_relist"]).",
         relisted=0,
         closed='0',
       private='n',
       suspended='".$SUSPENDED."',";
       $query .= "current_bid=0,
       num_bids=0,
       shipping_terms='".addslashes(strip_tags($sessionVars["SELL_shipping_terms"]))."'
       WHERE id = '".$sessionVars["SELL_auction_id"]."'";
    $backtoclosed = true;
    $res = mysql_query($query);
    if (!$res) {
      MySQLError($query);
      exit;
    }
    $auction_id = $sessionVars['SELL_auction_id'];
    $sessionVars["SELL_auction_id_old"] = $auction_id;
    $query = "DELETE FROM ".$DBPrefix."bids WHERE auction='$auction_id'";
    $res = @mysql_query($query);
    if(!$res) {
      MySQLError($query);
      exit;
    }
    #// Proxy Bids
    $query = "DELETE FROM ".$DBPrefix."proxybid WHERE itemid='$auction_id'";
    $res = @mysql_query($query);
    if(!$res) {
      MySQLError($query);
      exit;
    }
    #// Winners: only in case of reserve not reached
    $query = "DELETE FROM ".$DBPrefix."winners WHERE auction='$auction_id'";
    $res = @mysql_query($query);
    if(!$res) {
      MySQLError($query);
      exit;
    }
  } else {
    $query =
    //    "INSERT INTO ".$DBPrefix."auctions VALUES ('".$sessionVars["SELL_auction_id"]."', '". // auction id
    "INSERT INTO ".$DBPrefix."auctions VALUES (NULL, '". // auction id
    $userrec["id"]."', '".
    addslashes($sessionVars["SELL_title"])."', '". // auction title
    $a_starts."', '". // auction starts
    addslashes($sessionVars["SELL_description"])."', '". // auction description
    addslashes($sessionVars["SELL_pict_url"])."', ". // picture URL
    $sessionVars["SELL_sellcat"].", '". // category
    $sessionVars["SELL_minimum_bid"]."', '".// minimum bid
    (($sessionVars["SELL_with_reserve"]=="yes")?$sessionVars["SELL_reserve_price"]:"0")."', '".// reserve price
    (($sessionVars["SELL_with_buy_now"]=="yes")?$sessionVars["SELL_buy_now_price"]:"0")."', '".// buy now price
    $sessionVars["SELL_atype"]."', '".// auction type
    $sessionVars["SELL_duration"]."', ".
    doubleval($sessionVars["SELL_customincrement"]).", '".
    $sessionVars["SELL_shipping"]."', '".// shipping method
    $payment_text."', '".// payment method$TPL_payments_list
    (($sessionVars["SELL_international"])?"1":"0")."', '".// international shipping
    $a_ends."', '".// ends
    "0', '".// current bid
    "0', ".// closed
    (($sessionVars["SELL_file_uploaded"])?"1":"0").", ".
    $sessionVars["SELL_iquantity"].", ".// quantity
    "'$SUSPENDED' ".//suspended
    ",'n',
    ".intval($sessionVars["SELL_relist"]).",
    0,
    0,
    'n','". 
    addslashes(strip_tags($sessionVars["SELL_shipping_terms"]))."',
    '".$sessionVars["SELL_buy_now_only"]."',
    '".$sessionVars["SELL_adultonly"]."'
    )";
    $res=mysql_query($query);
    if ($res) {
      $sql="SELECT LAST_INSERT_ID() as id";
      $res_=mysql_query($sql);
      //      $auction_id=mysql_insert_id();
      $auction_id=mysql_result($res_,0,"id");
      $_SESSION['sessionVars']['SELL_auction_id']=$auction_id;
      $sessionVars['SELL_auction_id']=$auction_id;
      $TPL_auction_id = $auction_id; 
    } else {
      MySQLError($query);
      exit;
    }
    if(isset($_SESSION['RELISTEDAUCTION'])) {
      /*
      * NOTE: Insert into relisted table
      */
      $backtosold=true;
    }
  }
  
  if($backtoclosed) {
    $query = "INSERT INTO ".$DBPrefix."closedrelisted VALUES(
             ".$sessionVars["SELL_auction_id_old"].",
             '".$NOWB."',
             ".$auction_id.")";
    $r_relisted = @mysql_query($query);
    if(!$r_relisted) {
      MySQLError($query);
      exit;
    }
  }
  
  #// Create pictures gallery if any
  if($SETTINGS['picturesgallery'] == 1 && @count($UPLOADED_PICTURES)> 0 && $GALLERY_UPDATED)  {
    #// Create dirctory
    umask();
    if(!is_dir($uploaded_path.$auction_id)) {
      mkdir($uploaded_path.$auction_id,0777);
    } else {
      if ($dir = @opendir($uploaded_path.$auction_id)) {
        while (($file = readdir($dir)) !== false) {
          if (!is_dir($uploaded_path.$auction_id."/".$file))
          @unlink($uploaded_path.$auction_id."/".$file);
        }
        @closedir($dir);
      }
    }
    #// Copy files
    while(list($k,$v) = each($UPLOADED_PICTURES)) {
      @copy($uploaded_path.session_id()."/$v",$uploaded_path.$auction_id."/".$v);
      @chmod($uploaded_path.$auction_id."/".$v,0777);
      @unlink($uploaded_path.session_id()."/$v");
    }
    #// Delete files, using dir (to eliminate eventual odd files)
    if ($dir = @opendir($uploaded_path.session_id())) {
      while (($file = readdir($dir)) !== false) {
        if (!is_dir($uploaded_path.session_id()."/".$file))
        @unlink($uploaded_path.session_id()."/".$file);
      }
      @closedir($dir);
    }
    @rmdir($uploaded_path.session_id());
  }
  #// Unset gallery variables
  unset($UPLOADED_PICTURES);
  unset($UPLOADED_PICTURES_SIZE);
  unset($GALLERY_UPDATED);
  unset($_SESSION["UPLOADED_PICTURES"]);
  unset($_SESSION["UPLOADED_PICTURES_SIZE"]);
  unset($_SESSION["GALLERY_UPDATED"]);
  
  //updating categories, only if not in editing and is not a Future auction
  if($sessionVars["SELL_private"] != 'y' && !($sessionVars["SELL_action"]=='edit') && $sessionVars["SELL_starts"] <= $NOW)
  {
    $query = "update ".$DBPrefix."counters set auctions = auctions+1";
    $result = mysql_query($query);
    // and increase category counters
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".intval($sessionVars["SELL_sellcat"])));
    $row["counter"]++;
    $row["sub_counter"]++;
    mysql_query("UPDATE ".$DBPrefix."categories SET counter=".$row["counter"].", sub_counter=".$row["sub_counter"]." WHERE cat_id=".$row["cat_id"]);
    // update recursive categories
    while ( $row["parent_id"]!=0 )
    {
      // update this parent's subcounter
      $row = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".$row["parent_id"]));
      $row["sub_counter"]++;
      mysql_query("UPDATE ".$DBPrefix."categories SET sub_counter=".$row["sub_counter"]." WHERE cat_id=".$row["cat_id"]);
    }
  }
  // Send notification if users keyword matches (Auction Watch)
  $result = mysql_query("SELECT auc_watch,email,nick,name FROM ".$DBPrefix."users");
  while($row = mysql_fetch_assoc($result))
  {
    unset($match);
    $w_title = array_filter(preg_split ("/[\s]+/", $sessionVars["SELL_title"], -1, PREG_SPLIT_NO_EMPTY),"strtolower");
    $w_descr = array_filter(preg_split ("/[\s]+/", eregi_replace("<br>", " ",eregi_replace("\n", " ",$sessionVars["SELL_description"])), -1, PREG_SPLIT_NO_EMPTY),"strtolower");
    $w_nick = strtolower($userrec["nick"]);
    $key = preg_split ("/[\s,]+/", $row["auc_watch"], -1, PREG_SPLIT_NO_EMPTY);
    trim($key);
    if(is_array($key) && count($key)>0)
    {
      while(list($k,$v) = each($key)){
        $v = strtolower($v);
        if(in_array($v,$w_title) || in_array($v,$w_descr) || $v==$w_nick){
          $match=1;
        }
      }
      // If there's at least one match, send e-mail
      if ($match){
        // Mail body and mail() functsion
        include $main_path."language/".$language."/auction_watchmail.inc.php";
      }
    }
    $i++;
  }
  #//========================================================================================================
  #  Show results
  #//========================================================================================================
  $TPL_auction_id = $auction_id;
  $user_id=$userrec["id"];
  if(!$sessionVars["SELL_action"]) {
    include "header.php";
  }

  $auction_url = $SETTINGS["siteurl"] . "item.php?mode=1&id=".$auction_id;
  if($sessionVars["SELL_action"]=="edit") {
    unset($_SESSION["sessionVars"]);
    unset($_SESSION["RELISTEDAUCTION"]);
    if(isset($_SESSION['backtolist']))
      header("Location: ".$_SESSION['backtolist']."?PAGE=".$_SESSION['backtolist_page']);
    else
      header("Location: yourauctions.php?PAGE=".$_SESSION['backtolist_page']);
    exit;
  }
  if($sessionVars["SELL_action"] == "reopen") {
    unset($_SESSION["sessionVars"]);
    unset($_SESSION["RELISTEDAUCTION"]);
    header("Location: yourauctions_c.php?PAGE=".$_SESSION['backtolist_page']);
    exit;
  }
  include phpa_include("template_sell_result_php.html");

  // Send confirmation email
  $auction_url = $SETTINGS["siteurl"] . "item.php?mode=1&id=".$auction_id;
  if($sessionVars["SELL_action"]=="edit") {
    unset($_SESSION["sessionVars"]);
    if(isset($_SESSION['backtolist']))
      header("Location: ".$_SESSION['backtolist']."?PAGE=".$_SESSION['backtolist_page']);
    else
      header("Location: yourauctions.php?PAGE=".$_SESSION['backtolist_page']);
    exit;
  }
  if($sessionVars["SELL_action"]=="reopen") {
    unset($_SESSION["sessionVars"]);
    header("Location: yourauctions_c.php?PAGE=".$_SESSION['backtolist_page']);
    exit;
  }
  include $include_path.'auction_confirmation.inc.php';
  if($backtosuspended) {
    include phpa_include("template_back_to_bulkloaded_php.html");
  } elseif($backtoclosed) {
    include phpa_include("template_back_to_closed_php.html");
  }elseif($backtosold) {
    include phpa_include("template_back_to_sold_php.html");
  }
  include "footer.php";
  
}
?>