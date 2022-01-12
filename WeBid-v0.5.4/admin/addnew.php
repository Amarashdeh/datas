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
include $include_path."messages.inc.php";
include $include_path."countries.inc.php";
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));

if($_POST[action] && basename($_SERVER[HTTP_REFERER]) == basename($_SERVER[PHP_SELF]))
{
	//-- Data check
	if(!$_POST[new_date] || !$_POST[title] || !$_POST[content]){
		$ERR = "ERR_112";
	}elseif(!ereg("^[0-9]{2}/[0-9]{2}/[0-9]{4}$",$_POST[new_date])){
		$ERR = "ERR_117";
	}else{
		$_POST[id] = md5(uniqid(rand()));
		if($SETTINGS['datesformat'] != "USA"){
			$date = strval(substr($_POST[new_date],6,4).substr($_POST[new_date],3,2).substr($_POST[new_date],0,2));
		}else{
			$date = strval(substr($_POST[new_date],6,4).substr($_POST[new_date],0,2).substr($_POST[new_date],3,2));
		}
		
		$query = "INSERT INTO ".$DBPrefix."news VALUES(NULL,'".addslashes($_POST[title][$SETTINGS['defaultlanguage']])."','".addslashes($_POST[content][$SETTINGS['defaultlanguage']])."',$date,".intval($_POST[suspended]).")";
		$res = mysql_query($query);
		if(!$res){
			$ERR = "ERR_001";
		}
		$_POST[id]=mysql_insert_id();
		#// Insert into translation table.
		reset($LANGUAGES);
		while(list($k,$v) = each($LANGUAGES)){
			$query = "INSERT INTO ".$DBPrefix."news_translated VALUES(
					$_POST[id],
					'$k',
					'".addslashes($_POST[title][$k])."',
					'".addslashes($_POST[content][$k])."')";
			$res = @mysql_query($query);
		}
		Header("Location: news.php");
		exit;
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
    <td background="images/bac_barint.gif">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
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
		<FORM NAME=addnew ACTION="<?php print basename($_SERVER[PHP_SELF]); ?>" METHOD="POST">
		<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
		<TR>
		<TD>
			<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 BORDER=0>
			<TR>
	 		<TD ALIGN=CENTER COLSPAN=2 class=title>
				<B><?php print $MSG_518; ?></B>
				<BR>
	 		</TD>
			</TR>
			<?php
			if($ERR || $updated){
			print "<TR><TD>&nbsp;</TD><TD WIDTH=486>";
			if($$ERR) print $$ERR;
			if($updated) print "Auction data updated";
			print "</TD></TR>";
			}
			?>


			<TR  BGCOLOR=#FFFFFF>
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
	  		?>
			<INPUT TYPE=text NAME=new_date SIZE=10 MAXLENGTH=10 VALUE="<?=$DATE;?>"> <?=$SAMPLE?>
	  		</TD>
			</TR>
			<TR BGCOLOR=#FFFFFF valign=top>
	  		<TD WIDTH="204" VALIGN="top" ALIGN="right">
			<?php print "$MSG_519 *"; ?>
	  		</TD>
	  		<TD WIDTH="486">
			<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif">&nbsp;<INPUT TYPE=text NAME=title[<?=$SETTINGS['defaultlanguage']?>] SIZE=40 MAXLENGTH=255 VALUE="<?php print $_POST[title]; ?>">
			<?php
				reset($LANGUAGES);
				while(list($k,$v) = each($LANGUAGES)){
					if($k!=$SETTINGS['defaultlanguage']) print "<BR><IMG SRC=../includes/flags/".$k.".gif>&nbsp;<INPUT TYPE=text NAME=title[$k] SIZE=40 MAXLENGTH=255 VALUE=>";
				}
			?>
	  		</TD>
			</TR>

			<TR BGCOLOR=#FFFFFF>
	  		<TD WIDTH="204" VALIGN="top" ALIGN="right">
			<?php print "$MSG_520 *"; ?>
	  		</TD>
	  		<TD WIDTH="486">
			<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif"><br>
			<TEXTAREA NAME=content[<?=$SETTINGS['defaultlanguage']?>] COLS=45 ROWS=20></TEXTAREA>
			<?php
				reset($LANGUAGES);
				while(list($k,$v) = each($LANGUAGES)){
					if($k!=$SETTINGS['defaultlanguage']) print "<BR><IMG SRC=../includes/flags/".$k.".gif><br><TEXTAREA NAME=content[$k] COLS=45 ROWS=20></TEXTAREA>";
				}
			?>
	  		</TD>
			</TR>

			<TR BGCOLOR=#FFFFFF>
	  		<TD WIDTH="204" VALIGN="top" ALIGN="right">
			<?php print "$MSG_521 *"; ?>
	  		</TD>
	  		<TD WIDTH="486">
			<INPUT TYPE=radio NAME=suspended value=0
			<?php
			if($_POST[suspended] == 0) print " CHECKED";
			?>
			>
			<?php print $MSG_030; ?>
			<INPUT TYPE=radio NAME=suspended value=1
			<?php
			if($_POST[suspended] == 1) print " CHECKED";
			?>
			> <?php print $MSG_029; ?>
	  		</TD>
			</TR>

			<TR BGCOLOR=#FFFFFF>
	  		<TD WIDTH="204" VALIGN="top" ALIGN="right">&nbsp;
		
			  </TD>
	  		<TD WIDTH="486">
			<INPUT TYPE="submit" VALUE="<?=$MSG_518?>">
	  		</TD>
			</TR>
		</TABLE>
		<INPUT type="hidden" NAME="id" VALUE="<?php echo $_GET[id]; ?>">
		<INPUT type="hidden" NAME="offset" VALUE="<?php echo $_GET[offset]; ?>">
		<INPUT type="hidden" NAME="action" VALUE="addnew">

		</TD>
		</TR>
		</TABLE>	
		</FORM>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>