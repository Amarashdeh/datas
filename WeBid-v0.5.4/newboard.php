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



#//Default for error message (blank)
unset($ERR);

#// Insert new currency
if($_POST[action] == "insert" && basename($HTTP_REFERER) == basename($PHP_SELF))
{
	if(empty($_POST[name]) ||
	empty($_POST[msgstoshow]) ||
	empty($_POST[active]))
	{
		$ERR = $ERR_047;
	}
	elseif(!ereg("^[0-9]+$",$_POST[msgstoshow]))
	{
		$ERR = $ERR_5000;
	}
	elseif(intval($_POST[msgstoshow] == 0))
	{
		$ERR = $ERR_5001;
	}
	else
	{
		$query = "insert into ".$DBPrefix."community
					  VALUES
					  (NULL,
					  '".addslashes($_POST[name])."',
					  0,
					  0,
					  ".intval($_POST[msgstoshow]).",
					  ".intval($_POST[active])."
					  )";
		$res = @mysql_query($query);
		if(!$res)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		else
		{
			Header("Location: boards.php");
			exit;
		}
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
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5031?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle"><FORM NAME="newcurrency" METHOD="post" ACTION="<?=basename($PHP_SELF)?>">
  <TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" ALIGN="CENTER" BGCOLOR="#0083D7">
    <TR>
      <TD>
        <TABLE WIDTH="100%" BORDER="0" CELLSPACING="1" CELLPADDING="4" ALIGN="CENTER">
          <TR BGCOLOR="#0083D7">
            <TD COLSPAN="2" class=title align=center>
	    <?=$MSG_5031?>
            </TD>
          </TR>
		  <?php
		  if(isset($ERR))
		  {
		  ?>
          <TR BGCOLOR="yellow">
            <TD COLSPAN="2"> <FONT COLOR=red><B>
              <?=$ERR?>
              </B></TD>
          </TR>
		  <?php
		  }
		  ?>
          <TR BGCOLOR="#FFFFFF">
            <TD WIDTH="24%"><?=$MSG_5034?></TD>
            <TD WIDTH="76%">
              <INPUT TYPE="text" NAME="name" SIZE="25" MAXLENGTH="255" VALUE="<?=$_POST[name]?>">
            </TD>
          </TR>
          <TR BGCOLOR="#FFFFFF">
            <TD WIDTH="24%" VALIGN="TOP"><?=$MSG_5035?></TD>
            <TD WIDTH="76%"><?=$MSG_5036?><BR>
              <INPUT TYPE="text" NAME="msgstoshow" SIZE="4" MAXLENGTH="4" VALUE="<?=$_POST[msgstoshow]?>">
            </TD>
          </TR>
          <TR BGCOLOR="#FFFFFF">
            <TD WIDTH="24%"><?=$MSG_5037?></TD>
            <TD WIDTH="76%"> 
              <INPUT TYPE="radio" NAME="active" VALUE="1"
			  <?php
			  if($_POST[active] == 1 || !isset($_POST[active]))
			  {
			  	print " CHECKED";
			  }
			  ?>
			  >
              <?=$MSG_5038?>
              <INPUT TYPE="radio" NAME="active" VALUE="2"
			  <?php
			  if($_POST[active] == 2)
			  {
			  	print " CHECKED";
			  }
			  ?>
			  >
              <?=$MSG_5039?></TD>
          </TR>
          <TR BGCOLOR="#FFFFFF">
            <TD WIDTH="24%">
              <INPUT TYPE="hidden" NAME="action" VALUE="insert">
            </TD>
            <TD WIDTH="76%">
              <INPUT TYPE="submit" NAME="Submit" VALUE="<?=$MSG_5029?>">
            </TD>
          </TR>
        </TABLE>
      </TD>
    </TR>
  </TABLE></FORM>
</TD>
</TR>
</TABLE>

</BODY>
</HTML>
