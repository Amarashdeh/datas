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
unset($PHPAUCTION_ADMIN_LOGIN);
unset($PHPAUCTION_ADMIN_USER);
unset($_SESSION["PHPAUCTION_ADMIN_LOGIN"]);
unset($_SESSION["PHPAUCTION_ADMIN_USER"]);
//Header("Location: login.php");
?>
<SCRIPT Language=Javascript>
parent.location.href='index.php';
</SCRIPT>