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
if($_POST['action'] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
    #// Update database
    $query = "update ".$DBPrefix."settings set
                  errortext='".addslashes($_POST['errortext'])."',
                  errormail='".$_POST['errormail']."'";
    $res = @mysql_query($query);
    if(!$res) {
        print "Error: $query<BR>".mysql_error();
        exit;
    } else {
        $ERR = $MSG_413;
        $SETTINGS = $_POST;
    }
} else {
    #//
    $query = "SELECT * FROM ".$DBPrefix."settings";
    $res = @mysql_query($query);
    if(!$res) {
        print "Error: $query<BR>".mysql_error();
        exit;
    } elseif(mysql_num_rows($res) > 0) {
        $SETTINGS = mysql_fetch_array($res);
    }
}

#// Set sample error message in session vars for error page preview
$SESSION_ERROR = $ERR_119;
$_SESSION["SESSION_ERROR"]=$SESSION_ERROR;

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<STYLE TYPE="text/css">
body {
scrollbar-face-color: #aaaaaa;
scrollbar-shadow-color: #666666;
scrollbar-highlight-color: #aaaaaa;
scrollbar-3dlight-color: #dddddd;
scrollbar-darkshadow-color: #444444;
scrollbar-track-color: #cccccc;
scrollbar-arrow-color: #ffffff;
}</STYLE>
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_set.gif" width="21" height="19"></td>
          <td class=white><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_526?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">

        <FORM NAME=conf ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
          <TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
            <TR>
              <TD ALIGN=CENTER class=title><?php print $MSG_409; ?></TD>
            </TR>
            <TR>
              <TD>
              <TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
                  <?php
                  if(isset($ERR))
                  {
                  ?>
                  <TR BGCOLOR=yellow>
                    <TD COLSPAN="2" ALIGN=CENTER><B><?php print $ERR; ?> </B></TD>
                  </TR>
                  <?php
                  }
                  ?>
                  <TR VALIGN="TOP">
                    <TD WIDTH=134>&nbsp;</TD>
                    <TD WIDTH="350"> <?php print $MSG_410; ?> </TD>
                  </TR>
                  <TR VALIGN="TOP">
                    <TD WIDTH=134 HEIGHT="22"> <?php print $MSG_411; ?> </TD>
                    <TD WIDTH="350" HEIGHT="22">
                      <TEXTAREA NAME="errortext" COLS="55" ROWS="8"><?=$SETTINGS['errortext']?></TEXTAREA>
                      </TD>
                  </TR>
                  <TR VALIGN="TOP">
                    <TD WIDTH=134 HEIGHT="22"> <?php print $MSG_412; ?> </TD>
                    <TD WIDTH="350" HEIGHT="22">
                      <INPUT TYPE="text" NAME="errormail" SIZE="55" VALUE="<?=$SETTINGS['errormail'];?>" MAXLENGTH="255">
                      </TD>
                  </TR>
                  <TR VALIGN="TOP">
                    <TD WIDTH=134 HEIGHT="22">&nbsp;</TD>
                    <TD WIDTH="350" HEIGHT="22">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH=134><INPUT TYPE="hidden" NAME="action" VALUE="update">
                      <INPUT TYPE="hidden" NAME="currency" VALUE="<?=$SETTINGS['currency']?>">
                    </TD>
                    <TD WIDTH="350"><INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_530; ?>">
                    </TD>
                  </TR>
                  <TR>
                    <TD WIDTH=134></TD>
                    <TD WIDTH="350"></TD>
                  </TR>
                </TABLE>
                </TD>
            </TR>
          </TABLE>
        </FORM>
    </TD>
  </TR>
</TABLE>
</BODY>
</HTML>