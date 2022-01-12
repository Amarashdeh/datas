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

	
	require('../includes/config.inc.php');

	if(!($HTTPS == '1' || $HTTPS == 'on')) exit;

	#// Retrieve user's data
	$query = "SELECT name,nick,DECODE(creditcard,'$MD5_PREFIX') as CCN, card_zip, exp_month,exp_year,card_owner
			  FROM ".$DBPrefix."users
			  WHERE id='$user'";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	else
	{
		$USER = mysql_fetch_array($res);
	}

?>

<HTML>
<HEAD>
  <TITLE><?=$SETTINGS[sitename]?></TITLE>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<BODY BGCOLOR="white" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <TABLE WIDTH="100%" CELLSPACING="0" BORDER="0" CELLPADDING="4">
    <TR BGCOLOR="#eeeeee">
      <TD WIDTH="85%" bgcolor="#eeeeee"><B><?=$MSG_5297?></B></TD>
      <TD align=right WIDTH="15%" bgcolor="#eeeeee"> <img src="images/secure.gif" width="15" height="20"></TD>
    </TR>
    <TR ALIGN="center">
      <TD colspan="2">
        <TABLE WIDTH="100%" CELLSPACING="1" BORDER="0" CELLPADDING="2" bgcolor="#ffffff">
          <TR bgcolor="#ffffff">

          <TD WIDTH="39%" valign="top">&nbsp;</TD>

          <TD WIDTH="61%" valign="top">&nbsp;</TD>
          </TR>
          <TR bgcolor="#ffffff">

          <TD WIDTH="39%" valign="top"> <B>
            <?=$MSG_294?>
            </B> </TD>

          <TD WIDTH="61%" valign="top"> 
            <?=$USER['name']?>
          </TD>
          </TR>
          <TR bgcolor="#ffffff">

          <TD WIDTH="39%" valign="top"> <B>
            <?=$MSG_293?>
            </B> </TD>

          <TD WIDTH="61%" valign="top"> 
            <?=$USER['nick']?>
          </TD>
          </TR>
          <TR bgcolor="#ffffff">

          <TD WIDTH="39%" valign="top"> <B>
            <?=$MSG_5285?>
            </B></TD>

          <TD WIDTH="61%" valign="top"> 
            <?=$USER[CCN]?>
          </TD>
          </TR>
          <TR bgcolor="#ffffff">

          <TD WIDTH="39%" valign="top"> <B>
            <?=$MSG_5286?>
            </B> </TD>

          <TD WIDTH="61%" valign="top"> 
            <?=$USER[exp_month]."/".$USER[exp_year];?>
          </TD>
          </TR>
          <TR>
		  <TD WIDTH="39%" valign="top"> <B>
            <?=$MSG_5287?>
            </B> </TD>

          <TD WIDTH="61%" valign="top"> 
            <?=$USER[card_owner];?>
          </TD>
          </TR>
          <TR>
		  <TD WIDTH="39%" valign="top"> <B>
            <?=$MSG_5301?>
            </B> </TD>

          <TD WIDTH="61%" valign="top"> 
            <?=$USER[card_zip];?>
          </TD>
          </TR>
          <TR bgcolor="#ffffff">

          <TD WIDTH="39%" valign="top">&nbsp;</TD>

          <TD WIDTH="61%" valign="top">&nbsp;</TD>
          </TR>
        </TABLE>
      </TD>
    </TR>
  </TABLE>
<BR>
          <P align="center"><A href="javascript:window.close()">Close</A></P>
</BODY>
</HTML>
