<?include "../includes/config.inc.php";?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>PHPAUCTION Administration back-end</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="0083D7" background="images/bac_hea.gif" text="#FFFFFF" link="#FFFFFF" vlink="#CCCCCC" alink="#666666" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="54" border="0" cellpadding="2" cellspacing="2" background="images/bac_hea.gif">
  <tr> 
    <td width="285" rowspan="2" valign="top">
		<A HREF=index.php TARGET=_top><img src="images/logo.gif" hspace="5" vspace="2" BORDER=0></A>
	</td>
    <td height="20">
		<div align="right"><img src="images/t_adm_be.gif" width="192" height="16" hspace="5"></div>
	</td>
  </tr>
  <tr>
  	<TD>
  	<?php
  		if (file_exists("../reverse/index.php")) {
  			print "<A TARGET=_top HREF=../reverse/admin/>$MSG_008</A>";
  		}
  		print "&nbsp;&nbsp;&nbsp;";
  		if (file_exists("../classifieds/index.php")) {
  			print "<A TARGET=_top HREF=../classifieds/admin/>$MSG_2_0001</A>";
  		}
  	?>
	</TD> 
    <td valign="top" align=right>
		<font size="1" face="Verdana, Arial, Helvetica, sans-serif">
		<?php
		  if($_SESSION['PHPAUCTION_ADMIN_LOGIN']) {
		?>
		  <?=$MSG_592?>
		  <B>
		  <?=$_SESSION['PHPAUCTION_ADMIN_USER']?>
		  </B></FONT>
		  <?php
		  } else {
			print "&nbsp;";
		  }
		  if($_SESSION['PHPAUCTION_ADMIN_LOGIN']) {
		?>
		 <font color="#FFFFFF" SIZE=1> | 
		 </font> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="logout.php" TARGET=content>logout</a></FONT></font>
		 <?ShowAdminFlags()?>
		 <?php
		  }
		?>
	 </td>
  </tr>
</table>
</body>
</html>