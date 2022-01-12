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
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));

if($_POST['action'] && strstr(basename($_SERVER[HTTP_REFERER]), basename($_SERVER[PHP_SELF])))
{
	//-- Data check
	if(!$_POST['new_date'] || !$_POST['title'] || !$_POST['content']){
		$ERR = "ERR_112";
	}elseif(!ereg("^[0-9]{2}/[0-9]{2}/[0-9]{4}$",$_POST['new_date'])){
		$ERR = "ERR_117";
	}else{
		if($SETTINGS['datesformat'] != "USA"){
			$date = strval(substr($_POST['new_date'],6,4).substr($_POST['new_date'],3,2).substr($_POST['new_date'],0,2));
		}else{
			$date = strval(substr($_POST['new_date'],6,4).substr($_POST['new_date'],0,2).substr($_POST['new_date'],3,2));
		}
		//$date = strval(substr($_POST['new_date'],6,4).substr($_POST['new_date'],3,2).substr($_POST['new_date'],0,2));
		
		$query = "UPDATE ".$DBPrefix."news SET title='".addslashes($_POST['title'][$SETTINGS['defaultlanguage']])."',content='".addslashes($_POST['content'][$SETTINGS['defaultlanguage']])."',new_date=$date,suspended=".intval($_POST['suspended'])." WHERE id='".$_POST['id']."'";
		$res = mysql_query($query);
		if(!$res){
			$ERR = "ERR_001";
		}
		reset($LANGUAGES);
		while(list($k,$v) = each($LANGUAGES)){
			$TR=@mysql_result(@mysql_query("SELECT title FROM ".$DBPrefix."news_translated WHERE lang='".$k."' AND id=".$_POST['id']),0,"title"); 
			if($TR){
				$query = "UPDATE ".$DBPrefix."news_translated SET 
						title='".addslashes($_POST['title'][$k])."',
						content='".addslashes($_POST['content'][$k])."'
						WHERE id='".$_POST['id']."' AND
						lang='$k'";
			}else{
				$query = "INSERT INTO ".$DBPrefix."news_translated VALUES(
						".$_POST['id'].",
						'$k',
						'".addslashes($_POST['title'][$k])."',
						'".addslashes($_POST['content'][$k])."')";
			}
			@mysql_query($query);
			unset($TR);
		}	
		Header("Location: news.php");
		exit;
	}
}

