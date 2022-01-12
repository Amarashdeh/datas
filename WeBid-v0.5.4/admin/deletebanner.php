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


@mysql_query("DELETE FROM ".$DBPrefix."banners WHERE id=$banner");
@mysql_query("DELETE FROM ".$DBPrefix."bannerscategories WHERE banner=$banner");
@mysql_query("DELETE FROM ".$DBPrefix."bannerskeywords WHERE banner=$banner");

@unlink("$image_upload_path"."banners/$user/$name");

#// Redirect
Header("Location: userbanners.php?id=$user");
?>