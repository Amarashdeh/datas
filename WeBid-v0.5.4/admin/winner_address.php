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


if($_POST['action'] == "update" && basename($HTTP_REFERER) == basename($PHP_SELF)) {
	$query = "UPDATE ".$DBPrefix."settings SET winner_address='".$_POST['winner_address']."'";
	$res = mysql_query($query);
	if(!$res){
		print "Error: $query<BR>".mysql_error();
		exit;
	}else{
		$ERR = $MSG_30_0060;
		$SETTINGS['winner_address'] = $_POST['winner_address'];
	}
}

?>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<TITLE>Newsletter Admin</TITLE>
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td background="images/bac_barint.gif">
	<table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr>
          <td width="30"><img src="images/i_use.gif" ></td>
          <td class=white><?=$MSG_25_0010?> &nbsp;&gt;&gt;&nbsp; <?=$MSG_30_0083?></td>
        </tr>
     </table>
	 </td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle">
		<FORM NAME=newsletter ACTION="<?php print basename($PHP_SELF); ?>" METHOD="POST">
          <TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
            <TR>
              <TD ALIGN=CENTER class=title><?php print $MSG_30_0083; ?></TD>
            </TR>
            <TR>
              <TD>
			  <TABLE WIDTH="100%" BORDER="0" CELLPADDING="5" BGCOLOR="#FFFFFF">
                  <?php
                  if(!empty($ERR)) {
				  ?>
                  <TR>
                    <TD COLSPAN=2 ALIGN=CENTER><?php print $ERR; ?> </TD>
                  </TR>
                  <?php
                  }
				  ?>
                  <TR>
                    <TD WIDTH="204" VALIGN="top" ALIGN="right">&nbsp;</TD>
                    <TD WIDTH="486">
						<?=$MSG_30_0084?>                      
                    </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="204" VALIGN="top" ALIGN="right"><?=$MSG_30_0085?> </TD>
                    <TD WIDTH="486">
						<INPUT TYPE=radio NAME=winner_address VALUE='y' <?if($SETTINGS['winner_address']=='y') print " checked";?>><?=$MSG_030?>
						<INPUT TYPE=radio NAME=winner_address VALUE='n' <?if($SETTINGS['winner_address']=='n') print " checked";?>><?=$MSG_029?>
                    </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="204" VALIGN="top" ALIGN="right"></TD>
                    <TD WIDTH="486"><INPUT TYPE=submit VALUE="<?=$MSG_530?>">
                      <INPUT TYPE="hidden" NAME="action" VALUE="update">
                    </TD>
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
