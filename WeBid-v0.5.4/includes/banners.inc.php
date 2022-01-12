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

#// ====================
#// Banners functions **
#// ====================

if(!function_exists(view)) {
	function view() {
		global $SETTINGS, $DBPrefix;
		global $HTTPS;
		unset($BANNERSARRAY);
		unset($THISBANNER);

		$query = "SELECT * FROM ".$DBPrefix."bannerssettings";
		$res_settings = mysql_query($query);
		$BANNERSETTINGS = mysql_fetch_array($res_settings);

		#// First try to retrieve banners according the filters

		#// ================================================================
		#// Categories filter
		#// ================================================================
		
		if(strstr($_SERVER['SCRIPT_FILENAME'],"browse.php")) {
			$query = "SELECT * FROM ".$DBPrefix."bannerscategories WHERE category=".intval($GLOBALS['id']);
			$res = mysql_query($query);
			if($res && @mysql_num_rows($res) > 0) {
				#// We have at least one banners to show
				while($row = mysql_fetch_array($res)) {
					$BANNERSARRAY[] = $row;
				}

				#// Pick a random element
				srand ((float) microtime() * 10000000);
				if(is_array($BANNERSARRAY)) {
					$RAND_IDX = array_rand($BANNERSARRAY);
					$BANNERTOSHOW = $BANNERSARRAY[$RAND_IDX][banner];
				}
			}
			
		}
		#// ================================================================
		#// Keywords filter
		#// ================================================================
		elseif(strstr($_SERVER['SCRIPT_FILENAME'], 'item.php') || basename($_SERVER['SCRIPT_FILENAME']) == 'bidhistory.php') {
			$query = "SELECT *
			         FROM ".$DBPrefix."bannerskeywords
			         WHERE
			         INSTR('".$GLOBALS['title']."', keyword) OR
			         INSTR('".$GLOBALS['description']."', keyword)";
			$res = mysql_query($query);
			if($res && @mysql_num_rows($res) > 0) {
				#// We have at least one banners to show
				while($row = mysql_fetch_array($res)) {
					$BANNERSARRAY[] = $row;
				}
			}
			$query = "SELECT * FROM ".$DBPrefix."bannerscategories WHERE category=".$GLOBALS['category'];
			$res = mysql_query($query);
			if($res && @mysql_num_rows($res) > 0) {
				#// We have at least one banners to show
				while($row = mysql_fetch_array($res)) {
					$BANNERSARRAY[] = $row;
				}
			}
			#// Pick a random element
			srand ((float) microtime() * 10000000);
			if(is_array($BANNERSARRAY)) {
				$RAND_IDX = array_rand($BANNERSARRAY);
				$BANNERTOSHOW = $BANNERSARRAY[$RAND_IDX][banner];
			}
		}


		#// We cannot apply filters in this page - let's retrieve a random banner
		if(empty($BANNERTOSHOW)) {
			$query = "SELECT * FROM ".$DBPrefix."banners ";
			if($BANNERSETTINGS[sizetype] == 'fix') {
				$query .= " WHERE width=$BANNERSETTINGS[width] AND height=$BANNERSETTINGS[height] ";
			} else {
				$query .= " WHERE 1";
			}

			$query .= " AND ((views < purchased AND purchased > 0) OR (purchased = 0))";
			$res = mysql_query($query);

			if($res && @mysql_num_rows($res) > 0) {
				$C = 0;

				#// We have at least one banners to show

				while($row = mysql_fetch_array($res)) {
					$C = @mysql_num_rows(mysql_query("SELECT banner FROM ".$DBPrefix."bannerscategories WHERE banner=$row[id]"));
					$CC = @mysql_num_rows(mysql_query("SELECT banner FROM ".$DBPrefix."bannerskeywords WHERE banner=$row[id]"));

					if($C == 0 && $CC == 0) {
						$BANNERSARRAY[] = $row;
					}
				}
			}

			#// Pick a random element
			srand ((float) microtime() * 10000000);
			if(is_array($BANNERSARRAY)) {
				$RAND_IDX = array_rand($BANNERSARRAY);
				$BANNERTOSHOW = $BANNERSARRAY[$RAND_IDX][id];
			}
		}



		#// ========================================================================================================================
		#// Display banner
		#// ========================================================================================================================
		if(isset($BANNERTOSHOW)) {
			$query = "SELECT * FROM ".$DBPrefix."banners WHERE id=$BANNERTOSHOW";
			$ress = @mysql_query($query);
			if($ress) {
				$THISBANNER = mysql_fetch_array($ress);
				if($THISBANNER[type] == 'swf') {
					if($HTTPS == "on" || $HTTPS == "1")
						$codebase="https://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
					else
						$codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
				?>

						  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="<?=$codebase?>" width="468" height="60">
						  <param name=movie value="<?=$SETTINGS['siteurl'].$GLOBALS['uploaded_path'].'banners/'.$THISBANNER[user].'/'.$THISBANNER[name]?>" />
						  <param name=quality value=high />
							<embed src="<?=$SETTINGS['siteurl'].$GLOBALS['uploaded_path'].'banners/'.$THISBANNER[user].'/'.$THISBANNER[name]?>" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="<?=$THISBANNER[width]?>" height="<?=$THISBANNER[height]?>"> </embed>
						  </object>
				   <?php
			   } else {
			   if(strstr($_SERVER["SCRIPT_FILENAME"],"stores")) {
				   $UPLD = "uploaded/";
				   //$UPLD = "../../uploaded/";
			   }
			   else {
				   $UPLD = $GLOBALS['uploaded_path'];
			   }
			   ?>
			   <a href="<?=$SETTINGS['siteurl']?>clickthrough.php?banner=<?=$THISBANNER['id']?>&url=<?=$THISBANNER['url']?>" target="_blank"> <img border=0 alt="<?=$THISBANNER['alt']?>" src="<?=$SETTINGS['siteurl'].$UPLD?>banners/<?=$THISBANNER['user']?>/<?=$THISBANNER['name']?>" /></a>
					   <?php
				   }
				   if(!empty($THISBANNER[sponsortext])) {
					   ?>
					   <br>
					   <a href="<?=$SETTINGS['siteurl']?>clickthrough.php?banner=<?=$THISBANNER['id']?>&url=<?=$THISBANNER['url']?>" target="_blank">
							   <?=$THISBANNER['sponsortext']?>
								  </a>
								  <?php
							  }
							  #// Update views
							  @mysql_query("UPDATE ".$DBPrefix."banners set views=views+1 WHERE id=".$THISBANNER['id']);
			}
		}
		#// ========================================================================================================================

	}
}
?>
