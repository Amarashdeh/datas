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

	if(basename($PHP_SELF) != "user_login.php")
	{
		#// Check if we are in Maintainance mode
		#// And if the logged in user is the superuser
		$query = "SELECT * FROM ".$DBPrefix."maintainance";
		$res = mysql_query($query);
		if($res && @mysql_num_rows($res) > 0)
		{
			$MAINTAINANCE = mysql_fetch_array($res);

			if($MAINTAINANCE[active] == 'y' && $_SESSION[PHPAUCTION_LOGGED_IN_USERNAME] != $MAINTAINANCE[superuser])
			{
				print $MAINTAINANCE[maintainancetext];
				exit;
			}
		}
	}
?>