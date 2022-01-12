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


#//Default for error message (blank)
$ERR = "&nbsp;";


if(isset($_POST[InsertButton]) && strlen($_POST[cat_name]) > 0 && basename($HTTP_REFERER) == basename($PHP_SELF))
{
	$query = "insert into ".$DBPrefix."faqscategories values(NULL,
		'".addslashes($_POST[cat_name][$SETTINGS['defaultlanguage']])."')";
	$res = @mysql_query($query);
	if(!$res)
	{
		print "Error: $query<BR>".mysql_error();
		exit;
	}
	$id = mysql_insert_id();
	reset($LANGUAGES);
	while(list($k,$v) = each($LANGUAGES)){
		@mysql_query("INSERT INTO ".$DBPrefix."faqscat_translated VALUES($id,'$k','".addslashes($_POST['cat_name'][$k])."')");
	}
}

#// Delete categories
if(is_array($_POST[delete]) && basename($HTTP_REFERER) == basename($PHP_SELF))
{
	while(list($k,$v) = each($_POST[delete]))
	{
		$query = "delete from ".$DBPrefix."faqscategories where id=$v";
		$r = @mysql_query($query);
		if(!$r)
		{
			print "Error: $query<BR>".mysql_error();
			exit;
		}
		@mysql_query("DELETE FROM ".$DBPrefix."faqscat_translated WHERE id=$v");
	}
}


#// Get data from the database
$query = "select * from ".$DBPrefix."faqscategories order by category";
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
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<FORM NAME="categories" METHOD="post" ACTION="<?=basename($PHP_SELF)?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5230?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" ALIGN="CENTER" BGCOLOR="#0083D7">
		<TR align=center>
			<TD BGCOLOR="#ffffff">&nbsp;</TD>
		</TR>
		<TR>
			<TD>
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
					<TR BGCOLOR="#0083D7">
						<TD COLSPAN="3" class=title align=center>
								<?=$MSG_5230?>
						</TD>
					</TR>
					<TR BGCOLOR="#FFFFFF">
						<TD COLSPAN="3"> <B>
							<?=$ERR?>
							</B></TD>
					</TR>
					<TR BGCOLOR="#EEEEEE">
						<TD COLSPAN="3">
						<?=$MSG_5234?>
						</TD>
					</TR>
					<TR BGCOLOR="#FFFFFF">
						<TD COLSPAN="3">
							<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="1">
								<TR>
									<TD WIDTH="21%"><?=$MSG_165?></TD>
									<TD WIDTH="79%">
										<IMG SRC="../includes/flags/<?=$SETTINGS['defaultlanguage']?>.gif">&nbsp;<INPUT TYPE="text" NAME="cat_name[<?=$SETTINGS['defaultlanguage']?>]" SIZE="25" MAXLENGTH="200">
										<?php
											reset($LANGUAGES);
											while(list($k,$v) = each($LANGUAGES)){
												if($k!=$SETTINGS['defaultlanguage']) print "<BR><IMG SRC=../includes/flags/".$k.".gif>&nbsp;<INPUT TYPE=text NAME=cat_name[$k] SIZE=25 MAXLENGTH=200>";
											}
										?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="21%">
										<INPUT TYPE="hidden" NAME="action" VALUE="insert">
									</TD>
									<TD WIDTH="79%">
										<INPUT TYPE="submit" NAME="InsertButton" VALUE="INSERT CATEGORY">
									</TD>
								</TR>
							</TABLE>
						</TD>
					</TR>
					<TR BGCOLOR="#FFFFFF">
						<TD COLSPAN="3"><?=$MSG_5235?></TD>
					</TR>
					<TR BGCOLOR="#eeeeee">
						<TD WIDTH="14%"><?=$MSG_5237?></TD>
						<TD WIDTH="72%"><?=$MSG_316?></TD>
						<TD WIDTH="14%" ALIGN=CENTER>
							<INPUT TYPE="submit" NAME="Submit" VALUE="Delete">
						</TD>
					</TR>
					<?php
					while($row = mysql_fetch_array($res__))
					{
						$row[category]=stripslashes($row[category]);
						#// Are there FAQs for this category?
						$query = "select id from ".$DBPrefix."faqs where category=$row[id]";
						$re = @mysql_query($query);
						if(mysql_num_rows($re) > 0)
						{
							$HAVEFAQS = TRUE;
						}
						else
						{
							$HAVEFAQS = FALSE;
						}
						
					?>
					<TR BGCOLOR="#eeeeee">
						<TD WIDTH="7%" BGCOLOR="#FFFFFF">
							
							<?=$row[id]?>
							
						</TD>
						<TD WIDTH="79%" BGCOLOR="#FFFFFF">
							
							<A HREF=editfaqscategory.php?id=<?=$row[id]?>>
							<?=$row[category]?>
							</A>
							
							</TD>
						<TD WIDTH="14%" BGCOLOR="#FFFFFF" ALIGN=CENTER>
						<?php
						if(!$HAVEFAQS)
						{
						?>
							<INPUT TYPE="checkbox" NAME="delete[<?=$row[id]?>]" VALUE="<?=$row[id]?>">
						<?php
						}
						?>
						</TD>
					</TR>
					<?php
					}
					?>
					<TR BGCOLOR="#eeeeee">
						<TD WIDTH="7%" BGCOLOR="#FFFFFF">&nbsp;</TD>
						<TD WIDTH="79%" BGCOLOR="#FFFFFF">&nbsp;</TD>
						<TD WIDTH="14%" BGCOLOR="#FFFFFF" ALIGN=CENTER>
							<INPUT TYPE="submit" NAME="Submit" VALUE="Delete">
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</TD>
</TR>
</TABLE>
</FOrM>
</BODY>
</HTML>