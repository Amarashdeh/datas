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

#//
$query = "SELECT * FROM ".$DBPrefix."settings";
$res = @mysql_query($query);
if(!$res) {
	print "Error: $query<BR>".mysql_error();
	exit;
} elseif(mysql_num_rows($res) > 0) {
	$HOME_SETTINGS = mysql_fetch_array($res);
	$SETTINGS=array_merge($SETTINGS,$HOME_SETTINGS);
}
if(file_exists(realpath(phpa_uploaded()."settings.ini"))) {
	$INI_SETTINGS=parse_ini_file(realpath(phpa_uploaded()."settings.ini"));
	$SETTINGS=array_merge($SETTINGS,$INI_SETTINGS);
}
#//
if($_POST['action'] == "update")
{
  if($_FILES['logo']['tmp_name']){
	#// Handle logo upload
	$inf = GetImageSize ($_FILES['logo']['tmp_name']);
	if ( $inf[2]<1 || $inf[2]>3 ) {
		print $ERR_602;
		exit;
	}
	if(!empty($_FILES['logo']['tmp_name']) && $_FILES['logo']['tmp_name'] != "none") {
		//		$TARGET = $image_upload_path.$_FILES['logo']['name'];
		$TARGET = realpath(phpa_uploaded())."/".$_FILES['logo']['name'];
		@move_uploaded_file($_FILES['logo']['tmp_name'],$TARGET);
		chmod($TARGET,0666);
		$LOGOUPLOADED = TRUE;
	}
  }

	#// Handle logo upload
	if(!empty($_FILES['background']['tmp_name']) && $_FILES['background']['tmp_name'] != "none") {
		//		$TARGET = $image_upload_path.$_FILES['background']['name'];
		$TARGET = realpath(phpa_uploaded())."/".$_FILES['background']['name'];
		@move_uploaded_file($_FILES['background']['tmp_name'],$TARGET);
		chmod($TARGET,0666);
		$BACKUPLOADED = TRUE;
	}

	$query = " UPDATE ".$DBPrefix."settings SET
				   loginbox=".$_POST['loginbox'].",
				   newsbox=".$_POST['newsbox'].",
				   newstoshow=".$_POST['newstoshow'].",";
	$INI_SETTINGS[loginbox]=$_POST['loginbox'];
	$INI_SETTINGS[newsbox]=$_POST['newsbox'];
	$INI_SETTINGS[newstoshow]=$_POST['newstoshow'];
	if($LOGOUPLOADED) {
		$query .= "logo='".$_FILES['logo']['name']."', ";
		$INI_SETTINGS[logo]=$_FILES['logo']['name'];
	}
	if($BACKUPLOADED) {
		$query .= "background='".$_FILES['background']['name']."', ";
		$INI_SETTINGS[background]=$_FILES['background']['name'];
	}
	$query .= "brepeat='".$_POST['brepeat']."',
					featureditemsnumber=".intval($_POST['featureditemsnumber']).",
					featuredcolumns=".intval($_POST['featuredcolumns']).",
					lastitemsnumber=".intval($_POST['lastitemsnumber']).",
					catfeatureditemsnumber=".intval($_POST['catfeatureditemsnumber']).",
					catthumbnailswidth=".intval($_POST['catthumbnailswidth']).",
					higherbidsnumber=".intval($_POST['higherbidsnumber']).",
					endingsoonnumber=".intval($_POST['endingsoonnumber']).",
					thimbnailswidth=".intval($_POST['thimbnailswidth']).",
					pagewidth=".intval($_POST['pagewidth']).",
					pagewidthtype='".$_POST['pagewidthtype']."',
					alignment='".$_POST['alignment']."';";	
	$INI_SETTINGS[brepeat]=$_POST['brepeat'];
	$INI_SETTINGS[featureditemsnumber]=intval($_POST['featureditemsnumber']);
	$INI_SETTINGS[featuredcolumns]=intval($_POST['featuredcolumns']);
	$INI_SETTINGS[lastitemsnumber]=intval($_POST['lastitemsnumber']);
	$INI_SETTINGS[catfeatureditemsnumber]=intval($_POST['catfeatureditemsnumber']);
	$INI_SETTINGS[catthumbnailswidth]=intval($_POST['catthumbnailswidth']);
	$INI_SETTINGS[higherbidsnumber]=intval($_POST['higherbidsnumber']);
	$INI_SETTINGS[endingsoonnumber]=intval($_POST['endingsoonnumber']);
	$INI_SETTINGS[thimbnailswidth]=intval($_POST['thimbnailswidth']);
	$INI_SETTINGS[pagewidth]=intval($_POST['pagewidth']);
	$INI_SETTINGS[pagewidthtype]=$_POST['pagewidthtype'];
	$INI_SETTINGS[alignment]=$_POST['alignment'];
	$initxt="";
	foreach($INI_SETTINGS as $k=>$v)
	$initxt.="$k=$v\r\n";
	$fp=fopen(realpath(phpa_uploaded())."/"."settings.ini","w");
	fwrite($fp,$initxt);
	fclose($fp);
	$res_ = @mysql_query($query);
	if(!$res_) {
		print "Error: $query<BR>".mysql_error();
		exit;
	} else {
		$SETTINGS=array_merge($SETTINGS,$INI_SETTINGS);
		$ERR = $MSG_5019;
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
                    <td class=white><?=$MSG_25_0009?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5005?></td>
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
                        <form name=conf action="<?=basename($PHP_SELF)?>" method="POST"  enctype="multipart/form-data">
                            <table width="95%" border="0" cellspacing="0" cellpadding="1" bgcolor="#0083D7">
                                <tr>
                                    <td align=CENTER class=title><?php print $MSG_5005; ?></td>
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
                                                <td width=169> <?php print $MSG_531; ?> </td>
                                                <td width="393">  <?php print $MSG_556; ?> <br>
                                                    <!--<img src="<?="../$uploaded_path".$SETTINGS['logo'];?>">--> <br>
                                                    <img src="<?=phpa_uploaded().$SETTINGS['logo']?>">
                                                     <?=$MSG_602; ?> <br>
                                                    <input type="file" name="logo" size="25" maxlength="100">
                                                    <input type=HIDDEN name="MAX_FILE_SIZE" value="51200">
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169> <?php print $MSG_25_0157; ?> </td>
                                                <td width="393"> 
													<?=$MSG_30_0184?>
													<P align=right><A HREF=../csseditor_.php?thestyle=themes/<?=$SETTINGS['theme']?>/style.css&sel=body&from=homepage.php&image=background><?=$MSG_30_0160?></A>
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169> 
                                                    <?=$MSG_1056?>
                                                     </td>
                                                <td width="393"> 
                                                    <?=$MSG_1057?>
                                                     <br>
                                                    <select name="alignment">
                                                        <option value="left" <?if($SETTINGS['alignment'] == "left") print " SELECTED"?>>Left</option>
                                                        <option value="center" <?if($SETTINGS['alignment'] == "center") print " SELECTED"?>>Center</option>
                                                        <option value="right" <?if($SETTINGS['alignment'] == "right") print " SELECTED"?>>Right</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td> 
                                                    <?=$MGS_2__0051?>
                                                     </td>
                                                <td> 
                                                    <?=$MGS_2__0052?>
                                                     <br>
                                                    <input name="pagewidth" type="text" id="pagewidth" size="5" maxlength="5" value=<?=$SETTINGS['pagewidth']?>>
&nbsp;
                                                    <select name="pagewidthtype" id="pagewidthtype">
                                                        <option value='perc' <?if($SETTINGS['pagewidthtype'] == 'perc') print " SELECTED";?>>%</option>
                                                        <option value='fix' <?if($SETTINGS['pagewidthtype'] == 'fix') print " SELECTED";?>>
                                                        <?=$MGS_2__0053?>
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169> <?php print $MSG_5013; ?> </td>
                                                <td width="393">  <?php print $MSG_5014; ?> <br>
                                                    <input type="text" size=5 name=lastitemsnumber value="<?=$SETTINGS['lastitemsnumber']?>">
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169> <?php print $MSG_5015; ?> </td>
                                                <td width="393">  <?php print $MSG_5016; ?> <br>
                                                    <input type="text" size=5 name=higherbidsnumber value="<?=$SETTINGS['higherbidsnumber']?>">
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169> <?php print $MSG_5017; ?> </td>
                                                <td width="393">  <?php print $MSG_5018; ?> <br>
                                                    <input type="text" size=5 name=endingsoonnumber value="<?=$SETTINGS['endingsoonnumber']?>">
                                                </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169> <?php print $MSG_532; ?> </td>
                                                <td width="393">  <?php print $MSG_537; ?> <br>
                                                    <input type="radio" name="loginbox" value="1"
					 <?php if($SETTINGS['loginbox'] == 1) print " CHECKED";?>
					 >
                                                     <?php print $MSG_030; ?> 
                                                    <input type="radio" name="loginbox" value="2"
					 <?php if($SETTINGS['loginbox'] == 2) print " CHECKED";?>
					 >
                                                     <?php print $MSG_029; ?>  </td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td colspan="2" bgcolor="eeeeee"><img src="../images/transparent.gif" width="1" height="5"></td>
                                            </tr>
                                            <tr valign="TOP">
                                                <td width=169 height="61"> <?php print $MSG_533; ?> </td>
                                                <td width="393" height="61">  <?php print $MSG_538; ?> <br>
                                                    <input type="radio" name="newsbox" value="1"
					 <?php if($SETTINGS['newsbox'] == 1) print " CHECKED";?>
					 >
                                                     <?php print $MSG_030; ?> 
                                                    <input type="radio" name="newsbox" value="2"
					 <?php if($SETTINGS['newsbox'] == 2) print " CHECKED";?>
					 >
                                                     <?php print $MSG_029; ?> <br>
                                                    <?php print $MSG_554; ?> <br>
                                                    <input type="text" name="newstoshow" size="5" maxlength="10" value="<?=$SETTINGS['newstoshow']?>">
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
