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
include "../includes/config.inc.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>WeBid Administration back-end</title>

<STYLE TYPE="text/css">
body {
scrollbar-face-color: #0083D7;
scrollbar-shadow-color: #0000cc;
scrollbar-highlight-color: #0083D7;
scrollbar-3dlight-color: #ffffff;
scrollbar-darkshadow-color: #000066;
scrollbar-track-color: #B7FFFF;
scrollbar-arrow-color: #ffffff;
}</STYLE>

<style type="text/css">
.menutitle{
cursor: pointer;
font-family: Verdana, Arial;
font-size: 10px;
color:#666666;
text-align:left;
text-decoration: none;
font-weight:bold;
padding: 4px;
}

.submenu{
font-family: Verdana, Arial;
font-size: 10px;
padding: 2px;
text-decoration: none;
text-color: #666666
}
.submenulink{
font-family: Verdana, Arial;
font-size: 10px;
padding: 2px;
text-decoration: none;
text-color: #666666
}
</style>

<script type="text/javascript">
/***********************************************
* Switch Menu script- by Martial B of http://getElementById.com/
* Modified by Dynamic Drive for format & NS4/IE4 compatibility
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

</script>
<style type="text/css">
<!--
.bullet {
	list-style-image: url(images/bul.gif);
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body bgcolor="EDF8FF" background="images/bac_bar.gif" text="#000000" link="#666666" vlink="#000000" alink="#3366CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
if(!empty($_SESSION['PHPAUCTION_ADMIN_LOGIN'])){
?>
<div id="masterdiv">
<table width="200" height="100%" border="0" cellpadding="0" cellspacing="0" background="images/bac_bar.gif">
  <tr>
    <td valign="top">
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td align="center"><img src="images/i_hom.gif" width="17" height="18"></td>
			<td><A HREF=home.php TARGET=content CLASS=menutitle><B>HOME</B></A></td>
  		</tr>
		 <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
    </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_set.gif" width="21" height="19" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('settings')"><?=strtoupper($MSG_5142)?></div>
			<span class="submenu" id="settings">
			<IMG SRC=images/bul.gif HSPACE=2><a href="settings.php" TARGET=content CLASS=submenulink><?=$MSG_526; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="batch.php" TARGET=content CLASS=submenulink><?=$MSG_348; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="picturesupload.php" TARGET=content CLASS=submenulink><?=$MSG_25_0186?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="buyitnow.php" TARGET=content CLASS=submenulink><?=$MGS_2__0025?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="errorhandling.php" TARGET=content CLASS=submenulink><?=$MSG_409?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="bidfind.php" TARGET=content CLASS=submenulink><?=$MGS_2__0032?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="countries.php" TARGET=content CLASS=submenulink><?=$MSG_081?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="payments.php" TARGET=content CLASS=submenulink><?=$MSG_075?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="durations.php" TARGET=content CLASS=submenulink><?=$MSG_069?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="increments.php" TARGET=content CLASS=submenulink><?=$MSG_128?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="membertypes.php" TARGET=content CLASS=submenulink><?=$MSG_25_0169?></a><BR><BR>
			<B><FONT COLOR=#666666><?=$MSG_276?></FONT></B><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="categories.php" TARGET=content CLASS=submenulink><?=$MSG_078?></a><BR><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_pre.gif" width="16" height="19" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('preferences')"><?=strtoupper($MSG_25_0008)?></div>
			<span class="submenu" id="preferences">
			<IMG SRC=images/bul.gif HSPACE=2><a href="currency.php" TARGET=content CLASS=submenulink><?=$MSG_5004?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="time.php" TARGET=content CLASS=submenulink><?=$MSG_344?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="dates.php" TARGET=content CLASS=submenulink><?=$MSG_363?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="defaultcountry.php" TARGET=content CLASS=submenulink><?=$MSG_5322?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="counters.php" TARGET=content CLASS=submenulink><?=$MGS_2__0057?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="multilingual.php" TARGET=content CLASS=submenulink><?=$MGS_2__0002?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="catsorting.php" TARGET=content CLASS=submenulink><?=$MSG_25_0146?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="usersauth.php" TARGET=content CLASS=submenulink><?=$MSG_25_0151?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="metatags.php" TARGET=content CLASS=submenulink><?=$MSG_25_0178?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="contactseller.php" TARGET=content CLASS=submenulink><?=$MSG_25_0216?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_gra.gif" width="19" height="19" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('graphic')"><?=strtoupper($MSG_25_0009)?></div>
			<span class="submenu" id="graphic">
			<IMG SRC=images/bul.gif HSPACE=2><a href="theme.php" TARGET=content CLASS=submenulink><?=$MSG_26_0002; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="homepage.php" TARGET=content CLASS=submenulink><?=$MSG_5005; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="fonts.php" TARGET=content CLASS=submenulink><?=$MSG_5001; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="colors.php" TARGET=content CLASS=submenulink><?=$MSG_5002?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="thumbnails.php" TARGET=content CLASS=submenulink><?=$MGS_2__0042?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_ban.gif" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('banners')"><?=strtoupper($MSG_25_0011)?></div>
			<span class="submenu" id="banners">
			<IMG SRC=images/bul.gif HSPACE=2><a href="banners.php" TARGET=content CLASS=submenulink><?=$MSG_5205; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="bannerssettings.php" TARGET=content CLASS=submenulink><?=$MSG__0013; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="managebanners.php" TARGET=content CLASS=submenulink><?=$MSG__0008?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_use.gif" width="24" height="18" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('users')"><?=strtoupper($MSG_25_0010)?></div>
			<span class="submenu" id="users">
			<B><FONT COLOR=#666666><?=$MSG_365?></FONT></B><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="newadminuser.php" TARGET=content CLASS=submenulink><?=$MSG_367; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="adminusers.php" TARGET=content CLASS=submenulink><?=$MSG_525; ?></a><BR><BR>
			<B><FONT COLOR=#666666><?=$MSG_350?></FONT></B><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="userssettings.php" TARGET=content CLASS=submenulink><?=$MSG_5268?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="acceptancetext.php" TARGET=content CLASS=submenulink><?=$MSG_25_0110?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="listusers.php" TARGET=content CLASS=submenulink><?=$MSG_045?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="activatenewsletter.php" TARGET=content CLASS=submenulink><?=$MSG_25_0079?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="newsletter.php" TARGET=content CLASS=submenulink><?=$MSG_607?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="banips.php" TARGET=content CLASS=submenulink><?=$MSG_2_0017?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="winner_address.php" TARGET=content CLASS=submenulink><?=$MSG_30_0083?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_auc.gif" width="24" height="15" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('auctions')"><?=strtoupper($MSG_239)?></div>
			<span class="submenu" id="auctions">
			<IMG SRC=images/bul.gif HSPACE=2><a href="extension.php" TARGET=content CLASS=submenulink><?=$MSG_2_0032; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="listauctions.php" TARGET=content CLASS=submenulink><?=$MSG_067; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="listclosedauctions.php" TARGET=content CLASS=submenulink><?=$MSG_5226?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="listsuspendedauctions.php" TARGET=content CLASS=submenulink><?=$MSG_5227?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_con.gif" width="22" height="19" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('contents')"><?=strtoupper($MSG_25_0018)?></div>
			<span class="submenu" id="contents">
			<IMG SRC=images/bul.gif HSPACE=2><a href="news.php" TARGET=content CLASS=submenulink><?=$MSG_516; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="aboutus.php" TARGET=content CLASS=submenulink><?=$MSG_5074; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="terms.php" TARGET=content CLASS=submenulink><?=$MSG_5075?></a><BR>
			<B><FONT COLOR=#666666><?=$MSG_148?></FONT></B><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="faqscategories.php" TARGET=content CLASS=submenulink><?=$MSG_5230?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="newfaq.php" TARGET=content CLASS=submenulink><?=$MSG_5231?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="faqs.php" TARGET=content CLASS=submenulink><?=$MSG_5232?></a><BR><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_sta.gif" width="21" height="19" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('stats')"><?=strtoupper($MSG_25_0023)?></div>
			<span class="submenu" id="stats">
			<IMG SRC=images/bul.gif HSPACE=2><a href="stats_settings.php" TARGET=content CLASS=submenulink><?=$MSG_5142; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="viewaccessstats.php" TARGET=content CLASS=submenulink><?=$MSG_5143; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="viewbrowserstats.php" TARGET=content CLASS=submenulink><?=$MSG_5165; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="viewplatformstats.php" TARGET=content CLASS=submenulink><?=$MSG_5318; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="viewdomainstats.php" TARGET=content CLASS=submenulink><?=$MSG_5166; ?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_too.gif" width="20" height="20" hspace="0"></td>
          <td width="170">
		  	<div class="menutitle" onclick="SwitchMenu('tools')"><?=strtoupper($MSG_5436)?></div>
			<span class="submenu" id="tools">
			<IMG SRC=images/bul.gif HSPACE=2><a href="maintainance.php" TARGET=content CLASS=submenulink><?=$MSG__0001; ?></a><BR>
			<IMG SRC=images/bul.gif HSPACE=2><a href="wordsfilter.php" TARGET=content CLASS=submenulink><?=$MSG_5068; ?></a><BR>
			</span>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
        <tr>
          <td width="30" align="center" valign="top"><img src="images/i_help.gif" width="18" height="19" hspace="0"></td>
          <td width="170">
		  	<A HREF=help.php TARGET=content CLASS=menutitle><B><?=strtoupper($MSG_148)?></B></A>
		  </TD>
        </tr>
        <tr>
          <td colspan=2><img src="images/bar_sep.gif" width="196" height="3" vspace="1"></td>
        </tr>
      </table></td>
  </tr>
</table>
</DIV>
<?}?>
</body>
</html>
