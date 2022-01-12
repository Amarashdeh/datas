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

#//Default for error message (blank)
$ERR = "&nbsp;";

#// Insert new message
if($_POST[action] == "update" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])){
	if(strlen($_POST[question]) == 0 && strlen($_POST[answer]) == 0){
		$ERR = "Required fields missing (all fields are required).";
		$settings = $_POST;
	}else{
		$query = "INSERT into ".$DBPrefix."faqs values(NULL,
			   '".addslashes($_POST['question'][$SETTINGS['defaultlanguage']])."',
			   '".addslashes($_POST['answer'][$SETTINGS['defaultlanguage']])."',
			   $_POST[category])";
		$res = @mysql_query($query);
		if(!$res){
			print "Error: $query<BR>".mysql_error();
			exit;
		}else{
			$id=mysql_insert_id();
			#// Insert into translation table.
			reset($LANGUAGES);
			while(list($k,$v) = each($LANGUAGES)){
				$query = "INSERT INTO ".$DBPrefix."faqs_translated VALUES(
						$id,
						'$k',
						'".addslashes($_POST['question'][$k])."',
						'".addslashes($_POST['answer'][$k])."')";
				$res = @mysql_query($query);
			}
			Header("Location: faqs.php");
			exit;
		}
	}
}

if($_POST[action] != "update")
{
	#// Get data from the database
	$query = "select * from ".$DBPrefix."faqscategories";
	$res_c = @mysql_query($query);
	if(!$res_c)
	{
		print "Error: $query<BR>".mysql_error();
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
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5231?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle"><FORM NAME="faq" METHOD="post" ACTION="<?=basename($_SERVER['PHP_SELF'])?>">
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" ALIGN="CENTER" BGCOLOR="#0083D7">
		<TR align=center>
			<TD BGCOLOR=#ffffff>&nbsp;</TD>
		</TR>
		<TR>
			<TD>
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
					<TR>
						<TD COLSPAN="2" BGCOLOR="#0083D7" align=center class=title>
							<?=$MSG_5231?>
						</TD>
					</TR>
					<TR BGCOLOR="#FFFFFF">
						<TD WIDTH="23%" CLASS=link HEIGHT="27" VALIGN="top">
							<?=$MSG_5238?> </TD>
						<TD WIDTH="77%" CLASS=link HEIGHT="27">
						<SELECT NAME="category">
							<?php
							while($row = mysql_fetch_array($res_c))
							{
								$row[category]=stripslashes($row[category]);
								print "<OPTION VALUE=\"$row[id]\"";
								if($_POST[category] == $row[category]) print " SELECTED";
								print ">$row[category]</OPTION>\n";
							}
						?>
						</SELECT>
						</TD>
					</TR>
					<TR BGCOLOR="#FFFFFF">
						<TD WIDTH="23%" CLASS=link HEIGHT="27" VALIGN="top">
						<?=$MSG_5239?></TD>
						<TD WIDTH="77%" CLASS=link HEIGHT="27">
							<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif">&nbsp;<INPUT TYPE="text" NAME="question[<?=$SETTINGS['defaultlanguage']?>]" SIZE="35" MAXLENGTH="200">
							<?php
								reset($LANGUAGES);
								while(list($k,$v) = each($LANGUAGES)){
									if($k!=$SETTINGS['defaultlanguage']) print "<BR><IMG SRC=../includes/flags/".$k.".gif>&nbsp;<INPUT TYPE=text NAME=question[$k] SIZE=35 MAXLENGTH=200>";
								}
							?>
						</TD>
					</TR>
					<TR BGCOLOR="#FFFFFF">
						<TD WIDTH="23%" CLASS=link HEIGHT="27" VALIGN="top">
						<?=$MSG_5240?></TD>
						<TD WIDTH="77%" CLASS=link HEIGHT="27">
							<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif"><br><TEXTAREA NAME="answer[<?=$SETTINGS['defaultlanguage']?>]" COLS="40" ROWS="15"></TEXTAREA>
							<?php
								reset($LANGUAGES);
								while(list($k,$v) = each($LANGUAGES)){
									if($k!=$SETTINGS['defaultlanguage']) print "<BR><IMG SRC=../includes/flags/".$k.".gif><br><TEXTAREA NAME=answer[$k] COLS=40 ROWS=15></TEXTAREA>";
								}
							?>
						</TD>
					</TR>
					<TR>
						<TD WIDTH="23%" BGCOLOR="#FFFFFF">
							<INPUT TYPE="hidden" NAME="action" VALUE="update">
						</TD>
						<TD WIDTH="77%" BGCOLOR="#FFFFFF">
							<INPUT TYPE="submit" NAME="Submit" VALUE="INSERT FAQ">
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