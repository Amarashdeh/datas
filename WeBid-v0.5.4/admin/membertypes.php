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

$DBGSTR = "DBGSTR: ". count($delete). "-" .
count($old_membertypes) . " <br><br>\n";

include "./rebuild_tables.php";

/*
* When the submit button is pressed (below on the page) on
* the first call to countires.php it calls countires.php
* again but with a form variable named "act" being sent as true
* (see the submit input in the HTML below).  This causes the execution
* of the below code.
*/

if ($_POST[act] && basename($_SERVER[HTTP_REFERER]) == basename($_SERVER[PHP_SELF])) {
  $old_membertypes = $_POST[old_membertypes];
  $new_membertypes = $_POST[new_membertypes];
  $new_membertype = $_POST[new_membertype];
  $delete = $_POST[delete];
	/*
	*	For a description of how the arrays (delete[], new_countries[],
	*	old_countries[]) are set up see the body of the HTML below.
	*/
	// we use a single SQL query to quickly do ALL our deletes
	$sqlstr = "DELETE FROM ".$DBPrefix."membertypes WHERE id IN (";
	/*
	* Delete anything marked for deletion in the delete[]
	* array.
	*/
	// if this is the first country being deleted it don't
	// precede it with an " or " in the SQL string
	if(is_array($delete)) {
		$idslist=join(",",$delete);
		$sqlstr.=$idslist.")";
		$DBGSTR=$sqlstr;
		// If the delete array is > 0 in size
		if (count($delete)) {
			$result = mysql_query($sqlstr);
			if ( !$result ) {
				echo "$DBGSTR";
				$TPL_info_err = $ERR_001;
			} else {
				$TPL_info_err = "";
			}
		}
	}
	/*
	* Now we update all the countries where old_countries
	* isn't the same as new_countries (saving ourselves a
	* lot of queries.
	*/
	if(is_array($old_membertypes)) {
		foreach($old_membertypes as $id => $val) {
			if ( "hey" != "hey")
			$DBGSTR .= "hey != hey";
			if ( $val != $new_membertypes[$id]) {
				$sqlstr = "UPDATE ".$DBPrefix."membertypes SET
							feedbacks = \"" .$new_membertypes[$id]["feedbacks"] . "\" , 
							membertype = \"\" , 
							icon = \"" .$new_membertypes[$id]["icon"] . "\" 
							WHERE id = " .$id;
				$DBGSTR .= "<br>" . $sqlstr;
				$result = mysql_query($sqlstr);
				if (!$result) {
					$TPL_info_err = $ERR_001;
					echo "$DBGSTR";
				}
			}
		}
	}
	
	/* If a new membertype was added, insert it into database */
	if ( !empty($new_membertype["feedbacks"]) )
	{
		$sqlstr = "INSERT INTO ".$DBPrefix."membertypes VALUES (\"\",'";
		$sqlstr .= $new_membertype["feedbacks"] . "','";
		$sqlstr .= $new_membertype["membertype"] . "','";
		$sqlstr .= "','";
		$sqlstr .= $new_membertype["icon"] . "');";
		$result = mysql_query($sqlstr);
		if (!$result) {
			$TPL_info_err = $ERR_001;
			echo "$DBGSTR";
		}
	}
	
	rebuild_table_file("membertypes");
	
}
if (file_exists( "../includes/membertypes.inc.php"))
include "../includes/membertypes.inc.php";
else {
	rebuild_table_file("membertypes");
	include "../includes/membertypes.inc.php";
}


?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=Javascript>
function selectAll(formObj, isInverse) 
{
   for (var i=0;i < formObj.length;i++) 
   {
      fldObj = formObj.elements[i];
      if (fldObj.type == 'checkbox' && fldObj.name.substring(0,6)=='delete')
      { 
         if(isInverse)
            fldObj.checked = (fldObj.checked) ? false : true;
         else fldObj.checked = true; 
       }
   }
}
</SCRIPT>

