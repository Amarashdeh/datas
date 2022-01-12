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
include $include_path.'status.inc.php';
include $include_path.'dates.inc.php';

#//
unset($ERR);

#// Delete boards
if(is_array($_POST[delete]) && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF']))
{
	while(list($k,$v) = each($_POST[delete]))
	{
		$query = "delete from ".$DBPrefix."community where id='$v'";
		$r = @mysql_query($query);
		if(!$r)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		$query = "delete from ".$DBPrefix."comm_messages where boardid='$v'";
		$r = @mysql_query($query);
		if(!$r)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
	}
}

#// Get data from the database
$query = "select * from ".$DBPrefix."community order by name";
$res__ = @mysql_query($query);
if(!$res__)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=javascript>
function selectDelete(formObj, isInverse) 
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
<FORM NAME="boards" METHOD="post" ACTION="<?=basename($_SERVER['PHP_SELF'])?>"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif">
	
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5032?></td>
        </tr>
      	</table>
	</td>
    </tr>
    <tr>
    <td align="center" valign="middle">&nbsp;</td>
    </tr>
    <tr> 
    <td align="center" valign="middle">
  		<TABLE WIDTH="600" BORDER="0" CELLSPACING="0" CELLPADDING="1" ALIGN="CENTER" BGCOLOR="#0083D7">
		<TR>
			<TD>
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="1" CELLPADDING="4" ALIGN="CENTER">
        		  <TR BGCOLOR="#0083D7">
            		<TD COLSPAN="6" clign=center class=title>
				<?=$MSG_5032?>
			</TD>
					</TR>
					<?php
					if(isset($ERR))
					{
					?>
        			<TR BGCOLOR="yellow">
            		  <TD COLSPAN="6" class=error>
            			<?=$ERR?>
            			</TD>
        			</TR>
					<?php
					}
					?>
					<TR bgcolor=#ffffff>
						<TD COLSPAN="6">
						<B><?=$MSG_5040?></B></TD>
					</TR>
					<TR BGCOLOR="#eeeeee">
						<TD WIDTH="6%"><?=$MSG_129?></TD>
						<TD WIDTH="40%"><?=$MSG_294?></TD>
						<TD WIDTH="10%" ALIGN=CENTER><?=$MSG_5046?></TD>
						<TD WIDTH="12%" ALIGN=CENTER><?=$MSG_5043?></TD>
						<TD WIDTH="16%" ALIGN=CENTER><?=$MSG_5044?></TD>
						<TD WIDTH="16%" ALIGN=CENTER>
							<INPUT TYPE="submit" NAME="Submit" VALUE="<?=$MSG_008?>">
						</TD>
					</TR>
					<?php
					while($row = mysql_fetch_array($res__))
					{
						if($row[active] == 1)
						{
							$BG = "#FFFFFF";
						}
						else
						{
							$BG = "#CCCCFF";
						}
					?>
					<TR BGCOLOR="<?=$BG?>">
						<TD WIDTH="6%">
							<?=$row[id]?>
						</TD>
						<TD WIDTH="40%"> <A HREF=editboards.php?id=<?=$row[id]?>>
							<?=$row[name]?>
							</A>
							<?php
							if($row[active] == 2)
							{
								print "&nbsp;&nbsp;&nbsp;<B>[INACTIVE]</B>";
							}
							?></TD>
						<TD WIDTH="10%" ALIGN=CENTER><?=$row[msgstoshow]?></TD>
						<TD WIDTH="12%" ALIGN=CENTER>
							<?=$row[messages]?>
						</TD>
						<TD WIDTH="16%" ALIGN=CENTER>
							<?php
							if($row[lastmessage] == 0)
							{
								print "--";
							}
							else
							{
								print FormatDate($row[lastmessage]);
							}
							?>
						</TD>
						<TD WIDTH="16%" ALIGN=CENTER>
							<INPUT TYPE="checkbox" NAME="delete[<?=$row[id]?>]" VALUE="<?=$row[id]?>">
						</TD>
					</TR>
					<?php
					}
					?>
					<TR bgcolor=#FFFFFF>
						<TD colspan=5>&nbsp;</TD>
						<TD align=center><a href="javascript: void(0)" onclick="selectDelete(document.forms[0],1)"><?=$MSG_30_0102?></A></TD>
					</TR>
					<TR BGCOLOR="#eeeeee">
						<TD WIDTH="6%" BGCOLOR="#FFFFFF">&nbsp;</TD>
						<TD BGCOLOR="#FFFFFF" WIDTH="40%">&nbsp;</TD>
						<TD WIDTH="10%" BGCOLOR="#FFFFFF" ALIGN=CENTER>&nbsp;</TD>
						<TD WIDTH="12%" BGCOLOR="#FFFFFF" ALIGN=CENTER>&nbsp;</TD>
						<TD WIDTH="16%" BGCOLOR="#FFFFFF" ALIGN=CENTER>&nbsp;</TD>
						<TD WIDTH="16%" BGCOLOR="#FFFFFF" ALIGN=CENTER>
							<INPUT TYPE="submit" NAME="Submit2" VALUE="Delete">
						</TD>
						</TR>
						</TABLE>
		</TD>
		</TR>
		</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
</body>
</HTML>