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
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
    if($_POST[maxpicturesize] == 0) {
        $ERR = $ERR_707;
        $SETTINGS['maxuploadsize'] = $_POST['maxpicturesize']*1024;
    } elseif(!empty($_POST[maxpicturesize]) && !ereg("^[0-9]+$",$_POST[maxpicturesize])) {
        $ERR = $ERR_708;
        $SETTINGS = $_POST;
    } else {
        #// Update database
        $query = "UPDATE ".$DBPrefix."settings SET
                    maxuploadsize=".$_POST[maxpicturesize]*1024;
        $res = @mysql_query($query);
        if(!$res) {
            print "Error: $query<BR>".mysql_error();
            exit;
        } else {
            $ERR = $MSG_5006;
            $SETTINGS['maxuploadsize'] = $_POST['maxpicturesize']*1024;
        }
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
          <td width="30"><img src="images/i_set.gif" width="21" height="19"></td>
          <td class=white><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_25_0186?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">

<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
<TR>
<TD align="center">
<BR>
<FORM NAME=conf ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
    <TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
        <TR>
            <TD ALIGN=CENTER class=title>
                <?php print $MSG_25_0186; ?>
            </TD>
        </TR>
        <TR>
            <TD>
            <TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
                <?php
                if(isset($ERR))
                {
                ?>
                    <TR BGCOLOR=yellow>
                    <TD COLSPAN="2" ALIGN=CENTER><B>
                      <?php print $ERR; ?>
                      </B></TD>
                  </TR>
                 <?php
                }
                 ?>
                <TR VALIGN="TOP">
                    <TD WIDTH=134>&nbsp;</TD>
                    <TD WIDTH="350">
                        <?php print $MSG_25_0187; ?>
                        </TD>
                </TR>
                <TR VALIGN="TOP">
                    <TD WIDTH=134 HEIGHT="22">
                        <?php print $MSG_671; ?>
                        </TD>
                    <TD WIDTH="350" HEIGHT="22">
                        <INPUT TYPE="text" NAME="maxpicturesize" SIZE="5" VALUE="<?=$SETTINGS[maxuploadsize]/1024;?>">
                        &nbsp;<?php print $MSG_672; ?></TD>
                </TR>
                <TR VALIGN="TOP">
                    <TD WIDTH=134 HEIGHT="22">&nbsp;</TD>
                    <TD WIDTH="350" HEIGHT="22">&nbsp;</TD>
                </TR>
                <TR>
                    <TD WIDTH=134>
                        <INPUT TYPE="hidden" NAME="action" VALUE="update">
                    </TD>
                    <TD WIDTH="350">
                        <INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
                    </TD>
                </TR>
                <TR>
                    <TD WIDTH=134></TD>
                    <TD WIDTH="350"> </TD>
                </TR>
            </TABLE>
            </TD>
        </TR>
    </TABLE>
    </FORM>
<br>
</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>