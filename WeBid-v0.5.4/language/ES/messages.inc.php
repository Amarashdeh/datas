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

if(!defined('INCLUDED')) exit("Access denied");

#// CHARSET ENCODING
#// Change the charset according to the language used in this file.
#// UTF-8 should work with almost any language
$CHARSET = "ISO 8859-1";

#// DOCUMENT DIRECTION
#// Change the $DOCDIR variable below according to the document direction neeeded
#// by the language you are using.
#// Possible values are:
#// 	- ltr (default) - means left-to-right document (almost any language)
#// 	- rtl - means right-to-left document (i.e. arabic, hebrew, ect).
$DOCDIR	 = "ltr";

#// Error messages and user interface messages are below. Translate them taking care of leaving
#// The PHP and HTML tags unchanged.
// Error messages

$ERR		= ""; // leave this line as is
$ERR_000	= ""; // leave this line as is
$ERR_001 = "Error en la Base de Datos. Contacta con el administrador del sistema. --Finalizaci&oacute;n Anormal**<BR>$query";
$ERR_002 = "Falta el nombre";
$ERR_003 = "Falta el nombre de usuario";
$ERR_004 = "Falta la contrase&ntilde;a";
$ERR_005 = "Por favor, repite la contrase&ntilde;a";
$ERR_006 = "Los Contrase&ntilde;as son diferentes";
$ERR_007 = "Falta la direcci&oacute;n de e-mail";
$ERR_008 = "Inserta una direcci&oacute;n de e-mail correcta";
$ERR_009 = "Este nombre de usuario ya existe actualmente";
$ERR_010 = "Nombre de usuario demasiado corto (m&iacute;n 6 caracteres)";
$ERR_011 = "Contrase&ntilde;a demasiado corta (m&iacute;n 6 caracteres)";
$ERR_012 = "Falta la direcci&oacute;n";
$ERR_013 = "Falta la poblaci&oacute;n";
$ERR_014 = "Falta la provincia";
$ERR_015 = "Falta el c&oacute;digo postal";
$ERR_016 = "Inserta un c&oacute;digo postal correcto";
$ERR_017 = "Falta el t&iacute;tulo del producto";
$ERR_018 = "Falta la descripci&oacute;n del producto";
$ERR_019 = "Falta la cantidad m&iacute;nima de inicio";
$ERR_020 = "La cantidad m&iacute;nima no es correcta";
$ERR_021 = "Falta el precio de reserva";
$ERR_022 = "El precio de reserva no es correcto";
$ERR_023 = "Elige una categor&iacute;a para tu producto";
$ERR_024 = "Elige una forma de pago";
$ERR_025 = "Usuario desconocido";
$ERR_026 = "Contrase&ntilde;a incorrecta";
$ERR_027 = "Falta el s&iacute;mbolo de la moneda";
$ERR_028 = "Por favor, escribe una direcci&oacute;n de e-mail correcta";
$ERR_029 = "Los datos del usuario ya estaban registrados.";
$ERR_030 = "Los campos deben ser num&eacute;ricos.";
$ERR_031 = "El formulario que intentas enviar est&aacute; incompleto";
$ERR_032 = "Al menos una de las direcciones e-mail no es correcta";
$ERR_033 = "La puja que has realizado no es correcta: $bid";
$ERR_034 = "Tu puja debe ser al menos de: ";
$ERR_035 = "El campo D&iacute;as debe ser num&eacute;rico";
$ERR_036 = "El vendedor no puede pujar por su art&iacute;culo";
$ERR_037 = "La clave de b&uacute;squeda no puede ser vac&iacute;a";
$ERR_038 = "Identificaci&oacute;n incorrecta";
$ERR_039 = "Ya has confirmado tu registro: ";
$ERR_040 = "Eres el usuario con la oferta mas alta y no puedes poner una oferta menor que tu mayor oferta que hiciste previamente.";
$ERR_041 = "Tienes que elegir una valoraci&oacute;n entre 1 y 5";
$ERR_042 = "Falta tu comentario";
$ERR_043 = "Formato de fecha incorrecto";
$ERR_044 = "Las cookies deben estar activas para identificarte";
$ERR_045 = "Este usuario no tienen subastas finalizadas";
$ERR_046 = "Este usuario no tiene subastas activas";
$ERR_047 = "Faltan campos obligatorios";
$ERR_048 = "Identificaci&oacute;n incorrecta";
$ERR_049 = "Fallo en la conexi&oacute;n con la Base de Datos. Por favor edita el archivo includes/passwd.inc.php
            para ajustar los par&aacute;metros.";
$ERR_050 = "Falta texto de aceptaci&oacute;n";
$ERR_051 = "Por favor, inserta un n&uacute;mero v&aacute;lido de d&iacute;gitos";
$ERR_052 = "Por favor, inserta el n&uacute;mero de noticias que se mostraron en la secci&oacute;n noticias";
$ERR_053 = "Por favor, inserta un n&uacute;mero v&aacute;lido de noticias";
$ERR_054 = "Por favor, rellena los dos campos de contrase&ntilde;a";
$ERR_055 = "El usuario <I>$_POST[username]</I> ya existe en la Base de datos";
$ERR_056 = "El incremento de puja no existe";
$ERR_057 = "El incremento de puja debe ser num&eacute;rico";
$ERR_058 = "Formato de moneda incorrecto.";
$ERR_059 = "Tu puja previa para esta subasta es mayor que tu puja actual.<br>  En subastas de varios art&iacute;culos no puedes hacer una oferta donde la puja anterior sea mayor que el valor de la puja actual.";
$ERR_060 = "La fecha de cierre de la subasta es menor o igual que la fecha de inicio. Cambia la duraci&oacute;n de la subasta para solucionar el problema.";
#//Added Aug.13,2002 by Mary
$ERR_061 = "El precio de compra que has establecido no es correcto";
$ERR_062 = "No puedes establecer un precio de reserva en una subasta de varios art&iacute;culos";
$ERR_063 = "No puedes usar un incremento personal en una subasta de varios art&iacute;culos";
$ERR_064 = "No puedes usar la opci&oacute;n de c&oacute;mpralo ya en una subasta de varios art&iacute;culos";

//--
$ERR_100 = "El usuario no existe";
$ERR_101 = "Contrase&ntilde;a incorrecta";
$ERR_102 = "El nombre de usuario no existe";
$ERR_103 = "No puedes calificarte a ti mismo";
$ERR_104 = "Todos los campos son obligatorios";
$ERR_105 = "El nombre de usuario no existe";
$ERR_106 = "<BR><BR>Usuario no especificado";
$ERR_107 = "Nombre de usuario demasiado corto";
$ERR_108 = "Contrase&ntilde;a demasiado corta";
$ERR_109 = "Las contrase&ntilde;as no coinciden";
$ERR_110 = "Direcci&oacute;n de e-mail incorrecta";
$ERR_111 = "Este usuario ya existe";
$ERR_112 = "Faltan datos";
$ERR_113 = "Debes tener al menos 18 a&ntilde;os para poder registrarte";
$ERR_114 = "No hay subastas activas en esta categor&iacute;a";
$ERR_115 = "Direcci&oacute;n de e-mail ya registrada";
$ERR_116 = "No existe ayuda para este tema.";
$ERR_117 = "Formato de fecha incorrecto";

#// ================================================================================
#// GIAN-- Jan. 19, 2002 -- Added for Pro version
$ERR_118 = "El archivo countries.txt no ha sido encontrado en el directorio <FONT FACE=Courier>admin</FONT>.";
$ERR_119 = "error de muestreo en el proceso.<BR>
                        MySQL dice: no puedo conectar con el servidor (localhost)";
$ERR_120 = "No tienes suficiente cr&eacute;dito para pagar la tasa de registro. Por favor, compra m&aacute;s cr&ntilde;editos.";
$ERR_121 = "No tienes suficiente cr&eacute;dito para pagar la tasa de subasta. Por favor, <A HREF=buy_credits.php TARGET=_blank>compra m&aacute;s cr&eacute;ditos</A> y reenv&iacute;a tu subasta.";
$ERR_122 = "Subastas no encontradas";

#// ================================================================================

$ERR_600 = "Tipo de subasta incorrecta";
$ERR_601 = "Campo de cantidad no correcto";
$ERR_602 = "Las im&aacute;genes deben ser GIF o JPG";
$ERR_603 = "La imagen es demasiado grande";
$ERR_604 = "Esta subasta ya existe";
$ERR_605 = "El ID especificado no es v&aacute;lido";
$ERR_606 = "El ID de la subasta no es correcto"; // used in bid.php
$ERR_607 = "Tu puja es menor a la puja m&iacute;nima";
$ERR_608 = "La cantidad especificada no es correcta";
$ERR_609 = "El usuario no existe";
$ERR_610 = "Escribe tu nombre de usuario y contrase&ntilde;a";
$ERR_611 = "Contrase&ntilde;a incorrecta";
$ERR_612 = "No puedes pujar, &iexcl;eres el vendedor!";
$ERR_613 = "No puedes pujar, &iexcl;eres el ganador!";
$ERR_614 = "Subasta cerrada";
$ERR_615 = "No puedes pujar por un valor menor al actual";
$ERR_616 = "C&oacute;digo postal demasiado corto";
$ERR_617 = "N&uacute;mero de tel&eacute;fono incorrecto";
$ERR_618 = "Tu cuenta ha sido suspendida o a&uacute;n no la has activado";
$ERR_619 = "Esta subasta ha sido suspendida";
$ERR_620 = "La categor&ntilde;a principal ha sido eliminada por el Administrador.";
$ERR_700 = "Formato de fecha incorrecto";
$ERR_701 = "Cantidad no v&aacute;lida (debe ser >0)";
$ERR_702 = "La puja actual debe ser mayor a la puja m&iacute;nima";

//ADDED Feb.14, 2002 MARY LACEY
$ERR_703 = "<br>&iexcl;No puedes hacer una valoraci&oacute;n sobre este usuario! <br>No eres el ganador/vendedor de esta subasta finalizada";
$ERR_704 = "<br>&iexcl;No puedes hacer una valoraci&oacute;n sobre este usuario! <br>Esta subasta no ha finalizado";
$ERR_705 = "S&oacute;lo puedes valorar a otro usuario, si has cerrado una transacci&oacute;n con &eacute;l";



#// GIAN-- Added on 03/07/2002 for ProPlus @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
$ERR_706 = "<I>N&uacute;m. m&aacute;ximo de im&aacute;genes</I> debe ser num&eacute;rico";
$ERR_707 = "<I>Tama&ntilde;o m&aacute;ximo de imagen</I> no puede ser cero";
$ERR_708 = "<I>Tama&ntilde;o m&aacute;ximo de imagen</I> debe ser num&eacute;rico";
$ERR_709 = "La imagen que has enviado es demasiado grande. No puedes excederte ";
$ERR_710 = "Tipo de archivo incorrecto. Los formatos soportados son: GIF, PNG y JPEG";
#//Added 08.03.02 Simokas
$ERR_711 = "No puedes comprar, &iexcl;eres el vendedor!";

$ERR_712 = "<B>Comprar ahora</B> no est&aacute; disponible en esta subasta";
$ERR_713 = "Tu cuenta ha sido suspendida";

#// Added for WeBid
$ERR_5000 = "Los mensajes a mostrar deben ser num&eacute;ricos";
$ERR_5001 = "Los mensajes a mostrar no pueden ser cero";
$ERR_5002 = "Debes elegir al menos un tipo (accesos, navegadores y plataformas, por pa&iacute;s)";
$ERR_5003 = "La lista de nombres no puede estar vac&iacute;a";
$ERR_5004 = "La subasta a la que est&aacute;s tratando de acceder es una subasta privada y t&uacute; no pareces ser uno de los compradores invitados.";
$ERR_5005 = "El vendedor de la subasta en la que est&aacute;s tratando de pujar,<BR>ha establecido algunas restricciones en ella y t&uacute; no puedes realizar una oferta";
$ERR_5006 = "El vendedor de la subasta en la que est&aacute;s tratando de pujar,<BR>ha establecido algunas restricciones en ella y t&uacute; no puedes realizar una oferta";
$ERR_5007 = "Para crear una subasta privada debes elegir al menos a un usuario de la lista de usuarios invitados";
$ERR_5008 = "La URL no puede estar vac&iacute;a";
$ERR_5009 = "El mensaje de bienvenida no puede estar vac&iacute;o (el logo es opcional)";
$ERR_5010 = "El porcentaje de las tasas debe ser num&eacute;rico";
$ERR_5011 = "N&uacute;mero de tarjeta de cr&eacute;dito no v&aacute;lido";
$ERR_5012 = "Fecha de caducidad no v&aacute;lida";
$ERR_5013 = "Falta el nombre del propietario de la tarjeta de cr&eacute;dito";
$ERR_5014 = "Falta el t&iacute;tulo o el mensaje";
$ERR_5015 = "Falta el c&oacute;digo postal de la tarjeta";
$ERR_5016 = "includes/config.inc.php ";
$ERR_5017 = "includes/passwd.inc.php ";
$ERR_5018 = "el directorio \"counter\" no es escribible.<BR>Debes cambiar los permisos de este directorio para poder continuar con la instalaci&oacute;n (CHMOD a 777)<BR>";
$ERR_5019 = "el directorio \"uploaded\" no es escribible.<BR>Debes cambiar los permisos de este directorio para poder continuar con la instalaci&oacute;n (CHMOD a 777)<BR>";
$ERR_5020 = "el directorio \"admin/backup\" no es escribible.<BR>Debes cambiar los permisos de este directorio para poder continuar con la instalaci&oacute;n (CHMOD a 777)<BR>";
$ERR_5021 = "Uno o m&aacute;s problemas han sido detectados y le ser&aacute;n mostrados a continuaci&oacute;n.<BR>Por favor soluci&oacute;nelos para continuar con la instalaci&oacute;n";
$ERR_5022 = "Imposible conectar con el servidor MySQL: ";
$ERR_5023 = "Imposible seleccionar Base de Datos: ";
$ERR_5024 = "El tama&ntilde;o m&aacute;ximo de env&iacute;o debe ser num&eacute;rico";
$ERR_5025 = " no existe";
$ERR_5026 = " no es escribible.<BR>Debes cambiar los permisos de este archivo o los cambios que has realizado no tendr&aacute;n efecto";
$ERR_5027 = " no existe en este servidor";
$ERR_5028 = " no es escribible.<BR><B>Debes cambiar los permisos de este archivo para continuar con la instalaci&oacute;n </B>(CHMOD a 666)<BR>";
$ERR_5029 = "Falta el nombre";
$ERR_5030 = "Falta el nombre de usuario";
$ERR_5031 = "Falta la contrase&ntilde;a";
$ERR_5032 = "Por favor escribe la contrase&ntilde;a dos veces";
$ERR_5033 = "Falta la direcci&oacute;n de e-mail";
$ERR_5034 = "Falta la direcci&oacute;n postal";
$ERR_5035 = "Falta la ciudad";
$ERR_5036 = "Falta la provincia";
$ERR_5037 = "Falta el pa&iacute;s";
$ERR_5038 = "Falta el c&oacute;digo postal";
$ERR_5039 = "Falta el tel&eacute;fono";
$ERR_5040 = "Falta la fecha de nacimiento";
$ERR_5041 = "El l&iacute;mite de factura no puede estar vac&iacute;o";
$ERR_5042 = "Los archivos siguientes no pueden ser escribibles:
<UL>
<LI>includes/invoice_header_text.ES.inc.txt
<LI>includes/invoice_footer_text.ES.inc.txt
</UL>
Por favor establece los permisos para estos archivos y que los srcipts PHP puedan escribir en ellos.";

$ERR_5043 = "No se puede crear la Base de Datos &nbsp;";
$ERR_5044 = "<BR><BR>El problema puede estar en al configuraci&oacute;n del servidor MySQL.  Si recibes este error, trata de crear una base de datos usando el panel de control bajo web (o por el m&eacute;todo que uses habitualmente). <BR> y reinicia la instalaci&oacute;n \"Usa existing database\" Adem&aacute;s del nombre de la Base de Datos que acabas de crear. Luego haz click en continuar.";
$ERR_5045 = "El precio de reserva no puede ser menor a la oferta minima";
$ERR_5046 = "El precio de Compralo ahora no puede ser menor que la oferta minima y/o el precio de reserva";

$ERR_25_001 = "Para actualizar/insertar por favor cambie alguna etiqueta";
$ERR_25_002 = "No valores numericos en variante numerica ";
$ERR_25_003 = "uploaded/cache";

// UI Messages

$MSG_001 = "Alta nuevo usuario";
$MSG_002 = "Tu nombre";
$MSG_003 = "Nombre de usuario";
$MSG_004 = "Contrase&ntilde;a";
$MSG_005 = "Por favor, repite la contrase&ntilde;a";
$MSG_006 = "Tu direcci&oacute;n de e-mail";
$MSG_007 = "Enviar";
$MSG_008 = "Borrar";
$MSG_009 = "Direcci&oacute;n";
$MSG_010 = "Poblaci&oacute;n";
$MSG_011 = "Provincia";
$MSG_012 = "C&oacute;digo postal";
$MSG_013 = "Tel&eacute;fono";
$MSG_014 = "Pa&iacute;s";
$MSG_015 = "--Selecciona aqu&iacute;";
$MSG_016 = "Tus datos han sido recibidos, ahora debes confirmar tu registro siguiendo las instrucciones<BR>
                        que te hemos enviado a: ";
