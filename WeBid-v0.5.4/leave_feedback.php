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

// Connect to sql server & inizialize configuration variables
require('./includes/config.inc.php');


//-- Check errors

if(!$rate && $action){
	$ERR = "ERR_041";
}else{
	if(!$feedback_text  && $action){
		$ERR = "ERR_042";
	}
}
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);

?>

<HTML>
<HEAD>
<TITLE></TITLE>


<SCRIPT Language=Javascript>

function SubmitFeedbackForm(){
	document.feedback.submit();
}


function ResetFeedbackForm(){
	document.feedback.reset();
}

</SCRIPT>


</HEAD>

<BODY  BGCOLOR="#FFFFFF" TEXT="#08428C" LINK="#08428C" VLINK="#08428C" ALINK="#08428C">

<SCRIPT Language=PHP>

require("header.php");

//-- Get current number of feedbacks
$query = "select user_id from ".$DBPrefix."feedbacks where user_id=".intval($user);
$result = mysql_query($query);

$num_feedbacks = mysql_num_rows($result);


//-- Get current total rate value for user
$query = "select rate from ".$DBPrefix."users where nick=".intval($user);
$result = mysql_query($query);
$total_rate = mysql_result($result,0,"rate");


if(!$action || $$ERR){
	
	print "<FONT FACE=\"Verdana,Helvetica,Arial\" SIZE=\"4\">";
	print "<BR><CENTER><B>$MSG_222</B><BR><BR></CENTER>";
	
	print "<CENTER>";
	print "<FONT FACE=\"Verdana, Arial, Helvetica, sans-serif\" SIZE=\"2\" COLOR=\"red\"><B>";
	print $$ERR;
	print "</FONT>";
	print "</B>";
	
	print "<FORM NAME=\"feedback\" ACTION=\"leave_feedback.php\" METHOD=POST>";
	print "<TABLE WIDTH=\"500\" BORDER=\"0\" CELLSPACING=\"1\" CELLPADDING=\"1\" BGCOLOR=\"#CCCCCC\">";
	print "<TR>";
	print "<TD>";
	print "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLSPACING=\"1\" CELLPADDING=\"4\" BGCOLOR=\"#CCCCCC\">";
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"4\" COLOR=\"#F6AF17\">";
	print "<B>$user</B>";
	print "</FONT>";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"2\" COLOR=\"#000000\">";
	print " ($num_feedbacks)  ";
	print "</FONT>";
	if($num_feedbacks > 0){
		$rate_ratio = round($total_rate/$num_feedbacks);
	}else{
		$rate_ratio = 0;
	}
	switch($rate_ratio){
		case 1:
		print "<IMG SRC=\"./images/estrella_1.gif\">";
		break;
		case 2:
		print "<IMG SRC=\"./images/estrella_2.gif\">";
		break;
		case 3:
		print "<IMG SRC=\"./images/estrella_3.gif\">";
		break;
		case 4:
		print "<IMG SRC=\"./images/estrella_4.gif\">";
		break;
		case 5:
		print "<IMG SRC=\"./images/estrella_5.gif\">";
		break;
	}
	print "</TR>";
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"2\">";
	print $MSG_224;
	print "<BR>";
	print "<CENTER>";
	print "<INPUT TYPE=radio NAME=rate VALUE=1 ";
	if($rate == "1"){
		print "CHECKED";
	}
	print "><IMG SRC=\"./images/estrella_1.gif\"> <IMG SRC=\"./images/transparent.gif\" WIDTH=\"10\"> ";
	print "<INPUT TYPE=radio NAME=rate VALUE=2 ";
	if($rate == "2"){
		print "CHECKED";
	}
	print "><IMG SRC=\"./images/estrella_2.gif\"> <IMG SRC=\"./images/transparent.gif\" WIDTH=\"10\">";
	print "<INPUT TYPE=radio NAME=rate VALUE=3 ";
	if($rate == "3"){
		print "CHECKED";
	}
	print "><IMG SRC=\"./images/estrella_3.gif\"> <IMG SRC=\"./images/transparent.gif\" WIDTH=\"10\">";
	print "<INPUT TYPE=radio NAME=rate VALUE=4 ";
	if($rate == "4"){
		print "CHECKED";
	}
	print "><IMG SRC=\"./images/estrella_4.gif\"> <IMG SRC=\"./images/transparent.gif\" WIDTH=\"10\">";
	print "<INPUT TYPE=radio NAME=rate VALUE=5 ";
	if($rate == "5"){
		print "CHECKED";
	}
	print "><IMG SRC=\"./images/estrella_5.gif\"> <IMG SRC=\"./images/transparent.gif\" WIDTH=\"10\">";
	print "</CENTER>";
	print "</TD>";
	print "</TR>";
	
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"2\">";
	print $MSG_223;
	print "<BR>";
	print "<TEXTAREA NAME=feedback_text COLS=50 ROWS=10>$feedback_text</TEXTAREA>";
	print "</TD>";
	print "</TR>";
	
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<CENTER>";
	print "<INPUT TYPE=\"hidden\" NAME=\"action\" VALUE=\"insert\">";
	print "<INPUT TYPE=\"hidden\" NAME=\"user\" VALUE=\"$user\">";
	print "<INPUT TYPE=\"hidden\" NAME=\"other_user\" VALUE=\"$YA_USER_NICK\">";
	print "<A HREF=\"javascript:SubmitFeedbackForm()\"><IMG SRC=\"./images/bt_enviar.gif\" BORDER=\"0\"></A> ";
	print "<A HREF=\"javascript:rESETFeedbackForm()\"><IMG SRC=\"./images/bt_borrar.gif\" BORDER=\"0\"></A>";
	print "</CENTER>";
	print "</TD>";
	print "</TR>";
	
	print "</TABLE>";
	print "</TD>";
	print "</TR>";
	print "</TABLE>";
	print "</FORM>";
	
}


