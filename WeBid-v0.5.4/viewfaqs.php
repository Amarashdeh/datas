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

#// Retrieve FAQs from the database
$query = "SELECT * from ".$DBPrefix."faqs where category=".intval($_REQUEST['cat']);
$res = @mysql_query($query);
if(!$res) {
  print "Error: $query<BR>".mysql_error();
  exit;
}
while($row = mysql_fetch_array($res)) {
  $TR = @mysql_fetch_array(@mysql_query("SELECT * FROM ".$DBPrefix."faqs_translated WHERE id=".intval($row['id'])." AND lang='".addslashes($language)."'"));
  if(is_array($TR)) {
    $FAQSQUESTION[$row[id]] = stripslashes($TR['question']);
    $FAQSANSWER[$row[id]] = stripslashes($TR['answer']);
  } else {
    $FAQSQUESTION[$row[id]] = stripslashes($row['question']);
    $FAQSANSWER[$row[id]] = stripslashes($row['answer']);
  }
}

#// Retrieve FAQs categories from the database
$query = "select * from ".$DBPrefix."faqscategories";
$res_c = @mysql_query($query);
if(!$res_c) {
  print "Error: $query<BR>".mysql_error();
  exit;
}

#// Retrieve category's name
$query = "select category from ".$DBPrefix."faqscategories where id=".intval($_REQUEST['cat']);
$res_n = @mysql_query($query);
if(!$res_n) {
  print "Error: $query<BR>".mysql_error();
  exit;
}

$NAME = stripslashes(mysql_result($res_n,0,"category"));

include phpa_include("template_viewfaq_php.html");

?>