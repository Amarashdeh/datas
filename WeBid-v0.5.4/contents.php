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

require("includes/config.inc.php");
switch($_GET["show"]) {
	case "aboutus":
	$TITLE = $MSG_5085;
	$CONTENT = stripslashes($SETTINGS['aboutustext']);
	break;
	case "terms":
	$TITLE = $MSG_5086;
	$CONTENT = stripslashes($SETTINGS['termstext']);
	break;
}

include "header.php";
include phpa_include("template_contents_php.html");
include "footer.php";
?>

