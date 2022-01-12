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

require('./includes/config.inc.php');
include $include_path."auctionstoshow.inc.php";
#// Get parameters from the URL
$params = getUrlParams("=");
if(empty($_GET['id']))
	$_GET['id'] = $params['id'];
else
	$params['id'] = $_GET['id'];
$id = intval($params['id']);

#// #############################################################################
function getsubtree($catsubtree,$i) {
	global $catlist, $DBPrefix;
	$res=mysql_query("SELECT cat_id FROM ".$DBPrefix."categories WHERE parent_id=".intval($catsubtree[$i]));
	while($row=mysql_fetch_assoc($res)) {
		$catlist[]=$row['cat_id'];
		$catsubtree[$i+1]=$row['cat_id'];
		getsubtree($catsubtree,$i+1);
	}
}

$catsubtree[0]=$id;
$catlist[]=$catsubtree[0];
getsubtree($catsubtree,0);
$catalist="(";
$catalist.=join(",",$catlist);
$catalist.=")";
$NOW = date("YmdHis",mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y")));
if ($id==0) {
	/*
	display full list of categories of level 0
	*/
	$result = mysql_query ( "SELECT * FROM ".$DBPrefix."categories WHERE parent_id='0' ORDER BY cat_name" );
	if (!$result) {
		/* output error message and exit */
		print "database error";
		exit;
	} else {
		/* query succeeded - display list of categories */
		$need_to_continue = 1;
		$cycle = 1;
		
		$TPL_main_value = "";
		$TPL_categories_string = $MGS_2__0027;
		while ($row=mysql_fetch_array($result)) {
			if ($cycle==1 ) {
				$TPL_main_value.="<tr WIDTH=100% ALIGN=LEFT>\n";
			}
			$sub_counter = (int)$row['sub_counter'];
			$cat_counter = (int)$row['counter'];
			if ($sub_counter!=0) $count_string = "(".$sub_counter.")";
			else {
				$count_string = "";
			}
			#// Retrieve the translated category name
			$row['cat_name'] = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$row['cat_id']." AND lang='".$language."'"),0,"cat_name");
			$TPL_main_value .=!empty($row['cat_colour']) ? "	<td BGCOLOR=\"".$row['cat_colour']."\" WIDTH=\"33%\"><a href=\"".$SETTINGS['siteurl']."browse.php?id=".$row['cat_id']."\">".$row['cat_name'].$count_string."</a></td>\n" : "	<td WIDTH=\"33%\"><a href=\"".$SETTINGS['siteurl']."browse.php?id=".$row['cat_id']."\">".$row['cat_name'].$count_string."</a></td>\n";
			
			++$cycle;
			if ($cycle==4) { $cycle=1; $TPL_main_value.="</tr>\n"; }
		}
		
		if ( $cycle>=2 && $cycle<=3 ) {
			while ( $cycle<4 ) {
				$TPL_main_value .= "	<td WIDTH=\"33%\">&nbsp;</td>\n";
				++$cycle;
			}
			$TPL_main_value .= "</tr>\n";
		}
		$TPL_auctions_list_value = array();

    $PAGE = 1;
    $PAGES = 1;

		include "header.php";
		include phpa_include("template_browse_header_php.html");
		include phpa_include("template_browse_php.html");
		include "footer.php";
		exit;
	}
} else {
	/*
	specified category number
	
	look into table - and if we don't have such category - redirect to full list
	*/
	$result = mysql_query ( "SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".intval($id) );
	if ($result)
	$category = mysql_fetch_array($result);
	else
	$category = false;
	#// Retrieve the translated category name
	$category['cat_name'] = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$category['cat_id']." AND lang='".$language."'"),0,"cat_name");
	if (!$category) {
		/* redirect to global categories list */
		header ( "Location: browse.php?id=0" );
		exit;
	} else {
		/*
		such category exists
		retrieve it's subcategories and its auctions
		*/
		/* recursively get "path" to this category */
		
		$TPL_categories_string = "".$category["cat_name"];
		$par_id = (int)$category['parent_id'];
		
		while ( $par_id!=0 ) {
			// get next parent
			$res = mysql_query ( "SELECT * FROM ".$DBPrefix."categories WHERE cat_id=".intval($par_id));
			if ($res) {
				$rw = mysql_fetch_array($res);
				if ($rw) $par_id = (int)$rw['parent_id'];
				else $par_id = 0;
			} else $par_id = 0;
			#// Retrieve the translated category name
			$rw['cat_name'] = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$rw['cat_id']." AND lang='".$language."'"),0,"cat_name");
			$TPL_categories_string = "<a href=\"".$SETTINGS['siteurl']."browse.php?id=".$rw["cat_id"]."\">".$rw["cat_name"]."</a> &gt; ".$TPL_categories_string;
		}
		
		/* get list of subcategories of this category */
		$subcat_count = 0;
		$result = mysql_query ( "SELECT * FROM ".$DBPrefix."categories WHERE parent_id=".intval($id)." ORDER BY cat_name" );
		if (!$result) {
			/* output error message and exit */
		} else {
			/* query succeeded - display list of categories */
			$need_to_continue = 1;
			$cycle = 1;
			
			$TPL_main_value = "";
			while ($row=mysql_fetch_array($result)) {
				++$subcat_count;
				if ($cycle==1 ) {
					$TPL_main_value.="<tr ALIGN=LEFT>\n";
				}
				$sub_counter = (int)$row['sub_counter'];
				$cat_counter = (int)$row['counter'];
				if ($sub_counter!=0) $count_string = "(".$sub_counter.")";
				else {
					if ($cat_counter!=0) {
						$count_string = "(".$cat_counter.")";
					} else $count_string = "";
				}
				if($row['cat_colour'] != "") {
					$BG ="BGCOLOR=".$row['cat_colour'];
				} else {
					$BG = "";
				}
				#// Retrieve the translated category name
				$row['cat_name'] = @mysql_result(mysql_query("SELECT cat_name FROM ".$DBPrefix."cats_translated WHERE cat_id=".$row['cat_id']." AND lang='".$language."'"),0,"cat_name");
				$TPL_main_value .= "	<td $BG WIDTH=\"33%\"><a href=\"".$SETTINGS['siteurl']."browse.php?id=".$row['cat_id']."\">".$row['cat_name'].$count_string."</a></td>\n";
				
				++$cycle;
				if ($cycle==4) {
					$cycle=1;
					$TPL_main_value.="</tr>\n";
				}
			}
			
			if ( $cycle>=2 && $cycle<=3 ) {
				while ( $cycle<4 ) {
					$TPL_main_value .= "	<td WIDTH=\"33%\">&nbsp;</td>\n";
					++$cycle;
				}
				$TPL_main_value .= "</tr>\n";
			}
		}
		/* determine limits for SQL query */
		$left_limit = ($page-1)*$lines;
		
		/* retrieve records corresponding to passed page number */
		$page = (int)$page;
		if ($page==0)	$page = 1;
		$lines = (int)$lines;
		if ($lines==0)	$lines = 50;
    
		/* get total number of records */
		$qs = "SELECT count(*) FROM ".$DBPrefix."auctions 
						WHERE category IN $catalist 
						AND	starts<=".$NOW." 
						AND closed='0' 
						AND private='n' 
						AND suspended ='0'";
		 if($SETTINGS['adultonly']=='y' && !isset($_SESSION["PHPAUCTION_LOGGED_IN"])){
			 $qs .= "AND adultonly='n'";
		 }

		if(!empty($_POST['catkeyword'])){
			$qs .= " AND title like '%".addslashes($_POST['catkeyword'])."'%";
		}
		$rsl = mysql_query ($qs);
		if ($rsl) {
			$hash = mysql_fetch_array($rsl);
			$total = !$hash[0] ? 1 : (int)$hash[0];
		} else $total = 1;
		#// Handle pagination
		$TOTALAUCTIONS = $total;

		if(!isset($_GET["PAGE"]) || $_GET["PAGE"] == 1) {
			$OFFSET = 0;
			$PAGE = 1;
		} else {
      $PAGE = $_REQUEST["PAGE"];
			$OFFSET = ($PAGE - 1) * $LIMIT;
		}
		$PAGES = ceil($TOTALAUCTIONS / $LIMIT);	
		
		$qs = "SELECT * FROM ".$DBPrefix."auctions 
				WHERE category IN $catalist 
				AND	starts<=".$NOW."	
				AND closed='0' 
				AND private='n' 
				AND suspended ='0' ";
		 if($SETTINGS['adultonly']=='y' && !isset($_SESSION["PHPAUCTION_LOGGED_IN"])){
			 $qs .= " AND adultonly='n'";
		 }
		if(!empty($_POST['catkeyword'])){
			$qs .= " AND title like '%".addslashes($_POST['catkeyword'])."%' ";
		}
		$qs .= "ORDER BY ends ASC LIMIT ".intval($OFFSET).",".intval($LIMIT);
		$result = mysql_query ($qs);
		/* get list of auctions of this category */
		$auctions_count = 0;
		/* selectd items formatter */
		include $include_path."browseitems.inc.php";
		
		$TPL_auctions_list_value=browseItems($result);
		$auctions_count=count($TPL_auctions_list_value);
		
		/*$TPL_auctions_total_value .= "<br>".
		"$MSG_290 $total<br>".
		"$MSG_289 $pages ($lines $MSG_291)<br>".
		$MSG_25_0229;
		
		for ($i=1; $i<=$pages; ++$i) {
			$TPL_auctions_total_value .=
			($page==$i)	?
			" $i "	:
			" <a href=\"".$SETTINGS['siteurl']."browse.php?id=".$id."&page=$i\">$i</a> ";
		}
		*/
		$TPL_auctions_total_value .="";
		if ($auctions_count==0) {
			$TPL_auctions_total_value = $ERR_114;
		}
	}
	
	include "header.php";
	include phpa_include("template_browse_header_php.html");
	if ( $subcat_count>0 ) {
		include phpa_include("template_browse_php.html");
	}
	if ($subcat_count==0) {
		include phpa_include("template_auctions_no_cat.html");
	}
	include "footer.php";
}
?>