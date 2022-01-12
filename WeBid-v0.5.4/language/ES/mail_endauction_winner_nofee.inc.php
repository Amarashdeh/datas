#
# --Send winner email address to seller
# 
# 			This file contains the message your customers
# 			will receive when someone sends them an auction.
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
#			<#s_name#>              Seller Name
#			<#s_nick#>              Seller Nickname
#			<#s_email#>             Seller email
#			<#s_address#>           Seller Address
#			<#s_city#>              Seller City
#			<#s_prov#>              Seller State/Province
#			<#s_country#>           Seller Country
#			<#s_zip#>               Seller Zip Code
#			<#s_phone#>             Seller Phone
#			<#i_title#>             auction item title 
#			<#i_description#>       auction item description 
#			<#i_url#>               URL to view auction 
#			<#i_ends#>              Auction End date/time
#			<#i_qty#>              Auction End date/time
#           <#w_report#>            Winner report/list
#           <#c_sitename#>          Auction Site Name
#           <#c_siteurl#>           main URL of auction site
#           <#c_adminemail#>        email address of Auction site webmaster
#        --------------------------------------------------------
#
#			USAGE:
#			Insert the above tags in the text of your message			
#			where you want each value to appear.			
#			Modify the message to reflect your needs.
#			Change [...] with to your correct data.
#
# 
#

Hola <#s_name#>,<br>
<br>
La subasta que has creado en <a href="<#c_sitename#>"><#c_sitename#></a> ha finalizado.<br>
desafortunadamente, tu cuenta no tiene crditos suficientes para abonar la tasa final de subasta<br>
Esta tasa es impuesta a todas las subastas que finalizan con ganador(es).<br>
<br>
La informacin de las subasta es:<br>
<br>
Ttulo: <#i_title#><br>
Descripcion: <#i_description#><br>
Cantidad: <#i_qty#><br>
Fecha de finalizacion: <#i_ends#><br>
Puja: <#i_currentbid#><br>

Por favor vete a <a href="<#c_siteurl#>"><#c_siteurl#></a> e identificate para aadir crditos a tu cuenta<br>
y as poder recibir la informacion de contacto del vendedor.<br>
<br>
Si has recibido este mensaje por error, por favor responde este email o<br>
escribe a <a href="mailto:<#c_adminemail#>"><#c_adminemail#></a>.<br>
<br>
Gracias por visitar <a href="<#c_sitename#>"><#c_sitename#></a> en <a href="<#c_siteurl#>"><#c_siteurl#></a>.