if($action && !$$ERR){
	
	//-- Today
	$today = $NOWB;
	
	//--
	$feedback_text = nl2br($feedback_text);
	$query = "insert into ".$DBPrefix."feedbacks values (".intval($user).", ".intval($other_user).",
				\"".addslashes($feedback_text)."\", 
				".intval($rate).", \"$today\")";
	
	$result = mysql_query($query);
	
	$total_rate = $total_rate + intval($rate);
	//--
	$query = "update ".$DBPrefix."users set rate=$total_rate,reg_date=reg_date where nick='".addlashes($user)."'";
	
	
	$result = mysql_query($query);
	
	
	print "<FONT FACE=\"Verdana,Helvetica,Arial\" SIZE=\"4\">";
	print "<BR><CENTER><B>$MSG_222</B><BR><BR></CENTER>";
	
	print "<CENTER>";
	print "<FONT FACE=\"Verdana, Arial, Helvetica, sans-serif\" SIZE=\"2\" >";
	print $MSG_225;
	
	print "<TABLE WIDTH=\"500\" BORDER=\"0\" CELLSPACING=\"1\" CELLPADDING=\"1\" BGCOLOR=\"#CCCCCC\">";
	print "<TR>";
	print "<TD>";
	print "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLSPACING=\"1\" CELLPADDING=\"4\" BGCOLOR=\"#CCCCCC\">";
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"4\" COLOR=\"#F6AF17\">";
	print "<B>$user</B>";
	print "</FONT>";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"2\" COLOR=\"#000000\">";
	print " ($num_feedbacks)";
	
	if($num_feedbacks > 0){
		$rate_ratio = round($total_rate/$num_feedbacks);
	}else{
		$rate_ratio = 0;
	}
	
	switch($rate_ratio){
		case 1:
		print "<IMG SRC=\"./images/estrella_1.gif\">";
		break;
		case 2:
		print "<IMG SRC=\"./images/estrella_2.gif\">";
		break;
		case 3:
		print "<IMG SRC=\"./images/estrella_3.gif\">";
		break;
		case 4:
		print "<IMG SRC=\"./images/estrella_4.gif\">";
		break;
		case 5:
		print "<IMG SRC=\"./images/estrella_5.gif\">";
		break;
	}		print "</FONT>";
	print "</TR>";
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"2\">";
	print "<B>$MSG_226:</B>";
	print "<IMG SRC=\"./images/transparent.gif\" WIDTH=\"10\">";
	
	switch($rate){
		case 1:
		print "<IMG SRC=\"./images/estrella_1.gif\">";
		break;
		case 2:
		print "<IMG SRC=\"./images/estrella_2.gif\">";
		break;
		case 3:
		print "<IMG SRC=\"./images/estrella_3.gif\">";
		break;
		case 4:
		print "<IMG SRC=\"./images/estrella_4.gif\">";
		break;
		case 5:
		print "<IMG SRC=\"./images/estrella_5.gif\">";
		break;
	}
	print "</TD>";
	print "</TR>";
	
	print "<TR BGCOLOR=\"#FFFFFF\">";
	print "<TD COLSPAN=\"2\">";
	print "<FONT FACE=\"Verdana, Helvetica,Arial\" SIZE=\"2\">";
	print "<B>$MSG_227:</B>";
	print "<BR>";
	print $feedback_text;
	print "</TD>";
	print "</TR>";
	
	print "</TABLE>";
	print "</TD>";
	print "</TR>";
	print "</TABLE>";
	
	
}
print "<BR><BR>";
print "<CENTER>";
print "<FONT FACE=\"Verdana,Helvetica,Arial\" SIZE=\"2\">";
print "<A HREF=\"profile.php?user=$user\">$MSG_218</A>";
print "</CENTER>";

</SCRIPT>

<?php require("./footer.php"); ?>
</BODY>
</HTML>
