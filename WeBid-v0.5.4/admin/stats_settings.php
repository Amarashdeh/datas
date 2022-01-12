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

require('../includes/config.inc.php');
include "loggedin.inc.php";

unset($ERR);

#//
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
    if(!isset($_POST[accesses]) && !isset($_POST[browsers]) && !isset($_POST[domains])) {
        $ERR = $ERR_5002;
        $SETTINGS = $_POST;
    } else {
        if(!isset($_POST[accesses])) $_POST[accesses] = 'n';
        if(!isset($_POST[browsers])) $_POST[browsers] = 'n';
        if(!isset($_POST[domains])) $_POST[domains] = 'n';
        #// Update database
        $query = "update ".$DBPrefix."statssettings set
                      activate='$_POST[activate]',
                      accesses='$_POST[accesses]',
                      browsers='$_POST[browsers]',
                      domains='$_POST[domains]'";
        $res = @mysql_query($query);
        if(!$res)
        {
            print "Error: $query<BR>".mysql_error();
            exit;
        }
        else
        {
            $ERR = $MSG_5148;
            $SETTINGS = $_POST;
        }
    }
} else {
    #//
    $query = "SELECT * FROM ".$DBPrefix."statssettings";
    $res = @mysql_query($query);
    if(!$res) {
        print "Error: $query<BR>".mysql_error();
        exit;
    } elseif(mysql_num_rows($res) > 0) {
        $SETTINGS = mysql_fetch_array($res);
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
          <td width="30"><img src="images/i_sta.gif" ></td>
          <td class=white>
          <?=$MSG_25_0023?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5142?></font></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
<TABLE BORDER=0 WIDTH=95% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
<TR>
<TD>
<CENTER>
    <BR>
    <FORM NAME=conf ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
        <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
            <TR>
                <TD ALIGN=CENTER><FONT COLOR=#FFFFFF FACE="Verdana, Arial, Helvetica, sans-serif" SIZE="4"><B>
                    <?php print $MSG_5141; ?>
                    </B></FONT></TD>
            </TR>
            <TR>
                <TD>
    <TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
      <?php
      if(isset($ERR))
      {
      ?>
      <TR BGCOLOR=yellow>
        <TD COLSPAN="2" ALIGN=CENTER><B><FONT FACE="Verdana, Arial, Helvetica, sans-serif" SIZE="2" COLOR="#FF0000">
          <?php print $ERR; ?>
          </FONT></B></TD>
      </TR>
      <?php
      }
                     ?>
      <TR VALIGN="TOP">
        <TD WIDTH=109>&nbsp;</TD>
        <TD WIDTH="375"><FONT FACE="Verdana, Verdana, Arial, Helvetica, sans-serif" SIZE="2">
          <?php print $MSG_5144; ?>
          </FONT></TD>
      </TR>
      <TR VALIGN="TOP">
        <TD WIDTH=109 HEIGHT="22"><FONT FACE="Verdana, Verdana, Arial, Helvetica, sans-serif" SIZE="2">
          <?php print $MSG_5149; ?>
          </FONT></TD>
        <TD WIDTH="375" HEIGHT="22"><FONT FACE="Verdana, Verdana, Arial, Helvetica, sans-serif" SIZE="2">
          <INPUT TYPE="radio" NAME="activate" VALUE="y" <?if($SETTINGS[activate] == "y") print " CHECKED"?>>
          <?php print $MSG_030; ?>
          <INPUT TYPE="radio" NAME="activate" VALUE="n" <?if($SETTINGS[activate] == "n") print " CHECKED"?>>
          <?php print $MSG_029; ?>
          </FONT></TD>
      </TR>
      <TR VALIGN="TOP">
        <TD WIDTH=109>&nbsp;</TD>
        <TD WIDTH="375"><FONT FACE="Verdana, Verdana, Arial, Helvetica, sans-serif" SIZE="2">
          <?php print $MSG_5150; ?>
          </FONT></TD>
      </TR>
      <TR VALIGN="TOP">
        <TD WIDTH=109>&nbsp;</TD>
        <TD WIDTH="375"><font face="Verdana, Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" name="accesses" value="y" <?if($SETTINGS[accesses] == "y") print " CHECKED"?>>
          <?php print $MSG_5145; ?>
          </font></TD>
      </TR>
      <TR VALIGN="TOP">
        <TD WIDTH=109 HEIGHT="22">&nbsp;</TD>
        <TD WIDTH="375" HEIGHT="22"><font face="Verdana, Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" name="browsers" value="y" <?if($SETTINGS[browsers] == "y") print " CHECKED"?>>
          <?php print $MSG_5146; ?>
          </font></TD>
      </TR>
      <TR VALIGN="TOP">
        <TD WIDTH=109 HEIGHT="22">&nbsp;</TD>
        <TD WIDTH="375" HEIGHT="22"><font face="Verdana, Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" name="domains" value="y" <?if($SETTINGS[domains] == "y") print " CHECKED"?>>
          <?php print $MSG_5147; ?>
          </font></TD>
      </TR>
        <TR VALIGN="TOP">
        <TD WIDTH=109 HEIGHT="22">&nbsp;</TD>
        <TD WIDTH="375" HEIGHT="22">
        <font face="Verdana, Verdana, Arial, Helvetica, sans-serif" size="2">
          <BR><BR><?php print $MSG_5151; ?><?php print $MSG_5152; ?> | <?php print $MSG_5153; ?> | <?php print $MSG_5154; ?>
          </font></TD>
      </TR>
      <TR VALIGN="TOP">
        <TD WIDTH=109 HEIGHT="22">&nbsp;</TD>
        <TD WIDTH="375" HEIGHT="22">&nbsp;</TD>
      </TR>
      <TR>
        <TD WIDTH=109>
          <INPUT TYPE="hidden" NAME="action" VALUE="update">
        </TD>
        <TD WIDTH="375">
          <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
        </TD>
      </TR>
      <TR>
        <TD WIDTH=109></TD>
        <TD WIDTH="375"> </TD>
      </TR>
    </TABLE>
    </TD>
    </TR>
    </TABLE>
    </FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>
