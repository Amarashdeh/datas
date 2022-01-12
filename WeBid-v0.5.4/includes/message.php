<?php
session_start();
//check users logged in

if(!isset($_SESSION["PHPAUCTION_LOGGED_IN"])) {
	Header("Location: user_login.php");
	exit;
}

include("config.inc.php");
	   
//get message info + set cookies for if an error occours
$sendto = $_POST['sendto'];
$_SESSION['sendto'] = $sendto;
$subject = $_POST['subject'];
$_SESSION['subject'] = $subject;
$message = $_POST['message'];
$_SESSION['messagecont'] = $message;	   

//check user exists
$sql = "SELECT * FROM ".$DBPrefix."users WHERE nick='$sendto'";
$run = mysql_query($sql) or die($sql.mysql_error());
$usercheck = mysql_num_rows($run);
if($usercheck == '0')
{	   
	$_SESSION['message'] = "This user doesn't exist";
	header('location: ../mail.php?x=1');
	exit;
}
$userarray = mysql_fetch_array($run);
$sendtoid = $userarray['id'];
$acceptsmail = $userarray['acceptpm'];
	   
//check user accepts mail
if($acceptsmail == '1')
{	   
	$_SESSION['message'] = "This user doesn't accept messages";
	header('location: http://www.roeonline.co.uk/mail.php');
	exit;
}
//check use mailbox insnt full
$sql = mysql_query("SELECT * FROM ".$DBPrefix."messages WHERE sentto='$sendtoid'");
$mailboxsize = mysql_num_rows($sql);
if($mailboxsize >= '30'){
	$_SESSION['message'] = "$sendto currently has a full inbox at the moment please try again later";
	header('location: ../mail.php');
	exit;
}
//send message
$time = date('d/m/y, H:i:s');
$nowmessage = nl2br($message);
$userid = $_SESSION['PHPAUCTION_LOGGED_IN'];
$sql = "INSERT INTO ".$DBPrefix."messages( `sentto` , `from` , `when` , `message` , `subject` )  VALUES ('$sendtoid', '$userid', '$time', '$nowmessage', '$subject')";
$run = mysql_query($sql) or die($sql.mysql_error());


if(isset($_SESSION['reply']))
{
	$reply = $_SESSION['reply'];
	$sql = "UPDATE ".$DBPrefix."messages SET replied='1' WHERE id='$reply'";
	$run = mysql_query($sql);
	unset($_SESSION['reply']);
}

//delete session of sent message
unset($_SESSION['messagecont']);
unset($_SESSION['subject']);
unset($_SESSION['sendto']);

//forward to correct page
header('location: ../mail.php');
?>