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
#// Retrieve banned free mail domains
$DOMAINS=@mysql_result(@mysql_query("SELECT banemail FROM ".$DBPrefix."usersettings"),0,"banemail");
$BANNEDDOMAINS = array_filter(explode("\n",$DOMAINS),chop);
if(count($BANNEDDOMAINS)>0){
	$TPL_domains_alert=$MSG_30_0053."<UL>";
	while(list($k,$v) = each($BANNEDDOMAINS)){
		$TPL_domains_alert.="<LI><B>".$v."</B>";
	}
	$TPL_domains_alert.="</UL>";
}else{
	$TPL_domains_alert='';
}

Function BannedEmail($email,$domains){
	$dom = explode('@',$email);
	$domains = array_map(chop,$domains);
	if(in_array($dom[1],$domains)){
		return TRUE;
	}else{
		return FALSE;
	}

}
 ?>
