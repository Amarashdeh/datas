<?php
if(!defined('INCLUDED')) exit("Access denied");
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

$to 		= $EMAIL;
$from 	= "From: $SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET";
$subject	= "Tu nueva contraseña";
$message = "Hola $TPL_username,<br>
Como has solicitado, hemos creado una nueva contraseña para tu cuenta.<br>
<br>
La nueva contrasena es: $NEWPASSWD
<br>
Usala para identificarte en $SETTINGS[sitename] y recuerda que la puedes cambiar por la que desees<br>
desde tu panel de control personal.
";
?>