if(!$_POST['action'])
{
	//--
	$query = "SELECT * FROM ".$DBPrefix."news WHERE id='".$_GET['id']."'";
	$res = mysql_query($query);
	if(!$res)
	{
		print $ERR_001;
		exit;
	}
	else
	{
		$title 		= stripslashes(htmlspecialchars(mysql_result($res,0,"title")));
		$content 	= stripslashes(mysql_result($res,0,"content"));
		$suspended 	= mysql_result($res,0,"suspended");
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
<TITLE></TITLE>
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_516?></td>
        </tr>
      </table>
	 </td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center" valign="middle">
	
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
	<TR>
	 <TD ALIGN=CENTER class=title><?php print $MSG_343; ?>
	 </TD>
	</TR>
	<tr>
	<td><FORM NAME=addnew ACTION="<?php print basename($_SERVER['PHP_SELF']); ?>" METHOD="POST">
		<TABLE WIDTH="100%" BORDER="0" CELLPADDING="5" CELLSPACING=1 bgcolor="#FFFFFF">

		<?php
		if($ERR || $updated){
		print "<TR><TD></TD><TD WIDTH=486>";
		if($$ERR) print $$ERR;
		if($updated) print "Auction data updated";
		print "</TD>
						</TR>";
		}
		?>
		<TR>
	  	<TD WIDTH="204" VALIGN="top" ALIGN="right">
		<?php print "$MSG_432 *"; ?>
	  	</TD>
	  	<TD WIDTH="486">
	  	<?php
	  	if($SETTINGS['datesformat'] != "USA")
	  	{
	  	$DATE = Date("d/m/Y",$TIME);
	  	$SAMPLE = " (dd/mm/yyyy)";
	  	}
	  	else
	  	{
	  	$DATE = Date("m/d/Y",$TIME);
	  	$SAMPLE = " (mm/dd/yyyy)";
	  	}
	  	$res_tr = @mysql_query("SELECT * FROM ".$DBPrefix."news_translated WHERE id=".$_GET['id']);
		while($tr=mysql_fetch_array($res_tr)){
			$TIT_TR[$tr['lang']] = $tr['title'];
			$CONT_TR[$tr['lang']] = $tr['content'];
		}
		?>
		<INPUT TYPE=text NAME=new_date SIZE=10 MAXLENGTH=10 VALUE="<?=$DATE;?>"> <?=$SAMPLE?>
	  	</TD>
		</TR>
		<TR>
	  	<TD WIDTH="204" VALIGN="top" ALIGN="right">
		<?php print "$MSG_519 *"; ?>
	  	</TD>
	  	<TD WIDTH="486">
		<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif">&nbsp;<INPUT TYPE=text NAME=title[<?=$SETTINGS['defaultlanguage']?>] SIZE=40 MAXLENGTH=255 VALUE="<?=stripslashes($TIT_TR[$SETTINGS['defaultlanguage']])?>">
		<?php
			reset($LANGUAGES);
			while(list($k,$v) = each($LANGUAGES)){
				if($k!=$SETTINGS['defaultlanguage']) print "<BR><IMG SRC=../includes/flags/".$k.".gif>&nbsp;<INPUT TYPE=text NAME=title[$k] SIZE=40 MAXLENGTH=255 VALUE=\"".stripslashes($TIT_TR[$k])."\">";
			}
		?>
	  	</TD>
		</TR>

		<TR>
	  	<TD WIDTH="204" VALIGN="top" ALIGN="right">
		<?php print "$MSG_520 *"; ?>
		  </TD>
	  	<TD WIDTH="486">
		<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif"><br>
		<TEXTAREA NAME=content[<?=$SETTINGS['defaultlanguage']?>] COLS=45 ROWS=20><?=stripslashes($CONT_TR[$SETTINGS['defaultlanguage']])?></TEXTAREA>
		<?php
			reset($LANGUAGES);
			while(list($k,$v) = each($LANGUAGES)){
				if($k!=$SETTINGS['defaultlanguage']) print "<br><IMG SRC=../includes/flags/".$k.".gif><br><TEXTAREA NAME=content[$k] COLS=45 ROWS=20>".stripslashes($CONT_TR[$k])."</TEXTAREA>";
			}
		?>
	  	</TD>
		</TR>

		<TR>
	  	<TD WIDTH="204" VALIGN="top" ALIGN="right">
		<?php print "$MSG_521 *"; ?>
	  	</TD>
	  	<TD WIDTH="486">
		<INPUT TYPE=radio NAME=suspended value=0
		<?php
		if($suspended == 0) print " CHECKED";
		?>
		>
		<?php print $MSG_030; ?>
		<INPUT TYPE=radio NAME=suspended value=1
		<?php
		if(suspended == 1) print " CHECKED";
		?>
		> <?php print $MSG_029; ?>
	  	</TD>
		</TR>

		<TR>
	  	<TD WIDTH="204" VALIGt">&nbsp;
		</TD>
	  	<TD WIDTH="486">
		<INPUT TYPE=submit VALUE="<?=$MSG_530?>">
	  	</TD>
		<tr>
		<td colspan="2">
		<INPUT type="hidden" NAME="id" VALUE="<?php echo $_GET['id']; ?>">
		<INPUT type="hidden" NAME="offset" VALUE="<?php echo $_GET['offset']; ?>">
		<INPUT type="hidden" NAME="action" VALUE="addnew"></td></TR>
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