</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr>
          <td width="30"><img src="images/i_set.gif" width="21" height="19"></td>
          <td class=white><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_25_0169?>
            </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><?php print $TPL_info_err . ""?>
      <TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
        <TR>
          <TD>
              <BR>
            <FORM NAME=conf ACTION=membertypes.php METHOD=POST>
              <TABLE WIDTH="650" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="0083D7" ALIGN="CENTER">
                <TR>
                  <TD ALIGN=CENTER class=title><?php print $MSG_25_0169; ?></TD>
                </TR>
                <TR>
                  <TD><TABLE WIDTH=100% CELLPADDING=2 BGCOLOR="#FFFFFF">
                      <TR>
                        <TD WIDTH=20></TD>
                        <TD colspan="6">
                          <?php 
                          print $MSG_25_0170;
                          if($$ERR) {
                          	print "<FONT COLOR=red><BR><BR>".$$ERR;
                          } else {
                          	if($$MSG) {
                          		print "<FONT COLOR=red><BR><BR>".$$MSG;
                          	} else {
                          		print "<BR><BR>";
                          	}
                          }
						  ?>
                           </TD>
                      </TR>
                      <TR>
                        <TD WIDTH=20></TD>
                        <TD BGCOLOR="#EEEEEE"> <B> <?php print $MSG_25_0171; ?> </B> </TD>
                        <!-- <TD BGCOLOR="#EEEEEE"> <B> &nbsp;<?php //print $MSG_25_0172; ?> </B> </TD> -->
                        <TD BGCOLOR="#EEEEEE"> <B> <?php print $MSG_25_0167; ?> </B> </TD>
                        <TD BGCOLOR="#EEEEEE" WIDTH=20></TD>
                        <TD BGCOLOR="#EEEEEE"> <B> <?php print $MSG_25_0168; ?> </B> </TD>
                      </TR>
                      <?php
                      foreach ($membertypes as $id => $quest) {
					  ?>
                      <TR>
                        <TD WIDTH=20></TD>
                        <TD><INPUT TYPE=hidden NAME=old_membertypes[<?=$id?>][feedbacks] VALUE='<?=$quest['feedbacks']?>'>
                          <INPUT TYPE=text NAME=new_membertypes[<?=$id?>][feedbacks] VALUE='<?=$quest['feedbacks']?>' SIZE=5>
                        </TD>
                        <!-- <TD><INPUT TYPE=hidden NAME=old_membertypes[<?=$id?>][membertype] VALUE='<?=$quest['membertype']?>'>
                        </TD> -->
                        <TD><INPUT TYPE=hidden NAME=old_membertypes[<?=$id?>][icon] VALUE='<?=$quest['icon']?>'>
                          <INPUT TYPE=text NAME=new_membertypes[<?=$id?>][icon] VALUE='<?=$quest['icon']?>' SIZE=30></TD>
                        <TD><IMG SRC='../images/icons/<?=$quest[icon]?>' align='middle'> </TD>
                        <TD><INPUT TYPE=checkbox NAME=delete[] VALUE='<?=$id?>'>
                        </TD>
                      </TR>
                      <?php
                      }
					  ?>
                      <TR>
                        <TD WIDTH=20>
                          Add</TD>
                        <TD><INPUT TYPE='text' NAME=new_membertype[feedbacks]' SIZE='5'></TD>
                        <!-- <TD>&nbsp;</TD> -->
                        <TD><INPUT TYPE='text' NAME='new_membertype[icon]' SIZE='30'></TD>
                        <TD colspan=2 align=right>
						<a href="javascript: void(0)" onclick="selectAll(document.forms[0],1)"><?=$MSG_30_0102?></A></TD>
                      </TR>
                      <TR>
                        <TD WIDTH=20></TD>
                        <TD colspan="6" align="center"><INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_089; ?>">
                        </TD>
                      </TR>
                    </TABLE>
                    <input type=text name=new_membertypes[<?=$id?>][membertype] value='<?=$quest['membertype']?>' size=30></TD>
                </TR>
              </TABLE>
            </FORM></TD>
        </TR>
      </TABLE></TD>
  </TR>
</TABLE>
</BODY>
</HTML>

