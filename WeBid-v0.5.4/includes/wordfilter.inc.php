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



Function Filter($txt)
{
	#//
	$query = "SELECT * FROM ".$DBPrefix."filterwords";
	$res__ = @mysql_query($query);
	if(!$res__)
	{
		MySQLError($query);
		exit;
	}
	elseif(mysql_num_rows($res__) > 0)
	{
		while($word = mysql_fetch_array($res__))
		{
			$txt = str_replace($word[word],"",$txt);
		}
	}

	return $txt;
}
?>