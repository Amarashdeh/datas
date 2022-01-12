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

	include "includes/config.inc.php";
	$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
	$NOW = date("YmdHis",$TIME);
	if($_POST['action'] && $_POST['username'] && $_POST['password'])
	{
		$query = "select id,name,email,accounttype from ".$DBPrefix."users where 
					nick='".addslashes($_POST['username'])."' and password='".md5($MD5_PREFIX.$_POST["password"])."' and suspended=0";
		$res = mysql_query($query);
		//print $query;;
		if(mysql_num_rows($res) > 0)
		{
			$_SESSION["PHPAUCTION_LOGGED_IN"] = mysql_result($res,0,"id");
			$_SESSION["PHPAUCTION_LOGGED_EMAIL"] = mysql_result($res,0,"email");
			$_SESSION["PHPAUCTION_LOGGED_NAME"] = mysql_result($res,0,"name");
			$_SESSION["PHPAUCTION_LOGGED_ACCOUNT"] = mysql_result($res,0,"accounttype");
			$_SESSION["PHPAUCTION_LOGGED_IN_USERNAME"] = $_POST["username"];
			
			#// Update "last login" fields in users table
			@mysql_query("UPDATE ".$DBPrefix."users SET lastlogin='".date("Y-m-d H:i:s",$TIME)."',
						reg_date=reg_date
						WHERE id=".$_SESSION["PHPAUCTION_LOGGED_IN"]);
			
			#// Remember me option
			if($_POST['rememberme'] == 1) {
				$remember_key=md5(time());
				$query = "INSERT INTO ".$DBPrefix."rememberme VALUES(".intval(mysql_result($res,0,"id")).",'".addslashes($remember_key)."')";
				if(!@mysql_query($query)){
					MySQLError($query);
					exit;
				}
				setcookie("PHPAUCTION_RM_ID",$remember_key,time()+(3600*24*365));
			}
		}else{
			$_SESSION['loginerror'] = $ERR_038;
		}
	}else{
		$_SESSION['loginerror'] = $ERR_038;
	}

	#// ===========================================================
	#// Added by Gian for IP banning
	#// Store user IP address in the database
	#// ===========================================================
	$query = "SELECT id FROM ".$DBPrefix."usersips where USER='".$_SESSION["PHPAUCTION_LOGGED_IN"]."' AND ip='".$_SERVER["REMOTE_ADDR"]."'";
	//print $query;
	$RR = mysql_query($query);
	if(!$RR)
	{
		MySQLError($query);
		exit;
	}
	elseif(mysql_num_rows($RR) == 0)
	{
		$query = "INSERT INTO ".$DBPrefix."usersips VALUES(
				  NULL,
				  '".$_SESSION["PHPAUCTION_LOGGED_IN"]."',
				  '".$_SERVER["REMOTE_ADDR"]."',
				  'after','accept')";
		$res___ = @mysql_query($query);
		if(!$res___)
		{
			MySQLError($query);
			exit;
		}
	}
	#// ===========================================================



	//Header("Location: $_SERVER['HTTP_REFERER']");
	Header("Location: $Https[httpsurl]"."index.php");
	exit;
?>