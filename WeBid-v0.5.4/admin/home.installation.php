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

?>
<TABLE WIDTH=95% BORDER=0 CELLPADDING=2 CELLSPACING=0 BGCOLOR="#FFFFFF" ALIGN="CENTER">
  <TR>
    <TD>
		<A HREF=<?=basename($_SERVER['PHP_SELF'])?>?show=stats><?=$MSG_25_0031?></A>
	</TD>
  </TR>
</TABLE>
<TABLE WIDTH=95% BORDER=0 CELLPADDING=1 CELLSPACING=0 BGCOLOR="#0083D7" ALIGN="CENTER">
  <TR>
    <TD>
	<TABLE WIDTH="100%" BORDER="0" CELLPADDING="4" CELLSPACING="1" BGCOLOR="#0083D7">
      <TR BGCOLOR="#0083D7">
        <TD COLSPAN="2" ALIGN=CENTER class=title><?=$MSG_25_0025?></TD>
        </TR>
      <TR>
        <TD WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_528?>
		</TD>
        <TD WIDTH="71%" BGCOLOR=#FFFFFF>
			<B><?=$SETTINGS['siteurl']?></B>
		</TD>
      </TR>
      <TR>
        <TD WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_527?>
		</TD>
        <TD WIDTH="71%" BGCOLOR=#FFFFFF>
			<B><?=stripslashes($SETTINGS['sitename'])?></B>
		</TD>
      </TR>
      <TR>
        <TD WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_540?>
		</TD>
        <TD WIDTH="71%" BGCOLOR=#FFFFFF>
			<B><?=$SETTINGS['adminmail']?></B>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_25_0026?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				if($SETTINGS['cron'] == '1') {
					print "<B>".$MSG_373."</B><BR>".$MSG_25_0027;
				} else {
					print "<B>".$MSG_374."</B>";
				}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_663?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				if($SETTINGS['picturesgallery'] == '1') {
					print "<B>".$MGS_2__0066."</B><BR>".$MSG_666.": ".$SETTINGS['maxpictures']."<BR>".$MSG_671.": ".$SETTINGS['maxpicturesize'];
				} else {
					print "<B>".$MGS_2__0067."</B>";
				}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MGS_2__0025?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				if($SETTINGS['buy_now'] != '1') {
					print "<B>".$MGS_2__0066."</B>";
				} else {
					print "<B>".$MGS_2__0067."</B>";
				}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MGS_2__0032?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?	
				$bidfind = @mysql_result(@mysql_query("SELECT * FROM ".$DBPrefix."bidfind"),0,"bidfind");
				print "<B>".ucfirst($bidfind)."</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_5008?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?	
				print "<B>".$SETTINGS['currency']."</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_25_0035?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?	
				if($SETTINGS['timecorrection'] == 0) {
					print "<B>".$MSG_25_0036."</B>";
				} else {
					print "<B>".$SETTINGS['timecorrection'].$MSG_25_0037."</B>";
				}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_363?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?	
				print "<B>".$SETTINGS['datesformat']."</B>";
				if($SETTINGS['datesformat'] == 'USA') {
					print " (".$MSG_382.")";
				} else {
					print " (".$MSG_383.")";
				}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_5322?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?	
				print "<B>".$SETTINGS['defaultcountry']."</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MGS_2__0057?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				print $MSG_25_0038;
				$counters = @mysql_fetch_Array(@mysql_query("SELECT * FROM ".$DBPrefix."counterstoshow"));
				print "<B>";
				if($counters['auctions'] == 'y') {
					print $MGS_2__0060."<BR>";
				}
				if($counters['users'] == 'y') {
					print $MGS_2__0061."<BR>";
				}
				if($counters['online'] == 'y') {
					print $MGS_2__0059;
				}
				print "</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MGS_2__0002?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				while(list($k,$v) = each($LANGUAGES)) {
					print "<B>".$v."</B>";
					if($k == $SETTINGS['defaultlanguage']) {
						print " (".$MGS_2__0005.")";
					}
					print "<BR>";
				}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_25_0040?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				print "<B>".$SETTINGS['alignment']."</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MGS_2__0051?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				print "<B>".$SETTINGS['pagewidth'];
				if($SETTINGS ['pagewidthtype'] == 'perc') {
					print "%";
				} else {
					print " ".$MSG_5224;
				}
				print "</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_25_0041?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				print $MSG_5013.":<B> ".$SETTINGS ['lastitemsnumber']."</B><BR>";
				print $MSG_5015.":<B> ".$SETTINGS ['higherbidsnumber']."</B><BR>";
				print $MSG_5017.":<B> ".$SETTINGS ['endingsoonnumber']."</B><BR>";
				print $MSG_25_0042.":<B> ";
				if($SETTINGS ['loginbox'] == '1') {
					print $MSG_030;
				} else {
					print $MSG_029;
				}
				print "</B><BR>";
				print $MSG_25_0043.":<B> ";
				if($SETTINGS ['newsbox'] == '1') {
					print $MSG_030."</B>";
					print " - ".$MSG_25_0044.":<B> ".$SETTINGS['newstoshow']."</B>";
				} else {
					print $MSG_029;
				}
				print "</B><BR>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_25_0045?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
				print $MSG_25_0048.":<B> ".$SETTINGS ['thumb_show']." ".$MSG_5224."</B>";
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG__0025?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
			if($SETTINGS ['banners'] == 1) {
				print "<B>".$MGS_2__0066."</B>";
			} else {
				print "<B>".$MGS_2__0067."</B>";
			}
			?>
		</TD>
      </TR>
      <TR>
        <TD VALIGN=TOP WIDTH="29%" BGCOLOR=#FFFFFF>
			<?=$MSG_25_0049?>
		</TD>
        <TD VALIGN=TOP WIDTH="71%" BGCOLOR=#FFFFFF>
			<?php
			if($SETTINGS ['newsletter'] == 1) {
				print "<B>".$MGS_2__0066."</B>";
			} else {
				print "<B>".$MGS_2__0067."</B>";
			}
			?>
		</TD>
      </TR>
    </TABLE>
	</TD>
  </TR>
</TABLE>
