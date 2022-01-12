#
# --Confirmation e-mail file
# 
# 			This file contains the message your customers
# 			will receive as a confirmation for the posted
#			auction.
#			Lines starting with # will be skipped.
#			Blank lines will be maintained.
#
#			Change the message below as needed using the 
#			following tags to reflect your customer's personal data:
#
#        --------------------------------------------------------
#			TAG SYNTAX				EFFECT
#        --------------------------------------------------------
#
#			<#c_name#>				customer name
#			<#c_nick#>				nick
#			<#c_email#> 			e-mail address
#			<#c_address#> 			street address
#			<#c_city#>   			city
#			<#c_country#> 			country
#			<#c_zip#> 			    zip
#			<#a_title#>				auction title
#			<#a_id#>				auction ID
#			<#a_description#>		description
#			<#a_picturl#>			picture url
#			<#a_minbid#>   			minimum bid
#			<#a_resprice#>			reserve price (if set)
#			<#a_duration#>			duration (in days)
#			<#a_location#>			item location
#			<#a_zip#>				item location zip
#			<#a_shipping#>			shipping terms
#			<#c_type#>   			auction type
#			<#c_qty#>   			auction type
#			<#a_intern#>			international shipping terms
#										. will ship internationally
#										. will NOT ship internationally
#			<#a_payment#>			selected payment methods (one per line)
#			<#a_ends#>				closing date and time
#			<#a_url#>				the URL of the page
#           <#c_sitename#>          site name
#           <#c_siteurl#>           site URL
#           <#c_adminemail#>        site administrator email address
#        --------------------------------------------------------
#
#			USAGE:
#			Insert the above tags in the text of your message			
#			where you want each value to appear.			
#			Modify the message to reflect your needs.
#		
# 
#

Apreciado <#b_name#>,<br>
<br>
Este mensaje te ha sido enviado desde <#c_sitename#> para notificarte que<br>
has sido invitado por <#c_nick#> a participar en la subasta a continuacin:<br>
  <br>
ID de subasta: <#a_id#><br>
Tipo de subasta: <#a_type#><br>
Producto: <#a_title#><br>
Cantidad: <#a_qty#><br>
Descripción: <#a_description#><br>
<br>
Puja de inicio: <#a_minbid#><br>
Precio de reserva: <#a_resprice#><br>
Incremento de puja: <#a_customincrement#><br>
<br>
URL de la subasta: <#a_url#><br>
<br>
Fecha termino: <#a_ends#><br>
<br>
Si has recibido este mensaje por error, por favor escribenos a <#c_adminemail#>.