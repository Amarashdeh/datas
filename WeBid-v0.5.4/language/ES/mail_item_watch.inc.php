<?php
if(!defined('INCLUDED')) exit("Access denied");
$message = "Hola $user_name,<br>
<br>
Esta es una respuesta automatica de tu lista de Artculos en la mira. <br>
Alguien ha hecho una oferta en un articulo que tienes en esta lista.<br>
<br>
Titulo de la subasta: $auc_title <br>
<br>
Oferta actual: $new_bid2 <br>
<br>
URL de la subasta<br>
<a href=".$SETTINGS['siteurl']."item.php?mode=1&id=$id>$auction_url</a>";

mail($e_mail,"$sitename - ".$MSG_472,$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\n"."Content-Type: text/html; charset=$CHARSET");

?>