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

if($_POST['act'] == "insert" && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
	#// Additional security check
	$RR = mysql_query("SELECT id from ".$DBPrefix."adminusers");
	if(mysql_num_rows($RR) > 0)	{
		print "Fatal error: user cannot be inserted - one or more administrators are already present in the database.<BR><A HREF=login.php>login page</A>";
		exit;
	}
	$md5_pass=md5($MD5_PREFIX.$_POST['password']);
	$query = "insert into ".$DBPrefix."adminusers values (10,'$_POST[username]', '$md5_pass', '20011224', '20020110093458', 1)";
	$result = @mysql_query($query);
	#// Redirect
	Header("Location: login.php");
	exit;
}
$query = "select MAX(id) from ".$DBPrefix."adminusers";
$result = @mysql_query($query);
while($row = mysql_fetch_row($result)) {
	$id = $row[0] + 1;
}
?>
<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="style.css" />
</HEAD>
<BODY>
<?php
if($id==1) {
	$id=0;
?>
<TABLE BORDER=0 WIDTH=650 CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF" ALIGN="CENTER">
	<TR>
		<TD><CENTER><BR><BR>
			<FORM NAME=login ACTION=login.php METHOD=POST>
			<TABLE WIDTH="410" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#336699">
			<TR>
				<TD>
					<TABLE WIDTH=100% CELLPADDING=3 ALIGN="CENTER" CELLSPACING="0" BORDER="0" BGCOLOR="#FFFFFF">
					<TR BGCOLOR="#336699">
						<TD COLSPAN="2" ALIGN=CENTER>
							<FONT COLOR=white><B>:: Please create your username and password ::</B></FONT>
						</TD>
					</TR>
					<TR>
						<TD></TD>
						<TD> <FONT COLOR=red>
						<?php print $ERR; ?>
						</TD>
					</TR>
					<TR>
						<TD ALIGN=right> 
							<?php print $MSG_003; ?>
						</TD>
						<TD>
							<INPUT TYPE=TEXT NAME=username SIZE=20 >
						</TD>
					</TR>
					<TR>
						<TD ALIGN=right> 
							<?php print $MSG_004; ?>
						</TD>
						<TD>
							<INPUT TYPE=password NAME=password SIZE=20 >
						</TD>
					</TR>
					<TR>
						<TD></TD>
						<TD>
							<INPUT TYPE="submit" NAME="act"ion VALUE="insert">
						</TD>
					</TR>
					</TABLE>
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</CENTER>
		</TD>
	</TR>
	</TABLE>
<?php

} else {
	$id=1;
	#//
	if($_POST[action] == "login") {
		if(strlen($_POST[username]) == 0 ||	strlen($_POST[password]) == 0) {
			$ERR = $ERR_047;
		} else {
			$query = "select * from ".$DBPrefix."adminusers where username='$_POST[username]' and password='".md5($MD5_PREFIX.$_POST[password])."'";
			$res = @mysql_query($query);
			if(!$res) {
				print "Error: $query<BR>".mysql_error();
				exit;
			}
			if(mysql_num_rows($res) == 0) {
				$ERR = $ERR_048;
			} else {
				$admin = mysql_fetch_array($res);
				#// Set sessions vars
				$PHPAUCTION_ADMIN_LOGIN = $admin[id];
				$PHPAUCTION_ADMIN_USER = $admin[username];
				$_SESSION["PHPAUCTION_ADMIN_LOGIN"]=$PHPAUCTION_ADMIN_LOGIN;
				$_SESSION["PHPAUCTION_ADMIN_USER"]=$PHPAUCTION_ADMIN_USER;
				#// Update last login information for this user
				$query = "update ".$DBPrefix."adminusers set lastlogin='".date("YmdHis")."' where username='$admin[username]'";
				$rr = mysql_query($query);
				if(!$rr) {
					print "Error: $query<BR>".mysql_error();
					exit;
				}
				#// Redirect
				print "<SCRIPT Language=Javascript>
						parent.location.href='index.php';
						</SCRIPT>";
				//Header("Location: home.php");
				exit;
			}
		}
	}
	
?>
<TABLE BORDER=0 WIDTH=650 CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF" ALIGN="CENTER">
<TR>
	<TD>
		<CENTER>
		<BR><BR>
<?php if(!$act || ($act && $ERR)) { ?>
		<FORM NAME=login ACTION=login.php METHOD=POST>
		<TABLE WIDTH="415" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#336699">
		<TR>
			<TD>
				<TABLE WIDTH=100% CELLPADDING=4 ALIGN="CENTER" CELLSPACING="0" BORDER="0" BGCOLOR="#FFFFFF">
				<TR BGCOLOR="#33CC33">
					<TD COLSPAN="2" ALIGN=CENTER>
						<B>:: PLEASE LOG IN WITH THE USERNAME & PASSWORD YOU CREATED ::</B>
					</TD>
				</TR>
				<TR>
					<TD></TD>
					<TD>
						<FONT COLOR=red><?php print $ERR; ?>
					</TD>
				</TR>
				<TR>
					<TD ALIGN=right> 
						<?php print $MSG_003; ?>
					</TD>
					<TD>
						<INPUT TYPE=TEXT NAME=username SIZE=20 >
					</TD>
				</TR>
				<TR>
					<TD ALIGN=right>
						<?php print $MSG_004; ?>
					</TD>
					<TD>
						<INPUT TYPE=password NAME=password SIZE=20 >
					</TD>
				</TR>
					<TR>
						<TD>&nbsp;</TD>
						<TD>
							
							<A HREF=http://www.phpauction.net/viewfaq.php?id=24 TARGET=_blank><?=$MSG_215?></A>
							
						</TD>
					</TR>
				<TR>
					<TD></TD>
					<TD>
						<INPUT TYPE="submit" NAME="action" VALUE="login">
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
		</FORM>
<?php  }  ?>
		
		</CENTER>
	</TD>
</TR>
</TABLE>
<?php  } 
require("./footer.php");  
?>