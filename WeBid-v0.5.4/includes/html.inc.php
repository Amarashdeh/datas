<?php
if(!defined('INCLUDED')) exit("Access denied");
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


	$HTMLTAGS = array("<B>",
				  "</B>",
				  "<I>",
				  "</I>",
				  "<U>",
				  "</U>",
				  "<STRONG>",
				  "</STRONG>",
				  "<UL>",
				  "<OL>",
				  "<LI>",
				  "</LI>",
				  "</LO>",
				  "</LU>",
				  "<H1>",
				  "</H1>",
				  "<H2>",
				  "</H2>",
				  "<H3>",
				  "</H3>",
				  "<H4>",
				  "</H4>",
				  "</H5>",
				  "<H5>",
				  "<H6>",
				  "</H6>",
				  "<FONT [a-z0-9=]*>",
				  "</FONT>",
				  "<P>",
				  "</P>");

	Function DropHtml($str)
	{
		global $HTMLTAGS;

		reset($HTMLTAGS);

		while(list($k,$v) = each($HTMLTAGS))
		{
			$repl = '';
			$str = eregi_replace($v,$repl,$str);
		}

		return strval($str);
	}






?>
