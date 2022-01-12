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


/* global variable */
$category_id_hash[]   = array();
$category_name_hash[] = array();
$parent_id_hash[]     = array();
$children_hash[]      = array();
$num_categories       = 0;


/* view categories */
function dump_children($id,$c,$ct){
	global $category_id_hash;
	global $category_name_hash;
	global $parent_id_hash;
	global $children_hash;
	global $TPL_categories_list;
	global $TPL_categories;

	static $indent;

	reset($parent_id_hash);

	while ( list($key, $val) = each( $parent_id_hash ) ) {
		if ($val == $id){
			if ( $c == 1){
				$sval = $indent.$category_name_hash[$key];
				$query = "INSERT INTO ".$DBPrefix."categories_plain VALUES (NULL,$key,'".addslashes($sval)."')";
				@mysql_query($query);

			}
			$indent .= '&nbsp; &nbsp;';

			#// pop current element before loop, in order to do not fall at an infinite loop
			unset($parent_id_hash[$key]);

			if ($children_hash[$key])
			{
				dump_children($key,$c,$ct);
			}
			
			$indent = substr($indent,0,-13);
			reset($parent_id_hash);				
		}
	}
}


/* Categories */
$query = "select cat_id,cat_name,parent_id from ".$DBPrefix."categories where deleted=0 order by cat_name";
$result = mysql_query($query);
if ( !$result ){
	print $ERR_001."$query<BR> ".mysql_error();
	exit;
}
$num_rows       = mysql_num_rows($result);
$num_categories = $num_rows;

$i=0;
while ( $i < $num_rows ){
	set_time_limit(1000);
	$category_id                      = mysql_result($result,$i,"cat_id");
	$category_name_hash[$category_id] = mysql_result($result,$i,"cat_name");
	$parent_id_hash[$category_id]     = mysql_result($result,$i,"parent_id");
	$children_hash[$parent_id_hash[$category_id]]++;
	$i++;
}
//      $cat = $categories;

mysql_query ( "DELETE FROM ".$DBPrefix."categories_plain" );
dump_children(0,1,$categoriesL);

?>
