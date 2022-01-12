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

include "./includes/config.inc.php";

#// If user is not logged in redirect to login page
if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}

$x = (isset($_GET['x']))? $_GET['x'] : '';
$u = (isset($_GET['u']))? $_GET['u'] : '';
$replymessage = (isset($_GET['message']))? $_GET['message'] : '';
$order = (isset($_GET['order']))? $_GET['order'] : '';
$action = (isset($_GET['action']))? $_GET['action'] : '';
$messageid = (isset($_GET['id']))? $_GET['id'] : '';
$delete = (isset($_POST['delete']))? $_POST['delete'] : NULL;
$userid = $_SESSION['PHPAUCTION_LOGGED_IN'];

//delete messages
if($action == 'delete')
{
	$sql = "DELETE FROM ".$DBPrefix."messages WHERE id='$messageid'";
	$run = mysql_query($sql) or die($sql.mysql_error());
	$_SESSION['message'] = "Message removed";
}

if(isset($delete)){
	$temparr = $_POST['deleteid'];
	$message_id = 0;
	for($x = 0; $x < count($temparr); $x++){
		$message_id .= ','.$temparr[$x];
	}
	$sql = "DELETE FROM ".$DBPrefix."messages WHERE id IN ($message_id)";
	$run = mysql_query($sql) or die($sql.mysql_error());
	$_SESSION['message'] = "Messages removed";
}

$TPL_error = $_SESSION['message'];

//if sending a message
if($x == 1)
{
	if(!empty($_SESSION['msg'.$replymessage])){
		$messagecont = str_replace('<br>', '', $_SESSION['msg'.$replymessage]); //clean message
	}
	$subject = $_SESSION['subject'.$replymessage];
	$sendto = $_SESSION['sendto'.$replymessage];
	//if sent from userpage
	if($u > 0)
	{
		$sql = "SELECT * FROM ".$DBPrefix."users WHERE id='$u'";
		$run = mysql_query($sql) or die($sql.mysql_error());
		$array = mysql_fetch_array($run);
		$sendto = $array['nick'];
	}
	
	//get variables
	$TPL_sendto = $sendto;
	$TPL_subject = $subject;
	$TPL_message_cont = $messagecont;
}

	//table headers
	$sentfrom = "<a href=\"http://www.roeonline.co.uk/mail.php?order=3\">From</a>";
	$whensent = "<a href=\"http://www.roeonline.co.uk/mail.php?order=1\">Sent</a>";
	$title = "<a href=\"http://www.roeonline.co.uk/mail.php?order=5\">Title</a>";
	
	//order messages
	if($order == '1'){ 
		$sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' ORDER BY `id` DESC";
		$whensent = "<a href=\"http://www.roeonline.co.uk/mail.php?order=2\">Sent <img src=\"http://www.roeonline.co.uk/images/layout/arrow_down.bmp\"></a>"; 
	}
	else if($order == '2'){ 
		$sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' ORDER BY `id` ASC";
		$whensent = "<a href=\"http://www.roeonline.co.uk/mail.php?order=1\">Sent <img src=\"http://www.roeonline.co.uk/images/layout/arrow_up.bmp\"></a>"; 
	}
	else if($order == '3'){ 
		$sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' ORDER BY `from` DESC";
		$sentfrom = "<a href=\"http://www.roeonline.co.uk/mail.php?order=4\">From <img src=\"http://www.roeonline.co.uk/images/layout/arrow_down.bmp\"></a>"; 
	}
	else if($order == '4'){ 
		$sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' ORDER BY `from` ASC";
		$sentfrom = "<a href=\"http://www.roeonline.co.uk/mail.php?order=3\">From <img src=\"http://www.roeonline.co.uk/images/layout/arrow_up.bmp\"></a>"; 
	}
	else if($order == '5'){ 
		$sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' ORDER BY `subject` DESC";
		$title = "<a href=\"http://www.roeonline.co.uk/mail.php?order=6\">Title <img src=\"http://www.roeonline.co.uk/images/layout/arrow_down.bmp\"></a>"; 
	}
	else if($order == '6'){ 
		$sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto='$userid' ORDER BY `subject` ASC";
		$title = "<a href=\"http://www.roeonline.co.uk/mail.php?order=5\">Title <img src=\"http://www.roeonline.co.uk/images/layout/arrow_up.bmp\"></a>"; 
	}
	else { $sql = "SELECT * FROM ".$DBPrefix."messages WHERE sentto = '$userid' ORDER BY `id` DESC"; }
	//get users messages
	$run = mysql_query($sql) or die($sql.mysql_error());
	
	$messages = mysql_num_rows($run);
	
	//display number of messages
	$messagespaceused = ($messages*4)+1;
	$messagespaceleft = (30-$messages)*4;
	$messagesleft = 30-$messages;


$_SESSION['message'] = (isset($_SESSION['message']))?$_SESSION['message']:'';
unset($_SESSION['message']);

include "header.php";
if($x == 1) include phpa_include("template_mail-send_php.html");
include phpa_include("template_mail_php.html");
include "footer.php";

?>
