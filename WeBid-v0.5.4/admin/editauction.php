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

include "../includes/config.inc.php";
include "loggedin.inc.php";
include $include_path."countries.inc.php";

$username = $name;
//-- Data check
if(!$_REQUEST[id]) {
	$URL = $_SESSION["RETURN_LIST"]."?offset=".$_SESSION['RETURN_LIST_OFFSET'];
    unset($_SESSION["RETURN_LIST"]);
    header("Location: $URL");
    exit;
}

/*
*        If script is called to actually make modifications
*        (ie on first invocation this script just displays some HTML
*         on the second it tries to modify the database).
*/

if($_POST['action'] && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
    
    $query="";
    if(isset($_POST["ntxt"])) {
        foreach($_POST["ntxt"] as $k=>$v) {
            if(empty($v) && isset($txt[$k]) && !empty($txt[$k])) {
                $query.=",txt$k=\"".urldecode($txt[$k])."\"";
            } else $query.=",txt$k=\"$v\"";
            
        }
    }
    if(isset($_POST["nnum"])) {
        foreach($_POST["nnum"] as $k=>$v) {
            if(empty($v) && isset($num[$k]) && !empty($num[$k])) {
                $query.=",num$k=\"".$num[$k]."\"";
            } else $query.=",num$k=\"$v\"";
        }
    }
	
    // Check that all the fields are not NULL
    if ($_POST["id"] && $_POST["title"] && $_POST["userid"] && $_POST["date"] && $_POST["duration"] && $_POST["category"] &&
    $_POST["description"] && $_POST["current_bid"] && $_POST["quantity"] && $_POST["min_bid"] && $_POST["reserve_price"] && $_POST["buy_now"] && $_POST["country"]) {

        $DATE = explode("/",$_POST["date"]);
        if($SETTINGS[datesformat] == "USA") {
          $tmp_day          = $DATE[1];
          $tmp_month        = $DATE[0];
          $tmp_year         = $DATE[2];
        } else {
          $tmp_day          = $DATE[0];
          $tmp_month        = $DATE[1];
          $tmp_year         = $DATE[2];
        }

        /*
        *         Check the input values for validity.
        */
        if(strlen($tmp_year) == 2) {
            $tmp_year = "19".$tmp_year;
        }
        
        if (!ereg("^[0-9]{2}/[0-9]{2}/[0-9]{4}$",$_POST["date"]) &&
        !ereg("^[0-9]{2}/[0-9]{2}/[0-9]{2}$",$_POST["date"])) { //date check
          $ERR = "ERR_700";
        } else if ($_POST["quantity"] < 1) { // 1 or more items being sold
          $ERR = "ERR_701";
        } else if ($_POST["current_bid"] < $_POST["min_bid"] && $_POST["current_bid"] != 0) {    // bid > min_bid
          $ERR = "ERR_702";
        } else {
            #// Retrieve auction's data
            $query = "SELECT * from ".$DBPrefix."auctions where id='".$_POST["id"]."'";
            $res = @mysql_query($query);
            if(!$res) {
                MySQLError($query);
                exit;
            } elseif(mysql_num_rows($res) == 0) {
                print $ERR_606;
                exit;
            } else {
                $AUCTION = mysql_fetch_array($res);
                $T = mktime(substr($AUCTION['starts'], 8, 2),
                    substr($AUCTION['starts'], 10, 2),
                    substr($AUCTION['starts'], 12, 2),
                    $tmp_month,
                    $tmp_day,
                    $tmp_year);
            $a_ends = $T+($_POST[duration]*24*60*60);
                $a_ends = date("YmdHis", $a_ends);
                
                if($AUCTION['category'] != $_POST["category"]) {
                    // and increase http category counters
                    $ct = intval($_POST["category"]);
                    $row = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$ct"));
                    $counter = $row['counter']+1;
                    $subcoun = $row['sub_counter']+1;
                    $parent_id = $row['parent_id'];
                    mysql_query("UPDATE ".$DBPrefix."categories SET counter=$counter, sub_counter=$subcoun WHERE cat_id=$ct");
                    
                    // update recursive categories
                    while ( $parent_id!=0 )    {
                        // update this parent's subcounter
                        $rw = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$parent_id"));
                        $subcoun = $rw['sub_counter']+1;
                        mysql_query("UPDATE ".$DBPrefix."categories SET sub_counter=$subcoun WHERE cat_id=$parent_id");
                        // get next parent
                        $parent_id = intval($rw['parent_id']);
                    }
                    // and decrease auction category counters
                    $cta = intval($AUCTION['category']);
                    $row = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$cta"));
                    $counter = $row['counter']-1;
                    $subcoun = $row['sub_counter']-1;
                    $parent_id = $row['parent_id'];
                    mysql_query("UPDATE ".$DBPrefix."categories SET counter=$counter, sub_counter=$subcoun WHERE cat_id=$cta");
                    
                    // update recursive categories
                    while ( $parent_id!=0 ) {
                        // update this parent's subcounter
                        $rw = mysql_fetch_array(mysql_query("SELECT * FROM ".$DBPrefix."categories WHERE cat_id=$parent_id"));
                        $subcoun = $rw['sub_counter']-1;
                        mysql_query("UPDATE ".$DBPrefix."categories SET sub_counter=$subcoun WHERE cat_id=$parent_id");
                        // get next parent
                        $parent_id = intval($rw['parent_id']);
                    }
                }
            }


            $time = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),$tmp_month, $tmp_day,$tmp_year);
            $date = date("YmdHis",$time);
            
            $sql="UPDATE ".$DBPrefix."auctions SET title=\"".AddSlashes($_POST["title"])."\",
                user=\"".AddSlashes($_POST["userid"])."\",
                starts=\"".AddSlashes($date)."\",
                ends=\"".AddSlashes($a_ends)."\",
                duration=\"".AddSlashes($_POST["duration"])."\",
                category=\"".AddSlashes($_POST["category"])."\",
                description=\"".AddSlashes($_POST["description"])."\",
                current_bid=\"".AddSlashes($_POST["current_bid"])."\",
                location=\"".AddSlashes($_POST["country"])."\",
                quantity=\"".AddSlashes($_POST["quantity"])."\",
                minimum_bid=\"".AddSlashes($_POST["min_bid"])."\",
                buy_now=\"".AddSlashes($_POST["buy_now"])."\",
                reserve_price=\"". AddSlashes($_POST["reserve_price"])."\"
                                WHERE id='".AddSlashes($_POST["id"])."'";
            $res=mysql_query ($sql);
            
            if (!$res) {
                print "Database error on update: " . mysql_error();
                exit;
            } else {
                $updated = 1;
            }
                $URL = $_SESSION["RETURN_LIST"]."?offset=".$_SESSION['RETURN_LIST_OFFSET'];
                unset($_SESSION["RETURN_LIST"]);
                header("Location: $URL");
                exit;
        }
    } else {
        // COUNTRIES
        
        $country_list="";
        while (list ($code, $descr) = each ($countries)) {
            $country_list .= "<option value=\"$descr\"";
            if ($descr == $country) {
                $country_list .= " selected";
            }
            $country_list .= ">$descr</option>\n";
        }
        // NICKS (usernames)
        
        $userid_list = ""; // empty string to begin HTML list
        $userid_query = "select id, nick from ".$DBPrefix."users";
        $res_q = mysql_query($userid_query);
        if(!$res_q) {
            print "Database access error: abnormal termination".mysql_error();
            exit;
        }
        while($row = mysql_fetch_array($res_q)) {
            $userid_list .= "<option value='".$row['id']."'";
            if ($row['id'] == $userid) {
                $userid_list .= " selected ";
            }
            $userid_list .= ">".$row['nick']."</option>\n";
        }
        
        
        // DURATIONS
        
        $dur_list = ""; // empty string to begin HTML list
        $dur_query = "select days, description from ".$DBPrefix."durations";
        $res_d = mysql_query($dur_query);
        if(!$res_d) {
            print "Database access error: abnormal termination".mysql_error();
            exit;
        }
        for ($i = 0; $i < mysql_num_rows($res_d); $i++) {
            $row = mysql_fetch_row($res_d);
            // 0 is days, 1 is description
            // Append to the list
            $dur_list .= "<option value=\"$row[0]\"";
            // If this Durations # of days coresponds to the duration of this
            // auction, select it
            if ($row[0] == $duration) {
                $dur_list .= " selected ";
            }
            $dur_list .= ">$row[1]</option>\n";
        }
        
        $ERR = "ERR_112";
    }
    
}

