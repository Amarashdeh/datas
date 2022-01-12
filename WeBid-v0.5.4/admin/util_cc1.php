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

reset($LANGUAGES);
while(list($k,$v) = each($LANGUAGES)){
	include "../includes/messages.".$k.".inc.php";
	$result = mysql_query ( "SELECT distinct c.cat_id, t.cat_name FROM ".$DBPrefix."categories c, ".$DBPrefix."cats_translated t WHERE c.parent_id='0' AND c.deleted=0 AND c.cat_id=t.cat_id AND t.lang='".$k."' ORDER BY cat_name" );
	$output = "<SELECT NAME=\"id\">\n";
	$output.= "<OPTION VALUE=\"\">$MGS_2__0038</OPTION>\n";
	$output.= "<OPTION VALUE=\"\"></OPTION>\n";

	if ($result)
		$num_rows = mysql_num_rows($result);
	else
		$num_rows = 0;

	$i = 0;
	while($i < $num_rows){
		$category_id = mysql_result($result,$i,"cat_id");
		$cat_name = mysql_result($result,$i,"cat_name");
		$output .= "	<OPTION VALUE=\"$category_id\">$cat_name</OPTION>\n";
		$i++;
	}

	$output.= "	<OPTION VALUE=\"\"></OPTION>\n";
	$output.= "	<OPTION VALUE=\"0\">$MSG_277</OPTION>\n";
	$output.= "</SELECT>\n";

	$handle = fopen ( "../includes/categories_select_box.".$k.".inc.php" , "w" );
	fputs ( $handle, $output );
	fclose ($handle);
}
?>