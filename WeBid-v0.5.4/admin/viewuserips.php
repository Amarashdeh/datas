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

$id = $_REQUEST[id];
$offset = $_REQUEST[offset];
if($_POST[action] == "update")
{
	if(is_array($_POST['accept']))
	{
		while(list($k,$v) = each($_POST['accept']))
		{
			@mysql_query("UPDATE ".$DBPrefix."usersips SET action='accept' WHERE id=$k");
		}
	}
	if(is_array($_POST['deny']))
	{
		while(list($k,$v) = each($_POST['deny']))
		{
			@mysql_query("UPDATE ".$DBPrefix."usersips SET action='deny' WHERE id=$k");
		}
	}
}

#//
$query = "SELECT nick,email,lastlogin FROM ".$DBPrefix."users WHERE id='".$id."'";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	$USER = mysql_fetch_array($res);
}

#//
$query = "SELECT * FROM ".$DBPrefix."usersips WHERE user='$id' AND type='first'";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	$FIRST = mysql_fetch_array($res);
}

$query = "SELECT * FROM ".$DBPrefix."usersips WHERE user='$id' AND type<>'first'";
$res = @mysql_query($query);
if(!$res)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_array($res))
	{
		$NEXT[$row['id']] = $row;
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
		<TD ALIGN=CENTER class=title>
			<?php print $MSG_2_0004; ?>
		</TD>
	</TR>
	<TR>
		<TD>

      <TABLE WIDTH=100% CELPADDING=0 CELLSPACING=1 BORDER=0 ALIGN="CENTER" CELLPADDING="3">
        <TR BGCOLOR=#FFFFFF ALIGN=CENTER>
          <TD colspan=7>
		  <FORM NAME=banform ACTION=<?=basename($_SERVER['PHP_SELF'])?> METHOD=POST>
              <table width="90%" border="0" cellspacing="0" cellpadding="2" bgcolor="#FFFFFF">
                <tr>
                  <td bgcolor="#ffffff">
                    <b>
                      <?php print $MSG_200; ?></b>
                      <?=$USER['nick']?>
					  (<A HREF=<?=$USER['email']?>><?=$USER['email']?></A>)
                    </td>
					<TD ALIGN=right>
					<?=$MSG_559.":".$USER['lastlogin']?>
                </tr>
              </table>
              <table width="90%" border="0" cellspacing="1" cellpadding="2" bgcolor="#CCCCCC">
                <tr>
                  <td width="35%" bgcolor="#eeeeee">
                    <div align="center"><b>
                      <?php print $MSG_087; ?>
                      </b></div>
                  </td>
                  <td width="27%" bgcolor="#eeeeee">
                    <div align="center"><b>
                      <?php print $MSG_2_0009; ?>
                      </b></div>
                  </td>
                  <td width="21%" bgcolor="#eeeeee">
                    <div align="center"><b>
                      <?php print $MSG_560; ?>
                      </b></div>
                  </td>
                  <td width="17%" bgcolor="#eeeeee">
                    <div align="center"><b>
                      <?php print $MSG_5028; ?>
                      </b></div>
                  </td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td width="35%"> <b>
                    <?php print $MSG_2_0005; ?>
                    </b></td>
                  <td width="27%">
                    <div align="center"><b>
                      <?php print $FIRST['ip']; ?>
                      </b></div>
                  </td>
                  <td width="21%" align=center> 
                    <?php
                    if($FIRST['action'] == 'accept')
                    {
                    	print $MSG_2_0012;
                    }
                    else
                    {
                    	print $MSG_2_0013;
                    }
				  ?>
                     </td>
                  <td width="17%"> 
                    <?php
                    if($FIRST['action'] == 'accept')
                    {
					?>
                    <input type="checkbox" name="deny[<?=$FIRST['id']?>]2" value="<?=$FIRST['id']?>">
                    <?php
                    print "&nbsp;".$MSG_2_0006;
                    }
                    else
                    {
					?>
                    <input type="checkbox" name="accept[<?=$FIRST['id']?>]2" value="<?=$FIRST['id']?>">
                    <?php
                    print "&nbsp;".$MSG_2_0007;
                    }
				  ?>
                     </td>
                </tr>
                <?php
                if(is_array($NEXT))
                {
                	while(list($k,$v) = each($NEXT))
                	{
				?>
                <tr bgcolor="#FFFFFF">
                  <td width="35%"> 
                    <?=$MSG_221?>
                     </td>
                  <td width="27%" align=center> 
                    <?=$v['ip']?>
                     </td>
                  <td width="21%" align=center> 
                    <?php
                    if($v['action'] == 'accept')
                    {
                    	print $MSG_2_0012;
                    }
                    else
                    {
                    	print $MSG_2_0013;
                    }
				  ?>
                     </td>
                  <td width="17%"> 
                    <?php
                    if($v['action'] == 'accept')
                    {
					?>
                    <input type="checkbox" name="deny[<?=$v['id']?>]2" value="<?=$v['id']?>">
                    <?php
                    print "&nbsp;".$MSG_2_0006;
                    }
                    else
                    {
					?>
                    <input type="checkbox" name="accept[<?=$v['id']?>]2" value="<?=$v['id']?>">
                    <?php
                    print "&nbsp;".$MSG_2_0007;
                    }
				  ?>
                     </td>
                  <?php
                	}
                }
				?>
                </tr>
              </table>
              <p>&nbsp;</p>
              <p>
                <input type="submit" name="Submit" value="<?=$MSG_2_0015?>">
                <INPUT TYPE=hidden NAME=action VALUE=update>
                <INPUT TYPE=hidden NAME=id VALUE=<?=$id?>>
              </p>
            </FORM>
          </TD>
        </TR>

      </TABLE>
</TD></TR></TABLE>

</TD>
</TR>
</TABLE>
</BODY>
</HTML>