if(!$_POST["action"] || ($_POST["action"] && !$updated)) {
    
    /*
    *        Make a large SQL query getting values from the "auctions"
    *        table and corresponding values that are indexed in other tables
    *         and displaying them both (and allowing the admin to change
    *        only the proper indexed values.
    */
    $query = "SELECT a.id, a.user as nick , u.nick as nick_description,
                a.title, a.starts, a.description,
                a.category, c.cat_name, a.duration as duration, d.description as
                dur_description, a.suspended, a.current_bid,
                a.quantity, a.reserve_price, a.buy_now, a.location, a.minimum_bid
                FROM ".$DBPrefix."auctions a, 
                ".$DBPrefix."users u, 
                ".$DBPrefix."categories c, 
				".$DBPrefix."durations d
                WHERE u.id = a.user 
                AND c.cat_id = a.category 
                AND d.days = a.duration 
                AND a.id='".$_REQUEST["id"]."'";
    $result = mysql_query($query);
    if(!$result) {
        print "Database access error: abnormal termination".mysql_error();
        exit;
    }
    
    $id = mysql_result($result,0,"id");
    $title = stripslashes(mysql_result($result,0,"title"));
    $userid = stripslashes(mysql_result($result,0,"nick"));
    $tmp_date = mysql_result($result,0,"starts");
    $duration = mysql_result($result,0,"duration");
    $category = mysql_result($result, 0, "category");
    $cat_description = stripslashes(mysql_result($result,0,"cat_name"));
    $description = stripslashes(mysql_result($result,0,"description"));
    $suspended = mysql_result($result,0,"suspended");
    $current_bid = mysql_result($result,0,"current_bid");
    $min_bid = mysql_result($result,0,"minimum_bid");
    $quantity = mysql_result($result,0,"quantity");
    $reserve_price = mysql_result($result,0,"reserve_price");
    $buy_now = mysql_result($result,0,"buy_now");
    $country = mysql_result($result, 0, "location");
    
    /*
    *         For all list-like items we create drop-down
    *        lists and select the index listed in the auction table.
    *        for this auction.
    */
    // NICKS (usernames)
    
    $userid_list = ""; // empty string to begin HTML list
    $userid_query = "select id, nick from ".$DBPrefix."users";
    $res_q = mysql_query($userid_query);
    if(!$res_q) {
        print "Database access error: abnormal termination".mysql_error();
        exit;
    }
    while($row = mysql_fetch_array($res_q)) {
        $userid_list .= "<option value='".$row['id']."'";
        if ($row['id'] == $userid) {
            $userid_list .= " selected ";
        }
        $userid_list .= ">$row[1]</option>\n";
    }
    
    // DURATIONS
    $dur_list = ""; // empty string to begin HTML list
    $dur_query = "select days, description from ".$DBPrefix."durations";
    $res_d = mysql_query($dur_query);
    if(!$res_d) {
        print "Database access error: abnormal termination".mysql_error();
        exit;
    }
    for ($i = 0; $i < mysql_num_rows($res_d); $i++) {
        $row = mysql_fetch_row($res_d);
        // 0 is days, 1 is description
        // Append to the list
        $dur_list .= "<option value=\"$row[0]\"";
        // If this Durations # of days coresponds to the duration of this
        // auction, select it
        if ($row[0] == $duration) {
            $dur_list .= " selected ";
        }
        $dur_list .= ">$row[1]</option>\n";
    }
    
    // CATEGORIES
    $T=        "<SELECT NAME=\"category\">\n";
    $categ = mysql_query("SELECT * FROM ".$DBPrefix."categories_plain");
    if($categ) {
        while($categ_result=mysql_fetch_array($categ)) {
            $T.=
            "        <OPTION VALUE=\"".
            $categ_result['cat_id'].
            "\" ".
            (($categ_result['cat_id']==$category)?"SELECTED":"")
            .">".$categ_result['cat_name']."</OPTION>\n";
        }
    }
    $T.="</SELECT>\n";
    $TPL_categories_list = $T;
    
    $country_list="";
    while (list ($code, $descr) = each ($countries)) {
        $country_list .= "<option value=\"$descr\"";
        if ($descr == $country) {
            $country_list .= " selected";
        }
        $country_list .= ">$descr</option>\n";
    }
    
    $date = mysql_result($result,0,"starts");
    $tmp_day = substr($date,6,2);
    $tmp_month = substr($date,4,2);
    $tmp_year = substr($date,0,4);
    if($SETTINGS[datesformat] == "USA") {
      $date = "$tmp_month/$tmp_day/$tmp_year";
    } else {
      $date = "$tmp_day/$tmp_month/$tmp_year";
    }
}

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_auc.gif" ></td>
          <td class=white><?=$MSG_239?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_512?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
  <TR>
    <TD ALIGN=CENTER class=title><?php print $MSG_512; ?></TD>
  </TR>
  <TR>
    <TD><FORM NAME=details ACTION="<?php print basename($_SERVER['PHP_SELF']); ?>" METHOD="POST">
    <TABLE WIDTH="100%" BORDER="0" CELLPADDING="5" BGCOLOR="#FFFFFF">
                <?php
                if($ERR || $updated){
                    print "<TR><TD></TD><TD WIDTH=486>";
                    if($$ERR) print $$ERR;
                    if($updated) print "Auction data updated";
                    print "</TD>
                </TR>";
                }
                ?>
                
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_312 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME=title SIZE=40 MAXLENGTH=255 VALUE="<?php print $title; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_313 *"; ?> </TD>
                  <TD WIDTH="486"><SELECT NAME=userid>
                      <OPTION VALUE=""> </OPTION>
                      <?php  echo $userid_list; ?>
                    </SELECT>
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print " $MSG_314 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME=date SIZE=20 MAXLENGTH=20 VALUE="<?php echo $date; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_315 *"; ?> </TD>
                  <TD WIDTH="486"><SELECT NAME=duration>
                      <OPTION VALUE=""> </OPTION>
                      <?php  echo $dur_list; ?>
                    </SELECT>
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204"  VALIGN="top" ALIGN="right"><?php print "$MSG_316 *"; ?> </TD>
                  <TD WIDTH="486"><?php print $TPL_categories_list; ?> </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_317 *"; ?> </TD>
                  <TD WIDTH="486"><TEXTAREA NAME=description COLS=40 ROWS=8><?php echo $description; ?></TEXTAREA>
                  </TD>
                </TR>
                <!------------------------- item variants ------------------>
                <?php
                if ($TPL_auction_variant!="") {
                ?>
                <TR>
                  <TD WIDTH="204" VALIGN="middle" ALIGN="right"><?print $MSG_25_0071;?></TD>
                  <TD WIDTH="486"><?php print $TPL_auction_variant; ?> </TD>
                </TR>
                <?php
                }
                ?>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_014 *"; ?> </TD>
                  <TD WIDTH="486"><SELECT NAME=country>
                      <OPTION VALUE=""> </OPTION>
                      <?php  echo $country_list; ?>
                    </SELECT>
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_318 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME="current_bid" SIZE=15 MAXLENGTH=15 VALUE="<?php echo $current_bid; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_327 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME="min_bid" SIZE=40 MAXLENGTH=40 VALUE="<?php echo
                $min_bid; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_319 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME="quantity" SIZE=40 MAXLENGTH=40 VALUE="<?php echo
                $quantity; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_320 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME="reserve_price" SIZE=40 MAXLENGTH=40 VALUE="<?php echo
                $reserve_price; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_497 *"; ?> </TD>
                  <TD WIDTH="486"><INPUT TYPE=text NAME="buy_now" SIZE=40 MAXLENGTH=40 VALUE="<?php echo
                $buy_now; ?>">
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_300"; ?> </TD>
                  <TD WIDTH="486">
                  <?php
                  if($suspended == 0)
                  print "$MSG_029";
                  else
                  print "$MSG_030";
                  ?>
                  </TD>
                </TR>
                <TR>
                  <TD WIDTH="204">&nbsp;</TD>
                  <TD WIDTH="486"><BR>
                    <BR>
                    <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_089; ?>">
                  </TD>
                </TR>
              <tr>
              <td colspan="2">
              <INPUT TYPE="hidden" NAME="id" VALUE="<?=$_GET[id];?>">
              <INPUT TYPE="hidden" NAME="offset" VALUE="<?=$_GET[offset]; ?>">
              <INPUT TYPE="hidden" NAME="action" VALUE="update">
              </td>
              </tr>
            </TABLE> </FORM>
            </TD>
        </TR>
      </TABLE>
      </TD>
  </TR>
</TABLE>
</BODY>
</HTML>