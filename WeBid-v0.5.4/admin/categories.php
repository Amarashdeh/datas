<?php
require('../includes/config.inc.php');
include "loggedin.inc.php";

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
Function ToBeDeleted($index){
	Global $delete;
	@reset($delete);
	while(list($k,$v) = @each($delete)){
		if($delete[$k] == $index) return true;
	}
	return false;
}

if (!ini_get('register_globals')) {
   $superglobales = array($_SERVER, $_ENV,
       $_FILES, $_COOKIE, $_POST, $_GET);
   if (isset($_SESSION)) {
       array_unshift($superglobales, $_SESSION);
   }
   foreach ($superglobales as $superglobal) {
       extract($superglobal, EXTR_SKIP);
   }
}

if($_POST['act'] && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
 $delete = $_POST['delete'];
 $categories_id = $_POST['categories_id'];
 $new_category = $_POST['new_category'];
	$def = $SETTINGS['defaultlanguage'];
	//-- Built new payments array
	$rebuilt_categories = array();
	$i = 0;
	if(is_array($_POST[categories][$def])){
		while(list($n,$m) = each($_POST[categories][$def])) {
			if(!ToBeDeleted($n)){
				reset($LANGUAGES);
				while(list($k,$v) = each($LANGUAGES)){
					$rebuilt_categories[$n][$k] = $_POST[categories][$k][$n];
				}
			}
			$i++;
		}
	}
	//-- Parse the categories array to update
	reset($LANGUAGES);
	while(list($u,$z) = each($LANGUAGES)){
		$def = $u;
		$i = 0;
		if(is_array($_POST[categories][$def])){
			reset($_POST[categories][$def]);
			while(list($t,$h) = each($_POST[categories][$def])) {
				if($_POST[categories][$def][$t] != $_POST[old_categories][$t] ||
				$_POST[old_colour][$t] != $_POST[colour][$t] || 
				$_POST[old_feesfree][$t] != $_POST['feesfree'][$t] || 
				$_POST[old_image][$t] != $image[$t] ) {
					if(empty($_POST['feesfree'][$t])) $_POST['feesfree'][$t]='n';
					//$feesfree[$t]=empty($feesfree[$t])?'n':'y';
					$query = "UPDATE ".$DBPrefix."categories 
								SET cat_name=\"".addslashes(htmlspecialchars($_POST[categories][$SETTINGS['defaultlanguage']][$t]))."\", 
									cat_colour=\"".$_POST[colour][$t]."\", 
									feesfree=\"".$_POST['feesfree'][$t]."\", 
									cat_image=\"$image[$t]\" 
								WHERE cat_id=$t";
					$result = mysql_query($query);
					if(!$result) {
						print "Database access error - abnormal termination ".mysql_error();
						exit;
					}
					reset($LANGUAGES);
					while(list($k,$v) = each($LANGUAGES)){
						$TR_name=@mysql_result(@mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE lang='".$k."' AND cat_id=".$t),0,"cat_name");
						if($TR_name){
							$query = "UPDATE ".$DBPrefix."cats_translated SET 
									cat_name='".addslashes($rebuilt_categories[$t][$k])."'
									WHERE cat_id=$t AND
									lang='$k'";
						}else{
							$query = "INSERT INTO ".$DBPrefix."cats_translated VALUES( 
									$t,
									'$k',
									'".addslashes($rebuilt_categories[$t][$k])."')";
						}
						@mysql_query($query);
						unset($TR_name);
					}
					$updated = TRUE;
				}
				$i++;
			}
		}
	}
	
	//-- Parse the categories array to delete
	if(is_array($delete)) {
		reset($delete);
		while(list($k,$v) = each($delete)) {
			$query = "delete from ".$DBPrefix."categories where cat_id=$v";
			$result = mysql_query($query);
			if(!$result) {
				print "Database access error - abnormal termination ".mysql_error();
				exit;
			}
			@mysql_query("DELETE FROM ".$DBPrefix."cats_translated WHERE cat_id=$v");
			$updated = TRUE;
			include $include_path."updatecategories.inc.php";
		}
	}
	
	//-- Add new category (if present)
	if($new_category) {
		if(!$parent) $parent = 0;
		$feesfree=empty($feesfree)?'n':'y';
		$query = "insert into ".$DBPrefix."categories (cat_id, parent_id, cat_name, deleted, sub_counter, counter, cat_colour, cat_image, feesfree) values (NULL, $parent,\"".addslashes(htmlspecialchars($new_category))."\", 0,0,0, \"$cat_colour\", \"$cat_image\", \"$newfeesfree\")";
		$result = mysql_query($query);
		if(!$result) {
			print "Database access error - abnormal termination ".mysql_error();
			exit;
		}
		$updated = TRUE;
		include $include_path."updatecategories.inc.php";
	}

	//-- If something has been modified or deleted
	//-- some HTML code pieces must be rebuilt.
	if($updated) {
		include "util_cc1.php";
		include "util_cc2.php";
	}
}


