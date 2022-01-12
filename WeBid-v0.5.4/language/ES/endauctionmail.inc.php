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


$END_AUCTION_NO_WINNER = "Hola $name,
La subasta que has creado en <#c_sitename#> ha finalizado.<br>
<br>
Datos de subasta<br>
------------------------------------<br>
Articulo: $title <br>
ID de subasta: $id <br>
La subasta comenzo: $starting_date <br>
La subasta finalizo: $ending_date <br>
URL de subasta: $auction_url <br>
<br>
Te informamos de que o hay ganador para esta subasta.";

$END_AUCTION_WINNER = "Hola $name,<br>
La subasta que has creado en <#c_sitename#> ha finalizado.<br>
<br>
Datos de subasta<br>
------------------------------------<br>
Articulo: $title <br>
ID de subasta: $id <br>
La subasta comenzo: $starting_date <br>
La subasta finalizo: $ending_date <br>
URL de subasta: $auction_url <br>
<br>
El ganador de la subasta es: $bidder_name.<br>
Puedes contactar con el ganador en esta direccion: $bidder_email";


$END_AUCTION_WINNER_CONFIRMATION = "Hola $bidder_name,<br>
Enhorabuena!!<br>
<br>
Eres el ganador de una subasta en <#c_sitename#><br>
<br>
Datos de subasta<br>
------------------------------------<br>
Articulo: $title <br>
ID de subasta: $id <br>
La subasta comenzo: $starting_date <br>
La subasta finalizo: $ending_date <br>
URL de subasta: $auction_url <br>
<br>
Proximamente el vendedor contactara contigo.<br>
Su direccion de email es:$email.<br>
<br>
Muchas gracias.";

?>