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
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));

if($_POST['action'] == $MSG_030 && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
    $query = "DELETE FROM ".$DBPrefix."news WHERE id='".$_POST['id']."'";
    $res = mysql_query($query);
    if(!$res) {
        $ERR = "ERR_001";
    } else {
        Header("Location: news.php");
        exit;
    }
}
elseif($_POST['action'] == $MSG_029 && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
    Header("Location: news.php");
    exit;
}

if(!$_POST['action']) {
    $query = "SELECT * FROM ".$DBPrefix."news WHERE id='".$_GET['id']."'";
    $res = mysql_query($query);
    if(!$res) {
        print $ERR_001;
        exit;
    } else {
        $title         = stripslashes(mysql_result($res,0,"title"));
        $content     = stripslashes(mysql_result($res,0,"content"));
        $suspended     = mysql_result($res,0,"suspended");
        $tmp_date = mysql_result($res,$i,"new_date");
        $day = substr($tmp_date,6,2);
        $month = substr($tmp_date,4,2);
        $year = substr($tmp_date,0,4);
        $new_date = "$day/$month/$year";
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
    <td background="images/bac_barint.gif">
      <table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_338?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><FORM NAME=addnew ACTION="<?php print basename($_SERVER['PHP_SELF']); ?>" METHOD="POST">
<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
<TR>
<TD>
    <TABLE WIDTH=100% CELPADDING=4 CELLSPACING=0 BORDER=0 >
    <TR>
     <TD ALIGN=CENTER COLSPAN=2 class=title><?php print $MSG_338; ?></TD>
    </TR>

    <?php
    if($ERR || $updated) {
        print "<TR><TD></TD><TD WIDTH=486>";
        if($$ERR) print $$ERR;
        if($updated) print "Data updated";
        print "</TD>
        </TR>";
    }
    ?>
    <TR bgcolor=#FFFFFF>
      <TD WIDTH="204" VALIGN="top" ALIGN="right">
        <?php print "$MSG_432 *"; ?>
      </TD>
      <TD WIDTH="486">
        <?php
        if($SETTINGS[datesformat] == "USA") {
            print Date("m/d/Y",$TIME). " (mm/dd/yyyy)";
        } else {
            print Date("d/m/Y",$TIME). " (dd/mm/yyyy)";
        }
        ?>
      </TD>
    </TR>
    <TR bgcolor=#FFFFFF>
      <TD WIDTH="204" VALIGN="top" ALIGN="right">
        <?php print "$MSG_519 *"; ?>
      </TD>
      <TD WIDTH="486">
        <?php print $title; ?>
      </TD>
    </TR>

    <TR bgcolor=#FFFFFF>
      <TD WIDTH="204" VALIGN="top" ALIGN="right">
        <?php print "$MSG_520 *"; ?>
      </TD>
      <TD WIDTH="486">
      <?php print nl2br($content); ?>
      </TD>
    </TR>

    <TR bgcolor=#FFFFFF>
      <TD WIDTH="204" VALIGN="top" ALIGN="right">
        <?php print "$MSG_521 *"; ?>
      </TD>
      <TD WIDTH="486">
      <?php
      if($suspended == 0) print " NO";
      if($suspended == 1) print " YES";
      ?>
      </TD>
    </TR>

    <TR bgcolor=#FFFFFF>
      <TD WIDTH="204" VALIGN="top" ALIGN="right">&nbsp;
        
      </TD>
      <TD WIDTH="486">
      <BR><BR>
      <?php print $MSG_339; ?>
      <BR><BR>
        <INPUT TYPE="submit" NAME="action" VALUE=<?php print $MSG_030; ?>>&nbsp;&nbsp;&nbsp;
        <INPUT TYPE="submit" NAME="action" VALUE=<?php print $MSG_029; ?>>
        <INPUT type="hidden" NAME="id" VALUE="<?php echo $_GET['id']; ?>">
        <INPUT type="hidden" NAME="offset" VALUE="<?php echo $_GET['offset']; ?>">
      </TD>
    </TR>
    </TABLE>
    </TD>
    </TR>
    </TABLE></FORM>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>