?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=Javascript>
function window_open(pagina,titulo,ancho,largo,x,y){
	var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
	open(pagina,titulo,Ventana);
}
function selectAllDelete(formObj, isInverse) 
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
function selectAllFree(formObj, isInverse) 
{
   for (var i=0;i < formObj.length;i++) 
   {
      fldObj = formObj.elements[i];
      if (fldObj.type == 'checkbox' && fldObj.name.substring(0,8)=='feesfree')
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
          <td class=white><?=$MSG_5142?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_078?></td>
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
<TD ALIGN=CENTER><BR>
<FORM NAME=conf ACTION="<?=basename($_SERVER['PHP_SELF'])?>" METHOD=POST>
	<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
		<TR> 
			<TD ALIGN=CENTER class=title>
				<?php print $MSG_078; ?>
				</B></TD>
		</TR>
		<TR> 
			<TD> 
				<TABLE WIDTH=100% CELLPADDING=2 BGCOLOR="#FFFFFF">
					<TR> 
						<TD WIDTH=10></TD>
						<TD COLSPAN=4> <P> 
						<?php 
						print $MSG_161;
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
						</P>
						  <P><img src="../images/nodelete.gif" width="20" height="21"> 
						  <?=$MGS_2__0030?>
						    </P></TD>
					</TR>
					<TR> 
						<TD WIDTH=10 HEIGHT="21"></TD>
						<TD COLSPAN=4 HEIGHT="21"> 
						<?php 
						if($parent > 0) {
							$father = $parent;
							$navigation = "";
							$counter = 0;
							do {
								$query = "select cat_id,cat_name,parent_id from ".$DBPrefix."categories where cat_id=$father";
								$result = mysql_query($query);
								
								$id 		= mysql_result($result,0,"cat_id");
								$descr 		= stripslashes(mysql_result($result,0,"cat_name"));
								$granfather = mysql_result($result,0,"parent_id");
								
								
								if($counter == 0) {
									$navigation = "$descr ";
								} else {
									if($parent != $father) {
										$navigation = "<A HREF=\"categories.php?parent=$id&name=$descr\">
																$descr</A>"." > ".$navigation;
									}
								}
								$counter++;
								$father = $granfather;
							} while($father > 0);
							$navigation = "<A HREF=\"categories.php\">$MSG_276:</A> ".$navigation;
							print $navigation;
						}
						?>
						</TD>
					</TR>
					<TR> 
						<TD WIDTH=10></TD>
						<TD BGCOLOR="#EEEEEE" WIDTH="302"> 
							<B> 
							<?php print $MSG_087; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE" WIDTH="72"> 
							<!-- Category colour -->
							<B> 
							<?php print $MSG_328; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE" WIDTH="70"> 
							<!-- Image location -->
							<B> 
							<?php print $MSG_329; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE" WIDTH="72"> 
							<B> 
							<?php print $MSG_25_0104; ?>
							</B> </TD>
						<TD BGCOLOR="#EEEEEE" WIDTH="72"> 
							<B> 
							<?php print $MSG_008; ?>
							</B> </TD>
					</TR>
					<?php
					
					//-- Get first level categories
					
					$query = "select * from ".$DBPrefix."categories where parent_id=".intval($parent)." and deleted=0 order by cat_name";
					$result = mysql_query($query);
					if(!$result) {
						print "Database access error - abnormal termination".mysql_error();
						exit;
					}
					$num_cats = mysql_num_rows($result);
					$i = 0;
					while($i < $num_cats ) {
						//-- Get category's data
						$cat_id = mysql_result($result,$i,"cat_id");
						$cat_name = stripslashes(mysql_result($result,$i,"cat_name"));
						$counter = mysql_result($result,$i,"counter");
						$sub_counter = mysql_result($result,$i,"sub_counter");
						$cat_colour = mysql_result($result, $i, "cat_colour");
						$cat_image = mysql_result($result, $i, "cat_image");
						$feesfree = mysql_result($result, $i, "feesfree");
						//-- Check if this category has sub_categories
						$query = "select count(cat_id) as subcats from ".$DBPrefix."categories where parent_id=$cat_id and deleted=0";
						$resultsub = mysql_query($query);
						if(!$resultsub) {
							print "Database access error - abnormal termination ".mysql_error();
							exit;
						}
						if(mysql_result($resultsub,0,"subcats") > 0) {
							$hassubs = 1;
						} else {
							$hassubs = 0;
						}
						#// Retrieve translations
						$res_trans = @mysql_query("SELECT * FROM ".$DBPrefix."cats_translated WHERE cat_id=$cat_id");
						if(@mysql_numrows($res_trans)>0){
							while($ct = mysql_fetch_array($res_trans)){
								$TRANSLATED[$ct['lang']][$cat_id] = stripslashes($ct['cat_name']);
							}
						}
						print "<TR valign=top>
							 <TD WIDTH=10 ALIGN=RIGHT VALIGN=TOP>
							 <A HREF=\"categories.php?parent=$cat_id&name=".urlencode($cat_name)."\">
							 <IMG SRC=\"../images/plus.gif\" BORDER=0 ALT=\"Browse Subcategories\">
							 </A>
							 </TD>
							 <TD VALIGN=top>
							 <INPUT TYPE=hidden NAME=categories_id[$i] VALUE=\"$cat_id\">
							 <INPUT TYPE=hidden NAME=old_categories[".$SETTINGS['defaultlanguage']."][$i] VALUE=\"$cat_name\">
							 <table width=100% boder=0 cellpadding=1 cellspacing=0>
							 <TR><TD>
							 <IMG SRC=../includes/flags/".$SETTINGS['defaultlanguage'].".gif></TD><TD><INPUT TYPE=text NAME=categories[".$SETTINGS['defaultlanguage']."][$cat_id] VALUE=\"".$TRANSLATED[$SETTINGS['defaultlanguage']][$cat_id]."\" SIZE=20></TD></TR>";
							 reset($LANGUAGES);
							 while(list($k,$v) = each($LANGUAGES)){
								 if($k!=$SETTINGS['defaultlanguage']) print "<tr><td>
									 	<IMG SRC=../includes/flags/".$k.".gif></TD><TD>
									<INPUT TYPE=text NAME=categories[$k][$cat_id] VALUE=\"".$TRANSLATED[$k][$cat_id]."\" SIZE=20>
									<INPUT TYPE=hidden NAME=old_categories[$k][$cat_id] VALUE=\"".$TRANSLATED[$k][$cat_id]."\">
									 </TD></TR>";
							 }
							 print "</table></TD>
							 <TD>
							 <INPUT TYPE=hidden NAME=old_colour[$cat_id] VALUE=\"$cat_colour\">
							 <INPUT TYPE=text NAME=colour[$cat_id] VALUE=\"$cat_colour\" SIZE=25>
							 </TD>
							 <TD>
							 <INPUT TYPE=hidden NAME=old_image[$cat_id] VALUE=\"$cat_image\">
							 <INPUT TYPE=text NAME=image[$cat_id] VALUE=\"$cat_image\" SIZE=25>
							 </TD>
							 <TD align=center>
							 <INPUT TYPE=hidden NAME=old_feesfree[$cat_id] VALUE=\"$feesfree\">
							 <INPUT TYPE=checkbox NAME=feesfree[$cat_id] VALUE=\"y\" ".(($feesfree=='y')? " CHECKED" : "")."  SIZE=25>
							 </TD>
							 <TD align=center>";
						
						if (counter == 0 && $sub_counter == 0 && $hassubs == 0) {
							print "<INPUT TYPE=checkbox NAME=delete[$cat_id] VALUE=$cat_id>";
						} else {
							print "<IMG SRC=\"../images/nodelete.gif\" ALT=\"You cannot delete this category\">";
						}
						print "</TD>
									 </TR>";
						$i++;
					}
			?>
			<TR>
			<TD colspan=4>&nbsp;</TD>
			<TD align=center><a href="javascript: void(0)" onclick="selectAllFree(document.forms[0],1)"><?=$MSG_30_0102?></A></TD>
			<TD align=center><a href="javascript: void(0)" onclick="selectAllDelete(document.forms[0],1)"><?=$MSG_30_0102?></A></TD>
			</TR>
		<TR>
		 <TD WIDTH=50>
		  Add
		 </TD>
		 <TD>
		 <INPUT TYPE=hidden NAME=parent VALUE="<?=$parent?>">
		 <INPUT TYPE=hidden NAME=name VALUE="<?=$name?>">
		 <INPUT TYPE=text NAME=new_category SIZE=25>
		 </TD>
		 <TD>
		 <INPUT TYPE=text NAME=cat_colour SIZE=25>
		 </TD>
		 <TD>
		 <INPUT TYPE=text NAME=cat_image SIZE=25>
		 </TD>
		 <TD align=center>
		 <INPUT TYPE=checkbox NAME=newfeesfree value='y' SIZE=25>
		 </TD>
		 <TD>
		 </TD>
		 </TR>
					<TR> </TR>
				</TABLE>    
				<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="5" BGCOLOR="#FFFFFF">
					<TR>
						<TD> 
							<CENTER>
								<INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_089; ?>">
							</CENTER>
						</TD>
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
</Body>
</HTML>