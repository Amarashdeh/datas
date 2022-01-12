<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
	<?php
	/* load settings */
	if (!isset($_CONFIG))
		require 'config.php';
	?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>WebChess Login</title>
</head>

<body>
<h2>WebChess Login</h2>

<form method="post" action="mainmenu.php">
<p>
	Nick: <input name="txtNick" type="text" size="15" />
	<br />
	Password: <input name="pwdPassword" type="password" size="15" />
</p>

<p>
	<input name="ToDo" value="Login" type="hidden" />
	<input name="login" value="login" type="submit" />
	<?php 
	if($CFG_NEW_USERS_ALLOWED==true)
	{
	?>
	<input name="newAccount" value="New Account" type="button" onClick="window.open('newuser.php', '_self')"/>
	<?php
	}
	?>
</p>
</form>

<p>Version 0.9.0, last updated September 2nd, 2004</p>

</body>
</html>
