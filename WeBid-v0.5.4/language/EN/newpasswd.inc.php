<?php
if(!defined('INCLUDED')) exit("Access denied");
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

$to 		= $EMAIL;
$from 	= "From: $SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET";
$subject	= "Your new password";
$message = "Hi $TPL_username,<br>
As you requested, we have created a new password for your account.<br>
<br>
It is: $NEWPASSWD<br>
<br>
Use it to login to $SETTINGS[sitename] and remember to change it to the one you prefer.
";
?>