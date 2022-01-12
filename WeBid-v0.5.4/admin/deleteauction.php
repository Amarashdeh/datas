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
if(!$_REQUEST["id"]) {
  $URL = $_SESSION["RETURN_LIST"];
  unset($_SESSION["RETURN_LIST"]);
  header("Location: $URL");
  exit;
}

if($_POST['action'] == "Delete" && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
  if(!$ERR) {
    //-- Get category
    $query = "select category,photo_uploaded,pict_url from ".$DBPrefix."auctions where id='".$_POST["id"]."'";
    $res__ = mysql_query($query);
    if(!$res__) {
      print $ERR_001." $query<BR>".mysql_error();
      exit;
    } else {
      $cat_id = mysql_result($res__,0,"category");
      $photo_uploaded = mysql_result($res__,0,"photo_uploaded");
      $pict_url = mysql_result($res__,0,"pict_url");
    }

    //-- delete auction
    $sql="delete from ".$DBPrefix."auctions WHERE id='".$_POST["id"]."'";
    $res=mysql_query ($sql);

    //-- Update counters
    mysql_query("update ".$DBPrefix."counters set auctions=(auctions-1)");

    //-- delete bids
    $query = "SELECT count(auction) as BIDS from ".$DBPrefix."bids WHERE auction='".$_POST["id"]."'";
    $res = mysql_query($query);
    if(!$res) {
      print "ERROR: $query<BR>".mysql_error();
      exit;
    }
    if(mysql_num_rows($res) > 0) {
      $BIDS = mysql_result($res,0,"BIDS");
      $sql="delete from ".$DBPrefix."bids WHERE auction='".$_POST["id"]."'";
      $res=mysql_query ($sql);

      #// Delete entries from the proxybid table
      $sql="delete from ".$DBPrefix."proxybid WHERE itemid='".$_POST["id"]."'";
      $res=mysql_query ($sql);
    } else {
      $BIDS = 0;
    }

    #// Delete file in counters
    mysql_query("DELETE ".$DBPrefix."auccounter where auction_id=".$_POST["id"]);

    //-- Update counters
    mysql_query("update ".$DBPrefix."bids set bids=(bids-$BIDS)");

    // update "categories" table - for counters
    $root_cat = $cat_id;
    do {
      // update counter for this category
      $query = "SELECT * FROM ".$DBPrefix."categories WHERE cat_id=\"$cat_id\"";
      $result = mysql_query($query);

      if($result) {
        if (mysql_num_rows($result)>0) {
          $R_parent_id = mysql_result($result,0,"parent_id");
          $R_cat_id = mysql_result($result,0,"cat_id");
          $R_counter = intval(mysql_result($result,0,"counter"));
          $R_sub_counter = intval(mysql_result($result,0,"sub_counter"));
          
          $R_sub_counter--;
          if ( $cat_id == $root_cat )
          --$R_counter;
          
          if($R_counter < 0) $R_counter = 0;
          if($R_sub_counter < 0) $R_sub_counter = 0;
          
          $query = "UPDATE ".$DBPrefix."categories SET counter='$R_counter', sub_counter='$R_sub_counter' WHERE cat_id=\"$cat_id\"";
          @mysql_query($query);
          
          $cat_id = $R_parent_id;
        }
      }
    } while ($cat_id!=0);

    #// ##############################################################################################
    #// Delete any image for this auction (uploaded picture and pictures gallery)

    #// Pictures gallery
    if(file_exists($image_upload_path.$_POST["id"])) {
      if($dir = @opendir($image_upload_path.$_POST["id"])) {
        while($file = readdir($dir)) {
          if($file != "." && $file != "..") {
            @unlink($image_upload_path.$_POST["id"]."/".$file);
          }
        }
        closedir($dir);
        @rmdir($image_upload_path.$_POST["id"]);
      }
    }

    #// Uploaded picture
    if($photo_uploaded)  {
      @unlink($image_upload_path.$pict_url);
    }

    $URL = $_SESSION["RETURN_LIST"];
    unset($_SESSION["RETURN_LIST"]);
    Header("location:  $URL?offset=".$_REQUEST["offset"]);
  }
}


if(!$_POST["action"]) {
  $query = "select a.id, u.nick, a.title, a.starts, a.description,
    c.cat_name, d.description as duration, a.suspended, a.current_bid,
    a.quantity, a.reserve_price, a.location from ".$DBPrefix."auctions
    a, ".$DBPrefix."users u, ".$DBPrefix."categories c, ".$DBPrefix."durations d where u.id = a.user and
    c.cat_id = a.category and d.days = a.duration and a.id=\"".$_GET["id"]."\"";
  $result = mysql_query($query);
  if(!$result) {
    print "Database access error: abnormal termination".mysql_error();
    exit;
  }

  $id = mysql_result($result,0,"id");
  $title = mysql_result($result,0,"title");
  $nick = mysql_result($result,0,"nick");
  $tmp_date = mysql_result($result,0,"starts");
  $duration = mysql_result($result,0,"duration");
  $category = mysql_result($result,0,"cat_name");
  $description = mysql_result($result,0,"description");
  $suspended = mysql_result($result,0,"suspended");
  $current_bid = mysql_result($result,0,"current_bid");
  $quantity = mysql_result($result,0,"quantity");
  $reserve_price = mysql_result($result,0,"reserve_price");
  $country = mysql_result($result, 0, "location");

  $country_list="";
  while (list ($code, $descr) = each ($countries)) {
    $country_list .= "<option value=\"$code\"";
    if ($code == $country) {
      $country_list .= " selected";
    }
    $country_list .= ">$descr</option>\n";
  };

  $day = substr($tmp_date,6,2);
  $month = substr($tmp_date,4,2);
  $year = substr($tmp_date,0,4);
  if($SETTINGS[datesformat] == "USA") {
    $date = "$month/$day/$year";
  } else {
    $date = "$day/$month/$year";
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
          <td class=white><?=$MSG_239?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_325?></td>
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
			<TD ALIGN=CENTER class=title>
              <?php print $MSG_325; ?>
            </TD>
          </TR>
        <TR>
            <TD ALIGN="CENTER">
            <TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 BORDER=0 BGCOLOR="#FFFFFF">
              <TR>
								<TD ALIGN=CENTER COLSPAN=2> <BR><BR>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_312"; ?>
                </TD>
                <TD WIDTH="486">
                  <?print $title; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_313"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $nick; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_314"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $date; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204"  VALIGN="top" ALIGN="right">
                  <?php print "$MSG_315"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $duration; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204"  VALIGN="top" ALIGN="right">
                  <?php print "$MSG_316"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $category; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_317"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $description; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_014"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $country; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_318"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $current_bid; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_319"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $quantity; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_320"; ?>
                </TD>
                <TD WIDTH="486">
                  <?php print $reserve_price; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204" VALIGN="top" ALIGN="right">
                  <?php print "$MSG_300"; ?>
                </TD>
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
                <TD WIDTH="486">
                  <?php print $MSG_326; ?>
                </TD>
              </TR>
              <TR>
                <TD WIDTH="204">&nbsp;</TD>
                <TD WIDTH="486">
                  <FORM NAME=details ACTION="deleteauction.php" METHOD="POST">
                    <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $_GET["id"]; ?>">
                    <INPUT TYPE="hidden" NAME="offset" VALUE="<?php echo $_REQUEST["offset"]; ?>">
                    <INPUT TYPE="hidden" NAME="action" VALUE="Delete">
                    <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_008; ?>">
                  </FORM>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE>
    </TD>
  </TR>
</TABLE>
</BODY>
</HTML>