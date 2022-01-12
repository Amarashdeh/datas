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


//-- CheckAge function checks the age of a user
//-- Returns: 0 if younger than 18
//--          1 if older than 18


if(!function_exists(CheckAge)) {

	Function CheckAge($day,$month,$year)
	{
		$NOW_year	= date("Y");
		$NOW_month	= date("m");
		$NOW_day	= date("d");

		if(($NOW_year - $year) > 18)
		{
				return 1;
		}
		else if((($NOW_year - $year) == 18) && ($NOW_month > $month))
		{
				return 1;
		}
		else if((($NOW_year - $year) == 18) && ($NOW_month == $month) && ($NOW_day >= $day))
		{
				return 1;
		}
		else
		{
				return 0;
		}
	}
}

?>
