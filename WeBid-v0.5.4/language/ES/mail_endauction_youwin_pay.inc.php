#
# --Send winner notification
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
#			<#w_name#>              Winner Name
#			<#w_nick#>              Winner Nickname
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

Hola <#w_name#>,<br>
<br>
Has resultado ganador de la siguiente subasta en <a href="<#c_sitename#><#i_title#>"><#c_sitename#><#i_title#></a>:<br>
<br>
<br>
Para acceder a la informacin de contacto del vendedor debes pagar la tasa correspondiente.<br>
Por favor identifcate en <a href="<#c_siteurl#>"><#c_siteurl#></a> y accede a la seccion "informacion de contacto del vendedor"<br>
desde tu panel de control para proceder al pago de la tasa.<br> 
<br>
Informacion de subasta<br>
------------------------------------<br>
Ttulo: <#i_title#><br>
Descripcion: <#i_description#><br>
Fecha de finalizacion: <#i_ends#><br>
URL: <a href="<#c_siteurl#>"><#c_siteurl#></a><a href="<#i_url#>"><#i_url#></a><br>
Puja: <#i_currentbid#><br>
<br>
Si has recibido este mensaje por error, por favor responde este email o<br>
escribe a <a href="mailto:<#c_adminemail#>"><#c_adminemail#></a>.<br>
<br>
Gracias por visitar <a href="<#c_sitename#>"><#c_sitename#></a> en <a href="<#c_siteurl#>"><#c_siteurl#></a>.