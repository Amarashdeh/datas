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

Function ToBeDeleted($index){
	Global $delete;
	$i = 0;
	while($i < count($delete)){
		if($delete[$i] == $index) return true;
		
		$i++;
	}
	return false;
}

$increments = $_POST[increments];
$lows = $_POST[lows];
$highs = $_POST[highs];
$delete = $_POST[delete];

if($_POST[act] && basename($_SERVER['HTTP_REFERER']) == basename($_SERVER['PHP_SELF'])) {
	//-- Al fields must be numeric with
	
	$i = 0;
	while($i < count($increments) - 1){
		/*$lows[$i] = input_money($lows[$i]);
		$highs[$i] = input_money($highs[$i]);
		$increments[$i] = input_money($increments[$i]);
		*/
		//print "$lows[$i] - $highs[$i] - $increments[$i]<BR>";
		if(!CheckMoney($lows[$i])){
			$ERR = "ERR_030";
		}
		if(!CheckMoney($highs[$i])){
			$ERR = "ERR_030";
		}
		if(!CheckMoney($increments[$i])){
			$ERR = "ERR_030";
		}
		
		/*
		if(!ereg("^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(\.[0-9]{1,2})$",$lows[$i])){
		$ERR = "ERR_030";
		}
		if(!ereg("^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(\.[0-9]{1,2})$",$highs[$i])){
		$ERR = "ERR_030";
		}
		if(!ereg("^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(\.[0-9]{1,2})$",$increments[$i])){
		$ERR = "ERR_030";
		}
		*/
		$i++;
	}
}

if($_POST[act] && !$$ERR){
	
	//-- Build new increments array
	
	$rebuilt_increments = array();
	$rebuilt_lows = array();
	$rebuilt_highs = array();

	$i = 0;
	while($i < count($increments)){
		
		if(!ToBeDeleted($i) && strlen($increments[$i]) != 0){
			
			$rebuilt_increments[] 	= $increments[$i];
			$rebuilt_lows[] 			= $lows[$i];
			$rebuilt_highs[] 			= $highs[$i];
		}
		$i++;
	}
	
	$query = "delete from ".$DBPrefix."increments";
	$result = mysql_query($query);
	if(!$result){
		print "Database access error - abnormal termination".mysql_error();
		exit;
	}
	
	$i = 0;
	$counter = 1;
	while($i < count($rebuilt_increments)){
		
		$query = "insert into ".$DBPrefix."increments values ('$counter', ".
		input_money($rebuilt_lows[$i]).", ".
		input_money($rebuilt_highs[$i]).", ".
		input_money($rebuilt_increments[$i]).")";
		$result = mysql_query($query);
		$i++;
		$counter++;
	}
	
	$MSG = "MSG_160";
	
	
}

?>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=Javascript>
function window_open(pagina,titulo,ancho,largo,x,y){
	
	var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
	open(pagina,titulo,Ventana);
}
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
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_set.gif" width="21" height="19"></td>
          <td><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_128?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle">
<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
<TR>
<TD align="center">
<BR>
<FORM NAME=conf ACTION=increments.php METHOD=POST>
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7" ALIGN="CENTER">
		<TR>
			<TD ALIGN=CENTER class=title>
				<?php print $MSG_128; ?>
			</TD>
		</TR>
		<TR>
			<TD>
				<TABLE WIDTH=100% CELLPADDING=2 BGCOLOR="#FFFFFF">
					<TR>
						<TD WIDTH=50></TD>
						<TD COLSPAN=4> 
							<?php
							print $MSG_135;
							?>
							<BR><BR>
							[&nbsp;<A HREF=javascript:window_open('converter.php','incre',650,200,30,30)><?=$MSG_5010?></A>&nbsp;]
							<?php
							//print $MSG_594;
							if($$ERR){
								print "<FONT COLOR=red><BR><BR>".$$ERR;
							}else{
								if($$MSG){
									print "<FONT COLOR=red><BR><BR>".$$MSG;
								}else{
									print "<BR><BR>";
								}
							}
							 ?>
							 </TD>
					</TR>
					<TR>
						<TD WIDTH=50></TD>
						<TD BGCOLOR="#EEEEEE">
							<B>
							<?php print $MSG_240; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE">
							<B>
							<?php print $MSG_241; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE">
							<B>
							<?php print $MSG_137; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE">
							<B>
							<?php print $MSG_008; ?>
							</B> </TD>
					</TR>
					<?php
					$query = "select * from ".$DBPrefix."increments order by low";
					$result = mysql_query($query);
					if(!$result){
						print "Database access error: contact the site adminitrator".mysql_error();
						exit;
					}
					$num_increments = mysql_num_rows($result);
					$i = 0;
					while($i < $num_increments)
					{
						$low = print_money_nosymbol(mysql_result($result,$i,"low"));
						$high = print_money_nosymbol(mysql_result($result,$i,"high"));
						$increment = print_money_nosymbol(mysql_result($result,$i,"increment"));
						
						/*
						$low = number_format(mysql_result($result,$i,"low"),2,'.',',');
						$high = number_format(mysql_result($result,$i,"high"),2,'.',',');
						$increment = number_format(mysql_result($result,$i,"increment"),2,'.',',');
						*/
						print "<TR>
										 <TD WIDTH=50></TD>
										 <TD><INPUT TYPE=text NAME=lows[] VALUE=\"".chop($low)."\" SIZE=10></TD>
										 <TD><INPUT TYPE=text NAME=highs[] VALUE=\"".chop($high)."\" SIZE=10></TD>
										 <TD><INPUT TYPE=text NAME=increments[] VALUE=\"".chop($increment)."\" SIZE=10></TD>
										 <TD align=center><INPUT TYPE=checkbox NAME=delete[] VALUE=\"$i\"></TD>
										 </TR>";
						$i++;
					}
					print "<TR>
	 <TD WIDTH=50>
	  Add
	 </TD>
	 <TD>
	 <INPUT TYPE=text NAME=lows[] SIZE=10>
	 </TD>
	 <TD>
	 <INPUT TYPE=text NAME=highs[] SIZE=10>
	 </TD>
	 <TD>
	 <INPUT TYPE=text NAME=increments[] SIZE=10>
	 </TD>
	 <TD align=center>
	 <a href=\"javascript: void(0)\" onclick=\"selectAll(document.forms[0],1)\">$MSG_30_0102</A>
	 </TD>
	 </TR>";
					
?>
					<TR>
						<TD WIDTH=50></TD>
						<TD>
							<INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_089; ?>">
						</TD>
					</TR>
					<TR>
						<TD WIDTH=50></TD>
						<TD> </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
	</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>