<?php
if(!defined('INCLUDED')) exit("Access denied");
$SUBJECT_TO_SELLER = "Recibiste una pregunta en tu subasta $HTTP_SESSION_VARS[CURRENTAUCTIONTITLE]";
$SUBJECT_TO_POSTER = "Respondieron tu pregunta en la subasta $HTTP_SESSION_VARS[CURRENTAUCTIONTITLE]";
$FROM = "From: ".$SETTINGS[sitename]." < ".$SETTINGS[adminmail]." >\n"."Content-Type: text/html; charset=$CHARSET";
$POSTER_MSG = "Estimado $POSTERNICK,<br>
<br>
Respondieron tu pregunta en el foro privado de la subasta:<br>
$HTTP_SESSION_VARS[CURRENTAUCTIONTITLE]<br>
<br>
El mensaje es:<br>
<br>
$MSG_ <br>
<br>
Recuerda que puedes volver a preguntar desde el foro privado (debes identificarte):<br>
".$SETTINGS[siteurl]."item.php?id=".$_SESSION["CURRENT_ITEM"]; 

$USER_MSG = "Apreciado $USERNICK,<br>
<br>
Recibiste una pregunta de $POSTERNICK en un foro privado de tu subasta:<br>
$HTTP_SESSION_VARS[CURRENTAUCTIONTITLE]<br>
<br>
El mensaje es:<br>
<br>
$MSG_ <br>
<br>
Recuerda que puedes contestar con otro mensaje en el foro privado de la subasta:<br>
".$SETTINGS[siteurl]."item.php?id=".$_SESSION["CURRENT_ITEM"]; 

$USER_PUBLIC_MSG = "Apreciado $USERNICK,<br>
<br>
Recibiste una pregunta de $POSTERNICK en tu foro público de tu subasta:<br>
$HTTP_SESSION_VARS[CURRENTAUCTIONTITLE]<br>
<br>
El mensaje es:<br>
<br>
$MSG_ <br>
<br>
Recuerda que puedes contestar con otro mensaje en el foro público de la subasta:<br>
".$SETTINGS[siteurl]."item.php?id=".$_SESSION["CURRENT_ITEM"]; 

?>