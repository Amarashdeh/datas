#
# --Confirmation e-mail file
#
# 			This file contains the message your customers
# 			will receive as a confirmation after the registration
#			process.
#			Lines starting with # will be skipped.
#			Blank lines will be maintained.
#
#			Change the message below as needed considering the
#			following tags to reflect your customer's personal data:
#
#        --------------------------------------------------------
#			TAG SYNTAX				EFFECT
#        --------------------------------------------------------
#
#			<#c_id#>							customer ID
#			<#c_name#>						name
#			<#c_nick#>						nick
#			<#c_address#> 					address
#			<#c_city#> 			   		city
#			<#c_prov#>  					province
#			<#c_country#> 					country
#			<#c_zip#> 						zip
#			<#c_phone#> 					phone number
#			<#c_email#> 					e-mail address
#			<#c_confirmation_page #>        confirm page
#
#        --------------------------------------------------------
#
#			USAGE:
#			Insert the above tags in the text of your message
#			where you want each value to appear.
#			Mofidy the message to reflect your needs.
#
#
#
#

Hola <#c_name#>,<br>
<br>
Gracias por registrarte en <#c_sitename#>.  Tu informacin de usuario es la siguiente.<br>
Por favor vistanos pronto en <#c_siteurl#>.<br>
<br>
Tu perfil<br>
--------------------<br>
# ID: <#c_id#><br>
Nombre de usuario: <#c_nick#><br>
Contraseña: <#c_password#><br>
# Nombre real: <#c_name#><br>
Direccion: <#c_address#><br>
Ciudad: <#c_city#><br>
Provincia/Region: <#c_prov#><br>
Pais: <#c_country#><br>
Codigo Postal: <#c_zip#><br>
Telefono: <#c_phone#><br>
E-mail: <#c_email#><br>
<br>
Para que tu registro sea completo debemos recibir el pago de la tasa de registro<br>
a traves de PayPal. Recibirs un email de confirmacin tan pronto como el pago haya sido realizado.<br>
<br>
Si has recibido este mensaje por error, por favor responde este email o<br>
escribe a <#c_adminemail#>.<br>
<br>
Gracias por visitar <#c_sitename#> en <#c_siteurl#>.