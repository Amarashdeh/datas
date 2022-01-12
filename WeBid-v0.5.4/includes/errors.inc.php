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
 
if(!defined('INCLUDED')) exit("Access denied");

#// Errors handling functions
if(!function_exists(openeLogFile))
{
	function openeLogFile () {
		global $logFileHandle, $logPath;
		global $cronScriptHTMLOutput;
	
		$logFileHandle = @fopen ($logPath.'error.log', "a");
	}
}

if(!function_exists(closeeLogFile))
{
	function closeeLogFile () {
		global $logFileHandle;
		global $cronScriptHTMLOutput;
	
		if ($logFileHandle)
			fclose ($logFileHandle);
	}
}

if(!function_exists(printeLog))
{
	function printeLog ($str) {
		global $logFileHandle;
		global $cronScriptHTMLOutput;
	
		if ($logFileHandle) {
			if (substr($str, strlen($str)-1, 1) != "\n")
				$str .= "\n";
			fwrite ($logFileHandle, $str);
			if ($cronScriptHTMLOutput)
				print "" . $str;
		}
	}
}
	
if(!function_exists(MySQLError))
{
	function MySQLError($Q)
	{
		global 	$SESSION_NAME,
				$SESSION_ERROR,
				$ERR_0001,
				$main_path;
		
		$SESSION_ERROR = $ERR_001."\t".$Q."\n\t".mysql_error();
		$_SESSION["SESSION_ERROR"]=$SESSION_ERROR;
		openeLogFile();
		printeLog(date('d-m-Y, H:i:s').':: '.$SESSION_ERROR);
		closeeLogFile();
		header('location: '.$main_path.'error.php');
		
		return;
	}
}
?>