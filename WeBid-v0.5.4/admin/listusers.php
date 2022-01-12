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

if($_GET['usersfilter'] == 'all') {
    unset($_SESSION["usersfilter"]);
    unset($Q);
} elseif(isset($_GET['usersfilter'])) {
    switch($_GET['usersfilter']) {
        case 'active':
        $Q = 0;
        break;
        case 'admin':
        $Q = 1;
        break;
        case 'confirmed':
        $Q = 8;
        break;
        case 'fee':
        $Q = 9;
        break;
        case 'sellers':
        $account = 'seller';
        break;
        case 'buyers':
        $account = 'buyer';
        break;
    }
    $usersfilter = $_GET['usersfilter'];
    $_SESSION["usersfilter"]=$usersfilter;
} elseif(!isset($_GET['usersfilter']) && isset($_SESSION['usersfilter'])) {
    switch($_SESSION['usersfilter']) {
        case 'active':
        $Q = 0;
        break;
        case 'admin':
        $Q = 1;
        break;
        case 'confirmed':
        $Q = 8;
        break;
        case 'fee':
        $Q = 9;
        break;
        case 'sellers':
        $account = 'seller';
        break;
        case 'buyers':
        $account = 'buyer';
        break;
    }
} else {
    unset($_SESSION["usersfilter"]);
    unset($Q);
}


#// Retrieve active auctions from the database
if(isset($Q)) {
    $TOTALUSERS = mysql_result(mysql_query("select count(id) as COUNT from ".$DBPrefix."users WHERE suspended=$Q"),0,"COUNT");
} elseif(isset($account)) {
    $TOTALUSERS = mysql_result(mysql_query("select count(id) as COUNT from ".$DBPrefix."users WHERE accounttype='$account'"),0,"COUNT");
} else {
    $TOTALUSERS = mysql_result(mysql_query("select count(id) as COUNT from ".$DBPrefix."users"),0,"COUNT");
}

//-- Set offset and limit for pagination
$LIMIT = 30;
if(!$offset) $offset = 0;

if(!isset($_GET[PAGE]) || $_GET[PAGE] == 1 || !$_GET[PAGE]) {
    $OFFSET = 0;
    $PAGE = 1;
} else {
    $PAGE = $_GET[PAGE];
    $OFFSET = ($_GET[PAGE] - 1) * $LIMIT;
}
$PAGES = ceil($TOTALUSERS / $LIMIT);
$_SESSION['RETURN_LIST'] = 'listusers.php';
$_SESSION['RETURN_LIST_PAGE'] = intval($PAGE);

