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

	
include "./includes/config.inc.php";
include $include_path."countries.inc.php";

if ($_POST[action] =="ok")
{
	if ($_POST[TPL_username])
	{
		$sql = "SELECT email,id FROM ".$DBPrefix."users WHERE nick=\"". AddSlashes($_POST[TPL_username])."\" OR email='".addslashes($_POST[TPL_username])."'";

		$res=mysql_query ($sql);
		if ($res)
		{
			if (mysql_num_rows($res)>0)
			{
					//-- Generate a new random password and mail it to the user
					$EMAIL = mysql_result($res,0,"email");
					$ID = mysql_result($res,0,"id");

					$NEWPASSWD = substr(uniqid(md5(time())),0,6);

					#// Added on Jan 2004 for XL 2.0
					$USERLANG = @mysql_result(@mysql_query("SELECT language
															FROM ".$DBPrefix."userslanguage
															WHERE user=".intval($ID)),0,"language");
					if(empty($USERLANG)) $USERLANG = $SETTINGS['defaultlanguage'];

					include $include_path."newpasswd.".$USERLANG.".inc.php";
					mail($to,$subject,$message,$from);

					//-- Update database
					$query = "update ".$DBPrefix."users set password='".md5($MD5_PREFIX.$NEWPASSWD)."'
								,reg_date=reg_date
								WHERE nick=\"".AddSlashes($_POST["TPL_username"])."\"
								OR email='".$_POST["TPL_username"]."'";
					$res = mysql_query($query);
					if(!$res)
					{
						print "An error occured while accessing the database: $query<BR>".mysql_error();
						exit;
					}

					include "header.php";
					include phpa_include("template_passwd_sent_php.html");
					include "footer.php";
					exit;
			}
			else
			{
				$TPL_err=1;
				$TPL_errmsg=$ERR_100;
			}
		}
		else
		{
			MySQLError($query);
			exit;
		}
	}
	else
	{
		$TPL_err=1;
		$TPL_errmsg=$ERR_112;
	}
}

if(!$_POST[action] || ($_POST[action] && $TPL_errmsg))
{
	include "header.php";
	include phpa_include("template_forgotpasswd_php.html");
}


	include "footer.php";
	$TPL_err=0;
	$TPL_errmsg="";
?>
