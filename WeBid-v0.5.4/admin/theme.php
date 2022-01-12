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
	if($_POST['theme'] == "") {
		$ERR = $ERR_707;
	} else {
		#// Update database
		$query = "UPDATE ".$DBPrefix."settings SET
					theme='".$_POST['theme']."'";
		$res = @mysql_query($query);
		$SETTINGS['theme'] = $_POST['theme'];
		if(!$res) {
			print "Error: $query<BR>".mysql_error();
			exit;
		} else {
			$ERR = $MSG_26_0005;
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
                    <td width="30"><img src="images/i_set.gif" width="21" height="19"></td>
                    <td class=white><?=$MSG_25_0009?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_26_0002?></td>
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
                        <form name=conf action=<?=basename($_SERVER['PHP_SELF'])?> method=POST>
                            <table width="95%" border="0" cellspacing="0" cellpadding="1" bgcolor="#0083D7" align="CENTER">
                                <tr>
                                    <td align=CENTER class=title><?php print $MSG_26_0002; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width=100% cellpadding=2 align="CENTER" bgcolor="#FFFFFF">
                                            <?php
                                            if(isset($ERR))
                                            {
											?>
                                            <tr bgcolor=yellow>
                                                <td colspan="2" align=CENTER><b><?php print $ERR; ?> </b></td>
                                            </tr>
                                            <?php
                                            }
				 							?>
                                            <tr valign="TOP">
                                                <td width=169> 
                                                    <?=$MSG_26_0003?>
                                                     </td>
                                                <td width="393"> 
                                                    <?=$MSG_26_0004?>
                                                     <br>
                                                        <?php
                                                        if ($dir = @opendir(realpath($include_path."../themes"))) {
                                                        	while (($atheme = readdir($dir)) !== false) {
                                                        		if ($atheme!="." && $atheme!=".." && $atheme!="CVS" && is_dir(realpath($include_path."../themes")."/".$atheme)) {
																	$THEMES[] = $atheme;
                                                        		}
                                                        	}
                                                        	@closedir($dir);
                                                        }
														asort($THEMES);
														?>
                                                    <select name="theme">
                                                        <?php
                                                        	while (list($k,$v) = each($THEMES)) {
                                                   		?>
                                                        <option value="<?=$v?>" <?if($SETTINGS['theme']==$v) print " SELECTED"?>>
                                                        <?=$v?>
                                                        </option>
                                                        <?php
                                                        	}
														?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=134 height="22">&nbsp;</td>
                                                <td width="350" height="22">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width=134>
                                                    <input type="hidden" name="action" value="update">
                                                </td>
                                                <td width="350">
                                                    <input type="submit" name="act" value="<?php print $MSG_530; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width=134></td>
                                                <td width="350"> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
