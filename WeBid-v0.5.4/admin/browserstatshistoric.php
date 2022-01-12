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
	$query = "SELECT year FROM ".$DBPrefix."currentbrowsers WHERE (year<>".date("Y")."
			  OR (year=".date("Y")." AND month<>".date("m").")) GROUP BY year ORDER BY year desc";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query".mysql_error();
		exit;
	}
	while($year = mysql_fetch_array($res))
	{
		$query = "SELECT * FROM ".$DBPrefix."currentbrowsers WHERE year=".$year[year]." AND month<>'".date("m")."' GROUP BY month ORDER BY month desc";
		$r_ = @mysql_query($query);
		if(!$r_)
		{
			print "Error: $query".mysql_error();
			exit;
		}
		//print $year[year]."<BR>";
		while($month = mysql_fetch_array($r_))
		{
			$YEARS[$year[year]][$month[month]] = $month[month];
		}
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
          <td class=white><?=$MSG_25_0023?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5165?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
  <TABLE WIDTH=780 CELLPADDING=2 CELLSPACING=1 BORDER=0 ALIGN="CENTER">
    <TR BGCOLOR="#FFCC00">
      <TD ALIGN=CENTER colspan="2" bgcolor="#eeeeee">
        <p class=title>
          <?=$MSG_5167."<I>$SETTINGS[sitename]</I>"?>
          </b> <BR>
          <B>
          <?=$MSG_5281;?>
          </B></p>
        <p>
			<A HREF=viewaccessstats.php?><?=$MSG_5143?></A> |
			<A HREF=viewdomainstats.php?><?=$MSG_5166?></A> |
			<A HREF=viewplatformstats.php?><?=$MSG_5318?></A>
			</p>
      </TD>
    </TR>
    <TR BGCOLOR=#FFFFFF>
      <TD width="80">&nbsp;</TD>
      <TD width="692">&nbsp;</TD>
    </TR>
    <tr bgcolor="#CCCCCC">
      <td width="80" height="21">
        <b>
        <?=$MSG_5280?>
        </b>  </td>
      <td align=right height="21" width="692">
        <a href="viewbrowserstats.php">
        <?=$MSG_5282?>
        </a>  </td>
      <?php
	  	if(is_array($YEARS))
		{
			while(list($k,$v) = each($YEARS))
			{
		?>
			<TR BGCOLOR=yellow>
				<TD COLSPAN=2 >
				<B><?=$k?></B>
				</TD>
			</TR>
			<?php
				while(list($t,$z) = each($v))
				{
			?>
    		<TR BGCOLOR=#eeeeee>
    		  <TD width="80"><b>
        		<?=$t?>
        		</b> </TD>
    		  <TD width="692">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="91%">
              <?php
			  	   $query = "SELECT browser,counter
				   			 FROM ".$DBPrefix."currentbrowsers
				   		 	 WHERE year='$k' AND month='$t'";
				   $RR = @mysql_query($query);
				   if(!$RR)
				   {
				   		print "Error: $query<BR>".mysql_error();
						exit;
				   }
				   else
				   {
				  		while($row = mysql_fetch_array($RR))
						{
							$query = "SELECT max(counter) as MAX, sum(counter) as TOTAL
				   					  FROM ".$DBPrefix."currentbrowsers
				   		 			  WHERE year='$k' AND month='$t'";
							$R___ = @mysql_query($query);
							$MAX = mysql_result($R___,0,"MAX");
							$TOTAL = mysql_result($R___,0,"TOTAL");

							$WIDTH = ( $row[counter] * $ABSOLUTEWIDTH ) / $MAX;
				  			$PERCENAGE = ceil(intval($row[counter] * 100 / $TOTAL));
							print $row[browser];
							?>
            				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                			  <tr>
                				<td width="2%">
                    			  <table border=0 callpadding=0 cellspacing=0 width=<?=intval($WIDTH)?> bgcolor=#006699>
                    				<tr>
                        			  <td>&nbsp; </td>
                    				</tr>
                    			  </table>
                				</td>
                				<td width="98%">
                    			  &nbsp;<?=$PERCENAGE?>
                    			  % </td>
                			  </tr>
            				</table>
					<?php
						}
					}
					?>
            </td>
          </tr>
        </table>
    		  </TD>
    		</TR>
    		<?php
				}
		 	}
		}
	?>
  </TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>