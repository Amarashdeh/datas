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
if(!defined('INCLUDED')) exit("Access denied");
?>
<HTML>
<BODY TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<A HREF="Javascript:window.close()"><IMG SRC=<?=$uploaded_path.session_id()."/".$UPLOADED_PICTURES[$img]?> BORDER=0></A>
</BODY>
</HTML>