$MSG_017 = "T&iacute;tulo del art&iacute;culo";
$MSG_018 = "Descripci&oacute;n del art&iacute;culo<BR>(se permiten etiquetas HTML b&aacute;sicas)";
$MSG_019 = "URL con una foto del producto<BR>(opcional)";
$MSG_020 = "La subasta empieza en";
$MSG_021 = "Precio de reserva";
$MSG_022 = "Duraci&oacute;n de la subasta";
$MSG_025 = "Condiciones de env&iacute;o";
$MSG_026 = "Formas de pago";
$MSG_027 = "Elige la categor&iacute;a que mejor<BR>describa tu art&iacute;culo";
$MSG_028 = "Subastar art&iacute;culo";
$MSG_029 = "No";
$MSG_030 = "Si";
$MSG_031 = "El comprador pagar&aacute; los gastos de env&iacute;io<BR>[especif&iacute;calos al describir el art&iacute;culo]";
$MSG_032 = "El vendedor paga los gastos de env&iacute;o";
$MSG_033 = "Se env&iacute;a al extranjero";
$MSG_034 = "Previsualizar subasta";
$MSG_035 = "Borrar el formulario";
$MSG_036 = "Enviar mis datos";
$MSG_037 = "Sin fotograf&iacute;a";
$MSG_039 = "Sin precio de reserva";
$MSG_040 = "Enviar subasta";
$MSG_041 = "Categor&iacute;a del art&iacute;culo";
$MSG_042 = "Descripci&oacute;n del art&iacute;culo";
$MSG_043 = "I.V.A no incluido";
$MSG_044 = "Escribe tu nombre de usuario, tu contrase&ntilde;a y pulsa el bot&oacute;n de ENVIAR SUBASTA para que tu subasta sea v&aacute;lida";
$MSG_045 = "Administraci&oacute;n de usuarios";
$MSG_046 = "A&uacute;n puedes <A HREF='sell.php?mode=recall&SESSION_ID=$SESSION_ID'> hacer cambios</A> en la subasta";
$MSG_049 = "Si no eres un usuario registrado, ";
$MSG_050 = "(m&iacute;nimo 6 caracteres)";
$MSG_051 = "Inicio";
$MSG_052 = "Login";
$MSG_053 = "Editar la direcci&oacute;n e-mail de contacto";
$MSG_054 = "Enviar la nueva direcci&oacute;n e-mail";
$MSG_055 = "Editar la direcci&oacute;n e-mail a continuaci&oacute;n.";
$MSG_056 = "Direcci&oacute;n e-mail actualizada";
$MSG_057 = "Editar el s&iacute;mbolo de moneda a continuaci&oacute;n";
$MSG_058 = "Enviar nuevo s&iacute;mbolo";
$MSG_060 = "S&iacute;mbolo de moneda actualizado";
$MSG_061 = "INSTALACION";
$MSG_062 = "ADMINISTRACION";
$MSG_063 = "CONFIGURACION";
$MSG_064 = "Paso 1. - Crear Base de datos MySQL";
$MSG_065 = "Paso 2. - Crear tablas necesarias";
$MSG_066 = "Paso 3. - Publicar tablas";
$MSG_067 = "Ver subastas activas";
$MSG_069 = "Editar duraci&oacute;n de subastas";
$MSG_070 = "Usa la casilla Borrar y el bot&oacute;n de Borrar para eliminar l&iacute;neas. Usa la &uacute;ltima l&iacute;nea para a&ntilde;adir una nueva condici&oacute;n de pago. Sencillamente edita los campos de texto y pulsa Actualizar para guardar los cambios.";
$MSG_071 = "Actualizar";
$MSG_073 = "L&iacute;neas borradas";
$MSG_074 = "Usa la casilla Borrar y el bot&oacute;n de Borrar para eliminar l&iacute;neas. Sencillamente edita los campos de texto y pulsa Actualizar para guardar los cambios.";
$MSG_075 = "Editar las formas de pago";
$MSG_076 = "S&iacute;mbolo de moneda";
$MSG_077 = "Editar la direcci&oacute;n e-mail de contacto";
$MSG_078 = "Tabla de categor&iacute;as/subcategor&iacute;as";
$MSG_081 = "Tabla de pa&iacute;ses";
$MSG_084 = "Mensaje enviado";
$MSG_086 = "Tabla de categor&iacute;as actualizada";
$MSG_087 = "Descripci&oacute;n";
$MSG_089 = "Procesar cambios";
$MSG_090 = "Tabla de pa&iacute;ses actualizada";
$MSG_091 = "Cambiar idioma";
$MSG_092 = "Edita, borra o inserta condiciones de pago";
$MSG_093 = "Tabla de condiciones de pago actualizada";
$MSG_094 = "Edita, borra o inserta pa&iacute;ses";
$MSG_096 = "Idioma actual";
$MSG_097 = "D&iacute;as";
$MSG_098 = "Confirmaci&oacute;n de registro";
$MSG_099 = "Confirmaci&oacute;n nueva subasta";
$MSG_100 = "Los datos de tu subasta han sido recibidos correctamente.<BR>Hemos enviado un mensaje de confirmaci&oacute;n a tu direcci&oacute;n de correo electr&oacute;nico.<BR>";
$MSG_101 = "URL de la subasta: ";
$MSG_102 = "&nbsp;Ir!&nbsp;";
$MSG_103 = "Buscar ";
$MSG_104 = "Navegar ";
$MSG_105 = "Ver historial";
$MSG_106 = "Env&iacute;a esta subasta a un amigo";
$MSG_107 = "E-mail de usuario";
$MSG_108 = "Ver imagen";
$MSG_111 = "La subasta comenza";
$MSG_112 = "La subasta finaliza";
$MSG_113 = "ID de subasta";
$MSG_114 = "No hay imagen disponible";
$MSG_115 = "&iexcl;Puja ahora!<BR>Es GRATIS";
$MSG_116 = "Precio actual";
$MSG_117 = "Ganador actual";
$MSG_118 = "Finaliza en ";
$MSG_119 = "N. de pujas";
$MSG_120 = "Incremento de puja";
$MSG_121 = "Pon tu puja m&aacute;xima";
$MSG_122 = "Edita, borra o inserta, duraci&oacute;n de subastas";
$MSG_123 = "Tabla de duraci&oacute;n de subastas actualizada";
$MSG_124 = "Puja m&iacute;nima";
$MSG_125 = "Vendedor";
$MSG_126 = " d&iacute;as, ";
$MSG_127 = "Puja inicial";
$MSG_128 = "Incremento de pujas";
$MSG_129 = "ID";
$MSG_133 = "Tabla de incremento de pujas";
$MSG_134 = "Puja actual";
$MSG_135 = "Edita, borra o a&ntilde;ade incrementos usando el formulario siguiente.<BR>
            Ten cuidado, no hay control sobre la congruencia de la tabla de valores.
            Debes tener cuidado de comprobarlo por ti mismo. La &uacute;nica comprobaci&oacute;n es sobre el contenido de los campos (debe ser num&eacute;rico) pero la relaci&oacute;n entre ellos no ser&aacute; comprobada.<br>
            [<A HREF=\"javascript:window_open('incrementshelp.php','incre',400,500,30,30)\" CLASS=\"links\">Leer m&aacute;s</A>]";
$MSG_136 = "y";
$MSG_137 = "Incremento";
$MSG_138 = "Volver a la subasta";
$MSG_139 = "Enviar esta subasta a un amigo";
$MSG_140 = "Nombre de tu amigo";
$MSG_141 = "E-mail de tu amigo";
$MSG_143 = "Tu e-mail";
$MSG_144 = "A&ntilde;adir un comentario";
$MSG_145 = "Enviar";
$MSG_146 = "La subasta ha sido enviada a ";
$MSG_147 = "Enviar a otro amigo";
$MSG_148 = "Ayuda";
$MSG_149 = "Puede contactar con el usuario utilizando el siguiente formulario";
$MSG_150 = "Enviar";
$MSG_151 = " La direcci&oacute;n de e-mail es ";
$MSG_152 = "Confirma tu puja";
$MSG_153 = "Para pujar tienes que ser un usuario registrado";
$MSG_154 = "Est&aacute;s pujando en:";
$MSG_155 = "Art&iacute;culo:";
$MSG_156 = "Tu puja:";
$MSG_158 = "Enviar mi puja";
$MSG_159 = "Tu puja ha sido registrada:";
$MSG_159 = "Usuario:";
$MSG_160 = "Tabla de incrementos actualizada";
$MSG_161 = "Editar, borrar o insertar, categor&iacute;as.<BR>[<A HREF=\"javascript:window_open('categorieshelp.php','incre',400,300,30,30)\" CLASS=\"links\">Leer m&aacute;s</A>]";
$MSG_163 = "Reg&iacute;strate!";
$MSG_165 = "Categor&iacute;a: ";
$MSG_166 = "Inicio";
$MSG_167 = "Imagen";
$MSG_168 = "Subasta";
$MSG_169 = "Puja actual";
$MSG_170 = "Pujas #";
$MSG_171 = "Finaliza en";
$MSG_172 = "No hay subastas activas en esta categor&iacute;a";
$MSG_173 = "Resultado de la b&uacute;squeda: ";
$MSG_175 = "Fecha y hora";
$MSG_176 = "Comprador";
$MSG_177 = "Indice de categor&iacute;as";
$MSG_178 = "Contacta con el comprador";
$MSG_179 = "Para obtener otra direcci&oacute;n e-mail, s&oacute;lo escribe tu nombre de usuario y contrase&ntilde;a";
$MSG_180 = " es:";
$MSG_181 = "Login de usuario";
$MSG_182 = "Edita tus datos personales";
$MSG_183 = "Tus datos han sido actualizados";
$MSG_184 = "Tabla de categor&iacute;as actualizada.";
$MSG_186 = "<A HREF=\"javascript:history.back()\">Volver</A>";
$MSG_187 = "Tu nombre de usuario";
$MSG_188 = "Tu contrase&ntilde;a";
$MSG_190 = "Categor&iacute;a de su art&iacute;culo";
$MSG_193 = "Duraci&iacute;n de la subasta";
$MSG_195 = "URL de la imagen";
$MSG_196 = "Descripci&oacute;n del art&iacute;culo";
$MSG_197 = "T&iacute;tulo de la subasta";
$MSG_198 = "No se encontr&oacute; ning&uacute;n art&iacute;culo";
$MSG_199 = "Buscar";
$MSG_200 = "Usuario: ";
$MSG_201 = "Nuevo usuario";
$MSG_202 = "Datos del usuario";
$MSG_203 = "Subastas activas";
$MSG_204 = "Subastas finalizadas";
$MSG_205 = "Tu Panel de control";
$MSG_206 = "Perfil del usuario";
$MSG_207 = "<b>Dejar valoraci&oacute;n</b>";
$MSG_208 = "<b>Ver valoraci&oacute;n</b>";
$MSG_209 = "Usuario registrado desde: ";
$MSG_210 = "Contactar con";
$MSG_212 = "Subastas:";
$MSG_213 = "Ver subastas activas";
$MSG_214 = "Ver subastas finalizadas";
$MSG_215 = "&iquest;Recordar contrase&ntilde;a?";
$MSG_216 = "Si has olvidado tu contrase&ntilde;a, escribe tu nombre de usuario";
$MSG_217 = "Una nueva contrase&ntilde;a ha sido enviada a tu direcci&oacute;n e-mail";
$MSG_218 = "Ver perfil del usuario.";
$MSG_219 = "Subastas Activas: ";
$MSG_220 = "Subastas Finalizadas: ";
$MSG_221 = "Login de Usuario";
$MSG_222 = "Calificaci&oacute;n de Usuario";
$MSG_223 = "Deja tu comentario";
$MSG_224 = "Elige una calificaci&oacute;n entre 1 y 5";
$MSG_225 = "Gracias por dejar tu comentario";
$MSG_226 = "Tu calificaci&oacute;n ";
$MSG_227 = "Tu comentario ";
$MSG_228 = "Calificado por ";
$MSG_229 = "Ultimas calificaciones:";
$MSG_230 = "Ver todas las calificaciones";
$MSG_231 = "USUARIOS REGISTRADOS";
$MSG_232 = "SUBASTAS";
$MSG_233 = "M&aacute;s";
$MSG_234 = "Atr&aacute;s &gt;&gt;";
$MSG_235 = "Reg&iacute;strate";
$MSG_239 = "Subastas";
$MSG_240 = "De";
$MSG_241 = "a";
$MSG_243 = "Si deseas cambiar la contrase&ntilde;a, rellena los dos campos siguientes. En caso contrario d&eacute;jalos en blanco.";
$MSG_244 = "Editar datos";
$MSG_245 = "Salir";
$MSG_246 = "Identificado como";
$MSG_248 = "Confirma tu registro";
$MSG_249 = "Confirmar";
$MSG_250 = "Anular";
$MSG_251 = "---- Selecciona aqu&iacute;";
$MSG_252 = "Fecha de nacimiento";
$MSG_253 = "(mm/dd/aaaa)";
$MSG_254 = "Sugerir una nueva categor&iacute;a";
$MSG_255 = "ID de la subasta";
$MSG_256 = "O selecciona la imagen que deseas subir (opcional)";
$MSG_257 = "Tipo de subasta";
$MSG_258 = "Cantidad de art&iacute;culos";
$MSG_260 = "Copyright 2008, <a href='http://sourceforge.net/projects/simpleauction'>WeBid</a>";
$MSG_261 = "Tipo de subasta";
$MSG_262 = "Tu sugerencia";
$MSG_263 = "reg&iacute;strate!";
$MSG_264 = "A&uacute;n puedes ";
$MSG_265 = "hacer cambios";
$MSG_266 = " en esta subasta.";
$MSG_267 = "Este es el &uacute;ltimo paso para completar tu registro en esta p&aacute;gina.
				<br>Para confirmar tu registro presiona el bot&oacute;n <B>Confirmar</B>.
				<BR>Si no quieres registrarte y deseas eliminar tus datos de nuestro base de datos, usa el bot&oacute;n <B>Anular</B>.";
$MSG_269 = "Tu puja ha sido recibida";
$MSG_270 = "Volver";
$MSG_271 = "Tu puja ha sido procesada correctamente";
$MSG_272 = "Subasta:";
$MSG_275 = "&nbsp;Ir!&nbsp;";
$MSG_276 = "Categorias";
$MSG_277 = "M&aacute;s";
$MSG_278 = "Ultimas subastas creadas";
$MSG_279 = "Mayores pujas";
$MSG_280 = "&iexcl;Finalizar&aacute;n pronto!";
$MSG_281 = "Columna de ayuda";
$MSG_282 = "Noticias";
$MSG_283 = "m&iacute;nimo";
$MSG_284 = "Cantidad";
$MSG_285 = "Ir atr&aacute;s";
$MSG_286 = " y especificar una puja v&aacute;lida.";
$MSG_287 = "Categor&iacute;a";
$MSG_288 = "El criterio de b&uacute;squeda no puede estar vac&iacute;o";
$MSG_289 = "P&aacute;ginas totales:";
$MSG_290 = "Art&iacute;culos totales:";
$MSG_291 = "art&iacute;culos mostrados por p&aacute;gina";
$MSG_293 = "NICK";
$MSG_294 = "NOMBRE";
$MSG_295 = "PA&iacute;S";
$MSG_296 = "E-MAIL";
$MSG_297 = "SUBASTA";
$MSG_298 = "Editar";
$MSG_300 = "Suspender";
$MSG_301 = "usuarios encontrados en la base de datos";
$MSG_302 = "Nombre";
$MSG_303 = "E-mail";
$MSG_304 = "Borrar usuario";
$MSG_305 = "Suspender usuario";
$MSG_306 = "Reactivar usuario";
$MSG_307 = "&iquest;Est&aacute;s seguro que deseas borrar este usuario?";
$MSG_308 = "&iquest;Est&aacute;s seguro que deseas suspender este usuario?";
$MSG_309 = "&iquest;Est&aacute;s seguro que deseas reactivar este usuario?";
$MSG_310 = "Reactivar";
$MSG_311 = "subastas en la base de datos";
$MSG_312 = "T&iacute;TULO";
$MSG_313 = "USUARIO";
$MSG_314 = "FECHA";
$MSG_315 = "DURACI&oacute;N";
$MSG_316 = "CATEGOR&iacute;A";
$MSG_317 = "DESCRIPCI&oacute;N";
$MSG_318 = "PUJA ACTUAL";
$MSG_319 = "CANTIDAD";
$MSG_320 = "PRECIO DE RESERVA";
$MSG_321 = "Suspender subasta";
$MSG_322 = "Reactivar subasta";
$MSG_323 = "&iquest;Est&aacute;s seguro que deseas suspender esta subasta?";
$MSG_324 = "&iquest;Est&aacute;s seguro que deseas reactivar esta subasta?";
$MSG_325 = "Borrar subasta";
$MSG_326 = "&iquest;Est&aacute;s seguro que deseas borrar esta subasta?";
$MSG_327 = "PUJA M&iacute;NIMA";
$MSG_328 = "Color";
$MSG_329 = "URL de la imagen";
$MSG_330 = "Gracias por confirmar tu registro.<BR>El proceso de registro se ha realizado con &eacute;xito, ahora puedes participar en las actividades de esta p&aacute;gina.<BR>";
$MSG_331 = "Tu registro ha sido eliminado permanentemente de nuestra base de datos.";
$MSG_332 = "T&iacute;tulo";
$MSG_333 = "Mensaje";
$MSG_334 = "Contactar con";
$MSG_335 = "Contacto desde ";
$MSG_336 = "en relac&iacute;&oacute;n a tu subasta ";
$MSG_337 = "Tu mensaje ha sido enviado a ";
$MSG_338 = "Borrar noticias";
$MSG_339 = "&iquest;Est&aacute;s seguro que deseas borrar esta noticia?";
$MSG_340 = "Nueva lista";
$MSG_341 = "Ver todas las noticias";
$MSG_342 = " Noticias";
$MSG_343 = "Editar noticias";

#// ================================================================================
#// GIAN-- Jan. 19, 2002 -- Added for Pro version
$MSG_344 = "Variables de hora";
$MSG_345 = "Si deseas ajustar la hora de tu servidor para mostrar exactamente la hora local, elige la opci&oacute;n (+ o -) hasta llegar a la hora que deseas.<BR>
                        Todas las horas de la p&aacute;gina ser&uacute;n ajustadas a la hora seleccionada.";
$MSG_346 = "Ajuste de hora";
$MSG_347 = "Variables de hora actualizadas";
$MSG_348 = "Proceso Batch";
$MSG_349 = "INFORMACION GENERAL";
$MSG_350 = "Usuarios registrados";
$MSG_351 = "Usuarios activos";
$MSG_352 = "Usuarios inactivos";
$MSG_353 = "Subastas activas";
$MSG_354 = "Subastas finalizadas";
$MSG_355 = "# de Pujas";
$MSG_356 = "Transacciones";
$MSG_357 = "Cantidad Total";
$MSG_358 = "desde";
$MSG_359 = "Resetear los contadores de transacciones";
$MSG_361 = "Usuarios y subasta";
$MSG_362 = "Valores desde ";
$MSG_363 = "Formato de fecha";
$MSG_364 = "Tasas";
$MSG_365 = "ADMINISTRADORES";
$MSG_367 = "Nuevo administrador";
$MSG_368 = "CATEGOR&iacute;AS";
$MSG_369 = "Crear nuevo &aacute;rbol de categor&iacute;as";
$MSG_370 = "OTRAS TABLAS";
$MSG_371 = "WeBid necesita ejecutar periodicamente cron.php para cerrar subastas finalizadas y
                        enviar e-mails de notificaci&oacute;n al vendedor y/o al ganador.
                        La mejor manera de ejecutar cron.php es crear un <A HREF=\"http://www.aota.net/Script_Installation_Tips/cronhelp.php4\" TARGET=_blank>cronjob</A> si tu
                        usas un servidor Unix/Linux.<BR>
                        Si por cualquier raz&oacute;n no puedes crear un cronjob en tu servidor, puedes elegir la opci&oacute;n <B>Non-batch</B>
                        para tener cron.php ejecutado por WeBid.";
$MSG_372 = "Ejecutar cron";
$MSG_373 = "Batch";
$MSG_374 = "Non-batch";
$MSG_375 = "De acuerdo con los valores establecidos en las variables de WeBid, cron.php borrar&aacute; las subastas creadas hace m&aacute;s de 30 d&iacute;as.
                        <BR>Puedes elegir otro periodo de tiempo.";
$MSG_376 = "Borrar subastas creadas antes de los &uacute;ltimos";
$MSG_377 = " d&iacute;as";
$MSG_378 = "Variables Batch actualizadas.";
$MSG_379 = "Elige el formato de fecha a usar.";
$MSG_380 = "Formato USA";
$MSG_381 = "Formato No-USA";
$MSG_382 = "mm/dd/aaaa";
$MSG_383 = "dd/mm/aaaa";
$MSG_384 = "Formato de fecha actualizado.";
$MSG_400 = "Direcci&oacute;n de e-mail";
$MSG_409 = "Error de gesti&oacute;n";
$MSG_410 = "El Error Fatal ocurrido durante la instalaci&oacute;n de WeBid (error t&iacute;pico de MySql) redireccionar&aacute; a una p&aacute;gina de error.
                        Puedes personalizar el mensaje de error que deseas que aparezca cuando el error se produzca.<BR>
                        NOTA: Comandos b&aacute;sicos HTML permitidos.";
$MSG_411 = "Texto del Error";
$MSG_412 = "Direcci&oacute;n e-mail para enviar el error";
$MSG_413 = "Variables de error de gesti&oacute;n actualizadas.";
$MSG_414 = "Previsualizar p&aacute;gina de error";
$MSG_415 = "Error";
$MSG_416 = "Por favor, env&iacute;a este mensaje de error a:";
$MSG_429 = "No hab&iacute;a ofertas o el precio de reserva no fue establecido";
$MSG_453 = "Informaci&oacute;n de contacto del ganador";
$MSG_454 = "Informaci&oacute;n de contacto del vendedor";
$MSG_455 = "Nick del ganador";
$MSG_456 = "E-mail del ganador";
$MSG_457 = "Puja del ganador";
$MSG_458 = "Subasta:&nbsp;";
$MSG_460 = "E-mail del vendedor";
$MSG_461 = "Tu puja";
$MSG_462 = "Bidfind";
$MSG_463 = "<A HREF=http://www.bidfind.com TARGET=_blank>Bidfind</A> es un directorio de b&uacute;squeda de art&iacute;culos en subasta.
                    Bidfind necesita encontrar un archivo de lista de";
$MSG_464 = "B&uacute;squeda avanzada";
$MSG_466 = "Buscar!";
$MSG_468 = "Puedes elegir entre dos modos de cargar tasas a tus usuarios:<OL>
			<LI><B>Pago:</B> Los usuarios pagar&aacute;n a tu cuenta PayPal cada vez que una tasa sea solicitada.
			<LI><B>Prepago:</B> Los usuarios prepagar&aacute;n (comprar cr&eacute;ditos) antes de acceder a los servicios que hayan solicitado
			</OL>";
$MSG_469 = "Actualmente el modo es:";
$MSG_470 = "% del precio final";

#// ================================================================================
#// Added by Simokas
#// ================================================================================

$MSG_471 = "Cazador de art&iacute;culos";
$MSG_472 = "Art&iacute;culos en la mira";
$MSG_473 = "Escribe palabra(s)";
$MSG_474 = "Palabra(s) actualizada";

#//Added by Mary 02-16-02
$MSG_476 = "VALORACI&oacute;N";
$MSG_477 = "<br>No tienes valoraciones hasta este momento.<br>";
//=======
$MSG_479 = "Cambiar a ";
$MSG_480 = "Para completar el proceso de registro, por favor, procede a pagar la tasa de registro de ";
$MSG_481 = " haciendo click en el bot&oacute;n PayPal siguiente. ";
$MSG_482 = "Pagar la tasa de registro";

$MSG_483 = "Tu cuenta";
$MSG_484 = "Tu subasta ha sido recibida correctamente.<BR>
    	    Para activarla, por favor, procede a pagar la tasa de ";
$MSG_485 = " haciendo click en el bot&oacute;n PayPal siguiente.";

$MSG_486 = " Tasa de subasta: ";
$MSG_488 = "Tasa de subasta confirmada";
$MSG_489 = "Tu tasa es a&uacute;n inferior para esta subasta";
$MSG_490 = "La tasa del vendedor es a&uacute;n inferior para esta subasta";
$MSG_491 = "La tasa del comprador es a&uacute;n inferior para esta subasta";
$MSG_492 = "PAGAR TASA";
$MSG_493 = "Valor de Tasa: ";
$MSG_494 = "Por favor, procede a pagar la tasa de ";
$MSG_495 = "Tasa de valor final de subasta para ";
#// Added by Simokas 08.03.02
$MSG_496 = "Comprar";
$MSG_497 = "Precio de compra";
$MSG_498 = "Art&iacute;culo comprado<br>";

$MSG_502 = "N&uacute;mero de valoraciones";
$MSG_503 = "Valoraci&oacute;n";
$MSG_504 = "COMENTARIO";
$MSG_505 = "Volver al perfil de usuario";
$MSG_506 = "Valoraci&oacute;n enviada el: ";
$MSG_507 = "Ocultar historial";
$MSG_508 = "[e-mail de usuario]";
$MSG_509 = "Informaci&oacute;n de usuario";
$MSG_511 = "Editar usuario";
$MSG_512 = "Editar subasta";
$MSG_513 = "Sugerir una categor&iacute;a";
$MSG_514 = "Precio establecido";
$MSG_515 = "Precio alcanzado";
$MSG_516 = "Administraci&oacute;n de noticias";
$MSG_517 = " noticias encontradas en la base de datos";
$MSG_518 = "A&ntilde;adir noticia";
$MSG_519 = "T&iacute;tulo";
$MSG_520 = "Contenido";
$MSG_521 = "Activar";
$MSG_523 = "Nota: Las cookies deben estar activadas para la identificaci&oacute;n.";
$MSG_524 = "VARIABLES";
$MSG_525 = "Gesti&oacute;n de administradores";
$MSG_526 = "Variables generales";
$MSG_527 = "Nombre de la p&aacute;gina";
$MSG_528 = "URL de la p&aacute;gina";
$MSG_530 = "Guardar cambios";
$MSG_531 = "Tu logo";
$MSG_532 = "&iquest;Mostrar opci&oacute;n de Login?";
$MSG_533 = "&iquest;Mostrar opci&oacute;n de Noticias?";
$MSG_534 = "&iquest;Mostrar texto de aceptaci&oacute;n?";
$MSG_535 = "El nombre de tu p&aacute;gina aparecer&aacute; en los mensajes que WeBid env&iacute;e a los usuarios";
$MSG_536 = "Esta debe ser la URL completa (comenzando por <B>http://</B>) de la instalaci&oacute;n del WeBid.<BR>
                        Aseg&uacute;rate de usar la barra (<b>/</b>) al final.";
$MSG_537 = "Selecciona <B>S&iacute;</B>, si deseas que la opci&oacute;n de login sea mostrada en la p&aacute;gina de inicio. Si no lo deseas selecciona <B>No</B>";
$MSG_538 = "Selecciona <B>S&iacute;</B>, si deseas que la opci&oacute;n de noticias sea mostrada en la p&aacute;gina de inicio. Si no lo deseas selecciona <B>No</B>";
$MSG_539 = "Seleccionando la opci&oacute;n <B>S&iacute;</B> har&aacute; que WeBid muestre el texto que escribas a continuaci&oacute;n en la p&aacute;gina de registro, justo antes del bot&oacute;n de env&iacute;o de informaci&oacute;n.<BR>
                        Se usa habitualmente para mostrar algunas notas legales que el usuario acepta en el momento de presionar el bot&oacute;n.";
$MSG_540 = "E-mail de Administraci&oacute;n";
$MSG_541 = "El e-mail de administraci&oacute;n se usa para enviar mensajes de e-mail autom&aacute;ticamente";
$MSG_542 = "Variables generales actualizadas";
$MSG_543 = "Inicio";
$MSG_544 = "Formato de moneda";
$MSG_545 = "Estilo US: 1,250.00";
$MSG_546 = "Estilo Europeo: 1.250,00";
$MSG_547 = "Pon cero o d&eacute;jalo en blanco si no quieres que las cantidades tengan decimales";
$MSG_548 = "Decimales";
$MSG_549 = "Posici&oacute;n del s&iacute;mbolo";
$MSG_550 = "Antes del valor (i.e. USD 200)";
$MSG_551 = "Despu&eacute;s del valor (i.e. 200 USD)";
$MSG_553 = "Variables de s&iacute;mbolo actualizadas";
$MSG_554 = "N&uacute;mero de noticias que deseas mostrar";
$MSG_555 = "Tipos de letra y colores";
$MSG_556 = "Logo actual";
$MSG_558 = "Creado";
$MSG_559 = "&uacute;ltimo login";
$MSG_560 = "Estado";
$MSG_561 = "BORRAR";
$MSG_562 = "Editar Administrador";
$MSG_563 = "Si deseas cambiar la contrase&ntilde;a de usuario rellena los dos campos siguientes. Para mantener la contrase&ntilde;a actual d&eacute;jalo en blanco.";
$MSG_564 = "Repita la contrase&ntilde;a";
$MSG_565 = "El usuario est&aacute;";
$MSG_566 = "activo";
$MSG_567 = "no activo";
$MSG_569 = "A&ntilde;adir usuario";
$MSG_570 = "Nunca identificado";
$MSG_571 = "Letra standard";
$MSG_572 = "Letra de error";
$MSG_573 = "Letra peque&ntilde;a";
$MSG_574 = "Letra de la parte inferior";
$MSG_575 = "Letra del t&iacute;tulo";
$MSG_576 = "Este es el tipo de letra de los mensajes de error";
$MSG_577 = "Este es el tipo de letra usado para mostrar la mayor parte del texto de la p&aacute;gina.<BR>
                        Si deseas tener tipos de colores distintos para elegir, edita el archivo includes/fontcolor.inc.php";
$MSG_578 = "Tipo";
$MSG_579 = "Tama&ntilde;o";
$MSG_581 = "Negrita";
$MSG_582 = "Cursiva";
$MSG_583 = "La <B>Letra peque&ntilde;a</B> se usa para mostrar algunos mensajes en la p&aacute;gina como la fecha";
$MSG_584 = "Tipo de letra usado en la parte inferior de la p&aacute;gina";
$MSG_585 = "Tipo de letra usado para el t&iacute;tulo de la p&aacute;gina";
$MSG_586 = "Color del borde";
$MSG_587 = "Este es el color usado en la celda inferior, la celda superior y el color de la tabla exterior";
$MSG_588 = "Letra de navegaci&oacute;n";
$MSG_589 = "Tipo de letra en los enlaces de la parte superior de la p&aacute;gina";
$MSG_590 = "Color de fondo de la cabecera de la p&aacute;gina";
$MSG_591 = "Color de las tablas de la cabecera";
$MSG_592 = "Identificado como: ";
$MSG_593 = "Tipos de letra y colores actualizados";
$MSG_594 = "<BR>
			<FONTs COLOR=RED><B>Nota:</B> Para que esta utilidad funcione, el formato de los n&uacute;meros debe ser el estilo USA.<BR>
		    Tus <A HREF=currency.php>variables de s&iacute;mbolo de moneda</A> ser&aacute;n ignorados aqu&iacute;.";
$MSG_595 = "Color de enlaces";
$MSG_596 = "Color de enlaces visitados";
$MSG_597 = "&iquest;Activar intercambio de banners?";
$MSG_599 = "Intercambio de banners";
$MSG_600 = "Intercambio de banners actualizado";
$MSG_601 = "Acceder al panel de administraci&oacute;n de PhpAdsNew.";
$MSG_602 = "Sube un nuevo logo (max. 50 Kbytes)";
$MSG_603 = "&iquest;Bolet&iacute;n informativo?";
$MSG_604 = "Si activas esta opci&oacute;n, los usuarios tendr&aacute;n la posibilidad de suscribirse a la lista de correo durante el proceso de registro.<BR>
			La \"administraci&oacute;n de Newsletter\" le da la opci&oacute;n de enviar noticias a los usuarios que lo hayan solicitado";
$MSG_605 = "Mensaje";
$MSG_607 = "Administraci&oacute;n de Newsletter";
$MSG_608 = "&iquest;Quieres recibir el bolet&iacute;n informativo?";
$MSG_609 = "Elige NO para no recibirlo";
$MSG_610 = "<b>Si deseas cambiar tu contrase&ntilde;a, por favor rellena los campos siguientes, sino d&eacute;jalos en blanco.</b>";
$MSG_611 = "<b>Este art&iacute;culo ha sido visitado</b>";
$MSG_612 = "<b>veces</b>";
$MSG_614 = "Usa nuestra tabla de incrementos proporcionales";
$MSG_615 = "Usa tu propio valor de incremento";
$MSG_617 = "<B>*NOTA*  Si deseas cambiar tu contrase&ntilde;a, por favor rellena los campos siguientes.<BR>Sino d&eacute;jalos en blanco.</B>";
$MSG_618 = "Tus subastas";
$MSG_619 = "Subastas activas";
$MSG_620 = "Tus pujas";
$MSG_621 = "Editar tu perfil personal";
$MSG_622 = "Mi panel de control";
$MSG_625 = "Empez&oacute;";
$MSG_626 = "Finaliza";
$MSG_627 = "No. pujas";
$MSG_628 = "M&aacute;x. puja";
$MSG_630 = "Re-listar";
$MSG_631 = "Procesar subastas seleccionadas";
$MSG_633 = "Este es el color de las tablas de la cabecera en la p&aacute;gina principal";
$MSG_634 = "La cabecera, columnas y filas de la subasta, tendr&aacute;n este color";
$MSG_635 = "Para cambiar la imagen de tu art&iacute;culo usa el campo siguiente.";
$MSG_636 = "Imagen actual";
$MSG_637 = "Volver a la lista de subastas";
$MSG_638 = "Pujas que has realizado";
$MSG_640 = "<b>*Nota*<b> Si la subasta es del tipo Dutch no podr&aacute;s establecer un precio de reserva, ni una cantidad de incremento de puja, as&iacute; como la opci&oacute;n C&oacute;MPRALO YA";
$MSG_641 = "Subasta Dutch";
$MSG_642 = "Subasta standard";
$MSG_643 = "\nEl precio que debes cobrar a cada usuario por unidad es de:";
$MSG_644 = "Para actualizar la lista de categor&iacute;as, debes editar primero
			el archivo categories.txt siguiendo las instrucciones de <A HREF=\"../docs/CATEGORIES\">docs/CATEGORIES</A>
			y ejecutar <A HREF=\"populate_categories.php\">populate_categories.php</A>";

$MSG_645 = "Enviar una pregunta al vendedor";
$MSG_646 = "Debes estar identificado para hacer una pregunta al vendedor";
$MSG_647 = "Preg&uacute;ntale a";
$MSG_648 = "	Responder a las preguntas";
$MSG_649 = "Respuesta:";
$MSG_650 = "Pregunta:";


#// GIAN-- 03/07/2002 addec for Pro Plus
$MSG_663 = "Galer&iacute;a de im&aacute;genes";
$MSG_664 = "Si activas esta opci&oacute;n, los vendedores podr&aacute;n subir im&aacute;genes adicionales
            hasta un n&uacute;mero M&aacute;ximo que tu especifiques (ver abajo).<BR>
            Recuerda que puedes establecer un tasa para las im&aacute;genes adicionales de los vendedores:
            lee la <A HREF=picturesgalleryfee.php>secci&oacute;n tasas</A>.";
$MSG_665 = "&iquest;Activar galer&iacute;a de im&aacute;genes?";
$MSG_666 = "M&aacute;x. n&uacute;mero de im&aacute;genes";
$MSG_667 = "Variables de galer&iacute;a de im&aacute;genes actualizadas";
$MSG_668 = "Tasa de galer&iacute;a de im&aacute;genes";
$MSG_669 = "Puedes cobrar a los vendedores por cada una de las im&aacute;genes que subir&aacute;n o dejar que lo hagan gratis";
$MSG_670 = "&iquest;Activar tasa de galer&iacute;a de im&aacute;genes?";
$MSG_671 = "Tama&ntilde;o M&aacute;ximo de imagen";
$MSG_672 = "Kbytes";
$MSG_673 = "Puede subir hasta ";
$MSG_674 = "im&aacute;genes.";
$MSG_675 = "Se te cobrar&aacute; ";
$MSG_676 = "por cada imagen subida.";
$MSG_677 = "Subir im&aacute;genes";
$MSG_678 = "Cerrar";
$MSG_679 = "Por favor, sigue los siguientes pasos:";
$MSG_680 = "Seleccione el archivo a subir";
$MSG_681 = "Sube el archivo";
$MSG_682 = "Repite los paso 1 y 2 para cada imagen. Cuando termines haz click en <I>Crear galer&iacute;a</I>.";
$MSG_683 = "&gt;&gt;&gt; Crear galer&iacute;a &lt;&lt;&lt;";
$MSG_684 = "Nombre del archivo";
$MSG_685 = "Tama&ntilde;o (bytes)";
$MSG_687 = "Archivos subidos";
$MSG_688 = "Has subido ";
$MSG_689 = " archivos";
$MSG_690 = "Tasa";
$MSG_691 = "Tasa de galer&iacute;a de im&aacute;genes";
$MSG_692 = "Editar galer&iacute;a de im&aacute;genes";
$MSG_693 = "&gt;&gt;&gt; Actualizar galer&iacute;a &lt;&lt;&lt;";
$MSG_694 = "Ver galer&iacute;a de im&aacute;genes";
$MSG_695 = "Repite los pasos 1 y 2 para cada imagen. Cuando termines haz click en <I>Actualizar galer&iacute;a</I>.";
$MSG_696 = "Tasa de galer&iacute;a de im&aacute;genes: ";
$MSG_697 = "Puedes borrar o a&ntilde;adir im&aacute;genes a tu galer&iacute;a a continuaci&oacute;n.
            <BR>tu galer&iacute;a puede contener hasta ";
$MSG_698 = "im&aacute;genes (n&uacute;mero de im&aacute;genes de tu galer&iacute;a original)";
#// MBL-- 03/10/2002 added for Pro Plus Proxy Bidding
$MSG_699 = "Tu puja de ";
$MSG_700 = " ha sido recibida. ";
$MSG_701 = " Tu puja no es suficiente para ser la M&aacute;s alta.<br>&iquest;Deseas pujar otra vez?";
$MSG_702 = " &iquest;Auto-puja?";


#// GIAN-- 03/11/2002 For Bulk Upload +++++++++++++++++++++++
$MSG_703 = "Env&iacute;o de varias subastas";
$MSG_704 = "Al usar esta opci&oacute;n, podr&aacute;s enviar varios art&iacute;culos .<BR>
						<BR>Una vez enviados, las subastas ser&aacute;n creadas, pero no mostradas(en vivo).  Podr&aacute;s comprobar los art&iacute;culos en la secci&oacute;n <A HREF=yourauctions_b.php>Tus subastas enviadas</A>. Despu&eacute;s de comprobar los art&iacute;culos, podr&aacute;s listarlos uno a uno para que se activen en subasta.
						<BR><BR>
						La informaci&oacute;n de las subastas ser&aacute; almacenada en un archivo de texto separadas por tabulaci&oacute;n siguiendo
						<A HREF=\"Javascript:window_open('bulkschema.php','bulkschema',400,500,20,20)\">este esquema</A>.
						<BR><BR>Adem&aacute;s necesitar&aacute;s saber los c&oacute;digos num&eacute;ricos para poder activar el archivo con la informaci&oacute;n correcta.";
$MSG_705 = "Esquema de env&iacute;o de varias subastas";
$MSG_706 = "A continuaci&oacute;n se muestra la lista de campos que puedes enviar para tus subastas, junto con su formato y/o valores .<BR>
            <BR>En tu archivo, cada subasta est&aacute; representada en una l&iacute;nea y cada campo debe estar separado por una tabulaci&oacute;n.";
$MSG_707 = "Campo";
$MSG_708 = "Valor";
$MSG_709 = "Una cadena de texto de hasta 255 caracteres de largo";
$MSG_710 = "Descripci&oacute;n del art&iacute;culo";
$MSG_711 = "Una descripci&oacute;n de texto de hasta 65535 caracteres de largo";
$MSG_712 = "El c&oacute;digo de categor&iacute;a o subcategor&iacute;a. Leer M&aacute;s <a href=bulkschema.php?title=cat>aqu&iacute;</a>.";
$MSG_715 = "El valor de la puja inicial para la subasta.";
$MSG_717 = "El valor del precio de reserva. Si no deseas marcar un precio de reserva para la subasta pon en este campo cero.";
$MSG_718 = "Tipo de subasta";
$MSG_719 = "1 significa <B>Subasta standard</B><BR>2 significa <B>Subasta Dutch</B>";
$MSG_721 = "Esta es la duraci&oacute;n de tu subasta.";
$MSG_722 = "Incremento de puja";
$MSG_723 = "Si estableces un incremento tipo, pon el valor aqu&iacute;.<BR>Si deseas que tu subasta siga el sistema de incremento establecido, pon en este campo cero.";
$MSG_724 = "Localidad y env&iacute;o";
$MSG_725 = "La localidad del vendedor (su localidad)";
$MSG_726 = "C&oacute;digo postal";
$MSG_727 = "El actual c&oacute;digo postal del vendedor (tu c&oacute;digo postal)";
$MSG_728 = "Gastos de env&iacute;o";
$MSG_729 = "1 significa <B>Los compradores pagar&aacute;n los gastos de env&iacute;o</B><BR>2 significa <B>El vendedor paga los gastos de env&iacute;o</B>";
$MSG_730 = "Venta";
$MSG_731 = "Si vas a enviar o no el art&iacute;culo al extranjero.<BR>
            1 significa <B>si</B><BR>2 significa <B>no</B>";
$MSG_733 = "Cu&aacute;ntos art&iacute;culos vas a vender (normalmente 1 para subastas standard, otro valor para subastas Dutch)";
$MSG_734 = "<A HREF=\"Javascript:window_open('bulkschema.php','bulkschema',400,500,20,20)\">Categor&iacute;as</A>";
$MSG_737 = "&iexcl;Env&iacute;o realizado!<br>Ahora ve a <A HREF=yourauctions_b.php>Tus subastas</a> para editar las subastas enviadas.";
$MSG_738 = "Precio m&iacute;nimo";
$MSG_739 = "El precio en el que la puja comenzar&aacute;";
$MSG_740 = "Para obtener un ID correcto de categor&iacute;as o subcategor&iacute;as, selecciona todas las categor&iacute;as del men&uacute;. Busca la categor&iacute;a deseada, si mantienes el cursor
	del rat&oacute;n sobre ella ver&aacute;s el ID de la categor&iacute;a. El n&uacute;mero mostrado es el ID de la subcategor&iacute;a, que necesitas escribir en el archivo de texto que enviar&aacute;s.";
$MSG_741 = "Subastas enviadas";
$MSG_901 = "N&uacute;mero de art&iacute;culos";
$MSG_904 = "Esta subasta ha finalizado";
$MSG_905 = "Comprueba esta subasta";
$MSG_906 = "Tu puja ya no es la ganadora";
$MSG_907 = "- Informaci&oacute;n del ganador";
$MSG_908 = "- No hay ganador";
$MSG_909 = "Subasta finalizada - Tu ganas!";
$MSG_910 = "No existen subastas de este usuario.";
$MSG_911 = "Finalizada";
$MSG_912 = "Administraci&oacute;n de ayuda";
$MSG_913 = "temas encontrados en la base de datos";
$MSG_914 = "Tema";
$MSG_915 = "Texto";
$MSG_916 = "Administraci&oacute;n de temas de ayuda";
$MSG_917 = "A&ntilde;adir tema de ayuda";
$MSG_918 = "Otros temas de ayuda:";
$MSG_919 = "Ayuda general";

#// Added by Simokas 10.03.2002
$MSG_920 = "&iquest;Activar comprar?";
$MSG_921 = "Si activas esta opci&oacute;n, los usuarios podr&aacute;n comprar el art&iacute;culo en ese mismo instante, si a&uacute;n no
	hay pujas por el mismo. Esta opci&oacute;n debe ser activada por el vendedor en el momento de crear la subasta.";
$MSG_922 = "E-mail al vendedor";
$MSG_923 = "Ubicaci&oacute;n del vendedor";
$MSG_1000 = "Claves de b&uacute;squeda o n&uacute;mero de la subasta";
$MSG_1001 = "Buscar en t&iacute;tulo <B>y</B> Descripci&oacute;n";
$MSG_1002 = "Buscar en categor&iacute;as";
$MSG_1003 = "Rango de precio";
$MSG_1004 = "Entre";
$MSG_1005 = "  y ";
$MSG_1006 = "Opciones de pago";
$MSG_1008 = "Pa&iacute;s";
$MSG_1009 = "Finalizar&aacute; en";
$MSG_1010 = "Hoy";
$MSG_1011 = "Ma&ntilde;ana";
$MSG_1012 = "en 3 D&iacute;as";
$MSG_1013 = "en 5 D&iacute;as";
$MSG_1014 = "Ordenar por";
$MSG_1015 = "Art&iacute;culos acaban primero";
$MSG_1016 = "Art&iacute;culos nuevos primero";
$MSG_1017 = "Precio M&aacute;s bajo primero";
$MSG_1018 = "Precio M&aacute;s alto primero";
$MSG_1020 = "Subasta de varios art&iacute;culos";
$MSG_1021 = "Subasta de un art&iacute;culo";

#// Mary added on March 12, 2002 for thanks,php and cancel.php
$MSG_1022 = "Pago realizado.  Si tienes alg&uacute;n problema o pregunta, por favor contacta con ";
$MSG_1023 = "Soporte";
$MSG_1024 = "Gracias por hacer negocios con nosotros";
$MSG_1025 = "Tu transacci&oacute;n no se ha realizado. No se te cobrar&aacute; nada. Si no deseas cancelar tu pago, o si has recibido esta p&aacute;gina por error, por favor contacta con ";

#// Gian - May 29, 2002
$MSG_1028 = "RE-SYNC CONTADORES";
$MSG_1029 = "&iquest;Est&aacute;s seguro de actualizar los contadores?";
$MSG_1030 = "Utilidad de sincronizaci&oacute;n de contadores";
$MSG_1031 = "Comenzando actualizaci&oacute;n de contadores...";

#// GIAN - sept. 12 2002
$MSG_1050 = "Soporte SSL";
$MSG_1051 = "&iquest;Activar soporte para SSL?";
$MSG_1052 = "URL de HTTPS";
$MSG_1053 = "El servidor seguro que uses puede estar bajo oro dominio o servidor. Por favor especif&iacute;calo a continuaci&oacute;n.";
$MSG_1054 = "Variables de SSL";
$MSG_1055 = "[<A HREF=\"javascript:window_open('httpshelp.php','https',400,500,30,30)\" CLASS=\"links\">Leer M&aacute;s</A>]";
$MSG_1056 = "Alineaci&oacute;n";
$MSG_1057 = "Esta es la alineaci&oacute;n de las p&aacute;ginas de WeBid en tu ventana del navegador.";



#// Added for WeBid
$MSG_5000 = "Disposici&oacute;n de la p&aacute;gina inicial";
$MSG_5001 = "Fuentes";
$MSG_5002 = "Colores";
$MSG_5003 = "Variables de la p&aacute;gina";
$MSG_5004 = "Variables del s&iacute;mbolo de moneda";
$MSG_5005 = "Variables de disposici&oacute;n general";
$MSG_5006 = "Variables de galer&iacute;a de im&aacute;genes actualizadas";
$MSG_5007 = "Variables PayPal actualizadas";
$MSG_5008 = "S&iacute;mbolo de moneda del sistema";
$MSG_5009 = "Otros s&iacute;mbolos de moneda";
$MSG_5010 = "Convertidor de moneda";
$MSG_5011 = "Art&iacute;culos destacados en la p&aacute;gina de inicio";
$MSG_5012 = "Este es el n&uacute;mero de art&iacute;culos destacados que se mostrar&aacute; en la p&aacute;gina principal (NOTA: SOLO los art&iacute;culos <B>destacados</B> ser&aacute;n mostrados).<BR>0
(cero) est&aacute; permitido.";
$MSG_5013 = "Ultimos art&iacute;culos creados";
$MSG_5014 = "Este es el n&uacute;mero de los art&iacute;culos M&aacute;s recientes que se mostrar&aacute;n en la p&aacute;gina inicial.<BR>0
(cero) est&aacute; permitido.";
$MSG_5015 = "Mayores Pujas";
$MSG_5016 = "Este es el n&uacute;mero de art&iacute;culos que se mostrar&aacute;n en la lista de mayores pujas dentro de la p&aacute;gina principal.<BR>0 (cero) est&aacute; permitido.";
$MSG_5017 = "Finalizar&aacute; pronto";
$MSG_5018 = "Este es el n&uacute;mero de art&iacute;culos que se mostrar&aacute;n en la lista de Finalizar&aacute;n pronto dentro de la p&aacute;gina principal.<BR>0 (cero) est&aacute; permitido.";
$MSG_5019 = "Variables de disposici&oacute;n general actualizadas";
$MSG_5020 = "Variables de fuentes actualizadas";
$MSG_5021 = "Variables de color actualizadas";
$MSG_5022 = "BUSQUEDA DE USUARIOS";
$MSG_5023 = "Buscar &gt;&gt;";
$MSG_5024 = "Nombre, apodo o e-mail";
$MSG_5025 = "Cuenta";
$MSG_5026 = "A&ntilde;adir cr&eacute;ditos";
$MSG_5027 = "Cambiar cr&eacute;ditos";
$MSG_5028 = "Acci&oacute;n";
$MSG_5029 = "IR >>";
$MSG_5030 = "FOROS";
$MSG_5031 = "Nuevo Foro";
$MSG_5032 = "Administraci&oacute;n de Foros";
$MSG_5033 = "LISTA DE FOROS";
$MSG_5034 = "T&iacute;tulo del Foro";
$MSG_5035 = "Mensajes a mostrar";
$MSG_5036 = "Este es el n&uacute;mero de mensajes M&aacute;s recientes que se mostrar&aacute;n en el foro.";
$MSG_5037 = "Crearlo como";
$MSG_5038 = "Activo";
$MSG_5039 = "Inactivo";
$MSG_5040 = "NOTA: Borrando un mensaje del foro se borrar&aacute;n todos los mensajes asociados";
$MSG_5043 = "# MSJ";
$MSG_5044 = "ULT MSJ";
$MSG_5046 = "MOSTRAR";
$MSG_5047 = "Variables de Foro";
$MSG_5048 = "&iquest;Activar el servicio de Foros?";
$MSG_5049 = "&iquest;Mostrar enlace al Foro?";
$MSG_5050 = "Seleccionando <B>si</B> mostraras un enlace al sistema de foros en la cabecera y en el pie de tu p&aacute;gina.";
$MSG_5051 = "Variables de foro actualizadas";
$MSG_5052 = "Editar Foro";
$MSG_5053 = "&uacute;ltimo mensaje";
$MSG_5054 = "El Foro est&aacute;";
$MSG_5056 = "No est&aacute;s identificado.<BR>Si env&iacute;as un mensaje ser&aacute; enviado como <B><I>Usuario Desconocido</I></B>.";
$MSG_5057 = "Enviar Mensaje";
$MSG_5058 = "Volver a los Foros";
$MSG_5059 = "Mensajes";
$MSG_5060 = "Enviado por ";
$MSG_5061 = "Usuario desconocido";
$MSG_5062 = "Ver todos los mensajes";
$MSG_5063 = "Ver/Editar mensajes";
$MSG_5064 = "Volver al Foro";
$MSG_5065 = "Borrar todos los mensajes M&aacute;s antiguos de";
$MSG_5067 = "Actualizar contadores ";
$MSG_5068 = "Filtro de palabras";
$MSG_5069 = "El filtro de palabras te da la posibilidad de que no se muestren palabras no deseadas:
<UL>
<LI>TITULO y DESCRIPCI&oacute;N de subastas.
<LI>Mensajes enviados en los Foros";
$MSG_5070 = "&iquest;Activar filtro de palabras?";
$MSG_5071 = "Lista de palabras no deseadas";
$MSG_5072 = "Escribe las palabras no deseadas una por l&iacute;nea (M&aacute;x. 255 caracteres por l&iacute;nea). Ten presente que cada l&iacute;nea es corresponde a \"una palabra\".";
$MSG_5073 = "Variables de filtro de palabras actualizadas";
$MSG_5074 = "p&aacute;gina de Sobre nosotros";
$MSG_5075 = "p&aacute;gina de T&eacute;rminos y Condiciones";
$MSG_5076 = "Activa esta opci&oacute;n si quieres un enlace a <U>Sobre nosotros</U> en el pie de tus p&aacute;ginas.";
$MSG_5077 = "&iquest;Activar p&aacute;gina Sobre nosotros?";
$MSG_5078 = "Contenido de la p&aacute;gina de Sobre nosotros<BR>(HTML permitido)";
$MSG_5079 = "Variables de p&aacute;gina de Sobre nosotros actualizadas";
$MSG_5080 = "Nota: cada caracter de nueva l&iacute;nea ser&aacute; convertido al comando HTML <B>&lt;BR&gt;</B>.";
$MSG_5081 = "Activa esta opci&oacute;n si quieres un enlace a <U>T&eacute;rminos y Condiciones</U> en el pie de tus p&aacute;ginas.";
$MSG_5082 = "&iquest;Activar la p&aacute;gina de T&eacute;rminos y Condiciones?";
$MSG_5083 = "Contenido de la p&aacute;gina de T&eacute;rminos y Condiciones<BR>(HTML Permitido)";
$MSG_5084 = "Variables de la p&aacute;gina de T&eacute;rminos y Condiciones actualizadas";
$MSG_5085 = "Sobre nosotros";
$MSG_5086 = "T&eacute;rminos y Condiciones";
$MSG_5088 = "Opciones de art&iacute;culos destacados en la p&aacute;gina de inicio";
$MSG_5089 = "Art&iacute;culos destacados de la p&aacute;gina de inicio";
$MSG_5090 = "Art&iacute;culos remarcados";
$MSG_5091 = "Art&iacute;culos en negrita";
$MSG_5092 = "B&uacute;squeda de subastas";
$MSG_5093 = "T&iacute;tulo, Descripci&oacute;n";
$MSG_5094 = "Ver&nbsp;subastas";
$MSG_5095 = "Volver a la lista de usuarios &gt;&gt;";
$MSG_5096 = "Activa esta opci&oacute;n de si deseas que tus vendedores puedan crear subastas <B><I>destacadas en la p&aacute;gina de inicio</I></B>.<BR>
Este tipo de subastas rota aleatoriamente en la p&aacute;gina principal de acuerdo con <A HREF=homepage.php>las variables de disposici&oacute;n general</A>.<BR>
No olvides marcar <A HREF=featuredfee.php>una tasa</A> para esta opci&oacute;n.";
$MSG_5097 = "Activa esta opci&oacute;n de si deseas que tus vendedores puedan crear subastas <B><I>remarcados</I></B>.<BR>
El t&iacute;tulo de los art&iacute;culos remarcados siempre aparece en negrita (p.ej: cuando navegas por las categor&iacute;as).<BR>
No olvides marcar <A HREF=boldfee.php>una tasa</A> para esta opci&oacute;n.";
$MSG_5098 = "Activa esta opci&oacute;n de si deseas que tus vendedores puedan crear subastas <B><I>especiales</I></B>.<BR>
El t&iacute;tulo de los art&iacute;culos en negrita siempre aparece en con un fondo de color (p.ej: cuando navegas por las categor&iacute;as).<BR>
No olvides marcar <A HREF=highlightedfee.php>una tasa</A> para esta opci&oacute;n.";
$MSG_5099 = "&iquest;Activar art&iacute;culos destacados en la p&aacute;gina de inicio?";
$MSG_5100 = "Variables de art&iacute;culos destacados en la p&aacute;gina de inicio actualizadas";
$MSG_5101 = "Variables de art&iacute;culos remarcados actualizadas";
$MSG_5102 = "Variables de art&iacute;culos en negrita actualizadas";
$MSG_5103 = "&iquest;Activar art&iacute;culos remarcados?";
$MSG_5104 = "&iquest;Activar art&iacute;culos en negrita?";
$MSG_5105 = "Otras tasas";
$MSG_5108 = "La opci&oacute;n de art&iacute;culos destacados en la p&aacute;gina de inicio est&aacute;: ";
$MSG_5109 = "La opci&oacute;n de art&iacute;culos remarcados est&aacute;: ";
$MSG_5110 = "La opci&oacute;n de art&iacute;culos en negrita est&aacute;: ";
$MSG_5111 = "ON";
$MSG_5112 = "OFF";
$MSG_5113 = "Cambiar";
$MSG_5115 = "d&iacute;as";
$MSG_5116 = "Env&iacute;o de varias subastas";
$MSG_5117 = "p&aacute;gina";
$MSG_5118 = "de";
$MSG_5119 = "&lt;&lt;Anterior";
$MSG_5120 = "Siguiente&gt;&gt;";
$MSG_5121 = "Para incrementar la visibilidad de tus subastas tienes las siguientes opciones:";
$MSG_5122 = "Art&iacute;culos destacados en la p&aacute;gina de inicio";
$MSG_5123 = "Art&iacute;culos en negrita";
$MSG_5124 = "Art&iacute;culos remarcados";
$MSG_5125 = "Tu subasta ha sido recibida correctamente.<BR>
Para activarla, por favor procede a pagar la tasa mostrada a continuaci&oacute;n";
$MSG_5126 = "Tu art&iacute;culo aparecer&aacute; de forma aleatoria en la p&aacute;gina de inicio.";
$MSG_5127 = "Tu art&iacute;culo aparecer&aacute; siempre con el fondo de color.";
$MSG_5128 = "El t&iacute;tulo de tu art&iacute;culo aparacer&aacute; siempre en negrita.";
$MSG_5129 = "Precio: ";
$MSG_5130 = "Has seleccionado las siguientes opciones:";
$MSG_5131 = " % del precio del art&iacute;culo";
$MSG_5132 = "Total";
$MSG_5133 = "Resumen de tasas";
$MSG_5134 = "Tasa de galer&iacute;a de im&aacute;genes";
$MSG_5135 = "Tu subasta ha sido recibida correctamente.<BR>Para activarla, por favor procede a pagar la tasa mostrada a continuaci&oacute;n.";
$MSG_5138 = "Nota: puedes usar el s&iacute;mbolo de moneda que creas oportuno en toda la p&aacute;gina.<BR>
Todas las cantidades que los usuarios tengan que pagar en PayPal ser&aacute;n reconvertidas a d&oacute;lares USA usando el cambio actualizado del d&iacute;a de hoy.";
$MSG_5139 = "Administraci&oacute;n de subastas";
$MSG_5140 = "Administraci&oacute;n de cuentas";
$MSG_5141 = "Estad&iacute;sticas de acceso";
$MSG_5142 = "Variables";
$MSG_5143 = "Ver estad&iacute;sticas de acceso";
$MSG_5144 = "Por favor, elige a continuaci&oacute;n si deseas que WeBid cree estad&iacute;sticas de acceso.";
$MSG_5145 = "Generar estad&iacute;sticas de acceso de usuarios";
$MSG_5146 = "Generar estad&iacute;sticas de navegadores y plataformas";
$MSG_5147 = "Generar estad&iacute;sticas de acceso de dominios<BR>
<B>Nota: WeBid usa la funci&oacute;n PHP <FONT FACE=Courier SIZE=2>gethostbyaddr()</FONT>. En algunos test de carga de servidor la carga ha subido al activar esta opci&oacute;n.</B>";
$MSG_5148 = "Variables de estad&iacute;sticas actualizadas.";
$MSG_5149 = "&iquest;Activar estad&iacute;sticas?";
$MSG_5150 = "Selecciona el tipo de estad&iacute;sticas que quieres generar";
$MSG_5151 = "WeBid reconoce lo siguiente:&nbsp;&nbsp;";
$MSG_5152 = "<A HREF=\"javascript:window_open('ST_browsers.html','ST_browsers',400,500,30,30)\" CLASS=\"links\">Navegadores</A>";
$MSG_5153 = "<A HREF=\"javascript:window_open('ST_platforms.html','ST_platforms',400,500,30,30)\" CLASS=\"links\">Plataformas (SO)</A>";
$MSG_5154 = "<A HREF=\"javascript:window_open('ST_countries.php','ST_domains',400,500,30,30)\" CLASS=\"links\">Dominios</A>";
$MSG_5155 = "Navegadores";
$MSG_5156 = "Plataformas";
$MSG_5157 = "Dominios";
$MSG_5158 = "Estad&iacute;sticas de acceso de ";
$MSG_5159 = "D&iacute;a";
$MSG_5160 = "Ver historial";
$MSG_5161 = "p&aacute;ginas vistas";
$MSG_5162 = "Visitantes &uacute;nicos";
$MSG_5163 = "Sesiones de usuario";
$MSG_5164 = "Totales";
$MSG_5165 = "Ver estad&iacute;sticas de navegador";
$MSG_5166 = "Ver estad&iacute;sticas de dominio";
$MSG_5167 = "Estad&iacute;sticas de navegador de ";
$MSG_5168 = "Estad&iacute;sticas de dominio de ";
$MSG_5169 = "Navegador";
$MSG_5170 = "Dominio";
$MSG_5171 = "Lista de usuarios invitados";
$MSG_5172 = "Lista de usuarios excluidos";
$MSG_5173 = "Crear nueva lista";
$MSG_5174 = "Nombre de lista";
$MSG_5175 = "Miembros";
$MSG_5176 = "Borrar las listas seleccionadas";
$MSG_5177 = "Crear &gt;&gt;";
$MSG_5178 = "A&ntilde;adir usuario (nick)";
$MSG_5179 = "Buscar usuarios";
$MSG_5180 = "Usuario";
$MSG_5181 = "A&ntilde;adir &gt;&gt;";
$MSG_5182 = "Buscar usuario (nick, nombre o e-mail)";
$MSG_5183 = "usuarios encontrados";
$MSG_5184 = "SELECCIONA";
$MSG_5185 = "Nick";
$MSG_5187 = "Editar contenido de la lista: ";
$MSG_5188 = "Eliminar usuarios seleccionados";
$MSG_5189 = "Enviar subasta";
$MSG_5190 = "Borrar campos";
$MSG_5191 = "Lista de usuarios invitados y Lista de usuarios excluidos";
$MSG_5192 = "Crear una subasta como <B>privada</B>: s&oacute;lo los usuarios de la lista de invitados podr&aacute;n acceder a la subasta y hacer una puja.<br>
Si no seleccionas esta opci&oacute;n tu subasta ser&aacute; p&uacute;blica (visible para todos los usuarios) pero s&oacute;lo los usuarios invitados podr&aacute;n pujar.";
$MSG_5193 = "Enviar invitaci&oacute;n a usuarios a trav&eacute;s de e-mail";
$MSG_5194 = "Subasta privada: ";
$MSG_5195 = "Enviar invitaci&oacute;n a usuarios a trav&eacute;s de e-mail: ";
$MSG_5196 = "Has sido invitado a una subasta privada";
$MSG_5197 = "Subastas de invitados";
$MSG_5199 = "Enviar puja";
$MSG_5200 = "Enviar Pregunta";
$MSG_5201 = "Enviar mensaje";
$MSG_5202 = "A&ntilde;adir a art&iacute;culos en la mira";
$MSG_5204 = "Insertar";
$MSG_5205 = "Activar/Desactivar soporte WAP";
$MSG_5206 = "Variables de WAP";
$MSG_5207 = "Activando el soporte para <A HREF=http://www.wapforum.org/what/index.htm target=_BLANK>WAP</A> en tu p&aacute;gina dar&aacute;s la posibilidad a los usuarios de navegar por las subastas y por las categor&iacute;as<BR>
realizar pujas a trav&eacute;s de WAP no es posible.";
$MSG_5208 = "&iquest;Activar soporte WAP?";
$MSG_5209 = "Variables de WAP actualizadas";
$MSG_5210 = "Hasta que no muevas el directorio <B>wap</B> hasta el directorio de instalaci&oacute;n de WeBid, la URL de acceso a tu web v&iacute;a WAP ser&aacute; <FONT FACE=Courier SIZE=2>http://yourdomain.com/yourWeBid/wap/</FONT>.
<BR>Nota: Necesita la barra al final.";
$MSG_5211 = "WAP URL";
$MSG_5212 = "Variables de p&aacute;gina de inicio";
$MSG_5213 = "Logo";
$MSG_5214 = "Mensaje de bienvenida";
$MSG_5216 = "&iquest;Activar?";
$MSG_5217 = "Activar el manejo de errores es muy recomendable. En caso de errores en rutinas WAP, un e-mail ser&aacute;
enviado al administrador (la direcci&oacute;n de e-mail es la que especificaste en las <A HREF=settings.php>Variables generales</A>).";
$MSG_5218 = "El logo que has subido aparcera en la p&aacute;gina web Adem&aacute;s del mensaje de bienvenida.<BR>
NOTA: la imagen que env&iacute;es debe ser en formato WBMP.";
$MSG_5219 = "Logo actual: ";
$MSG_5220 = "Max. 255 caract.";
$MSG_5221 = "Fondo de art&iacute;culos en negrita";
$MSG_5222 = "<B>NOTA: Los art&iacute;culos destacados son mostrados en la p&aacute;gina de inicio, en filas de dos art&iacute;culos, pero este n&uacute;mero puede ser cualquier otro.</B>";
$MSG_5223 = "Tama&ntilde;o de miniaturas (el mejor es 195 pixels o menos)";
$MSG_5224 = "pixels";
$MSG_5225 = "Subastas destacadas de la pagina de inicio";
$MSG_5226 = "Ver subastas finalizadas";
$MSG_5227 = "Ver subastas suspendidas";
$MSG_5228 = "&iquest;Mostrar logo de la p&aacute;gina de inicio?";
$MSG_5229 = "Administraci&oacute;n de FAQs";
$MSG_5230 = "Categor&iacute;as de FAQs";
$MSG_5231 = "Nueva FAQ";
$MSG_5232 = "Administrar FAQs";
$MSG_5233 = "OTROS CONTENIDOS";
$MSG_5234 = "Insertar nueva categor&iacute;a";
$MSG_5235 = "<B>Nota</B>: s&oacute;lo las categor&iacute;as sin FAQs pueden ser eliminadas.";
$MSG_5237 = "CAT. ID";
$MSG_5238 = "Categor&iacute;a de FAQ's ";
$MSG_5239 = "Pregunta";
$MSG_5240 = "Respuesta<BR>(HTML permitido)";
$MSG_5241 = "Editar FAQ";
$MSG_5243 = "Indice de ayuda";
$MSG_5244 = "Administraci&oacute;n de subastas";
$MSG_5245 = "Arriba";
$MSG_5248 = "Variables de factura";
$MSG_5249 = "Facturas enviadas";
$MSG_5250 = "Archivar facturas";
$MSG_5251 = "Enviar facturas";
$MSG_5252 = "Variables de facturas actualizadas";
$MSG_5253 = "Porcentaje de Tasas";
$MSG_5254 = "Si necesitas aplicar las tasas de tu pa&iacute;s en las facturas que env&iacute;es, establ&eacute;celo a continuaci&oacute;n. Ser&aacute; aplicado a cada factura que env&iacute;es.<BR><B>Escribe 0 (cero) si no necesitas aplicar ning&uacute;n impuesto.</B>";
$MSG_5256 = "Tasa de inicio de subasta para el vendedor";
$MSG_5257 = "Tasa de finalizaci&oacute;n de subasta para el vendedor";
$MSG_5258 = "Tasa de finalizaci&oacute;n de subasta para el comprador";
$MSG_5260 = "Tasa de art&iacute;culos destacados en la p&aacute;gina de inicio";
$MSG_5261 = "Tasa de art&iacute;culos remarcados";
$MSG_5262 = "Tasa de art&iacute;culos en negrita";
$MSG_5263 = "&iquest;Activar soporte para facturas?";
$MSG_5265 = "Hay ";
$MSG_5266 = " factura(s) pendientes de enviar.<BR><BR>Por favor haz click en el bot&oacute;n <B>Enviar ahora &gt;&gt;</B> para enviarlas.<BR>Este proceso puede durar unos segundos, por favor espera hasta recibir el mensaje de confirmaci&oacute;n. ";
$MSG_5267 = "Enviar ahora &gt;&gt; ";
$MSG_5268 = "Variables de registro de usuario";
$MSG_5269 = "Tienes la posibilidad de solicitar durante el proceso de registro a tus usuarios la informaci&oacute;n de la tarjeta de cr&eacute;dito.<BR>
Esta es una opci&oacute;n adicional que puedes incorporar. La informaci&oacute;n de la tarjeta de cr&eacute;dito no ser&aacute; comprobada, tan s&oacute;lo un algoritmo de validaci&oacute;n ser&aacute; aplicado.
<BR><B>Nota:</B> Esta opci&oacute;n s&oacute;lo estar&aacute; disponible si el <A HREF=https.php>soporte SSL</a> est&aacute; activado.<BR><BR>Ahora mismo el soporte SSL est&aacute;:";
$MSG_5270 = "&iquest;Solicitar a los usuarios informaci&oacute;n de la tarjeta de cr&eacute;dito?";
$MSG_5271 = "Variables de registro de usuario actualizadas";
$MSG_5272 = "Informaci&oacute;n de tu tarjeta de cr&eacute;dito";
$MSG_5273 = "Por favor escribe los datos de tu tarjeta de cr&eacute;dito a continuaci&oacute;n.<BR>Un n&uacute;mero de tarjeta de cr&eacute;dito v&aacute;lido es necesario y nunca ser&aacute; usado para cargar con tasas al usuario.";
$MSG_5274 = "<FONT COLOR=red><B>Activado</B></FONT>";
$MSG_5275 = "<FONT COLOR=red><B>Desactivado</B></FONT>";
$MSG_5276 = "Eliminar mensaje";
$MSG_5277 = "Volver a la lista de mensajes";
$MSG_5278 = "Editar mensaje";
$MSG_5279 = "Volver a la lista de mensajes";
$MSG_5280 = "A&ntilde;os/Meses";
$MSG_5281 = "Informe hist&oacute;rico";
$MSG_5282 = "Ver mes actual";
$MSG_5283 = "Editar categor&iacute;a de FAQs";
$MSG_5284 = "Nombre de Categor&iacute;a";
$MSG_5285 = "N&uacute;mero de tarjeta de cr&eacute;dito";
$MSG_5286 = "Fecha de Expiraci&oacute;n";
$MSG_5287 = "Titular";
$MSG_5288 = "mm/aa";
$MSG_5289 = "CC";
$MSG_5291 = "Usuarios activos";
$MSG_5292 = "Cuenta no confirmada";
$MSG_5293 = "Tasa de registro no pagada";
$MSG_5294 = "Suspendido por el Administrador";
$MSG_5295 = "Ver";
$MSG_5296 = "Todos los usuarios";
$MSG_5297 = "Informaci&oacute;n de tarjeta de cr&eacute;dito de usuario";
$MSG_5298 = "Https debe estar activado para solicitar <BR>la informaci&oacute;n de la tarjeta de cr&eacute;dito.";
$MSG_5299 = "Limitar env&iacute;o a";
$MSG_5300 = " mensajes enviados.";
$MSG_5301 = "C&oacute;digo Postal de Tarjeta";

#// -----------------------------------------------
$MSG_5303 = "Tasas";
$MSG_5304 = "Total final";
$MSG_5305 = "Factura enviada";
$MSG_5306 = "Facturas enviadas";
$MSG_5307 = "Factura #";
$MSG_5309 = "Cliente";
$MSG_5311 = "Facturas en la Base de Datos";
$MSG_5312 = "Detalles de factura";
$MSG_5315 = "Exportar a texto";
$MSG_5316 = "Volver a facturas &gt;&gt;";
$MSG_5318 = "Ver estad&iacute;sticas por plataforma";
$MSG_5319 = "Copia de factura al Admin";
$MSG_5320 = "Selecciona <B>Si</B> si deseas enviar una copia de cada factura a la direcci&oacute;n de e-mail del Administrador";
$MSG_5321 = "Puedes mejorar la presentaci&oacute;n de tus facturas modificando los siguientes archivos:<UL>
<LI>includes/invoice_header_text.inc.txt
<LI>includes/invoice_footer_text.inc.txt
</UL>
Que son la cabecera y el pie de cada una de tus facturas.
";
$MSG_5322 = "Pa&iacute;s por defecto";
$MSG_5321 = "Puedes seleccionar un pa&iacute;s por defecto para tu sitio.<BR>Se mostrar&aacute; autom&aacute;ticamente como primer pa&iacute;s de la lista en toda la p&aacute;gina.";
$MSG_5323 = "Pa&iacute;s por defecto actualizado";
$MSG_5324 = "Art&iacute;culos destacados en su categor&iacute;a";
$MSG_5325 = "Activa esta opci&oacute;n si deseas que tus usuarios puedan crear sus subastas como <B><I>Categor&iacute;a de destacados</I></B>.<BR>
Las subastas destacadas en su categor&iacute;a salen de forma aleatoria al navegar en las categor&iacute;as, siguiendo las variables de <A HREF=homepage.php>Dise&ntilde;o General</A>.<BR>
No olvides establecer <A HREF=categoryfeaturedfee.php>una tasa</A> para esta opci&oacute;n.";
$MSG_5326 = "&iquest;Activar art&iacute;culos destacados en su categor&iacute;a?";
$MSG_5327 = "Destacados en su categor&iacute;a";
$MSG_5328 = "Variables de categor&iacute;a de art&iacute;culos destacadas actualizadas";
$MSG_5329 = "Este es el n&uacute;mero de art&iacute;culos destacados que se mostrar&aacute;n en la p&aacute;gina de categor&iacute;as (NOTA: SOLO los art&iacute;culos <B>destacados</B> ser&aacute;n mostrados).<BR>0
(cero) est&aacute; permitido.";
$MSG_5330 = "<B>NOTA: Los art&iacute;culos de la destacados en su categor&iacute;a es mostrada en la p&aacute;gina de inicio, en filas de cuatro art&iacute;culos, por lo que el n&uacute;mero a mostrar puede ser cualquiera.</B>";
$MSG_5331 = "Tasa de art&iacute;culos destacados en su categor&iacute;a";
$MSG_5332 = "La opci&oacute;n de art&iacute;culos destacados en su categor&iacute;a est&aacute;: ";
$MSG_5333 = "Tasa de art&iacute;culos destacados en su categor&iacute;a actualiza";
$MSG_5334 = "Tasa de art&iacute;culos destacados en su categor&iacute;a en la p&aacute;gina de inicio actualizadas";
$MSG_5335 = "Tasa de art&iacute;culos remarcados actualizada";
$MSG_5336 = "Tasa de art&iacute;culos en negrita actualizada";
$MSG_5337 = "Art&iacute;culos destacados en su categor&iacute;a";
$MSG_5338 = "Tus art&iacute;culos aparecer&aacute;n destacados de forma aleatoria en las p&aacute;gina de categor&iacute;as";
$MSG_5339 = "WeBid est&aacute; ejecut&aacute;ndose en:";
$MSG_5340 = "MODO DE PRUEBA";
$MSG_5341 = "MODO ONLINE";
$MSG_5342 = "Art&iacute;culos destacados";
$MSG_5343 = "Comprobaci&oacute;n de Sistema";
$MSG_5344 = "MySQL";
$MSG_5346 = "Crear archivos configuraci&oacute;n.";
$MSG_5347 = "Creando DB";
$MSG_5348 = "Comprobaci&oacute;n de sistema finalizada.";
$MSG_5349 = "Continuar &gt;&gt;";
$MSG_5350 = "Sistemas operativos";
$MSG_5351 = "Comprobar archivos";
$MSG_5352 = "Comprobar directorios";
$MSG_5353 = "Obteniendo ruta";
$MSG_5356 = "Creando comprobaciones de instalaci&oacute;n...";
$MSG_5357 = "&iexcl;Error!";
$MSG_5358 = "Crear una nueva Base de Datos";
$MSG_5359 = "Usar una Base de Datos existente";
$MSG_5360 = "Tipo de Base de datos";
$MSG_5361 = "Host de MySQL";
$MSG_5362 = "Nombre de Base de Datos";
$MSG_5363 = "Nombre de Usuario de MySQL";
$MSG_5364 = "Contrase&ntilde;a de MySQL";
$MSG_5365 = "Ruta de include";
$MSG_5366 = "Esta debe ser la ruta absoluta del directorio <B>includes</B>.<BR>
Si no has cambiado el directorio <B>includes</B> a otro nombre, no cambies el valor mostrado.";
$MSG_5367 = "Directorio Upload";
$MSG_5368 = "Esta debe ser la ruta absoluta del directorio <B>uploaded</B>.<BR>
Si no has cambiado el directorio <B>uploaded</B> a otro nombre, no cambies el valor mostrado.";
$MSG_5369 = "Esta debe ser la ruta relativa desde (desde tu directorio principal de instalaci&oacute;n) a tu directorio <B>uploaded</B>.<BR>
Si no has cambiado el directorio <B>uploaded</B> a otro nombre, no cambies el valor mostrado.";
$MSG_5370 = "Tama&ntilde;o M&aacute;ximo de Upload";
$MSG_5371 = "Este es el tama&ntilde;o M&aacute;ximo de las im&aacute;genes que se pueden enviar al servidor.";
$MSG_5372 = "Prefijo MD5";
$MSG_5373 = "Escribe un valor aleatorio aqu&iacute;.<BR> Ser&aacute; usado para dificultar la desencriptaci&oacute;n de las contrase&ntilde;as.";
$MSG_5374 = "&iquest;Activar MODO DE PRUEBA?";
$MSG_5375 = "Ejecutar WeBid en modo de prueba activar&aacute; el <B>Simulador PayPal de WeBid</B>, te dar&aacute; la posibilidad de comprobar el funcionamiento de PayPal en tu sistema.<BR>
El modo de prueba puede ponerse ON/OFF desde la zona de administraci&oacute;n cuando sea necesario.";
$MSG_5376 = "Procesando archivos de configuraci&oacute;n";
$MSG_5377 = "Variables escritas en includes/config.inc.php";
$MSG_5378 = "Variables de MySQL escritas en includes/passwd.inc.php";
$MSG_5379 = ": base de datos creada";
$MSG_5380 = "Tablas de la base de datos creada";
$MSG_5381 = "Instalaci&oacute;n de WeBid completada.<BR>
Ahora puedes acceder a la <A HREF=login.php>Zona de Administraci&oacute;n</A> para configurar el sistema.";
$MSG_5382 = "MENSAJES DE E-MAIL";
$MSG_5383 = "Mensajes de confirmaci&oacute;n de registro";
$MSG_5384 = "Mensajes de confirmaci&oacute;n de subasta";
$MSG_5385 = "Finalizaci&oacute;n de subasta (vendedor)";
$MSG_5386 = "Finalizaci&oacute;n de subasta (ganador)";
$MSG_5387 = "Hay tres tipos de <B>mensajes de confirmaci&oacute;n</B> que WeBid env&iacute;a, dependiendo de <A HREF=admin.php?S=fees>variables de tasas</A>:
<UL>
<LI>Sin tasa de registro
<LI>Tasa de registro establecida en modo <B>pago</B>
<LI>Tasa de registro establecida en modo <B>prepago</B>
</UL>
Puedes configurar el mensaje que se env&iacute;a a continuaci&oacute;n. Por favor ten presente que puedes usar comandos especiales:
usa la lista de <B>comandos</B> haciendo click en el <IMG SRC=images/tagstool.gif ALIGN=MIDDLE> icono cercano a cada l&iacute;nea de texto.<BR>";
$MSG_5388 = "Comandos posibles";
$MSG_5389 = "Comando";
$MSG_5391 = "Seleccionar";
$MSG_5392 = "Puedes usar los comandos siguientes en tus mensajes de texto:";
$MSG_5393 = "Tasa no establecida";
$MSG_5394 = "Tasa establecida - Modo Pago";
$MSG_5395 = "Tasa establecida - Modo Prepago";
$MSG_5396 = "&iexcl;Atenci&oacute;n!";
$MSG_5397 = "Variables de e-mails";
$MSG_5398 = "Mensajes de e-mail de tasa de registro";
$MSG_5399 = "Hay dos tipos de <B>mensjes de confirmaci&oacute;n de subasta</B> que WeBid env&iacute;a:
<UL>
<LI><B>Confirmaci&oacute;n de Subasta</B>: confirmar al vendedor que la subasta ha sido recibida correctamente
<LI><B>Tasa de confirmaci&oacute;n de subasta</B>: confirmar al vendedor que el pago de la tasa ha sido procesado.
</UL>
Puedes configurar el mensaje que se env&iacute;a a continuaci&oacute;n. Por favor ten presente que puedes usar comandos especiales:
usa la lista de <B>comandos</B> haciendo click en el <IMG SRC=images/tagstool.gif ALIGN=MIDDLE> icono crecano a cada l&iacute;nea de texto.<BR>";
$MSG_5400 = "Confirmaci&oacute;n de subasta";
$MSG_5401 = "Confirmaci&oacute;n de Tasa de subasta";
$MSG_5402 = "Nombre de tu p&aacute;gina";
$MSG_5403 = "URL de tu p&aacute;gina";
$MSG_5404 = "Direcci&oacute;n de e-mail de Administrador";
$MSG_5405 = "Este es el nombre de tu Sitio. Aparecer&aacute; en la la barra superior del navegador y como el remitente en los e-mails que env&iacute;e WeBid.";
$MSG_5406 = "Esta es la URL completa de tu Sitio (ej. http://www.yourdomain.com/auction/). <B>Nota: la barra final es necesaria</B>.";
$MSG_5407 = "Esta es la direcci&oacute;n de e-mail del administrador de la p&aacute;gina.";
$MSG_5408 = "M&aacute;x. ";
$MSG_5431 = "Env&iacute;ame una nueva contrase&ntilde;a";
$MSG_5433 = "VARIABLES ACTUALES";
$MSG_5434 = "FACTURAS";
$MSG_5435 = "WAP";
$MSG_5436 = "HERRAMIENTAS";
$MSG_5437 = "Puedes contactar con el soporte en vivo de WeBid en ICQ (<B>UIN: 95137622</B>).<BR>Estado actual:";
$MSG_5438 = "Estad&iacute;sticas por Plataformas de ";
$MSG_5439 = "SOPORTE ONLINE";
$MSG_5440 = "La opci&oacute;n CHAT tambi&eacute;n est&aacute; disponible.";
$MSG_5441 = "<B>Sistema de Facturas de WeBid</B> te dar&aacute; la posibilidad de agrupar todas las tasas que tenga que pagar cada usuario en una &uacute;nica factura.
<BR>Las facturas ser&aacute;n enviadas una vez que el usuario alcance el <B>l&iacute;mite de facturas</B> establecido anteriormente y que permitir&aacute; que los usuarios abonen las tasas en un solo pago.
<BR><BR>Ten presente que <B>Sistema de Facturas de WeBid</B> desactivar&aacute; el sistema de pago PayPal ya que asume que realizas el pago de tasas por uno de los <A HREF=alternativepayments.php>m&eacute;todos alternativos de pago</A>.";
$MSG_5442 = "L&iacute;mite de facturas";
$MSG_5443 = "S&oacute;lo las facturas iguales o superiores al <B>L&iacute;mite de facturas</B> ser&aacute;n enviadas.";
$MSG_5444 = "M&eacute;todos de pago alternativos";
$MSG_5445 = "Tienes la posibilidad de darle a tus usuarios la posibilidad de ofrecer m&eacute;todos de pago alternativos.<BR><BR>
Escribe a continuaci&oacute;n el nombre de cada uno de los m&eacute;todos de pago y completa la descripci&oacute;n (ej. Si vas a permitir el pago mediante transferencia bancaria puedes escribir tu n&uacute;mero de cuenta bancaria.).";
$MSG_5446 = "Nombre corto";
$MSG_5447 = "Descripci&oacute;n detallada";
$MSG_5449 = "Nuevo m&eacute;todo de pago";
$MSG_5450 = "Variables de m&eacute;todos de pago actualizadas";
$MSG_5451 = "Facturas pendientes";
$MSG_5452 = " facturas no enviadas";
$MSG_5453 = "ENVIAR";
$MSG_5454 = "Total (tasas no incluidas)";
$MSG_5456 = "Cabecera y pie de factura";
$MSG_5457 = "ADMINISTRACION DE FACTURAS";
$MSG_5458 = "WeBid te da la posibilidad de modificar el aspecto de tus facturas. El siguiente texto est&aacute; predefinido y puede ser modificado en tus facturas.";
$MSG_5459 = "Cabecera de factura";
$MSG_5460 = "Pie de factura";
$MSG_5461 = "Deudas de Tasas";
$MSG_5462 = "Descripci&oacute;n de tasas";
$MSG_5464 = "Previsualizar";
$MSG_5465 = "La tasa que tienes que pagar por la creaci&oacute;n de esta subasta es: ";
$MSG_5466 = "Recibir&aacute;s facturas de forma peri&oacute;dica y deber&aacute;s pagar las tasas correspondientes usando uno de los siguientes m&eacute;todos de pago: ";
$MSG_5467 = "Facturas recibidas";
$MSG_5468 = "Nota: s&oacute;lo las facturas cuyo valor sea igual o superior a ";
$MSG_5469 = " ser&aacute;n enviadas, respetando el l&iacute;mite establecido en <A HREF=taxsettings.php>variables de facturas</A>.";
$MSG_5470 = "Pagado";
$MSG_5471 = "Pagar ahora";
$MSG_5472 = "Todas las facturas";
$MSG_5473 = "Facturas pagadas";
$MSG_5474 = "facturas no pagadas";
$MSG_5476 = "Pagar por factura";
$MSG_5477 = "Puedes pagar usando uno de los siguientes m&eacute;todos:";
$MSG_5478 = "Haz click si has solucionado los problemas ";


#// Added by Gian - nov. 9 - 2002
$MSG_5479 = "WeBid necesita WeBid needs to check you installation directories to retrieve the information necessary to the updates management.<BR>
Haz click en el bot&oacute;n a continuaci&oacute;n.
<BR><BR>Nota: el proceso puede tardar un rato.";
$MSG_5480 = "ESTADO";
$MSG_5481 = "Error de permisos: no se puede escribir en el fichero.";
$MSG_5482 = "Permisos de escritura ok..";
$MSG_5483 = "EJECUTAR ACTUALIZACION";
$MSG_5484 = "Upgrades";
$MSG_5485 = "Patches and Updates";

#// Added by Gian - nov. 27 2002
$MSG_5486 = "Descuento inicial";
$MSG_5487 = "Puedes a&ntilde;adir un descuento a la cuenta de usuario al darse de alta.
Este aparecer&aacute; con signo negativo en la primera factura.<BR>
Por favor rellena en el campo a continuaci&oacute;n el valor de el descuento o cero (no se a&ntilde;adir&aacute; ning&uacute;n descuento)";
$MSG_5488 = "Editar facturas pendientes";
$MSG_5489 = "A&ntilde;adir l&iacute;nea";
$MSG_5490 = " facturas enviadas";

#// Added by Gian - Dec. 7th 2002
$MSG_5491 = "Enviar de nuevo";

#// Added by Gian - Jan. 30 2003
$MSG_5492 = "productos";
$MSG_5493 = "puja";
$MSG_5494 = "pujado para ";
$MSG_5495 = "por cada articulo";
$MSG_5496 = "Tasas pagadas";
$MSG_5497 = "Directorio principal";
$MSG_5498 = "Esta debe ser la ruta absoluta a su <b>directorio principal</b> de instalalción.";
$MSG_5505 = "Puntuacion: ";
$MSG_5506 = "Calificaciones positivas: ";
$MSG_5507 = "<font color=red>Calificaciones negativas: </font>";
$MSG_5508 = "Usuario desde ";
$MSG_5509 = "Calificado ";
$MSG_5510 = " Comprar >> ";

#// Messages used for the wap front end
$MSG_9000 = "Ultimas subastas creadas";
$MSG_2612 = "T&iacute;tulo: ";
$MSG_9003 = "Comienza en: ";
$MSG_9004 = "Puja actual: ";



#//Added for reserve price fee
$MSG_9005 = "Tasa precio de reserva";
$MSG_9006 = "<b> % del precio de reserva </b>";
$MSG_9007 = "Tasa precio de reserva";
$MSG_9008 = "Puedes cobrar a tus usuarios una Tasa precio de reserva. Puede ser una cantidad fija o un porcentaje del precio de reserva
                    <BR>WeBid soporta el sistema de pago <A HREF=http://www.paypal.com TARGET=_blank>PayPal</A>.";
$MSG_9009 = "&iquest;Activar Tasa precio de reserva?";
$MSG_9010 = "Puedes encontrar el id de la categor&iacute;a <A HREF=\"Javascript:window_open('catids.php','catids',400,500,20,20)\">aqu&iacute;</A>.";



#// Added by Gian Feb 13, 2003
$MSG__0001 = "p&aacute;gina en mantenimiento";
$MSG__0002 = "Puedes deshabilitar temporalmente el acceso a tu p&aacute;gina si es necesario. <BR>
En modo de \"En mantenimiento\" solo un usuario tendr&aacute; acceso a ella. Despu&eacute;s de que registres un usuario a trav&eacute;s de <A HREF=../register.php>la p&aacute;gina de registro com&uacute;n</A>
, rellena en el campo a continuaci&oacute;n del usuario. Despu&eacute;s de cambiar a \"p&aacute;gina en mantenimiento\" <A HREF=../user_login.php>identificate aqu&iacute;</A> para acceder al sitio.<BR>
En el modo \"En mantenimiento\" el texto es usualmente una p&aacute;gina HTML (se permiten etiquetas HTML b&aacute;sicas).";
$MSG__0004 = "C&oacute;digo HTML \"En mantenimiento\"";
$MSG__0005 = "Variables de \"En mantenimiento\" actualizadas";
$MSG__0006 = "&iquest;Cambiar a mode \"En mantenimiento\"?";
$MSG__0007 = "El c&oacute;digo";

$MSG__0008 = "Administraci&oacute;n de Banners";
$MSG__0009 = "WeBid ya no incluye phpAdsNew. Ahora proporciona una herramienta propia para administraci&oacute;n de banner.<BR>
Si quieres integrar phpAdsNew en tu sitio WeBid por favor visita <A HREF=http://sourceforge.net/projects/phpadsnew/>el sitio de phpAdsNew para mayor ayuda</a>.";
$MSG__0010 = "BANNERS";
$MSG__0012 = "Administraci&oacute;n de usuarios";
$MSG__0013 = "Variables relacionadas con los Banners";
$MSG__0014 = "El sistema de banners de WeBid rota los banners aleatoriamente, despu&eacute;s de aplicar los filtros aplicados en la suscripci&oacute;n del banner.
<BR>Lo primero a establecer son las medidas de banner:";
$MSG__0015 = "Cualquier tama&ntilde;o";
$MSG__0016 = "Tama&ntilde;o fijo (especifica)";
$MSG__0017 = "Ancho";
$MSG__0018 = "Largo";
$MSG__0020 = "Ancho y Largo deben ser n&uacute;meros enteros";
$MSG__0022 = "Compa&ntilde;&iacute;a";
$MSG__0024 = "Administraci&oacute;n de Banners";
$MSG__0025 = "Banners";
$MSG__0026 = "Agregar usuario";
$MSG__0028 = "Borrar usuarios seleccionados (se borrar&aacute;n los banners)";
$MSG__0029 = "Seleccionar banner";
$MSG__0030 = "URL";
$MSG__0031 = "Texto debajo banner";
$MSG__0032 = "texto ALT";
$MSG__0033 = "<B>Filtros</B>";
$MSG__0035 = "Palabras claves";
$MSG__0036 = "Formatos permitidos: GIF, JPG, PNG, SWF";
$MSG__0037 = "URL completa incluyendo http://";
$MSG__0038 = "Se puede dejar vacio";
$MSG__0039 = "Tienes la posibilidad de filtrar la rotaci&oacute;n de los banners con dos criterios:
<UL>
<LI><B>Categor&iacute;as</B>: Selecciona a continuaci&oacute;n una o M&aacute;s categor&iacute;as. El banner aparece solamente cuando sean visibles las categor&iacute;as seleccionadas. (ej. cuando navegas por las categor&iacute;as, p&aacute;gina de la subasta)
<LI><B>Palabras claves</B>: Introduzca una o M&aacute;s palabras claves (una por linea). El banner aparece solo en las p&aacute;ginas de subastas que contenga al menos una de las palabras claves en el t&iacute;tulo o descripci&oacute;n del art&iacute;culo.
</UL>
El filtro de <B>Categor&iacute;as</B> aplica en las p&aacute;ginas de navegaci&oacute;n de las categor&iacute;as y en las de art&iacute;culos.<BR>
El filtro de <B>Palabras claves</B> aplica solamente en las p&aacute;ginas de subastas.<BR>
Si no existe ninguna coincidencia, se utilizar&aacute; un banner aleatorio (entre aquellos que no tengan restricciones de filtros).";
$MSG__0040 = "Agregar banner";
$MSG__0041 = "<B>Nuevo banner</B>";
$MSG__0042 = "&nbsp;(requerido)";
$MSG__0043 = "<B>Usuario de Banners</B>";
$MSG__0044 = "Por favor inserta una URL v&aacute;lida";
$MSG__0045 = "Vistas compradas";
$MSG__0046 = "Cero o en blanco significa vistas ilimitadas";
$MSG__0047 = "$TARGET ya existe actualmente";
$MSG__0048 = "Tipo de archivo erroneo. Formatos permitidos: GIF, JPG, PNG, SWF";
$MSG__0049 = "Vistas:";
$MSG__0050 = "URL:";
$MSG__0051 = "Clicks:";
$MSG__0052 = "Ver&nbsp;filtros";
$MSG__0053 = "<B>Categor&iacute;as</B>";
$MSG__0054 = "<B>Palabras claves</B>";
$MSG__0055 = "Editar Banner";
$MSG__0056 = "Nuevo banner";


$MSG__0148 = "Subasta re listada";
$MSG__0149 = "Valor re listado incorrecto: debe ser un N&uacute;mero";
$MSG__0150 = "El art&iacute;culo ser&aacute; re listado autom&aacute;ticamente ";
$MSG__0151 = " veces";
$MSG__0152 = "Opci&oacute;n de re listado no seleccionada";
$MSG__0153 = "Re listados / <BR>Re listados";
$MSG__0154 = "Re listados ";
$MSG__0155 = " veces.";
$MSG__0156 = "Valores de subastas re listadas";
$MSG__0157 = "Los vendedores tendr&aacute;n la posibilidad de definir el N&uacute;mero de veces que desean re listar sus subastas si no tienen pujas.
Limita el cantidad M&aacute;xima de veces que una subasta puede ser re listada a continuaci&oacute;n.<BR>
Introduce cero o d&eacute;jalo en blanco si no quieres activar esta funcionalidad.";
$MSG__0158 = "L&iacute;mite de re listados";
$MSG__0159 = "L&iacute;mite de re listados incorrectos";
$MSG__0160 = "Valores de re listado actualizados";
$MSG__0161 = "M&aacute;ximo N&uacute;mero de re listados programados excedido. ";
$MSG__0162 = "Puedes escoger re listar autom&aacute;ticamente tus subastas cuando cierren si no han tenido pujas.<BR>
Introduce el N&uacute;mero de veces que se re listar&aacute; la subasta (introduce cero o d&eacute;jalo en blanco sino deseas re listar autom&aacute;ticamente).
<BR><FONT COLOR=RED>N&uacute;mero M&aacute;ximo de re listados permitidos: ";


#// Added May 26, 2003
$MSG__0163 = "Ganadores";
$MSG__0164 = "ID de subasta inv&aacute;lido";
$MSG__0165 = "La subasta no existe";
$MSG__0166 = "Ver ganadores";

/**
* NOTE: added aug. 19, 2003
*/
$MSG__0167 = "Relistado manualmente";
$MSG__0168 = "Subastas relistadas manualmente";


/**
* NOTE: GPL 2.0
*/
$MSG_2_0001 = "para";
$MSG_2_0002 = "Exportar lista como archivo Excell";

#// IP BANNING MANAGEMENT
$MSG_2_0003 = "ADMINISTRACI&oacute;N IPs";
$MSG_2_0004 = "Ver IP del usuario";
$MSG_2_0005 = "Registro de IP";
$MSG_2_0006 = "Ban";
$MSG_2_0007 = "Aceptar";
$MSG_2_0009 = "Direcci&oacute;n IP";
$MSG_2_0012 = "<FONT COLOR=GREEN><B>Aceptado</B></FONT>";
$MSG_2_0013 = "<FONT COLOR=red><B>Bloqueado</B></FONT>";
$MSG_2_0015 = "Procesar la selecci&oacute;n";
$MSG_2_0017 = "Administraci&oacute;n de direcciones IP ";
$MSG_2_0018 = "B&uacute;SQUEDA DIRECCI&oacute;N IP";
$MSG_2_0019 = "Introduzca la direcci&oacute;n IP completa o una parte.<BR>
Ejemplo:<UL><LI>215.25.0.55<LI>225.76<LI>36.52.125</UL>";
$MSG_2_0020 = "Administraci&oacute;n de direcciones IP bloqueadas";
$MSG_2_0021 = "Bloquear direcci&oacute;n IP: ";
$MSG_2_0024 = "(Direcci&oacute;n IP completa - ejemplo: 185.39.51.63)";
$MSG_2_0025 = "Intorducci&oacute;n manual";
$MSG_2_0026 = "Lo sentimos pero por una o m&aacute;s razones se la ha negado el acceso a este sitio.<BR>
Si tiene alguna subasta activa, hemos cancelado todas las pujas y eliminado el art&iacute;culo(s) de las base de datos.
<BR><BR>
Gracias";
$MSG_2_0027 = "&iquest;Comentario?";

#// Added by Gian on Aug. 5 - 2003
$MSG_2_0028 = "&iquest;Comprador ganador?";
$MSG_2_0029 = "Factura";
$MSG_2_0030 = "Puedes pedir una factura por todas las tasas mostradas a continuaci&oacute;n o solo aquellas que selecciones en la columna de <B>Facturas</B> y haz click en el bot&oacute;n de <B>Crear facturas</B>.
<BR>La factura se env&iacute;a inmediatamente a tu cuenta de correo electr&oacute;nico.
<BR>Tambi&eacute;n estar&aacute; disponible en la p&aacute;gina de <A HREF=yourinvoices.php>Facturas recibidas</A>en tu panel de control.";
$MSG_2_0031 = "Crear factura";

#// AUCTIONS AUOEXTENSION
$MSG_2_0032 = "Variables Extensi&oacute;n de Subastas";
$MSG_2_0033 = "EXTENSI&oacute;N DE SUBASTAS";
$MSG_2_0034 = "&iquest;Activar Autoextensi&oacute;n de subastas?";
$_CUSTOM_0032 = "Autoextensi&oacute;n de subastas te permite extender autom&aacute;ticamente la subasta por gives <B>X</B> segundos su tiempo de finalizaci&oacute;n, si alguien puja en los &uacute;ltimos <B>Y</B> segundos de la subasta.
<BR>";
$MSG_2_0035 = "Extender subasta por ";
$MSG_2_0036 = " segundos si alguien puja en los &uacute;ltimos ";
$MSG_2_0037 = " segundos";
$MSG_2_0038 = "Por favor utiliza N&uacute;meros enteros v&aacute;lidos";
$MSG_2_0039 = "Variables de Autoextensi&oacute;n de subastas actualizadas";

#//
$MGS_2__0001 = "Elije idioma";
$MGS_2__0002 = "Soporte multiidioma";
$MGS_2__0003 = "<BR>El idioma por defecto es el ingl&eacute;s. WeBid tambi&eacute;n incluye los archivos en espa&ntilde;ol.<BR><BR>
Si quieres a&ntilde;adir otros idiomas o cambiar el idioma por defecto tienes que seguir los siguientes pasos:
<UL>
<LI>Edita <B>includes/languages.inc.php</B> en la parte superior del archivo para activar el idioma que vas a agregar en el site (ah&iacute; encontrar&aacute;s las instrucciones).
<LI>Si quieres agregar un idioma nuevo abre includes/messages.EN.inc.php con un editor de texto y s&aacute;lvalo
con el nombre apropiado: Ej. Si lo vas a traducir al franc&eacute;s, debes salvar el archivo como
messages.FR.inc.php.
<BR>

Primero define la codificaci&oacute;n de los caracteres necesaria para el idioma al principio del archivo de mensajes.
La variable que debes editar es: <FONT FACE=courier>\$CHARSET</FONT>. La codificaci&oacute;n UTF-8 generalmente funciona para todos los idiomas.<BR>
Despu&eacute;s debes definir el sentido de lectura. La variable a modificar es: <FONT FACE=courier>\$DOCDIR</FONT>
existen dos valores posibles:
<UL>
<LI><B>ltr</B> (izquierda a derecha): Es el valor por defecto y significa que el texto se lee de izquierda a derecha
<LI><B>rtl</B> (derecha a izquierda): Significa que el texto se lee de derecha a izquierda(ej. arabe, hebreo, ect)
</UL>
Una vez cambiado <FONT FACE=courier>\$CHARSET</FONT> y <FONT FACE=courier>\$DOCDIR</FONT> de acuerdo al idioma en que agregar&aacute;s,
tienes que traducir todos los mensajes de error y los mensajes de la interfase del usuario que se encuentran en el archivo messages.
Sube los archivos traducidos al directorio includes/.

<LI>Tambi&eacute;n necesitar&aacute;s la bandera (s) correspondiente en el directorio includes/flags. Las banderas de todos los paises las puedes encontrar en
<A HREF=http://www.WeBid.net/flags/ TARGET=_blank>http://www.WeBid.net/flags/</A>. Despu&eacute;s de descargar el archivo (las banderas est&aacute;n agrupadas por continente) debes buscar la bandera(s) que necesitas y cambiar el nombre del archivo a XX.gif, cuando XX es el c&oacute;digo del pa&iacute;s que necesitas para tu idioma.
<BR>Por ejemplo: pa-Netherlands.gif debe cambiar a NL.gif, sm-Sweden.gif debe cambiar a SE.gif, ect.
<BR>Copia las bandera(s) con el nuevo nombre en el directorio includes/flags/.
<BR><B>Nota:</B> Para cada archivo traducido includes/messages.XX.inc.php, se necesita el archivo XX.gif correspondiente en includes/flags/
<LI>Traduce los archivos de correo electr&oacute;nico. El nombre de cada archivo de correo electr&oacute;nico debe incluir el c&oacute;digo del pa&iacute;s del idioma, como se explica anteriormente para el archivo de mensajes.
<BR>Los archivos de correo electr&oacute;ncio se encuentran en  el directorio includes/:
<UL>
<LI>auctionmail.EN.inc.php
<LI>friendmail.EN.inc.php
<LI>invitationmail.EN.inc.php
<LI>mail_request_to_seller.EN.inc.php
<LI>mail_endauction_youwin_pay.EN.inc.php
<LI>mail_endauction_youwin_nodutch.EN.inc.php
<LI>mail_endauction_youwin.EN.inc.php
<LI>mail_endauction_winner_pay.EN.inc.php
<LI>mail_endauction_winner_nofee.EN.inc.php
<LI>mail_endauction_winner.EN.inc.php
<LI>mail_endauction_nowinner.EN.inc.php
<LI>mail_endauction_buyers_nofee.EN.inc.php
<LI>no_longer_winnermail.EN.inc.php
<LI>setup_confirmation_pay_mail.EN.inc.php
<LI>usermail_prepay.EN.inc.php
<LI>usermail_pay_invoice.EN.inc.php
<LI>usermail.EN.inc.php
<LI>usermail_pay.EN.inc.php
</UL>
<BR><B>lib/includes/</B>
<UL>
<LI>credits_confirmation.EN.inc.php
<LI>signup_completed.EN.inc.php
<LI>signup_denied.EN.inc.php
<LI>signup_fee_confirmation_pay.EN.inc.php
<LI>signup_fee_confirmation_prepay.EN.inc.php
</UL>
<LI>Selecciona el idioma por defecto a continuaci&oacute;n. Los otros idiomas disponibles tambi&eacute;n estar&aacute;n en la p&aacute;gina de inicio con sus bandera(s) correspondientes.
</UL>";
$MGS_2__0004 = "Idioma por defecto";
$MGS_2__0005 = "<FONT COLOR=RED><B>Idi&oacute;ma por defecto</B></FONT>";
$MGS_2__0006 = "Tipo tasa";
$MGS_2__0007 = "%";
$MGS_2__0008 = "Cantidad fija";
$MGS_2__0009 = "Introduce los rangos de cantidad a continuaci&oacute;n y la tasa correspondiente para cada uno.<BR>
Por ejemplo:
<TABLE WIDTH=100% CELLPADDING=2 BGCOLOR=\"#FFFFFF\">
  <TR>
    <TD WIDTH=\"132\" BGCOLOR=\"#EEEEEE\"> <B> de </B> </TD>
    <TD WIDTH=\"132\" BGCOLOR=\"#EEEEEE\"><B> hasta </B> </TD>
    <TD WIDTH=\"132\" BGCOLOR=\"#EEEEEE\"><B> Cantidad </B> </TD>
    <TD WIDTH=\"96\" BGCOLOR=\"#eeeeee\"> <B> Tipo Tasa </B></TD>
  </TR>
  <TR BGCOLOR=\"#FFFFFF\">
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">0.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">100.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">1.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">Fix amount</FONT></TD>
  </TR>
  <TR BGCOLOR=\"#FFFFFF\">
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">101.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">200.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">1.50</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">Fix amount</FONT></TD>
  </TR>
  <TR BGCOLOR=\"#FFFFFF\">
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">201.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">500.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">3.00</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">%</FONT></TD>
  </TR>
  <TR BGCOLOR=\"#FFFFFF\">
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">501</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">10000000000</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">5</FONT></TD>
    <TD><FONT SIZE=\"2\" FACE=\"Verdana, Arial, Helvetica, sans-serif\">%</FONT></TD>
  </TR>
  <TR>
    <TD> </TD>
  </TR>
</TABLE>";
$MGS_2__0010 = "<BR><BR><B>Nota:</B> La mejor manera de ejecutar cron.php es utilizando un cronjob.
El modo <B>non-batch</B> no se recomienda: se han detectado problemas en sitios con bastante tr&aacute;fico.";
$MGS_2__0011 = "Esta herramienta est&aacute; disponible solo si no hay subastas presentes en la base de datos.";
$MGS_2__0012 = "Los m&eacute;todos de pago definidos a continuaci&oacute;n son los m&eacute;todos de pagos aceptados por el vendedor para recibir dinero del comprador.";
$MGS_2__0013 = "ID";
$MGS_2__0014 = "Cantidad";
$MGS_2__0015 = "Vendedor";
$MGS_2__0016 = "Fecha de inicio";
$MGS_2__0017 = "Duraci&oacute;n";
$MGS_2__0018 = "Fecha t&eacute;rmino";
$MGS_2__0019 = "Puja inicio";
$MGS_2__0020 = "Puja actual";
$MGS_2__0021 = "N&uacute;mero de pujas";
$MGS_2__0022 = "Relistar (Relistado)";
$MGS_2__0023 = "Tipo subasta";
$MGS_2__0024 = "Precio de reserva";
$MGS_2__0025 = "C&oacute;mpralo ahora";
$MGS_2__0026 = "Privado";
$MGS_2__0027 = "TODAS";
$MGS_2__0028 = "Navegar p&aacute;ginas";
$MGS_2__0029 = "N&uacute;mero factura incorrecto";
$MGS_2__0030 = " significa que la entrada no se puede borrar ya que se est&aacute; usando.";
$MGS_2__0031 = "Nota: Si activas el sistema de facturaci&oacute;n las opciones de <A HREF=admin.php?S=fees>Pago y Prepago</A> no tendr&aacute;n ning&uacute;n efecto.";
$MGS_2__0032 = "Soporte Bidfind";
$MGS_2__0033 = "El Soporte Bidfind te dar&aacute; visibilidad a trav&eacute;s del directorio -buscador de Bidfind
(<A HREF=http://bidfind.com/af/af-allcat.html TARGET=_blank>http://bidfind.com/af/af-allcat.html</A>).
<BR>Para estar enlistado ve a su p&aacute;gina de<A HREF=http://bidfind.com/af/af-sitereg.html TARGET=_blank>Get Your Site Listed</A> y sigue las instrucciones.
<BR>Activa Bidfind a continuaci&oacute;n para peri&oacute;dicamente generar el archivo <I>megalist</I> (megalist.html).";
$MGS_2__0034 = "&iquest;Activar soporte Bidfind?";
$MGS_2__0035 = "Valores de Bidfind actualizados.";
$MGS_2__0036 = "&iexcl;C&oacute;mpralo ahora!";
$MGS_2__0037 = "Enviar subasta";
$MGS_2__0038 = "Selecciona la categor&iacute;a";
$MGS_2__0039 = "Si has olvidado tu contrase&ntilde;a escribe tu nombre de usuario o direcci&oacute;n e-mail a continuaci&oacute;n.";
$MGS_2__0040 = "Username o direcci&oacute;n e-mail";
$MGS_2__0041 = "Puja Ganadora";
$MGS_2__0042 = "Thumbnails";
$MGS_2__0043 = "WeBid muestra tres diferentes tipos de thumbnails:
<UL>
<LI>Thumbnails en listas de subastas (son los thumbnails que aparecen en los listados de subastas)
<LI>Thumbnails en Home Page (son los thumbnails de las subastas destacadas que aparecen en la p&aacute;gina principal)
<LI>Thumbnails en categor&iacute;as (son los thumbnails de las subastas destacadas en las p&aacute;ginas de categorias)
</UL>
You can set the thumbnails width to a different value for each thumbnail class.";
$MGS_2__0044 = "Ancho de thumbnail";
$MGS_2__0045 = " pixeles (120 recomendado)";
$MGS_2__0046 = "Paramentros de Thumbnails Actualizados";
$MGS_2__0047 = "SELECCIONAR CATEGORIA &gt;&gt;";
$MGS_2__0048 = "&iexcl;Cerrar ahora!";
$MGS_2__0049 = "&iexcl;Relistar ahora!";
$MGS_2__0050 = "Relistar subasta";
$MGS_2__0051 = "Ancho de p&aacute;gina";
$MGS_2__0052 = "Es el ancho del box m&aacute;s externo de las p&aacute;ginas de tu sitio. Puede ser un ancho fijo en pixeles o un porcentaje del ancho de la ventana del tu navegador.";
$MGS_2__0053 = "pixeles";
$MGS_2__0054 = "<B><FONT COLOR=red>Ya seleccionado</FONT></B>";
$MGS_2__0055 = "Para que tus cambios tengan efecto tienes que pagar las tasas detalladas a continuaci&oacute;n.
<BR><FONT COLOR=RED><B>Si no proceder&aacute;s al pago de las tasas tu subasta se quedar&aacute; suspendida y no ser&aacute; accesible a los compradores</B></FONT>";
$MGS_2__0056 = "Subastas suspendidas";
$MGS_2__0057 = "Mostrar contadores";
$MGS_2__0058 = "Puedes decidir de mostrar algunos contadores en la cabezera de tu sitio.<BR>
Hay tres diferentes contadores:
<UL>
<LI>Subastas activas
<LI>Usuarios registrados
<LI>Usuarios en l&iacute;nea
</UL>
Puedes habilitar/desabilitar cada uno de los contadores a continuaci&oacute;n.";
$MGS_2__0059 = "Usuarios en l&iacute;nea";
$MGS_2__0060 = "Subastas activas";
$MGS_2__0061 = "Usuarios registrados";
$MGS_2__0062 = "Contadores que quieres mostrar";
$MGS_2__0063 = "Valores de contadores actualizados";
$MGS_2__0064 = "USUARIOS EN LINEA";
$MGS_2__0065 = "<B>Nota</B>: la posibilidad de re-listar subastas automaticamente solo es disponible si el
<A HREF=taxsettings.php>soporte de facturas est&aacute; habilitado</A>.<BR>El soporte de facturas est&aacute;: ";
$MGS_2__0066 = "Abilitado";
$MGS_2__0067 = "Desabilitado";
$MGS_2__0068 = "para relitar ";
$MGS_2__0069 = "Modificada en esta sesi&oacute;n.";
$MGS_2__0070 = "Ya seleccionado en esta misma sesi&oacute;n: no pagado todavia";
$MGS_2__0071 = "Esta opci&oacute;n solo est&aacute; disponible si no existen subastas (activas o cerradas) en la base de datos.";
$MGS_2__0072 = "&iquest;Cobrar la tasa de inicio subasta?";
$MGS_2__0073 = "Puedes decidir de cobrar o no cobrar la tasa de inicio subasta al vndedor cuando cuando uan subasta es re-listada de manera automatica.
Las tasas para las opciones de art&iacute;culos destacados siempre se cobrar&aacute;n.";
$MGS_2__0074 = "Se han relistado las siguientes subastas.";
$MGS_2__0075 = "T&iacute;tulo de la subasta";
$MGS_2__0076 = "Total tasas";
$MGS_2__0077 = "Puedes escoger cargar o no cargar una comisi&oacute;n por publicaci&oacute;n cuando los usuarios relistan sus subastas manualmente. Eligiendo esta opci&oacute;n, las tasas de art&iacute; destacados siempre ser&aacute;n cargados.";
$MSG_2__0078 = ": base de datos actualizada";
$MSG_2__0079 = "Tablas de la base de datos creadas o actualizadas donde necesario.";

$ERR_25_0000 = "El precio de reserva tiene que ser mayor de la puja inicial, y el precio &iexcl;Compralo ahora! tiene que ser mayor del precio de reserva.";
$ERR_25_0001 = "Por favor escoja una sub-categoria";

$MSG_25_0000 = "Tus datos de venta por defecto";
$MSG_25_0001 = "GANADOR";
$MSG_25_0002 = "VENDEDOR";
$MSG_25_0003 = "Deja tu comentario";
$MSG_25_0004 = "Nick del comentario";
$MSG_25_0006 = "Cantidad de la subasta";
$MSG_25_0008 = "Preferencias";
$MSG_25_0009 = "Interface";
$MSG_25_0010 = "Usuarios";
$MSG_25_0011 = "Publicidad";
$MSG_25_0012 = "B&uacute;squeda Usuarios";
$MSG_25_0013 = "Cuenta Usuario";
$MSG_25_0015 = "Enviar Newsletter";
$MSG_25_0016 = "Opciones Distacads";
$MSG_25_0017 = "Subastas Suspendidas";
$MSG_25_0018 = "Contenidos";
$MSG_25_0021 = "Facturas";
$MSG_25_0022 = "Pago/Prepago";
$MSG_25_0023 = "Estadisticas";
$MSG_25_0025 = "Estado de la instalaci&oacute;n";
$MSG_25_0026 = "Proceso Batch (cron.php)";
$MSG_25_0027 = "No olvidar configurar un cronjob para ejecutar cron.php (15 minutos es el intervalo de tiempo recomendado).<BR>
Para mas informaci&oacute;n acerca de c&oacute;mo configurar un cronjob <A HREF=http://www.WeBid.net/faqs.php TARGET=_blank>hacer referencia a las FAQS</A>.";
$MSG_25_0028 = "Direcci&oacute;n E-mail Paypal";
$MSG_25_0029 = "IPN URL: ";
$MSG_25_0030 = "<FONT COLOR=RED>Falta la direcci&oacute;n e-mail de Paypal!!</FONT> [<A HREF=paypaladdress.php>Solucionar</A>]";
$MSG_25_0031 = "Estadisticas (resumen)";
$MSG_25_0032 = "N&uacute;mero m&aacute;ximo de relisting admitido: ";
$MSG_25_0033 = "Relisting automatico no admitido";
$MSG_25_0034 = "<FONT COLOR=RED>Las facturas estan desabilitadas, tienen que estar abilitadas para que el relisting automatico tenga efecto</FONT> [<A HREF=taxsettings.php>Fix</A>]";
$MSG_25_0035 = "Correci&oacute;n hora del site";
$MSG_25_0036 = "Hora del servidor";
$MSG_25_0037 = " horas";
$MSG_25_0038 = "Contadores a mostrar en la cabezera:<BR>";
$MSG_25_0039 = "Lenguajes disponibles";
$MSG_25_0040 = "Alineaci&oacute;n de las p&aacute;ginas";
$MSG_25_0041 = "Mostrar en Home Page";
$MSG_25_0042 = "Box de login";
$MSG_25_0043 = "Box de noticias";
$MSG_25_0044 = "Noticias a mostrar";
$MSG_25_0045 = "Ancho de las thumbnails";
$MSG_25_0046 = "Subastas destacadas en Home Page: ";
$MSG_25_0047 = "Subastas destacadas en categor&iacute;as: ";
$MSG_25_0048 = "Otras thumbnails: ";
$MSG_25_0049 = "Subscripci&oacute;n a Newsletter";
$MSG_25_0051 = "Pay";
$MSG_25_0052 = "Prepay";
$MSG_25_0053 = "<BR>Pay/Prepay s&oacute;lo tiene efecto si las facturas est&aacute;n habilitadas.<BR>
Puesto que ahora est&aacute;n desabilitadas <A HREF=taxsettings.php>tendr&iacute;as que habilitarlas</A> para poder trabajar en modalidad Pay o Prepay.";
$MSG_25_0054 = "ver detalles";
$MSG_25_0055 = "Usuarios Registrados";
$MSG_25_0056 = "Usuarios Suspendidos";
$MSG_25_0057 = "Subastas Act&iacute;vas";
$MSG_25_0059 = "Pujas en Subastas Activas";
$MSG_25_0060 = "Total FActuras Pendientes";
$MSG_25_0061 = "Facturas Inpagadas";
$MSG_25_0062 = "(impuestos no incluidos)";
$MSG_25_0063 = "Accessos de hoy";
$MSG_25_0064 = "Web Stores";
$MSG_25_0065 = "Definici&oacute;n Stores";
$MSG_25_0066 = "Colores";
$MSG_25_0067 = "Administraci&oacute;n Stores";
$MSG_25_0068= "Tabla de variantes";
$MSG_25_0069= "Etiquetas copiadas del directorio padre";
$MSG_25_0070= "Nuevo valor -->";
$MSG_25_0071= "B&uacute;squeda variantes";
$MSG_25_0072= "WeBid te permite definir campos adiccionales para las subastas bajo categor&iacute;as determinadas.
<BR>Eso se suele hacer por ejemplo para productos como <I>libros</I> por los que es necesaria informaci&oacute;n adicional como ISBN, autor, editor, etc.
<BR>Puedes definir hasta 10 campos de texto y 10 campos num&eacute;ricos.<BR>
<UL>
<LI>Para ver los campos adicionales asociados a una categor&iacute;a, selecciona la categor&iacute;a y pulsa <B>reload</B>.
<LI>Para a&ntilde;adir campos adicionales a una categor&iacute;a (o m&aacute;s categor&iacute;as a la vez, hasta todas) seleccionala(s) y rellena los nombres de los campos en text0, text1,...,text9 y num0, num1,...num9
</UL>";
$MSG_25_0073= "Numerico";
$MSG_25_0074= "Re-enviar&nbsp;e-mail";
$MSG_25_0075= "Re-enviar e-mail de confirmaci&oacute;n";
$MSG_25_0076= "Re-enviar e-mail";
$MSG_25_0077= "HTML no permitido";
$MSG_25_0078= "E-mail enviado a ";
$MSG_25_0079= "Newsletter";
$MSG_25_0080= "Resumen Actividades";
$MSG_25_0081= "Mi Cuenta";
$MSG_25_0082= "Vender";
$MSG_25_0083= "Comprar";
$MSG_25_0084= "A&ntilde;adir nueva clave";
$MSG_25_0085= "Recuerda mi login";
$MSG_25_0086= "Contacta con nosotros";
$MSG_25_0087= "La opci&oacute;n <B>Contacta con nosotros</B> te brinda la posibilidad de introducir nombres y roles de miembros del personal, adem&aacute;s de sus direcciones de correo.<BR>
Los usuarios que te contactar&aacute;n a trav&eacute;s de la p&aacute;gina <A TARGET=_blank HREF=../contactus.php>Contacta con nosotros</A> podr&ntilde;an elegir a cual miembro del peronal enviar el mensaje.<BR>
Si no quieres activar esta opci&oacute;n, no introduzcas nada a continuaci&oacute;n";
$MSG_25_0088= "Rol";
$MSG_25_0089= "Nombre&nbsp;(opcional)";
$MSG_25_0090= "A&ntilde;adir";
$MSG_25_0092= "Error al enviar el e-mail";
$MSG_25_0093= "Gracias por contactar con nosotros. Nuestro personal se pondr&aacute; en contacto contigo cuanto antes.";
$MSG_25_0094= "Membro de el personal";
$MSG_25_0095= "Enviar mensaje";
$MSG_25_0096= "Confirmaci&oacute;n alta usuarios";
$MSG_25_0097= "If you enable the option below, the users signup process will require the administrator's approval.<BR>
If the option is disabled, users will simply receive a signup confirmation e-mail and will have to confirm their registration.
<BR><BR>The <B>Users signup confirmation</B> option is only available if no signup fee is requested.";
$MSG_25_0098= "&iquest;Activar confirmaci&oacute;n de registro? Esta opci&oacute;n obliga a que el administrador sea qui&eacute;n confirme los registros desde el Panel de Administraci&oacute;n";
$MSG_25_0099= "Configuraci&oacute;n de confirmaci&oacute; de registro actualizada";
$MSG_25_0100= "The Signup Confirmation Settings option cannot be enabled because a signup fee is set. [<A HREF=signupfee.php>fix</A>]";
$MSG_25_0101= "Confirmaciones Pendientes";
$MSG_25_0103= "Rechazar";
$MSG_25_0104= "Categor&iacute;as Libres";
$MSG_25_0105= "Guardar Selecci&oacute;n";
$MSG_25_0106= "You can select one or more categories from the list below to avoid charging the fee for auctions listed under them.<BR>
This is usualy done for promotional purpose for limited period of time";
$MSG_25_0106= "Puedes seleccionar una o m&aacute;s categor&iacute;as en la lista a continuaci&oacute;n para que no se carguen comisiones para las subasta listadas bajo estas categor&iacute;as.<BR>
Esto se hace generalmente por razones promocionales y limitados periodos de tiempo";
$MSG_25_0107= "Thumbnails en listas de subastas";
$MSG_25_0108= "Thumbnails en p&aacute;gina principal";
$MSG_25_0109= "Thumbnails en p&aacute;ginas de categor&iacute;as";
$MSG_25_0110= "Nota Legal";
$MSG_25_0111= "Base de datos actualizada";
$MSG_25_0112= "Texto de categorias Libres";
$MSG_25_0113= "Este texto aparecer&aacute; en al principio de la p&aacute;gina <B>Subastar Art&iacute;culo</B> si la categor&iacute;a es una categor&iacute;a libre (HTML admitido, max. 255 caracteres)";
$MSG_25_0114= "Base de datos actualizada";
$MSG_25_0115= "Subastas pendientes";
$MSG_25_0116= "Empezar&aacute;";
$MSG_25_0117= "Finalizar&aacute;";
$MSG_25_0118= "&iexcl;Comenzar ahora!";
$MSG_25_0119= "Productos Vendidos";
$MSG_25_0120= "Excluir usuario en mi lista de Lista de Usuarios Excluidos";
$MSG_25_0121= "Acab&oacute; el";
$MSG_25_0122= "Tipos de cuentas";
$MSG_25_0123= "WeBid te permite decidir de tener dos tipos de cuentas diferentes para vendedores y compradores, o un &uacute;nico tipo de cuenta para todos los usuarios.<BR>
Si decides tener dos tipos de cuentas diferentes para vendedores y compradores, los vendedores tendr&aacute;n acceso limitado a los recursos de tu sitio (por ejemplo no podr&aacute;n acceder a la p&aacute;gina de <B>VEnder Art&iacute;culo</B>, las funcionalidades del panel de control ser&aacute;n diferentes, etc).
<BR>Por favor selecciona a continuaci&oacute;n la opci&oacute;n que prefieres.<BR>
No te olvides de definir el tipo de <A HREF=userconfirmation.php>Confirmaci&oacute;n Alta Usuarios</A>.";
$MSG_25_0124= "Cuentas diferentes para vendedores y compradores";
$MSG_25_0125= "Cuenta &uacute;nica";
$MSG_25_0126= "Datos actualizados";
$MSG_25_0127= "El tipo de cuentas de usuario seleccionado es: ";
$MSG_25_0128= "Puedes modificar tu selecci&oacute;n desde la p&aacute;gina <A HREF=accounttypes.php>Tipos de cuentas</A>.";
$MSG_25_0129= "S&oacute;lo para vendedores";
$MSG_25_0130= "S&oacute;lo para compradores";
$MSG_25_0131= "Tanto para vendedores como para compradores";
$MSG_25_0132= "Ninguna confirmaci&oacute;n necesaria para vendedores y compradores";
$MSG_25_0133= "Quiero registrarme como";
$MSG_25_0134= "<B>Vendedor</B> (puede vender y pujar)";
$MSG_25_0135= "<B>Comprador</B> (tansolo puede pujar)";
$MSG_25_0136= "Necesita la aprobaci&oacute;n del administrador";
$MSG_25_0137= "Tienes que seleccionar un tipo de cuenta (vendedor o comprador)";
$MSG_25_0138= "Vendedores";
$MSG_25_0139= "Compradores";
$MSG_25_0140= "Tu cuenta no es una cuenta <B>vendedor</B>. Ninguna actividad de venta est&aacute; permitida.<BR> Si quieres puedes pedir un cambio a <B>cuenta vendedor</B> ";
$MSG_25_0141= "enviando una petici&oacute;n a el administrador";
$MSG_25_0142= "Tu petici&oacute;n ha sido enviada.";
$MSG_25_0143= "Tu cuenta no es una cuenta <B>vendedor</B>. Ninguna actividad de venta est&aacute; permitida.<BR> Ya has enviado tu petici&oacute;n de cambio a <B>cuenta vendedor</B>: tu petici&oacute;n est&aacute; siendo evaluada. ";
$MSG_25_0144= "Peticiones compradores";
$MSG_25_0145= "Tu petici&oacute;n de cambio de cuenta";
$MSG_25_0146= "Ordenar Categor&iacute;as";
$MSG_25_0147= "La lista de categor&iacute;as en la columna de la izquerda en la p&aacute;gina principal, se puede ordenar <B>alfabeticamente</B> o segun el N&uacute;mero de subastas en cada una de las categor&iacute;as (<B>contadores de categor&iacute;a</B>).<BR>
Elije a continuaci&oacute;n el orden que prefieres";
$MSG_25_0148= "Alfab&eacute;tico";
$MSG_25_0149= "Contadores de categor&iacute;as";
$MSG_25_0150= "Datos de Orden de Categor&iacute;as Actualizados";
$MSG_25_0151= "Autentificaci&oacute;n Usuarios";
$MSG_25_0152= "Por defecto WeBid pide la contrase&ntilde;a de usuario antes de crear una subasta. Es una medida de seguridad adicional que recomendamos, pero puede ser cambiada a continuaci&oacute;n si necesario seleccionando <B>Autentificaci&oacute;n de usuario no necesaria</B>.";
$MSG_25_0153= "Por defecto (pedir contrase&ntilde;a de usuario antes de crear la subasta)";
$MSG_25_0154= "Autentificaci&oacute;n de usuario no necesaria";
$MSG_25_0155= "Parametros de Autentificaci&oacute;n de Usuarios Actualizados";
$MSG_25_0156= "Ranges -->";
$MSG_25_0157 = "Tu im&aacute;gen de fondo";
$MSG_25_0158 = "Fondo actual (reducido)";
$MSG_25_0159 = "Subir nueva im&aacute;gen de fondo (max. 50 Kbytes)";
$MSG_25_0160 = "Repetir";
$MSG_25_0161 = "Repetir horizontal";
$MSG_25_0162 = "Repetir vertical";
$MSG_25_0163 = "&uacute;nica instancia";
$MSG_25_0164 = "No usar";
$MSG_25_0165 = "Opciones";
$MSG_25_0166 = "Volver a la subasta";
$MSG_25_0167 = "icono";
$MSG_25_0168 = "borrar";
$MSG_25_0169 = "Niveles de afiliaci&oacute;n";
$MSG_25_0170 = "Editar, borrar o a&ntilde;adir niveles de afiliaci&oacute;n utilizando el formulario a continuaci&oacute;n. \"Puntos\" es el limite superior (el nivel m&iacute;nimo es implicito), \"afiliaci&oacute;n\" es el nombre de el nivel, \"icono\" es el nombre de el icono (im&aacute;gen) correspondiente al nivel que se mostrar&aacute;, relativo al directorio \"images/icons/\"";
$MSG_25_0171 = "Puntos";
$MSG_25_0172 = "tipo de afiliaci&oacute;n";
$MSG_25_0173 = "";
$MSG_25_0174 = "Moneda Paypal";
$MSG_25_0175 = "Selecciona la moneda a utilizar en los pagos a trav&eacute;s de Paypal (USD,GBP,JPY,CAD,EUR)";
$MSG_25_0176 = "CONVERTIR AHORA!";
$MSG_25_0177 = "PARA";
$MSG_25_0178 = "HTML Meta Tags";
$MSG_25_0179 = "Para ayudar alguno motores de b&uacute;squeda (como Google) a exponer mejor tu site, puedes usar el <B>Meta Description Tag</B> y el <B>Meta Keywords Tag</B>.
<BR>Ambos proporcionar&oacute;n al motor de b&uacute;squeda informaci&oacute;n adicional adem&aacute;s de la que el motor de b&uacute;squeda puede encontrar en las p&aacute;ginas pero <B>no esperar obtener una buena posici&oacute;n el los motores de b&uacute;squeda simplemente porqu&eacute; utilizas los Meta Tags!</B>.
Alguno motores ignoran totalmente los Meta Tags.
<BR>Un buen art&iacute;culo para aprender algo sobre los Meta Tags se encuentra <A HREF=http://searchenginewatch.com/webmasters/article.php/2167931 TARGET=_blank>aqu&iacute;</A>.
<BR><BR>Leave the field(s) blank if you don't want to use Meta Tags.";
$MSG_25_0180 = "Meta Description Tag";
$MSG_25_0181 = "Meta Keywords Tag";
$MSG_25_0182 = "El Meta Description Tag se suele utilizar para describir tu p&aacute;gina en los resultados de las b&uacute;squeda.<BR>
Rellena a continuaci&oacute;n un breve texto que describa tu web.";
$MSG_25_0184 = "The Meta Keywords Tag proporcionan a los motores de b&uacute;squeda informaci&oacute;n adicional para indexar tu web.<BR>
Rellena las palabras clave a continuaci&oacute;n separadas por comas (ej. libros, subastas de libros, venta de libros).";
$MSG_25_0185 = "Preferecnias de Meta Tags Actualizadas";
$MSG_25_0186 = "Upload de fotos";
$MSG_25_0187 = "Rellena a continuaci&oacute;n el tama&ntilde;o m&aacute;ximo admitido (en Kbytes) de la im&aacute;gen que los vendedores pueden subir al servidor al dar de alta una subasta.<BR>
<B>Nota</B>: este valor se refiere a la im&aacute;gen estandard asociada a una subasta, los parametros de la galer&iacute;a de imagenes se pueden modificar <A HREF=picturesgallery.php>aqu&iacute;</A>.";
$MSG_25_0188 = "E-mail de subastas terminadas";
$MSG_25_0189 = "C&oacute;mo vendedor, puedes decidir de recibir un e-mail por cada subastas que termina, o bien recibir un e-mail diario con el resumen de todas las subastas que han terminado en el mismo d&iacute;a.<BR>
La segunda opci&oacute;n en general es recomendable si tienes un gran N&uacute;mero de subastas.<BR>Finalmente puedes tambi&eacute;n decidir de no recibir algun e-mail pero esta opci&oacute;n no es recomendable.";
$MSG_25_0190 = "Recibir <B>un</B> e-mail por cada subasta";
$MSG_25_0191 = "Recebir un e-mail diario cumulativo";
$MSG_25_0192 = "Opci&oacute;n de e-mail de fine subastas actualizadas";
$MSG_25_0193 = "No recibir algun e-mail";
$MSG_25_0195 = "C&oacute;mo vendedor, puede recibir un e-mail de confirmaci&oacute;n por cada subasta que das de alta, o bien no recibir ningun e-mail.<BR>Por favor elige a continuaci&oacute;n.";
$MSG_25_0196 = "Recibir el <B>e-mail de confirmaci&oacute;n de subasta</B>.";
$MSG_25_0197 = "No recibir el <B>e-mail de confirmaci&oacute;n de subasta</B>.";
$MSG_25_0198 = "acerca de";
$MSG_25_0199 = "Resumen subastas cerradas";
$MSG_25_0200 = "Comentarios: ";
$MSG_25_0201 = "Marcar la &uacute;ltima frase: ";
$MSG_25_0202 = " cita: ";
$MSG_25_0203 = " acerca de ";
$MSG_25_0204 = "Certifica usuarios";
$MSG_25_0205 = "Certifica";
$MSG_25_0206 = "No certif.";
$MSG_25_0207 = "Usuarios certificado";
$MSG_25_0208 = "Usuarios no certificados";
$MSG_25_0209 = "Vender precio";
$MSG_25_0210 = " positivo ";
$MSG_25_0211 = " justo ";
$MSG_25_0212 = " negativo ";
$MSG_25_0213 = "Dejar este mensaje para todos los usuarios seleccionados: ";
$MSG_25_0214 = "Buscar tambi&eacute;n subastas cerradas: ";
$MSG_25_0215 = "T&eacute;rminos de env&iacute;o";
$MSG_25_0216 = "Contactar con el vendedor";
$MSG_25_0217 = "Dejar a cualquier usuario que visite tu web la posibilidad de contactar con los vendedores no es recomendable.
Por esta raz&oacute;n WeBid te ofrece la posibilidad de decidir si es posible contactar con los vendedores.
<BR> Por favor elige una opci&oacute;n a continuaci&oacute;n:";
$MSG_25_0218 = "Cualquier usuario puede contactar con el vendedor";
$MSG_25_0219 = "Solo los usuarios que hayan hecho login podr&aacute;n contactar con el vendedor.";
$MSG_25_0220 = "Ningun usuario podr? contactar con el vendedor.";
$MSG_25_0226 = "N&uacute;mero de columnas de las subastas destacadas";
$MSG_25_0229 = "P&aacute;ginas: ";

//multi-language months
$MSG_MON_001="Ene";
$MSG_MON_001E="Enero";
$MSG_MON_002="Feb";
$MSG_MON_002E="Febrero";
$MSG_MON_003="Mar";
$MSG_MON_003E="Marcha";
$MSG_MON_004="Abr";
$MSG_MON_004E="Abril";
$MSG_MON_005="May";
$MSG_MON_005E="Mayo";
$MSG_MON_006="Jun";
$MSG_MON_006E="Junio";
$MSG_MON_007="Jul";
$MSG_MON_007E="Julio";
$MSG_MON_008="Ago";
$MSG_MON_008E="Agosto";
$MSG_MON_009="Sep";
$MSG_MON_009E="Septiembre";
$MSG_MON_010="Oct";
$MSG_MON_010E="Octubre";
$MSG_MON_011="Nov";
$MSG_MON_011E="Noviembre";
$MSG_MON_012="Dic";
$MSG_MON_012E="Diciembre";

$MSG_26_0001 = "Historia de pujas";
$MSG_26_0002 = "Selecci&oacute;n de Temas";
$MSG_26_0003 = "Temas disponibles";
$MSG_26_0004 = "Estos son los temas que se encuentran instalados en el site. Recuerda que los cambios tambi&eacute;n afectan al logo y el fondo!";
$MSG_26_0005 = "Preferencias de Temas actualizadas";

#// GPL 3.0
$MSG_30_0002 = "Ancho";
$MSG_30_0003 = "Est&iacute;lo";
$MSG_30_0004 = "Editar Letra Standard";
$MSG_30_0005 = "Editar Letra de Error";
$MSG_30_0006 = "Editar Letra del T&iacute;tulo";
$MSG_30_0007 = "Editar Letra de Navegaci&oacute;n";
$MSG_30_0008 = "Editar Letra de la Parte Inferior";
$MSG_30_0009 = "Las propiedades de las fuentes ustilizadas en el site est&aacute;n definidas in el archivo CSS del tema activo.
<br>Puedes cambiarlo escogiendo la opci&oacute;n <B>Editar</B> En el tipo de letra que desees.<br>Tambi&eacute;n puedes editar el archivo CSS con tu editor de texto preferido. Recomendamos esta opci&oacute;n solo a aquellos usuarios con conociminetos de CSS.";
$MSG_30_0010 = "Archivo CSS en uso: ";
$MSG_30_0011 = "Algunos de los colores del tema que has elegido se pueden cambiar a continuaci&oacute;n.<br>Escoge la opci&oacute;n <B>Editar</B> en el color que desees cambiar.
<br>Tambi&eacute;n puedes editar el archivo CSS con tu editor de texto preferido. Recomendamos esta opci&oacute;n solo a aquellos usuarios con conociminetos de CSS.";
$MSG_30_0012 =  "Editar Color del borde";
$MSG_30_0013 =  "Color de la parte superior de las Tablas";
$MSG_30_0014 =  "Este es el color del fondo de la parte superior de las tablas.";
$MSG_30_0015 =  "Editar Color de la parte superior de las Tablas";
$MSG_30_0016 =  "Fondo de Art&iacute;culos Destacados";
$MSG_30_0017 =  "Este es el Color del fondo de los Art&iacute;culos Destacados.";
$MSG_30_0018 =  "Editar Color del fondo de los Art&iacute;culos Destacados";
$MSG_30_0019 =  "Este es el Color de Enlaces No Visitados.";
$MSG_30_0020 =  "Editar Color de Enlaces";
$MSG_30_0021 =  "Este es el Color de Enlaces Visitados.";
$MSG_30_0022 =  "Ediar Color de Enlaces Visitados";
$MSG_30_0023 =  "Color de Fondo de P&aacute;gina";
$MSG_30_0024 =  "Este es el Color De Fondo de las P&aacute;ginas.";
$MSG_30_0025 =  "Editar Color de Fondo d elas P&aacute;gians";
$MSG_30_0026 =  "Color de Fondo del Contenedor";
$MSG_30_0027 =  "Este es color de fondo de la caja m&aacute;s externa que aparece en las p&aacute;ginas.";
$MSG_30_0028 =  "Editar Color de Fondo del Contenedor";
$MSG_30_0029 =  "Puedes definir la cantidad de categorias que se muestran en la columna izquierda en la p&aacute;gina de incio";
$MSG_30_0030 =  "Categor&iacute;as que se muestran: ";
$MSG_30_0031 =  "Pujas";
$MSG_30_0032 =  "Retracci&oacute;n de pujas";
$MSG_30_0033 =  "Como administrador del site, tienes la posibilidad de retraer/borrar la &uacute;ltima puja en una subasta.
<br>Esto es &uacute;til cuando el usuario se equivoca en la cantidad de la puja y se da cuenta despu&eacute;s de su error.
<br><B>Importante: Solo la &uacute;ltima puja puede ser borrada</B>.
<br><br>Para retraer una puja usa el ID de la subasta en el campo o accede a trav&eacute;s de
<A HREF=listauctions.php>Lista de Subastas Activa</A> para buscar la subasta y acceded en la opci&oacute;n de <B>Retracci&oacute;n de Pujas</B> desde ah&iacute;.";
$MSG_30_0034 =  "Procede &gt;&gt;";
$MSG_30_0035 =  "Inicia";
$MSG_30_0037 =  "ID de la Puja";
$MSG_30_0038 =  "Fecha de la Puja";
$MSG_30_0039 =  "Cantidad de la Puja";
$MSG_30_0041 =  "Mapa del site";
$MSG_30_0042 =  "Si la opci&oacute;n <B>Mapa del site</B> est&aacute; activada, un enlace a la p&aacute;gina del Mapa del site se a&ntilde;ade en la parte inferior de las p&aacute;ginas.
<br>El Mapa del site muestra un resumen de las principales secciones del site.
<br><br>&iquest;Activar opci&oacute;n Mapa del site?";
$MSG_30_0043 =  "Preferencias de Mapa del site actualizadas";
$MSG_30_0044 =  "Webstores";
$MSG_30_0045 =  "Vendedor &uacute;nico";
$MSG_30_0046 =  "Puedes escoger ser el vendedor &uacute;nico del site. Para activar la opci&oacute;n de <B>Vendedor &uacute;nico</B> primero tienes que registrar un usuario al cual seleccionar&aacute;s despu&eacute;s como el &uacute;nico permitido para vender.
<br>Selecciona usuario que ser&aacute; el Venderdor &uacute;nico. Selecciona la opci&oacute;n <B>No Vendedor &uacute;nico</B> sino quieres activar esta opci&oacute;n.";
$MSG_30_0047 = "No Vendedor &uacute;nico";
$MSG_30_0048 = "Preferencias de Vendedor &uacute;nico actualizadas";
$MSG_30_0049 = "Preferencias de Newsletters actualizadas";
$MSG_30_0050 = "Bloqueo de e-mails gratuitos";
$MSG_30_0051 = "Puedes bloquear el uso de e-mails gratuitos durante el proceso de registro. Escribe los dominios de los mails que quieres bloquear.
<br>Los Usuarios que intenten registrarse usando una cuenta de e-mail de los dominions listados, recibir&aacute; un mensaje de error pidi&eacute;ndole registrarse con otra direcci&oacute;n e-mail.<br>
Aseg&uacute;rate de poner el dominio completo (ejem. hotmail.com, yahoo.com).";
$MSG_30_0052 = "Dominios a bloquear";
$MSG_30_0053 = "Algunos dominios que ofrecen servicios de e-mail gratuitos han sido bloquedos en este site. Por favor no se registre utilizando alguno de los siguientos dominios:";
$MSG_30_0054 = "Direcci&oacute;n e-mail incorrecta: e-mails grauitos no se permiten para el registro en este site. Por favor use otra direcci&oacute;n e-mails.";
$MSG_30_0055 = "El newsletter enviado por WeBid deber&aacute; ser HTML.<br>
Aseg&uacute;rate que cada nueva linea contenga la etiqueta <CODE>&lt;BR&gt;</CODE> de tal forma que al enviarse, se transformar&aacute; en una nueva linea, de lo contrario, todo parecer&aacute; una sola linea y paracer&aacute; un mensaje sin formato.";
$MSG_30_0056 = "Si deseas que las factura se envien autom&aacute;ticamente necesitas laopci&oacute;n de estable un cronjob en tu servidor [<A HREF=batch.php>Lee m&aacute;s</A>].";
$MSG_30_0057 = "Felicitaci&oacute;n de Cumplea&ntilde;os";
$MSG_30_0058 = "WeBid se puede hacer cargo de enviar a tus usuarios un e-mail de Felicitaci&oacute;n por su cumplea&ntilde;os. Tendr&aacute;s que activar el servicio y dar la informaci&oacute;n necesaria en los campos <B>Asunto</B> y <B>Mensaje</B>.";
$MSG_30_0059 = "&iquest;Activar Felicitaci&oacute;n de Cumplea&ntilde;os?";
$MSG_30_0060 = "Preferencias de Felicitaci&oacute;n de Cumplea&ntilde;os actualizada";
$MSG_30_0061 = "<B>Cuidado:</B> Tu instalaci&oacute;n est&aacute; <A HREF=batch.php>configurada para hacer <CODE>cron.php</CODE> en modo non-natch/A>. Esto significa que <CODE>cron.php</CODE> se ejecutar&aacute; cada vez que se acceda a tu p&aacute;gina de inicio.
<br>No es recomendable activar la Felicitaci&oacute;n de Cumplea&ntilde;os ya que tu p&aacute;gina de inicio puede descargar extremadamente despacio cuando se envien los e-mail de Felicitaci&oacute;n. De todas maneras considera que las felicitaciones se env&iacute;an una vez al d&iacute;a.";
$MSG_30_0062 = "Por favor usa m&iacute;nimo 4 caracteres";
$MSG_30_0063 = "&iquest;Solamente Compra ahora?";
$MSG_30_0064 = "&iquest;Activar subastas de <B>Solamente Compra ahora</B>?";
$MSG_30_0065 = "Activando la opci&oacute;n de <B>Solamente Compra ahora</B> se da la opci&oacute;n a los vendedores de crear subastas en las que no se puede pujar, sino usar solamente la opci&oacute;n de <B>Compra ahora</B> (subasta con precio fijo).
<br><B>Nota:</B> La opci&oacute;n <B>Solamente Compra Ahora</B> solo funcionar&aacute; si <B>Compra ahora</B> est&aacute; activo.";
$MSG_30_0066 = "Preferencias de Solamente Compra ahora actualizadas";
$MSG_30_0067 = "Subasta <B>Solamente Compra ahora</B>";
$MSG_30_0068 = "N/A";
$MSG_30_0069 = "Vendedor: Edita esta subasta";
$MSG_30_0070 = "Buscar solo en esta categor&iacute;a";
$MSG_30_0071 = "Subastas Solo Adultos";
$MSG_30_0072 = "Activando esta opci&oacute;n los vendedores tiene la opci&oacute;n de crear subastas para<B>Solo Adultos</B> que ser&aacute;n visibles solamente a los usuarios que est&eacute;n conectados.";
$MSG_30_0073 = "&iquest;Activar subastas Solo Adultos?";
$MSG_30_0074 = "Preferencias de subastas Solo Adultos actualizadas";
$MSG_30_0075 = "&iquest;Subasta Solo Adultos?";
$MSG_30_0076 = "Si el contenido de esta subasta est&aacute; dirigido a un exclusivamente p&uacute;blico adulto, por favor selecciona la opci&oacute;n <B>Si</B> a continuaci&oacute;n. Subastas Solo Adultos ser&aacute;n visibles solo a los usuarios que est&eacute;n conectados.";
$MSG_30_0077 = "Detalles de como recibir tus cobros como vendedor";
$MSG_30_0078 = "Puedes incluir los detalle de pago (ejem: cuenta paypal, cuenta del banco, etc).<br>A los compradores ganadores de tus subastas recibir&aacute;n un e-mail que les notificar&aacute; que han ganado la subasta e incluir&aacute; esta informaci&oacute;n.";
$MSG_30_0079 = "Tus detalles de pago han sido actualizados";
$MSG_30_0080 = "Opciones de pago";
$MSG_30_0081 = "Visto ";
$MSG_30_0083 = "Direcci&oacute;n de los ganadores en e-mail";
$MSG_30_0084 = "Puedes incluir la direcci&oacute;n del ganador en el e-mail de notificaci&oacute;n que se env&iacute;a al vendedor cuando se cierra la subasta. Solo debes activar o desactivar la opci&oacute;n.";
$MSG_30_0085 = "&iquest;Incluir la direcci&oacute;n del ganador en los e-mails?";
$MSG_30_0086 = "Direcci&oacute;n: ";
$MSG_30_0087 = "&iquest;Confirmas que deseas procesar las subastas seleccionadas?";
$MSG_30_0088 = "Algunos de los campos en la fomra de registro puede ser o no ser solicitados, estos a su vez pueden ser opcionales u obligatorios.<br>Por favor realiza la selecci&oacute;n.";
$MSG_30_0089 = "Solicitado";
$MSG_30_0090 = "Opcional";
$MSG_30_0091 = "Obligatorio";
$MSG_30_0092 = "Fecha de nacimiento";
$MSG_30_0096 = "Seleccionar todos";
$MSG_30_0097 = "Deseleccionar";
$MSG_30_0098 = "&nbsp; = Sobrepuja";
$MSG_30_0099 = "Vender un art&iacute;culo similar";
$MSG_30_0100 = "Subastas <B>Compra ahora!</B>";
$MSG_30_0101 = "Subastas <B>Solamente Compra ahora</B>";
$MSG_30_0102 = "Seleccionar/Deseleccionar";
$MSG_30_0103 = "No hay ganador";
$MSG_30_0104 = "Enviar las facturas es por defecto un proceso semiautom&aacute;tico. El administrador tiene que dedicar periodicamente tempo para entra en la p&aacute;gina de <A HREF=sendinvoices.php>Enviar Facturas</A> e iniciar el procedimiento.
<br>Como otra opci&oacute;n, se puede establecer un cron job para que envie las facturas de proceso autom&aacute;tico (ejem. Una vez al mes).<br>
El script que debe ejecutarse es ";
$MSG_30_0105 = "Preferecencias de Bloqueo de e-.mails actualizadas";
$MSG_30_0106 = "WeBid incluye soporte para el m&eacute;todo de pago de Authorize.net's SIM (Simple Integration Method). Para utilizar este sistema debes tener una cuenta en Authorize.net Merchant Account. Accede en <A HREF=http://www.authorize.net TARGET=_blank>http://www.authorize.net</A> para mayor informaci&oacute;n.";
$MSG_30_0107 = "&iquest;Activar soporte para Authorize.net?";
$MSG_30_0108 = "ID de acceso";
$MSG_30_0109 = "Llave de Transacci&oacute;n";
$MSG_30_0120 = "Authorize.net te proporciona un <B>ID de acceso</B> y una <B>Llave de Transacci&oacute;n</B>. Por favor rellena los campos con la informaci&oacute;n.";
$MSG_30_0121 = "Pagar a trav&eacute;s del sistema Authorize.net";
$MSG_30_0122 = "Art&iacute;culos Deseados";
$MSG_30_0123 = "Al activar la opci&oacute;n <B>Art&iacute;culos Deseados</B> los compradores tienen la posibilidad de publicar anuncios sobre art&iacute;culos en lo que est&aacute; interesados en ofertar.<BR>
El vendedor podr&aacute; buscar entre la base de datos de <B>Art&iacute;culos Deseados</B> y contactar a los compradores a las subastas de los art&iacute;culos que correspondan a su petici&oacute;n.
<br><br>&iquest;Activar <B>Art&iacute;culos Deseados</B>?";
$MSG_30_0124 = "Preferencias de Art&iacute;culos Deseados actualizadas";
$MSG_30_0125 = "T&iacute;tulo del anuncio";
$MSG_30_0126 = "Procesar anuncios seleccionados";
$MSG_30_0127 = "&iquest;Est&aacute;s seguro que deseas procesar los anuncios seleccionados?";
$MSG_30_0128 = "Publicar un nuevo (Art&iacute;culo Deseado)";
$MSG_30_0129 = "Anuncio de Art&iacute;culo Deseado";
$MSG_30_0130 = "Previsualizar anuncio";
$MSG_30_0131 = "Todav&iacute;a puedes <a HREF='wanteditem.php?mode=recall'>realizar cambios</a> a tu anuncio";
$MSG_30_0132 = "Enviar Anuncio";
$MSG_30_0133 = "Tu anuncio ha sido recibido correctamente.<br>Puedes ver la lista completa de tus <B>Art&iacute;culos Deseados</B> <A HREF=wanted.php>aqu&iacute;</B><br>";
$MSG_30_0134 = "Agregar URL: ";
$MSG_30_0135 = "Publicar un anuncio similar";
$MSG_30_0136 = "Comentarios del Anunciador";
$MSG_30_0137 = "Anunciador: edita este art&iacute;lo deseado";
$MSG_30_0138 = "Fecha del comentario";
$MSG_30_0139 = "Cerrar&aacute;";
$MSG_30_0140 = "ID del Anuncio";
$MSG_30_0141 = "Comentario recibido:&nbsp;";
$MSG_30_0142 = "Puntuaci&oacute;n del comentario:&nbsp;";
$MSG_30_0143 = "&iquest;Est&aacute;s vendiendo este art&iacute;culo?";
$MSG_30_0144 = "Respondonder a este anuncio";
$MSG_30_0145 = "Regreso al anuncio";
$MSG_30_0146 = "Art&iacute;culo Deseado: &nbsp;";
$MSG_30_0147 = "Si est&aacute;s vendiendo este art&iacute;culo introduce el <B>n&uacute;mero del art&iacute;culo</B> y da click en el bot&oacute;n de <B>Enviar</B>.<BR>Si no recuerdas el n&uacute;mero de este art&iacute;culo puedes ";
$MSG_30_0148 = "Ver tus subasta actuales aqu&ntilde;i";
$MSG_30_0149 = "N&uacute;mero de art&iacute;culo";
$MSG_30_0150 = "Enviar &gt;";
$MSG_30_0151 = "Responder a demanda de <I>Art&iacute;culo Deseado</I>";
$MSG_30_0152 = "Por favor introduce el n&uacute;mero del art&iacute;culo";
$MSG_30_0153 = "La subasta no existe, est&aacute; cerrada o tu no eres el vendedor";
$MSG_30_0154 = "Ha ocurrido un problema mientras se enviaba la informaci&oacute;n del anunciador. Por favor contacte con el administrador del site.";
$MSG_30_0155 = "Un e-mail ha sido enviado al anunciador de este art&iacute;culo.";
$MSG_30_0156 = "Respuestas";
$MSG_30_0157 = "Ver anuncios cerrados";
$MSG_30_0158 = "Ver anunicos abiertos";
$MSG_30_0159 = "Art&iacute;culos Deseados (cerrado)";
$MSG_30_0160 = "Editar la imagen del fondo";
$MSG_30_0162 = "Foro P&uacute;blico de esta subasta";
$MSG_30_0163 = "Foro Privado de esta subasta";
$MSG_30_0166 = "WeBid ofrece un foro p&uacute;blico para cada subasta y un foro privado para comunicaciones entre el vendedor y el comprador.
Introduzca el n&uacute;mero de mensajes que deseas mostrar en la p&aacute;gina del foro.";
$MSG_30_0167 = "Foro P&uacute;blico para: ";
$MSG_30_0168 = "identif&iacute;cate primero";
$MSG_30_0169 = "Foro Privado para: ";
$MSG_30_0170 = "Foro Privado para: ";
$MSG_30_0172 = "&uacute;ltimo mensaje publicado";
$MSG_30_0173 = "# Mensajes";
$MSG_30_0174 = "Ning&uacute;n foro privado ha sido abierto para esta subasta";
$MSG_30_0175 = "Tus Foros Privados";
$MSG_30_0176 = "Ver Ganadores";
$MSG_30_0177 = "Subasta acabando";
$MSG_30_0178 = "&nbsp;&nbsp;No se encontraron ganadores para esta subasta";
$MSG_30_0179 = "Puja ganadora";
$MSG_30_0180 = "Historia completa de Pujas";
$MSG_30_0181 = "Foros";
$MSG_30_0182 = "Reinicializar tus valores de ventas";
$MSG_30_0183 = "&iquest;Seguro deseas reinicializar tus valores de ventas?";
$MSG_30_0184 = "La imagen del fondo es la que aparece en el fondo de las p&aacute;ginas del site. Puedes seleccionar como prefieres que esa imagen se repita (horizontal, vertical, etc.)
<br><B>Nota:</B> La trayectoria de la imagen es relativo a la localizaci&oacute;n del directorio principal de instalaci&oacute;n de WeBid y debe tener la siguiente forma <CODE>url(path/to/image.gif)</CODE><br>
Por ejemplo, si pone la imagen de fondo en el directorio <code>images/</code> y el nombre de la imagen es <code>mybackground.gif</code> debe ser <code>url(images/mybackground.gif)</code> en el campo de <B><code>Imagen de fondo:</code></B>.";
$MSG_30_0185 = "Click aqu&iacute; para continuar";
$MSG_30_0187 =  "Color de Fondo de la Barra de Navegaci&oacute;n";
$MSG_30_0188 =  "Puedes definir el color de la barra de navegaci&oacute;n de su encabezado principal para todas las p&aacute;ginas";
$MSG_30_0189 =  "Editar el color de Fondo de la Barra de Navegaci&oacute;n";
$MSG_30_0207 = "Calificar";
$MSG_30_0208 = "Poner oferta >>";
$MSG_30_0209 = "Conoce a este vendedor";
?>
