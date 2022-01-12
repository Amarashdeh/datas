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
$prefix="../";
if(file_exists(realpath(phpa_uploaded()."settings.ini"))) {
	$INI_SETTINGS=parse_ini_file(realpath(phpa_uploaded()."settings.ini"));
	$SETTINGS=array_merge($SETTINGS,$INI_SETTINGS);
}
#//
if($_POST['action'] == "update" && basename($HTTP_REFERER) == basename($PHP_SELF)) {
	#// Data check
	if(empty($_POST['thumb_show'])) {
		$ERR = $ERR_047;
	} else {
		#// Update database
		$query = "UPDATE ".$DBPrefix."settings SET
					  thumb_show=".$_POST['thumb_show'].",
					  thimbnailswidth=".$_POST['thimbnailswidth'].",
					  catthumbnailswidth=".$_POST['catthumbnailswidth'];
		$INI_SETTINGS['thumb_show'] = $_POST['thumb_show'];
		$INI_SETTINGS['thimbnailswidth'] = $_POST['thimbnailswidth'];
		$INI_SETTINGS['catthumbnailswidth'] = $_POST['catthumbnailswidth'];
		$initxt="";
		foreach($INI_SETTINGS as $k=>$v)
		$initxt.="$k=$v\r\n";
		$fp=fopen(realpath(phpa_uploaded()."settings.ini"),"w");
		fwrite($fp,$initxt);
		fclose($fp);
		$res = @mysql_query($query);
		if(!$res) {
			print "Error: $query<BR>".mysql_error();
			exit;
		} else {
			$SETTINGS['thumb_show'] = $_POST['thumb_show'];
			$SETTINGS['thimbnailswidth'] = $_POST['thimbnailswidth'];
			$SETTINGS['catthumbnailswidth'] = $_POST['catthumbnailswidth'];
			$ERR = $MGS_2__0046;
		}
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
                    <td class=white><?=$MSG_25_0009?>&nbsp;&gt;&gt;&nbsp;<?=$MGS_2__0042?></td>
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
                        <form name=conf action=<?=$_SERVER['PHP_SELF']?> method=POST>
                            <table width="95%" border="0" cellspacing="0" cellpadding="1" bgcolor="#0083D7">
                                <tr>
                                    <td align=CENTER class=title><?php print $MGS_2__0042; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width=100% cellpadding=2 align="CENTER" bgcolor="#FFFFFF">
                                            <?php
                                            if($ERR != "")
                                            {
   			      ?>
                                            <tr bgcolor=yellow>
                                                <td colspan="2" align=CENTER><b><?php print $ERR; ?> </b></td>
                                            </tr>
                                            <?php
                                            }
           	      ?>
                                            <tr valign="TOP">
                                                <td height="31">&nbsp;</td>
                                                <td height="31">
                                                    <?=$MGS_2__0043;?>
                                                    </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" height="6"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td height="31">
                                                    <?=$MSG_25_0107;?>
                                                    </td>
                                                <td height="31">&nbsp; 
                                                    <input name=thumb_show type=text value="<?=$SETTINGS['thumb_show']?>" size=5 maxlength="10">
                                                    
                                                    <?=$MGS_2__0045;?>
                                                     </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td height="31">
                                                    <?=$MSG_25_0108;?>
                                                    </td>
                                                <td height="31">&nbsp; 
                                                    <input name=thimbnailswidth type=text value="<?=$SETTINGS['thimbnailswidth']?>" size=5 maxlength="10">
                                                    
                                                    <?=$MGS_2__0045;?>
                                                     </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td height="31">
                                                    <?=$MSG_25_0109;?>
                                                    </td>
                                                <td height="31">&nbsp; 
                                                    <input name=catthumbnailswidth type=text value="<?=$SETTINGS['catthumbnailswidth']?>" size=5 maxlength="10">
                                                    
                                                    <?=$MGS_2__0045;?>
                                                     </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width=173>
                                                    <input type="hidden" name="action" value="update">
                                                </td>
                                                <td width="459">
                                                    <input type="submit" name="act" value="<?php print $MSG_530; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width=173></td>
                                                <td width="459"></td>
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
