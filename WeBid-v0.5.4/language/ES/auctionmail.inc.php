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

Hola <#c_name#>,<BR>
<BR>
Tu subasta ha sido creada en <#c_sitename#>.  <BR>
<BR>
ID de subasta: <#a_id#><BR>
Tipo de subasta: <#a_type#><BR>
Articulo: <#a_title#><BR>
Cantidad: <#a_qty#><BR>
Descripcion: <#a_description#><BR>
Puja inicial: <#a_minbid#><BR>
Precio de reserva: <#a_resprice#><BR>
Incremento de puja: <#a_customincrement#><BR><BR>
URL de subasta: <a href="<#a_url#>"><#a_url#></a><BR>
La subasta finaliza: <#a_ends#><BR>
<BR>
<#a_altfeedue#><BR>
<BR>
Si has recibido este mensaje por error, por favor responde este email o<BR>
escribe a <#c_adminemail#>.<BR>
<BR>
Gracias por visitar <#c_sitename#> en <#c_siteurl#>.