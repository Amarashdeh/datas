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

	#// Check if the current IP address is present in the database and if yes,
	#// Determine which action to take.
	$_X = mysql_num_rows(mysql_query("SELECT id FROM ".$DBPrefix."usersips WHERE ip='".$_SERVER["REMOTE_ADDR"]."' AND action='deny'"));
	if($_X > 0 && !strstr($_SERVER["PHP_SELF"],"admin/"))
	{
		header("Location: iperror.php");
		exit;
	}


?>
