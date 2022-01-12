<?php
if(!defined("INCLUDED")) exit("Access denied");
$MSG = "El usuario ".$_SESSION["PHPAUCTION_LOGGED_IN_USERNAME"]." (".$_SESSION["PHPAUCTION_LOGGED_NAME"]."),
con una cuenta de comprador ha pedido la modificaci�n de su cuenta a vendedor.

Datos del usuario:
------------------
ID: ".$_SESSION["PHPAUCTION_LOGGED_IN"]."
Nombre: ".$_SESSION["PHPAUCTION_LOGGED_NAME"]."
Nombre de Usuario: ".$_SESSION["PHPAUCTION_LOGGED_IN_USERNAME"]."
E-mail: ".$_SESSION["PHPAUCTION_LOGGED_EMAIL"];

mail($SETTINGS['adminmail'],"Petici�n de cambio de cuenta",$MSG,"From: ".$_SESSION["PHPAUCTION_LOGGED_NAME"]." <".$_SESSION["PHPAUCTION_LOGGED_EMAIL"].">\n");
?>