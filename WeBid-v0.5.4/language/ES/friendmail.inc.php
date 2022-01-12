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
#			<#s_name#>              sendername 
#			<#s_email#>             sender email 
#			<#s_comment#>           sender comment 
#			<#f_name#>              friend name 
#			<#f_email#>             friend email 
#			<#i_title#>             auction item title 
#			<#i_description#>       auction item description 
#			<#i_url#>               URL to view auction 
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

Hola <#f_name#>,<br>
<br>
<#s_name#> con email <a href="mailto:<#s_email#>"><#s_email#></a> piensa que una subasta te puede<br>
 interesar, visitala en <#c_sitename#>.<br>
<br>
<#s_name#> dice: <#s_comment#><br>
<br>
Titulo: <#i_title#><br>
<br>
Puedes visitar la subasta aqui: <a href="<#c_siteurl#><#i_url#>"><#c_siteurl#><#i_url#></a><br>
<br>
Si has recibido este mensaje por error, por favor responde este email o<br>
escribe a <a href="mailto:<#c_adminemail#>"><#c_adminemail#></a>.<br>
<br>
Gracias por visitar <#c_sitename#> en <a href="<#c_siteurl#>"><#c_siteurl#></a>.