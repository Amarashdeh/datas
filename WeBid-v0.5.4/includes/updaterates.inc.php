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
//this function is actually not used since soap calls are made
Function UpdateRates()
{
	$query = "SELECT *,NOW()-(last_update) as dif from ".$DBPrefix."lastupdate";
 	$res = mysql_query($query);
	
	if(!$res)
	{
		return;
	}
	$ar = mysql_fetch_array($res);
	$mydif = (int)($ar[dif]/60) - 1440;
	print "+++++++++++++++++++++";$mydif;
	if($mydif>0)
	{
	 $fp = fopen("http://www.bankofcanada.ca/fmd/exchange.htm","r");
	 $x=0;$g=0;
	 while(!feof($fp))
	 {
	  $buf = fgets($fp, 4096);
	  if(eregi("U.S. Dollar",$buf)) $x=4;
	  if(eregi("</PRE>",$buf)) $x=0;
	  if($x==4)
	  {
       if(!eregi("US/CA",$buf))
       {
    	$ime = explode("/",$buf);
		print_r($ime);
		print "<BR>";
    	$s = explode(" ",$ime[1]);
    	$r = array_reverse ($s);

    	if(eregi("Euro de",$buf))
    	{
    	 $ime[0]="European Monetary Union EURO";
    	 $s = explode(" ",$buf);
    	 $r = array_reverse ($s);
    	}

    	if($ime[0]<>"" and $r[0]<>"")
    	{
    	 $g++;
    	 if(eregi("U.S. Dollar",$buf)) {$koef = (float)$r[0];}
    	 $k = ((float)$r[0]/(float)$koef);
    	 $usd = 1/$k;
    	 $res = mysql_query("SELECT * FROM ".$DBPrefix."rates WHERE sifra=\"$ime[0]\"");
    	 $num = mysql_num_rows($res);
    	 if($num > 0)
		 {
        	mysql_query("UPDATE ".$DBPrefix."rates SET rate='$usd' WHERE sifra=\"$ime[0]\"");
		 }
		 else
		 {
        	//mysql_query("INSERT INTO ".$DBPrefix."rates VAUES( 						 NULL,						 '$usd', sifra=\"$ime[0]\"");
		 }
    	}
       if(eregi("Venezuelan Bolivar",$buf)) $x=0;
       }
	  }
	 }
	 fclose($fp);
	 mysql_query("UPDATE ".$DBPrefix."lastupdate SET last_update=NOW();");
	}
}
?>