?>
<HTML>
<HEAD>
<SCRIPT Language=Javascript>
<!--
function SubmitFilter()
{
    document.filter.submit();
}
//-->
</SCRIPT>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=Javascript>
function window_open(pagina,titulo,ancho,largo,x,y){
    
    var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
    open(pagina,titulo,Ventana);
    
}
</SCRIPT>
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif">
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_use.gif" ></td>
          <td class=white><?=$MSG_25_0010?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_045?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center" valign="middle">
            <TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
            <TR>
            <TD ALIGN=CENTER class=title><?php print $MSG_045; ?></TD>
            </TR>
            <TR>
            <TD>
                <TABLE WIDTH=100% CELPADDING=0 CELLSPACING=1 BORDER=0 ALIGN="CENTER" CELLPADDING="3" BGCOLOR=#ffffff>
                <TR>
                <TD COLSPAN=8>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
                    <FORM NAME=search ACTION=userssearch.php METHOD=POST>
                    <tr>
                    <td bgcolor="#eeeeee"> 
                    <BR>
                    <?=$MSG_5022?> <INPUT TYPE=text NAME=keyword SIZE=25>
                    <input type=SUBMIT name=SUBMIT value="<?=$MSG_5023?>">
                    <?=$MSG_5024?>
                    </td>
                    </tr>
                    </FORM>
                    </table>
                </TD>
                </TR>
                <TR BGCOLOR=#FFFFFF>
                <TD COLSPAN=8>
                <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=0 BORDER=0>
    			    <FORM NAME="filter" ACTION="<?=basename($_SERVER['PHP_SELF'])?>">
                  <TR>
                    <TD WIDTH=30%> <B>
                    <?=$TOTALUSERS." ".$MSG_301?>
                    </B> </TD>
                    <TD WIDTH=20% valign="center">
                    <TD WIDTH=50% align=right>
                    <?=$MSG_5295?>
                    <SELECT NAME=usersfilter onChange="SubmitFilter()">
                    <OPTION VALUE=all>
                    <?=$MSG_5296?>
                    </OPTION>
                    <OPTION VALUE=active <?if($_SESSION['usersfilter'] == 'active') print " selected"?>>
                    <?=$MSG_5291?>
                    </OPTION>
                    <OPTION VALUE=admin <?if($_SESSION['usersfilter'] == 'admin') print " selected"?>>
                    <?=$MSG_5294?>
                    </OPTION>
                    <OPTION VALUE=fee <?if($_SESSION['usersfilter'] == 'fee') print " selected"?>>
                    <?=$MSG_5293?>
                    </OPTION>
                    <OPTION VALUE=confirmed <?if($_SESSION['usersfilter'] == 'confirmed') print " selected"?>>
                    <?=$MSG_5292?>
                    </OPTION>
                    <?php
                    if($SETTINGS['accounttype'] == 'sellerbuyer') {
                    ?>
                    <OPTION VALUE=sellers <?if($_SESSION['usersfilter'] == 'sellers') print " selected"?>>
                    <?=$MSG_25_0138?>
                    </OPTION>
                    <OPTION VALUE=buyers <?if($_SESSION['usersfilter'] == 'buyers') print " selected"?>>
                    <?=$MSG_25_0139?>
                    </OPTION>
                    <?php
                    }
                    ?>
                    </SELECT>
                    </TD>
                  </TR>
                  </FORM>
                  </TABLE>
                </TD>
                </TR>
                <TR BGCOLOR="#FFCC00">
                    <TD ALIGN=CENTER width="5%"> <B> <?php print $MSG_5289; ?> </B>  </TD>
                    <TD ALIGN=LEFT width="20%"> <B> <?php print $MSG_293; ?> </B>  </TD>
                    <TD ALIGN=LEFT width="30%"> <B> <?php print $MSG_294; ?> </B>  </TD>
                    <TD ALIGN=LEFT width="10%"> <B> <?php print $MSG_295; ?> </B>  </TD>
                    <TD ALIGN=LEFT width="10%"> <B> <?php print $MSG_296; ?> </B>  </TD>
                    <TD ALIGN=LEFT width="10%"> <B> <?php print strtoupper($MSG_25_0079); ?> </B>  </TD>
                    <TD ALIGN=LEFT width="10%"> <B> <?php print strtoupper($MSG_560); ?> </B>  </TD>
                    <TD ALIGN=LEFT width="75"> <B> <?php print $MSG_297; ?> </B>  </TD>
                </tr>
                <?php
                if(isset($Q)) {
                    $query = "select * from ".$DBPrefix."users WHERE suspended=$Q order by nick limit $OFFSET, $LIMIT";
                } elseif(isset($account)) {
                    $query = "select * from ".$DBPrefix."users WHERE accounttype='$account' order by nick limit $OFFSET, $LIMIT";
                } else {
                    $query = "select * from ".$DBPrefix."users order by nick limit $OFFSET, $LIMIT";
                }
                $result = mysql_query($query);
                if(!$result) {
                    print "Database access error: abnormal termination<BR>$query<BR>".mysql_error();
                    exit;
                }
                $num_users = mysql_num_rows($result);
                $i = 0;
                $bgcolor = "#FFFFFF";
                while($i < $num_users){
                    if($bgcolor == "#FFFFFF"){
                        $bgcolor = "#EEEEEE";
                    }else{
                        $bgcolor = "#FFFFFF";
                    }
                    $id = mysql_result($result,$i,"id");
                    $nick = mysql_result($result,$i,"nick");
                    $name = mysql_result($result,$i,"name");
                    $country = mysql_result($result,$i,"country");
                    $email = mysql_result($result,$i,"email");
                    $creditcard = mysql_result($result,$i,"creditcard");
                    $suspended = mysql_result($result,$i,"suspended");
                    $newsletter = mysql_result($result,$i,"nletter");

                    print "<TR BGCOLOR=$bgcolor><TD ALIGN=CENTER width=5%>";
                    if(!empty($creditcard) && $Https['https'] == 'yes') {
                        print "<A HREF=javascript:window_open('".$Https['httpsurl']."admin/viewcc.php?user=$id','incre',400,280,30,30)><IMG SRC=images/visa.gif BORDER=0></A>";
                    } elseif(!empty($creditcard) && $Https['https'] == 'no') {
                        print "<A HREF=javascript:window_open('httpsneeded.php','incre',400,200,30,30)><IMG SRC=images/visa.gif BORDER=0></A>";
                    }
                    print "        </TD>
                    <TD>$nick</TD>
                    <TD>$name</TD>
                    <TD>$country</TD>
                    <TD><A HREF=\"mailto:$email\">$email</A></TD>
                    <TD align=center>";
                    if($newsletter == 1) {
                        print "$MSG_030";
                    }
                    if($newsletter == 2) {
                        print "$MSG_029";
                    }
                    print "</TD><TD>";
                    if($suspended == 0) {
                        print "<B><FONT COLOR=green>$MSG_5291</B>";
                    }
                    if($suspended == 1) {
                        print "<B><FONT COLOR=violet>$MSG_5294</B>";
                    }
                    if($suspended == 9) {
                        print "<B><FONT COLOR=red>$MSG_5293</B>";
                    }
                    if($suspended == 10) {
                        print "<B><FONT COLOR=orange><A HREF=\"excludeuser.php?id=$id&offset=$offset\" class=\"nounderlined\">".$MSG_25_0136."</A>";
                    }
                    if($suspended == 8) {
                        print "<B><FONT COLOR=orange>$MSG_5292</B>
                               <BR>
                               <A HREF=resendemail.php?id=$id>$MSG_25_0074</A>
									";
				}
				if($suspended == 1) {
				print "
									<B><FONT COLOR=violet>$MSG_5294</B>
                               ";
                    }
                    print "</TD>";
                    print "<TD ALIGN=LEFT>
                    <A HREF=\"edituser.php?userid=$id&offset=$offset\" class=\"nounderlined\">$MSG_298</A><BR>
                    <A HREF=\"deleteuser.php?id=$id&offset=$offset\" class=\"nounderlined\">$MSG_008</A><BR>
                    <A HREF=\"excludeuser.php?id=$id&offset=$offset\" class=\"nounderlined\">";
                    if($suspended == 0) {
                        print $MSG_300;
                    } else {
                        print $MSG_310;
                    }
                    print "</A><BR>
                    <A HREF=\"viewuserauctions.php?id=$id&offset=$offset\" class=\"nounderlined\">$MSG_5094</A><BR>
                    <A HREF=\"userfeedback.php?id=$id&offset=$offset\" class=\"nounderlined\">$MSG_503</A><BR>
                    <A HREF=\"viewuserips.php?id=$id&offset=$offset\" class=\"nounderlined\">$MSG_2_0004</A>
                    </TD>
                    </TR>";
                    $i++;
                }
                ?>
                </TABLE>
                <center class=white>
                <?=$MSG_5117?>
                &nbsp;&nbsp;
                <?=$PAGE?>
                <?=$MSG_5118?>
                &nbsp;&nbsp;
                <?=$PAGES?>
                <BR>
                <?php
                $PREV = intval($PAGE - 1);
                $NEXT = intval($PAGE  + 1);
                ?>
                <?php
                if($PAGES > 1) {
                    if($PAGE > 1) {
                ?>
    		  	<A HREF="<?=basename($_SERVER[PHP_SELF])?>?PAGE=<?=$PREV?>"><U><SPAN CLASS=white>
                <?=$MSG_5119?>
                </SPAN></U></a> &nbsp;&nbsp;
                <?php
                }
                ?>
                <?php
                $LOW = $PAGE - 5;
                if($LOW <= 0) $LOW = 1;
                $COUNTER = $LOW;
                while($COUNTER <= $PAGES && $COUNTER < ($PAGE+6)) {
                if($PAGE == $COUNTER) {
                    print "<B>$COUNTER</B>&nbsp;&nbsp;";
                } else {
					print "<A HREF=\"".basename($_SERVER[PHP_SELF])."?PAGE=$COUNTER\"><U><SPAN CLASS=white>$COUNTER</SPAN></U></A>&nbsp;&nbsp;";
                }
                $COUNTER++;
                }
                ?>
                &nbsp;&nbsp;
                <?php
                if($PAGE < $PAGES) {
                ?>
      			<A HREF="<?=basename($_SERVER[PHP_SELF])?>?PAGE=<?=$NEXT?>"><U><SPAN CLASS=white>
                  <?=$MSG_5120?>
                  </SPAN></U></A> 
                <?php
                    }
                }
                ?>
                </center>
                </TD>
              </TR>
            </TABLE>
            <BR>
          </TD>
        </TR>
      </TABLE>
    </td>
  </tr>
</table>
</BODY>
</HTML>
