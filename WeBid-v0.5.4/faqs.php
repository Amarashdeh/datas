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


$prefix="";
require('./includes/config.inc.php');

#// Retrieve FAQs categories from the database
$query = "SELECT * from ".$DBPrefix."faqscat_translated WHERE lang='$language' order by category";
$res_c = @mysql_query($query);
if(!$res_c)
{
	print "Error: $query<BR>".mysql_error();
	exit;
}

include phpa_include("template_faqs_php.html");
?>