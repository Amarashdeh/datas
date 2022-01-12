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
require('./includes/config.inc.php');
$SETTINGS['bidfind'] = @mysql_result(@mysql_query("SELECT bidfind FROM ".$DBPrefix."bidfind"),0,"bidfind");
if($SETTINGS['bidfind'] != 'enabled') return;
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
	
?>
<HTML><HEAD><TITLE>BidFind MegaList at PHPAuction</title></head><BODY><P> All format and contents of this page are under BidFind copyright and BidFind reserves all rights.<BR>Copying in whole or part are prohibited. Access to this page is limited to BidFind services.<BR>BidFind is a registerd trademark<BR></p><VERSION>V.1.7<BR>
<?php
	$query="SELECT * FROM ".$DBPrefix."auctions WHERE private='n' AND closed='0' AND suspended=0 AND starts<='".$NOW."'
			ORDER BY starts DESC LIMIT 2500";
	$res = mysql_query($query);
	if(!$res)
	{
		MySQLError($query);
		exit;
	}
	elseif(mysql_num_rows($res) > 0)
	{
		while($f = mysql_fetch_array($res))
		{
			unset($tok);
			unset($DESCR);
			#// Create a resume of the description
			$f['description'] = eregi_replace("&lt;","<",$f['description']);
			$f['description'] = eregi_replace("&gt;",">",$f['description']);
			$f['description'] = eregi_replace('>','> ',$f['description']);
			$f['description'] = eregi_replace("<[^>]*>",'',$f['description']);
			$f['description'] = eregi_replace("\n"," ",$f['description']);
			$f['description'] = eregi_replace("\r"," ",$f['description']);
			$f['description'] = eregi_replace("\t"," ",$f['description']);
			$f['description'] = eregi_replace("(\\\)*","",$f['description']);
			$f['description'] = eregi_replace("\"","",$f['description']);	
			$f['description'] = eregi_replace("'","",$f['description']);
			$f['description'] = eregi_replace("\&quot;","",$f['description']);
			$f['description'] = eregi_replace("(\.)+",'.',$f['description']);
			$f['description'] = eregi_replace("[{}]+",'',$f['description']);
			$f['description'] = str_replace(" ? ",' ',$f['description']);
			$f['description'] = str_replace(" ! ",' ',$f['description']);
			
			unset($replacement);
			$pattern = array("/\s\&*\s/",
							"/\s[!]+\s/",
							"/\s[?]+\s/",
							"/\s#*\s/",
							"/\s\^*\s/",
							"/\s[\$]*\s/",
							"/\s[\*]*\s/",
							"/\s[@]*\s/",
							"/\s[\)]*\s/",
							"/\s[\(]*\s/",
							"/\s[=]*\s/",
							"/\s[_]*\s/",
							"/\s[-]*\s/",
							"/\s[\~]*\s/",
							"/\s[`]*\s/",
							"/\s\&[0-9]*;\s/",
							"/\s;\s/",
							"/\s:\s/",
							);
			for($i=0;$i<count($pattern);$i++) {
				$replacement[] = " ";
			}
			$f['description'] = preg_replace($pattern,$replacement,$f['description']);
			$pattern = array("/[\&]+/",
							"/[!]+/",
							"/[#]+/",
							"/[\^]+/",
							"/[\$]+/",
							"/[\*]+/",
							"/[@]+/",
							"/[\)]+/",
							"/[\(]+/",
							"/[?]+/",
							"/[%]+/",
							"/[`]+/",
							"/\&[0-9]+;/",
							"/'/",
							"/\&[a-z A-Z]+;/",
							"/\|/",
							);
			$replacement = array("&","!","#","","$","*","@"," "," ","?","%","","","","","");
			$f['description'] = preg_replace($pattern,$replacement,$f['description']);

			for($L=65;$L<=90;$L++){
				$pattern = "/\s[".chr($L)."]{1 *}\s/";
				$f['description'] = preg_replace($pattern," ",$f['description']);
			}
			for($L=97;$L<=122;$L++){
				$pattern = "/\s[".chr($L)."]{1 *}\s/";
				$f['description'] = preg_replace($pattern," ",$f['description']);
			}
			$f['description'] = preg_replace('/\s+/',' ',$f['description']);
			$DES = $f['description'];
			$DES = strip_tags(html_entity_decode($f['description']));
			$tok = strtok($DES, " ");
			$charcount = 0;
			while ($tok && $charcount<250) {
				$DESCR .= " ".$tok;
				$charcount += strlen($tok);
				$tok = strtok(" ");
			}
			#// Get user's nick
			$USERNICK = @mysql_result(@mysql_query("SELECT nick FROM ".$DBPrefix."users WHERE id='".$f['user']."'"),0,"nick");
			$row="<ITEM>auction<ITEMURL>".$SETTINGS[siteurl]."item.php?id=".$f["id"]."<ITEMTITLE>".stripslashes($f["title"])."<DESCRIPTION>".trim($DESCR)."<PRICE>".print_money($f["minimum_bid"]);
			// Find category
			$query2 = "SELECT cat_id,parent_id,cat_name FROM ".$DBPrefix."categories WHERE cat_id='".$f["category"]."'";
			$result = mysql_query($query2);
			if (!$result)
			{
				MySQLError($query2);
				exit;
			}
			$result     = mysql_fetch_array ( $result );
			$parent_id  = $result[parent_id];
			$cat_id     = $categories;
			$j = $f['category'];
			$i = 0;
			do {
				$query = "SELECT cat_id,parent_id,cat_name FROM ".$DBPrefix."categories WHERE cat_id='$j'";
				$result = mysql_query($query);
				if ( !$result )
				{
					MySQLError($query);
					exit;
				}
				$result = mysql_fetch_array ( $result );
				if ( $result )
				{
					$parent_id  = $result[parent_id];
					$c_name[$i] = $result[cat_name];
					$c_id[$i]   = $result[cat_id];
					$i++;
					$j = $parent_id;
				} else {
					$parent_id=0;
					$error=1;
					// error message: cat not exists
					//print "<CENTER>$err_font $ERR_620 </FONT></CENTER>";
				}
			} while ($parent_id != 0);
			$TPL_cat_value="";
			if($error==0){
				for ($j=$i-1; $j>=0; $j--)
				{
					if ( $j != 0)
					{
						$TPL_cat_value .= $c_name[$j];
					}
					else
					{
					 $TPL_cat_value .= ":".$c_name[$j];
					}
				}
			}
			else{$TPL_cat_value="NA";}

			$row.="<CAT>".$TPL_cat_value;
			$day = substr($f["ends"],6,2);
			$month = substr($f["ends"],4,2);
			$year = substr($f["ends"],0,4);
			$date = "$month/$day";

			$row.="<MANUF>NA<LOCALE>NA<POSTDATE>NA<ENDS>".$date."<SELLER>".$USERNICK;
			#// Disable image untill thumbnails
			//$f["pict_url"] = "";
			if ($f["pict_url"]!=""){
				$pos = strpos ($f["pict_url"],"http://");
				if ($pos===false) {
					$img=$SETTINGS[siteurl]."getthumb.php?w=".$SETTINGS['thimbnailswidth']."&fromfile=$uploaded_path".$f['pict_url'];
				}
				else{
					$img=$f["pict_url"];
				}
			}
			else{$img="NA";}
			$row.="<TINYURL>".$img."<BR>\n";
			print $row;
		}
	}
?>
</body></html>
