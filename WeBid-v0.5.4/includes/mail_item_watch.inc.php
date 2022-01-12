<?php
if(!defined('INCLUDED')) exit("Access denied");
$message = "Hello $user_name,<br>
<br>
This is an automatic response from Your Item Watch. <br>
Someone has bid on an item you have added to your item watch list.<br>
<br>
Auction Title: $auc_title <br>
<br>
Current Bid: $new_bid2 <br>
<br>
Auction URL:<br>
$auction_url";

mail($e_mail,"$sitename - Item Watch",$message,"From:$SETTINGS[sitename] <$SETTINGS[adminmail]>\nReplyTo:$SETTNGS[adminmail]"); 

?>