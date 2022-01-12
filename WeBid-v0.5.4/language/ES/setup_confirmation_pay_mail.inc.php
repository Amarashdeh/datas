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

Hola <#c_name#>,<br>
<br>
Este es un mensaje de confirmacion para informarte de que la tasa de activacion de subasta <br>
ha sido recibida correctamente para <#a_title#> y que la subasta ha sido activado.<br>
<br>
URL de subasta: <#a_url#><br>
<br>
Si has recibido este mensaje por error, por favor responde este email o<br>
escribe a <#c_adminemail#>.<br>
<br>
Gracias por visitar <#c_sitename#> en <#c_siteurl#>.