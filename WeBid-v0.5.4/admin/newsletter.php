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


if($_POST['action'] == "newsletter" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
	#//
	if(empty($_POST['subject']) || empty($_POST['content'])) {
		$ERR = $ERR_5014;
	} else {
		$COUNTER = 0;
		switch($_POST['usersfilter']) {
			case 'all':
			$query = "select email from ".$DBPrefix."users where nletter='1'";
			break;
			case 'active':
			$query = "select email from ".$DBPrefix."users where nletter='1' AND suspended=0";
			break;
			case 'admin':
			$query = "select email from ".$DBPrefix."users where nletter='1' AND suspended=1";
			break;
			case 'fee':
			$query = "select email from ".$DBPrefix."users where nletter='1' AND suspended=9";
			break;
			case 'confirmed':
			$query = "select email from ".$DBPrefix."users where nletter='1' AND suspended=8";
			break;
		}
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)) {
			if(mail($row['email'],stripslashes($_POST['subject']),stripslashes($_POST['content']),"From:".$SETTINGS['sitename']." <".$SETTINGS['adminmail'].">\n"."Content-Type: text/html; charset=$CHARSET")) {
				$COUNTER++;
			}
		}
		if(!$result) {
			$ERR = $ERR_001;
		} else {
			$ERR = $COUNTER.$MSG_5300;
		}
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
          <td class=white><?=$MSG_25_0010?> &nbsp;&gt;&gt;&nbsp; <?=$MSG_607?></td>
        </tr>
     </table>
	 </td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle">
		<FORM NAME=newsletter ACTION="<?php print basename($_SERVER['PHP_SELF']); ?>" METHOD="POST">
          <TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
            <TR>
              <TD ALIGN=CENTER class=title><?php print $MSG_607; ?></TD>
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
                    <TD WIDTH="204" VALIGN="top" ALIGN="right"><?php print "$MSG_5299 *"; ?> </TD>
                    <TD WIDTH="486"><SELECT NAME=usersfilter onChange="SubmitFilter()">
                        <OPTION VALUE=all><?=$MSG_5296?></OPTION>
                        <OPTION VALUE=active><?=$MSG_5291?></OPTION>
                        <OPTION VALUE=admin ><?=$MSG_5294?></OPTION>
                        <OPTION VALUE=fee><?=$MSG_5293?></OPTION>
                        <OPTION VALUE=confirmed ><?=$MSG_5292?></OPTION>
                      </SELECT>
                    </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="204" VALIGN="top" ALIGN="right"> <?php print "$MSG_332 *"; ?> </TD>
                    <TD WIDTH="486"><INPUT TYPE=text NAME=subject SIZE=40 MAXLENGTH=255 VALUE="<?php print $subject; ?>">
                    </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="204" VALIGN="top" ALIGN="right"> <?php print "$MSG_605 *"; ?> </TD>
                    <TD WIDTH="486"><?=$MSG_30_0055?><BR><TEXTAREA NAME=content COLS=45 ROWS=20><?php print $content; ?></TEXTAREA>
                    </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="204" VALIGN="top" ALIGN="right"></TD>
                    <TD WIDTH="486"><INPUT TYPE=submit VALUE="<?=$MSG_25_0015?>">
                      <INPUT TYPE="hidden" NAME="action" VALUE="newsletter">
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
