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

Apreciado <#w_name#>,<br>
<br>
Felicidades! Acabas de ganar la subastas a continuacion: <br>
<br>
Datos subasta<br>
------------------------------------<br>
Titulo: <#i_title#><br>
Descripción: <#i_description#><br>
<br>
Tu puja: <#i_currentbid#> <br>
Fecha termino: <#i_ends#><br>
URL subasta: <a href="<#c_siteurl#><#i_url#>"><#c_siteurl#><#i_url#></a><br>
<br>
========================<br>
INFORMACION DEL VENDEDOR<br>
========================<br>
<br>
<#s_nick#><br>
<a href="mailto:<#s_email#>"><#s_email#></a><br>
<br>
<br>
Si has recibido este mensaje por error, por favor escribenos a <a href="mailto:<#c_adminemail#>"><#c_adminemail#></a>.
