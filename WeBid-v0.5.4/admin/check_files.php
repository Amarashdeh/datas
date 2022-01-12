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

	  $err_font = "<FONT FACE=\"Verdana,Arial,Helvetica\" SIZE=\"2\" COLOR=red>";
	  $std_font = "<FONT FACE=\"Verdana,Arial,Helvetica\" SIZE=\"3\">";

function files($dir, $pattern = "-no-pattern-") {

    $direc = (is_dir($dir)) ? $direc = $dir : $direc = dirname($dir);
    if (isset($direc)):
        $dh = opendir($direc);
    else:
        return false;
    endif;
	$i=0;
    while ($file = readdir($dh)) {
        if (is_file("${direc}/${file}") && (ereg("$pattern", "$file") ||
        $pattern == "-no-pattern-"))

             $file_list[] = $file;
	 $i++;
    }

    closedir($dh);
return $i-2;

}

$dir_root=files("../");
$dir_admin=files("../admin");
$dir_includes=files("../includes");
$dir_templates=files("../templates");
$dir_sql=files("../sql");
$dir_phpAdsNew=files("../phpAdsNew");

echo "$std_font Checking files in directories...<br><font size=\"2\">";
if ($dir_root >= 53)
	{ $msg.="root directory ... Ok<br>"; }
	else
	{ $msg.="root directory ... $err_font Files missing</font><br>"; 	}
if ($dir_admin >= 45)
	{ $msg.="admin directory ... Ok<br>"; }
	else
	{ $msg.="admin directory ... $err_font Files missing</font><br>"; 	}
if ($dir_includes >= 36)
	{ $msg.="includes directory ... Ok<br>"; }
	else
	{ $msg.="includes directory ... $err_font Files missing</font><br>"; 	}
if ($dir_templates >= 45)
	{ $msg.="templates directory ... Ok<br>"; }
	else
	{ $msg.="templates directory ... $err_font Files missing</font><br>"; 	}
if ($dir_sql >= 2)
	{ $msg.="sql directory ... Ok<br>"; }
	else
	{ $msg.="sql directory ... $err_font Files missing</font><br>"; 	}
if ($dir_phpAdsNew >= 29)
	{ $msg.="phpAdsNew directory ... Ok<br>"; }
	else
	{ $msg.="phpAdsNew directory ... $err_font Files missing</font><br>"; 	}
?>