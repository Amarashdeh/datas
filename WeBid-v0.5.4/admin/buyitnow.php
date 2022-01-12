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

$prefix="../";
#//
$ERR = "";

if($_POST['action'] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	$query = " UPDATE ".$DBPrefix."settings SET
					buy_now=".intval($_POST['buy_now']).",
					bn_only='".$_POST['bn_only']."'";	
	$res_ = @mysql_query($query);
	if(!$res_) {
		print "Error: $query<BR>".mysql_error();
		exit;
	} else {
		$SETTINGS['buy_now']=$_POST['buy_now'];
		$SETTINGS['bn_only']=$_POST['bn_only'];
		$ERR = $MSG_30_0066;
	}
}

?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td background="images/bac_barint.gif">
            <table width="100%" border="0" cellspacing="5" cellpadding="0">
                <tr>
                    <td width="30"><img src="images/i_gra.gif" width="19" height="19"></td>
                    <td class=white><?=$MSG_25_0009?>&nbsp;&gt;&gt;&nbsp;<?=$MGS_2__0025?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" valign="middle">
            <table border=0 width=100% cellpadding=0 cellspacing=0 bgcolor="#FFFFFF">
                <tr>
                    <td align="center"> <br>
                        <form name=conf action="<?=basename($_SERVER['PHP_SELF'])?>" method="POST"  enctype="multipart/form-data">
                            <table width="95%" border="0" cellspacing="0" cellpadding="1" bgcolor="#0083D7">
                                <tr>
                                    <td align=CENTER class=title><?php print $MGS_2__0025; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width=100% cellpadding=2 align="CENTER" bgcolor="#FFFFFF">
                                            <?php
                                            if($ERR != "") {
											?>
                                            <tr>
                                                <td colspan="2" align=CENTER bgcolor="yellow"><b><?php print $ERR; ?> </b></td>
                                            </tr>
                                            <?php
                                            }
											?>
                                            <tr valign="TOP">
                                                <td colspan="2"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169 height="61"> <?php print "$MSG_920"; ?> </td>
                                                <td width="393" height="61">  <?php print $MSG_921; ?> <br>
                                                    <input type="radio" name="buy_now" value="2"
												 <?php if($SETTINGS['buy_now'] == 2) print " CHECKED";?>
												 >
																				 <?php print $MSG_030; ?> 
																				<input type="radio" name="buy_now" value="1"
												 <?php if($SETTINGS['buy_now'] == 1) print " CHECKED";?>
												 >
                                                     <?php print $MSG_029; ?> <br>
                                                     </td>
                                            </tr>
                                            <tr>
                                                <td width=169>
                                                    <input type="hidden" name="action" value="update">
                                                </td>
                                                <td width="393">
                                                    <input type="submit" name="act" value="<?php print $MSG_530; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width=169></td>
                                                <td width="393"> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
