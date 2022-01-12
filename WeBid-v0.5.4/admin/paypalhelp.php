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
?>
<HTML>
<HEAD>
<TITLE>Phpauction.org</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type="text/css"><!--.bluelink {  font: 10pt Verdana, Arial, Helvetica, sans-serif; color: 000066; text-decoration: none}--></STYLE>
</HEAD>
<BODY bgcolor="#FFFFFF">
<P>&nbsp;</P>
	<CENTER>
		<P><B><FONT FACE="Verdana, Arial, Helvetica, sans-serif" SIZE="4" COLOR="#000066">Set 		up your PayPal</FONT></B> <B><FONT FACE="Verdana, Arial, Helvetica, sans-serif" SIZE="4" COLOR="#000066">Account</FONT></B></P>
			<TABLE width="352" border="0" cellspacing="0" cellpadding="0">
				<TR>
					<TD>
					<P><FONT FACE="Tahoma, Verdana" SIZE="2">To be able to charge 					the users of your auction site, you need to have a <A HREF="http://www.paypal.com" TARGET="_blank">Paypal</A> 					account set up.<BR>					<BR>          From your PHPauction administration back-end, under the <B>SETTINGS</B>           tab, <I>( PayPal E-mail Address</I> option) the only thing you have           to do is to fill in the e-mail address you chose as your <A HREF="http://www.paypal.com" TARGET="_blank">Paypal</A>           e-mail account address.<BR>					<BR>          When a user goes to the <A HREF="http://www.paypal.com" TARGET="_blank">Paypal</A>           web site to pay one of the fees you set up, <A HREF="http://www.paypal.com" TARGET="_blank">Paypal</A>           returns the transaction's information to a PHPauction script which is           responsible for updating the database tables according to the outcome           of the transaction. This script is <B>notification.php</B> and is stored           in the main directory of the PHPauction distribution.</FONT></P>				        <P><FONT FACE="Tahoma, Verdana" SIZE="2">Before you can begin taking payments,           you must tell <A HREF="http://www.paypal.com" TARGET="_blank">Paypal</A>           where this script is:</FONT></P>				<UL>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Go to <A HREF="http://www.paypal.com" TARGET="_blank">Paypal</A> 						site</FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Log in</FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Go to your <B>My 						Account </B> page</FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Choose <B>Preferences</B></FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Choose<B> Instant 						Payment Notification<BR>						Preferences</B></FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Click on the <B>Edit 						button</B> </FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">Activate the <B>Instant 						Payment Notification Option</B></FONT></LI>					<LI><FONT FACE="Tahoma, Verdana" SIZE="2">in the url field 						write the complete path to <B>notification.php</B> in 						your PHPauction installation.<BR>						I.e. if you installed PHPauction at http://www.yoursite.com/ 						the Instant Payment Notification URL will be http://www.yoursite.com/notification.php</FONT></LI>				</UL>				<P><FONT FACE="Tahoma, Verdana" SIZE="2"><BR>					<BR>					</FONT></P>				<CENTER>					<P align="center"><A href="javascript:window.close()" class="bluelink">Close</A></P>				</CENTER>
					</TD>
				</TR>
			</TABLE>
	</CENTER>
</BODY>
</HTML>