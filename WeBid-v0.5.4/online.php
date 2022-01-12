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

#// ==============================================================
#// By default the expiration time is 900 seconds (15 minutes)
#// Change the value below if you need a different time interval
$DURATION = 900;
#// ==============================================================

#// You shouldn't edit the code below unless you know what you are doing

$s=session_id();
$uxtime=date("U");
$sqluni="SELECT * from ".$DBPrefix."online where SESSION='$s'";
$res=@mysql_query($sqluni);
if(!$res) {
	$cretab="CREATE TABLE ".$DBPrefix."online (
  				ID bigint(21) NOT NULL auto_increment,
  				SESSION varchar(255) NOT NULL default '',
  				time bigint(21) NOT NULL default '0',
  				PRIMARY KEY  (ID)
			)";
	@mysql_query($cretab);
}
$row=@mysql_fetch_array($res);
if(!$row) {
	$insess="INSERT into ".$DBPrefix."online (SESSION, time) values('$s','$uxtime')";
	@mysql_query($insess);

} else {
	$updtime="update ".$DBPrefix."online set time='$uxtime' where ID='$row[ID]'";
	@mysql_query($updtime);

}
$deltime=$uxtime-$DURATION;
$removeold="DELETE from ".$DBPrefix."online where time<'$deltime'";
@mysql_query($removeold);
$sql="SELECT * from ".$DBPrefix."online";
$res=@mysql_query($sql);
$count15min=@mysql_num_rows($res);

print "&nbsp;|&nbsp;<B>".$count15min."</B>&nbsp;".$MGS_2__0064;
//print "There have been $count15min users in the last 15 minutes";

?>