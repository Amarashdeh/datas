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
include "loggedin.inc.php";


$ABSOLUTEWIDTH = 650;

#// Retrieve data
$query = "SELECT * FROM ".$DBPrefix."currentaccesses ORDER BY day";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query".mysql_error();
	exit;
}

$MAX = 0;
while($row = mysql_fetch_array($res))
{
	$PAGEVIEWS[$row[day]] = $row[pageviews];
	$UNIQUEVISITORS[$row[day]] = $row[uniquevisitors];
	$USERSESSIONS[$row[day]] = $row[usersessions];
	
	if(max($PAGEVIEWS[$row[day]],$UNIQUEVISITORS[$row[day]],$USERSESSIONS[$row[day]]) > $MAX)
	{
		$MAX = max($PAGEVIEWS[$row[day]],$UNIQUEVISITORS[$row[day]],$USERSESSIONS[$row[day]]);
	}
}
if(is_array($PAGEVIEWS))
{
	$TOTAL_PAGEVIEWS = array_sum($PAGEVIEWS);
	$TOTAL_UNIQUEVISITORS = array_sum($UNIQUEVISITORS);
	$TOTAL_USERSESSIONS = array_sum($USERSESSIONS);
}
?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_sta.gif" ></td>
          <td class=white><?=$MSG_25_0023?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5143?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
  <TABLE WIDTH=95% CELLPADDING=2 CELLSPACING=1 BORDER=0 ALIGN="CENTER">
    <TR BGCOLOR="#FFCC00">
      <TD ALIGN=CENTER colspan="2" bgcolor="#eeeeee">
        <p class=title>
          <?=$MSG_5158."<I>$SETTINGS[sitename]</I>"?>
          <BR>
          <?=date("F Y");?>
          </p>
        <p>
			<A HREF=viewbrowserstats.php?><?=$MSG_5165?></A> |
			<A HREF=viewdomainstats.php?><?=$MSG_5166?></A> |
			<A HREF=viewplatformstats.php?><?=$MSG_5318?></A>
		</p>
      </TD>
    </TR>
    <TR>
      <TD colspan="2">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF">
          <tr>
            <td><b>
              <?=strtoupper($MSG_5164)?>
              </b></td>
          </tr>
          <tr>
            <td>
              <table border=0 callpadding=0 cellspacing=0 width=250 bgcolor=red>
                <tr>
                  <td width="22" bgcolor="#006699">&nbsp;</td>
                  <td bgcolor="#FFFFFF" width="144"><b>&nbsp;
                    <?=$MSG_5161?>
                    : </b></td>
                  <td bgcolor="#FFFFFF" width="78"><b>
                    <?=$TOTAL_PAGEVIEWS?>
                    </b></td>
                </tr>
              </table>
              <table border=0 callpadding=0 cellspacing=0 width=250 bgcolor=orange>
                <tr>
                  <td width="22" bgcolor="#66CC00">&nbsp;</td>
                  <td bgcolor="#FFFFFF" width="144"><b>&nbsp;
                    <?=$MSG_5162?>
                    : </b></td>
                  <td bgcolor="#FFFFFF" width="78"><b>
                    <?=$TOTAL_UNIQUEVISITORS?>
                    </b></td>
                </tr>
              </table>
              <table border=0 callpadding=0 cellspacing=0 width=250 bgcolor=yellow>
                <tr>
                  <td width="22">&nbsp;</td>
                  <td bgcolor="#FFFFFF" width="144"><b>&nbsp;
                    <?=$MSG_5163?>
                    :<b>
                    </b></b></td>
                  <td bgcolor="#FFFFFF" width="78">
                    <b> <b>
                    <?=$TOTAL_USERSESSIONS?>
                    </b> </b>
                  </td>
                </tr>
              </table>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table>
      </TD>
    </TR>
    <TR BGCOLOR=#FFFFFF>
      <TD width="80">&nbsp;</TD>
      <TD width="692">&nbsp;</TD>
    </TR>
    <tr bgcolor="#CCCCCC">
      <td align=CENTER width="80" height="21"> 
        <b>
        <?=$MSG_5159?>
        </b>  </td>
      <td align=right height="21" width="692"> 
        <a href="accessstatshistoric.php">
        <?=$MSG_5160?>
        </a>  </td>
      <?php
      while(list($k,$vv) = @each($PAGEVIEWS))
      {
		?>
    		<TR BGCOLOR=#eeeeee>
    		  <TD width="80" ALIGN=CENTER> <b>
        		<?=$k?>
        		</b> </TD>
    		  <TD width="692">
        		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        		  <tr>
            		<td width="89%"> 
            		  <?php $WIDTH = ( $PAGEVIEWS[$k] * $ABSOLUTEWIDTH ) / $MAX;?>
            		  
            		  <TABLE BORDER=0 CALLPADDING=0 CELLSPACING=0 WIDTH=<?=intval($WIDTH)?> BGCOLOR=#006699>
                		<TR>
                		  <TD><B><FONT COLOR=white>
                    		<?=$PAGEVIEWS[$k]?>
                    		</B></TD>
                		</TR>
            		  </TABLE>
            		</td>
        		  </tr>
        		  <tr>
            		<td width="89%"> 
            		  <?php $WIDTH = ( $UNIQUEVISITORS[$k] * $ABSOLUTEWIDTH ) / $MAX;?>
            		  
            		  <TABLE BORDER=0 CALLPADDING=0 CELLSPACING=0 WIDTH=<?=intval($WIDTH)?> BGCOLOR=#66CC00>
                		<TR>
                		  <TD><B><FONT COLOR=white>
                    		<?=$UNIQUEVISITORS[$k]?>
                    		</B></TD>
                		</TR>
            		  </TABLE>
            		</td>
        		  </tr>
        		  <tr>
            		<td width="89%"> 
            		  <?php $WIDTH = ( $USERSESSIONS[$k] * $ABSOLUTEWIDTH ) / $MAX;?>
            		  
            		  <TABLE BORDER=0 CALLPADDING=0 CELLSPACING=0 WIDTH=<?=intval($WIDTH)?> BGCOLOR=#FFFF33>
                		<TR>
                		  <TD><B>
                    		<?=$USERSESSIONS[$k]?>
                    		</B></TD>
                		</TR>
            		  </TABLE>
            		</td>
        		  </tr>
        		</table>
    		  </TD>
    		</TR>
    <?php
      }
		?>
  </TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>
