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

include "includes/config.inc.php";

#// Handle banners clickthrough

$URL = str_replace('\r','',str_replace('\n','',$_GET["url"]));

#// Update clickthrough counter in the database
@mysql_query("UPDATE ".$DBPrefix."banners set clicks=clicks+1 WHERE id=".intval($_GET["banner"]));

#// Redirect
Header("Location: $URL");
exit;



?>