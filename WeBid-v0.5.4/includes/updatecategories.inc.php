<?php
if(!defined('INCLUDED')) exit("Access denied");
$NOW = date("YmdHis",mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y")));
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

$query = "SELECT * FROM ".$DBPrefix."categories";
$res = @mysql_query($query);
while($row = mysql_fetch_array($res))
{
	reset($LANGUAGES);
	while(list($k,$v) = each($LANGUAGES)){
		$TR_name=@mysql_result(@mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE lang='".$k."' AND cat_id=".$row['cat_id']),0,"cat_name");
		if(!empty($TR_name)){
			$query = "UPDATE ".$DBPrefix."cats_translated SET cat_name'".addslashes($row['cat_name'])."' WHERE cat_id=".$row['cat_id']." AND lang'".$k."'";
		}else{
			$query = "INSERT INTO ".$DBPrefix."cats_translated  VALUES (
					".$row['cat_id'].",
					'$k',
					'".addslashes($row['cat_name'])."')";
		}
		mysql_query($query);unset($TR_name);
	}
}

?>