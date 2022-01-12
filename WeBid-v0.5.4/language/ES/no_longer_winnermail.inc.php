#
# --Send Auction to a Friend e-mail file
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
#			<#o_name#>              Old Winner Name (email goes to this person)
#			<#o_nick#>              Old Winner Nickname
#			<#o_email#>             Old Winner email
#			<#o_bid#>               Old Winner bid
#			<#n_bid#>               New Winning Bid
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

Hola <#o_name#>,<br>
<br>
Tu puja de <#o_bid#> ya no es la puja ganadora de la subasta en <#c_sitename#>:<br>
<br>
Titulo: <#i_title#><br>
Descripcin: <#i_description#><br>
Fecha de finalizacion: <#i_ends#><br>
Nueva puja ganadora: <#n_bid#><br>
<br>
Puedes visitar la subasta aqu: <#c_siteurl#><#i_url#><br>
<br>
Si has recibido este mensaje por error, por favor responde este email o<br>
escribe a <#c_adminemail#>.<br>
<br>
Gracias por visitar <#c_sitename#> en <#c_siteurl#>.