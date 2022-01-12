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

$query = "SELECT * FROM ".$DBPrefix."faqs";
$res = @mysql_query($query);
while($row = mysql_fetch_array($res))
{
	reset($LANGUAGES);
	while(list($k,$v) = each($LANGUAGES)){
		$TR=@mysql_fetch_array(@mysql_query("SELECT * FROM ".$DBPrefix."faqs_translated WHERE lang='".$k."' AND id=".$row['id']));
		if(!$TR){
			$query = "INSERT INTO ".$DBPrefix."faqs_translated  VALUES (
					".$row['id'].",
					'$k',
					'".addslashes($row['question'])."',
					'".addslashes($row['answer'])."')";
		}
		mysql_query($query);
		unset($TR_name);
	}
}

?>