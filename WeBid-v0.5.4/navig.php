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
if (!$_GET[thepage]) {
	echo "page not defined.";
	die();
	}
if (!$_GET[thestyle]) {
	echo "style not defined.";
	die();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
	<title>CSS Editor Navigation</title>
	<meta name="copyright" content="pixy@pixy.cz" />
	<style type="text/css">
	* html dl.sty-bar dd a	{ display: inline; }
	* html dl.sty-bar dd.active	{ margin: -3px 0 0 0; border-width: 0; line-height: 1.9em; }
	html * dl.sty-bar	{ display: table; float: none; }
	dl.sty-bar	{ margin: 0 0 .5em 0; padding: 3px 0 0 0; width: auto; float: left; line-height: 1.6em; border-style: solid; border-color: navy; font-size: small; font-variant: small-caps; background-color: transparent; border-width: 0 0 1px 0; }
	dl.sty-bar dd	{ margin: 1px -6px -1px 5px; padding: 0; float: left; border-width: 0 0 0 1px; border-style: solid; border-color: navy; }
	dl.sty-bar dd a	{ display: table-cell; padding: 0 .5em; color: #5355df; text-decoration: none; white-space: nowrap; font-weight: bold; }
	dl.sty-bar dd.active > a	{ margin: -3px 1px -1px -1px; border-width: 0 0 3px 0; border-style: solid; border-color: aqua; }
	dl.sty-bar dd.active a	{ color: aqua; border-width: 1px 1px 1px 1px; border-style: solid; border-color: #990000 #990000 #ffffff #990000; }
	dl.sty-bar dt.help	{ float: left; padding: 2px 6px; margin: 0 0 0 -2px; line-height: 1.6em; font-weight: bold; }
	dl.sty-bar dd a:hover	{ color: navy; background-color: silver; text-decoration: none; }
	dl.sty-bar dd.active a:hover	{ text-decoration: underline; color: aqua; background-color: white; }
	</style>
</head>
<body>
<div>
<dl class="sty-bar">
<?php
$path1="test.php?thepage=".rawurlencode($_GET[thepage])."&thestyle=".rawurlencode($_GET[thestyle]);
$path2="test.php?thepage=".rawurlencode($_GET[thepage])."&thestyle=".rawurlencode($_GET[thestyle])."&editOn=yes";
echo "<dt class='help'>Style:".$_GET[thestyle]."</dt>";
echo "<dd><a href='$_GET[thepage]' target='page'>View and navigate</a></dd>";
echo "<dd><a href='$path1' target='page'>View styled page</a></dd>";
echo "<dd><a href='$path2' target='page'>Edit style</a></dd>";
echo "<dd><a href='editstylesheet.php?thepage=".rawurlencode($_GET[thepage])."&thestyle=".rawurlencode($_GET[thestyle])."' target='page'>View stylesheet</a></dd>";
echo "<dd><a href='$_GET[thepage]' target='_top'>Exit from editing</a></dd>";
?>
</dl>
</div>
</body>
</html>
