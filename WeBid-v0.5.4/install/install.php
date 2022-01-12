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
<h1>WeBid Installer v0.5.4</h1>
<p>Please make sure you've followed all the steps in the readme located in the docs folder before running this else it will not work.</p>
<?php
if(empty($DbHost) || empty($DbUser) || empty($DbPassword) || empty($DbDatabase)){
	echo '<p>You must enter your database details into includes/passwd.inc.php before running this script</p>';
}
if(isset($_GET['URL'])){
$siteURL = $_GET['URL'];
include('../includes/passwd.inc.php');
include('sql/dump.inc.php');
if(!mysql_connect($DbHost, $DbUser, $DbPassword)){
	echo '<p>Cannot connect to '.$DbHost.'</p>';
}
if(!mysql_select_db($DbDatabase)){
	echo '<p>Cannot select database</p>';
}
echo ($_GET['n']*25) . '% Complete<br>';
$from = (isset($_GET['from'])) ? $_GET['from'] : 0;
$fourth = floor(count($query)/4);
$to = ($_GET['n'] == 4) ? count($query) : $fourth*$_GET['n'];
for($i = $from; $i < $to; $i++){
	mysql_query($query[$i]) or die(mysql_error()."\n".$query[$i]);
}
if($i < count($query))
	echo '<script type="text/javascript">window.location = "install.php?URL='.$_GET['URL'].'&n='.($_GET['n']+1).'&from='.($i+1).'";</script>';
else {
?>
Now please delete the install folder from your server
<?php
}
} else {
?>
<form action="" method="get">
Please enter the url of your webid installation including trailing slash
<input name="URL" type="text" value="http://">
<input name="n" type="hidden" value="1">
<input value="submit" type="submit">
</form>
<?php } ?>