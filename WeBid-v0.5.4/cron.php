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
if(!isset($_SERVER['SCRIPT_NAME'])) $_SERVER['SCRIPT_NAME'] = 'cron.php';
include "./includes/passwd.inc.php";
include "./includes/config.inc.php";
include $include_path."converter.inc.php";
include $include_path."dates.inc.php";

function openLogFile () {
	global $logFileHandle, $logFileName;
	global $cronScriptHTMLOutput;

	$logFileHandle = @fopen ($logPath.'cron.log', "a");
	if ($cronScriptHTMLOutput == true)
		print "<PRE>\n";
}

function closeLogFile () {
	global $logFileHandle;
	global $cronScriptHTMLOutput;

	if ($logFileHandle)
		fclose ($logFileHandle);
	if ($cronScriptHTMLOutput)
		print "</PRE>\n";
}

function printLog ($str) {
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

function printLogL ($str, $level) {
	for($i = 1;$i <= $level;++$i)
		$str = "\t" . $str;
	printLog($str);
}

function errorLog ($str) {
	global $logFileHandle, $adminEmail;

	printLog ($str);
	/**
	* mail (
	* $adminEmail,
	* "An cron script error has occured",
	* $str,
	* "From: $adminEmail\n".
	* "Content-type: text/plain\n"
	* );
	*/
	closeLogFile();
	exit;
}

function errorLogSQL () {
	global $query;
	errorLog ("SQL query error: $query\n" . "Error: " . mysql_error());
}

function constructCategories() {
	global $DBPrefix;
	$query = "SELECT cat_id, parent_id, sub_counter, counter
	         FROM ".$DBPrefix."categories ORDER BY cat_id";
	$res = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_array($res)) {
		$row['updated']=false;
		$categories[$row['cat_id']]=$row;
	}
	return $categories;
}

// initialize cron script
openLogFile();
printLog("=============== STARTING CRON SCRIPT: " . date("F d, Y H:i:s"));

$categories=constructCategories();

/**
* ------------------------------------------------------------
* 1) "close" expired auctions
* closing auction means:
* a) update database:
* + "auctions" table
* + "categories" table - for counters
* + "counters" table
* b) send email to winner (if any) - passing seller's data
* c) send email to seller (reporting if there was a winner)
*/
printLog("++++++ Closing expired auctions");
$TIME = mktime(date("H")+$SETTINGS['timecorrection'],date("i"),date("s"),date("m"), date("d"),date("Y"));
$NOW = date("YmdHis",$TIME);
$NOWB = date("Ymd",$TIME);
$query = "SELECT * FROM ".$DBPrefix."auctions
         WHERE ends <='$NOW'
         AND ((closed='0')
         OR (closed='1'
         AND reserve_price > 0
         AND num_bids > 0
         AND current_bid < reserve_price
         AND sold='s'))";
printLog ($query);
$result = mysql_query($query);

if (!$result)
	errorLogSQL();
else {
	$num = mysql_num_rows($result);
	printLog($num . " auctions to close");

	$resultAUCTIONS = $result;
	$n = 1;
	while ($row = mysql_fetch_array($resultAUCTIONS)) { //loop auctions
		$n++;
		$Auction = $row;
		$Auction[description] = strip_tags($Auction[description]);
		printLog("\nProcessing auction: " . $row["id"]);
		// //======================================================
		// BEGINNING OF ITEM WATCH CODE Rida nr 247
		// //======================================================
		// Send notification if user added auction closes
		$ended_auction_id = $row['id'];
		$title = $row["title"];

		$resultUSERS = mysql_query("SELECT nick,email,item_watch FROM ".$DBPrefix."users");
		while ($watchusers = mysql_fetch_array($resultUSERS)) {
			$nickname = $watchusers['nick'];
			$e_mail = $watchusers['email'];
			$keyword = $watchusers['item_watch'];
			$key = split(" ", $keyword);
			for ($j = 0; $j < count($key); $j++) {
				$match = strpos($key[$j], $ended_auction_id);
			}
			// If keyword matches with opened auction title or/and desc send user a mail
			if ($match) {
				$sitename = $SETTINGS['sitename'];
				$auction_url = $SETTINGS['siteurl'] . "item.php?mode=1&id=" . $ended_auction_id;
				// Mail body and mail() functsion
				include (phpa_include("template_item_watch_endedmail_php.html"));
			}
		}
		//======================================================
		// END OF ITEM WATCH CODE
		//======================================================

		//************************************
		//  update category tables
		//*************************************
		$cat_id = $row["category"];
		$root_cat = $cat_id;
		do {
			// update counter for this category
			$R_parent_id = $categories[$cat_id]['parent_id'];
			$R_cat_id = $categories[$cat_id]['cat_id'];
			$R_counter = intval($categories[$cat_id]['counter']);
			$R_sub_counter = intval($categories[$cat_id]['sub_counter']);
			$R_sub_counter--;
			if ($cat_id == $root_cat)
				--$R_counter;
			if ($R_counter < 0)
				$R_counter = 0;
			if ($R_sub_counter < 0)
				$R_sub_counter = 0;
			$categories[$cat_id]['counter']=$R_counter;
			$categories[$cat_id]['sub_counter']=$R_sub_counter;
			$categories[$cat_id]['updated']=true;
			$cat_id = $R_parent_id;
		} while ($cat_id != 0 && isset($categories[$cat_id]));
		// update "counters" table - decrease number of auctions
		$query = "UPDATE ".$DBPrefix."counters SET auctions=(auctions-1),
		         closedauctions=(closedauctions+1)";
		printLogL($query, 1);
		if (!mysql_query($query))
			errorLogSQL();
		// //************************************
		// //  RETRIEVE SELLER INFO FROM DATABASE
		// //*************************************
		$query = "SELECT * FROM ".$DBPrefix."users WHERE id='" . $Auction["user"] . "'";
		printLogL($query, 1);
		$result = mysql_query ($query);
		if ($result) {
			if (mysql_num_rows($result) > 0) {
				mysql_data_seek ($result, 0);
				$Seller = mysql_fetch_array($result);
			} else
				$Seller = array();
		} else
			errorLogSQL();
		// //**************************************************
		// // check if there is a winner - and get his info
		// //***************************************************
		$winner_present = false;
		$query = "SELECT * FROM ".$DBPrefix."bids WHERE auction='" . $row['id'] . "' ORDER BY bid DESC";
		printLogL($query, 1);
		$result = mysql_query ($query);
		if ($result) {
			if (mysql_num_rows($result) > 0 and ($row['current_bid'] >= $row['reserve_price'] || $row['sold']=='s')) {
				$decrem = mysql_num_rows($result);
				mysql_data_seek($result, 0);
				$WinnerBid = mysql_fetch_array($result);
				$WinnerBid['quantity'] = $row['quantity'];
				$winner_present = true;
				// //  RETRIEVE WINNER INFO FROM DATABASE
				$query = "SELECT * FROM ".$DBPrefix."users WHERE id='" . $WinnerBid['bidder'] . "'";
				$result = mysql_query ($query);
				if ($result) {
					if (mysql_num_rows($result) > 0) {
						mysql_data_seek ($result, 0);
						$Winner = mysql_fetch_array($result);
					} else
						$Winner = array ();
				} else
					errorLogSQL();
			}
		} else
			errorLogSQL();
		/**
		* send email to seller - to notify him
		* create a "report" to seller depending of what kind auction is
		*/
		$atype = intval($Auction["auction_type"]);
		if ($atype == 1) {
			$WINNING_BID = $Auction[current_bid];
			/**
			* Standard auction
			*/
			if ($winner_present) {
        		$report_text = $Winner["nick"] . " (<a href='mailto:".$Winner["email"]."'>". $Winner["email"] . "</a>)\n";
				if($SETTINGS['winner_address'] == 'y'){
					$report_text .= $MSG_30_0086.$Winner['address']." ".$Winner['city']." ".$Winner['zip']." "." ".$Winner['prov'].", ".$Winner['country'];
				}
				// // Add winner's data to "winners" table
				$query = "INSERT INTO ".$DBPrefix."winners VALUES (NULL,'" . $Auction['id'] . "','" . $Seller['id'] . "','" . $Winner['id'] . "'," . $Auction['current_bid'] . ",'$NOW',0)";
				$res = @mysql_query($query);
				/**
				* Update column bid in table ".$DBPrefix."counters
				*/
				$counterbid = mysql_query("UPDATE ".$DBPrefix."counters SET bids=(bids-$decrem)");
			} else {
				$report_text = $MSG_429;
			}
		} else {
			// //**************************************************
			// //  		 Dutch Auction
			// //***************************************************
			unset($WINNERS_NICK);
			unset($WINNERS_EMAIL);
			unset($WINNERS_NAME);
			unset($WINNERS_QUANT);
			unset($WINNERS_BIDQUANT);
			$report_text = "";
			// find out last bids for evey bidder
			$sql = "SELECT max(id) as mid
			       FROM ".$DBPrefix."bids
			       WHERE auction =  '" . $Auction['id'] . "' GROUP BY bidder";
			$reint = mysql_query ($sql);
			$iarr = array();
			if ($reint) {
				while ($rwint = mysql_fetch_array($reint))
					$iarr[] = $rwint['mid'];
			}
			// find out winners sorted by bid
			if(count($iarr) > 0) {
				$incl = "(" . join(",", $iarr) . ")";
				$query = "SELECT * FROM ".$DBPrefix."bids WHERE id in $incl ORDER BY bid DESC";
				$res = mysql_query ($query);
				if ($res) {
					$numDbids = mysql_num_rows($res);
					/**
					* Update column bid in table ".$DBPrefix."counters
					*/
					$counterbid = mysql_query("UPDATE ".$DBPrefix."counters SET bids=(bids-$numDbids)");
					if ($numDbids == 0) {
						$report_text = "No bids";
					} else {
						$WINNERS_ID = array();
						$report_text = "";
						$WINNING_BID = $WinnerBid['bid'];
						$items_count = $Auction["quantity"];
						$items_sold = 0;
						$row = mysql_fetch_array($res);
						do {
							if (!in_array($row['bidder'], $WINNERS_ID)) {
								if ($row[bid] < $WINNING_BID) {
									$WINNING_BID = $row[bid];
								}
								$items_wanted = $row["quantity"];
								$items_got = 0;
								if ($items_wanted <= $items_count) {
									$items_got = $items_wanted;
									$items_count -= $items_got;
								} else {
									$items_got = $items_count;
									$items_count -= $items_got;
								}
								$items_sold += $items_got;
								// // Retrieve winner nick from the database
								// // Added by Gianluca Jan. 9, 2002
								$query = "SELECT nick,email,name,address,city,zip,prov,country FROM ".$DBPrefix."users WHERE id='$row[bidder]'";
								// print "$query<BR>";
								$res_n = @mysql_query($query);
								$NICK = @mysql_result($res_n, 0, "nick");
								$EMAIL = @mysql_result($res_n, 0, "email");
								$NAME = @mysql_result($res_n, 0, "name");
								$ADDRESS = @mysql_result($res_n, 0, "address")." ".
								@mysql_result($res_n, 0, "city")." ".
								@mysql_result($res_n, 0, "zip")." ".
								@mysql_result($res_n, 0, "prov").", ".
								@mysql_result($res_n, 0, "country");
								$items_got = $items_got;
								// // Addd by Gian - dec 19 2002
								// // ============================
								$WINNERS_ID[$NICK] = $row['bidder'];
								$WINNERS_BID[$NICK] = $row['bid'];
								$WINNERS_NICK[$NICK] = $NICK;
								$WINNERS_EMAIL[$NICK] = $EMAIL;
								$WINNERS_NAME[$NICK] = $NAME;
								$WINNERS_QUANT[$NICK] = $items_got;
								$WINNERS_BIDQUANT[$NICK] = $items_wanted;
								// // ============================
								$report_text .= " $MSG_159 " . $NICK . " ($EMAIL) " . $items_got . " $MSG_5492, $MSG_5493 " . print_money($row["bid"]) . " $MSG_5495 - ($MSG_5494 $items_wanted $MSG_5492)\n";
								if($SETTINGS['winner_address'] == 'y'){
									$report_text .= " ".$MSG_30_0086.$ADDRESS."\n";
								}
								$report_text .= "\n";
								$totalamount = $row[bid];
								// Add winner's data to "winners" table
								$query = "INSERT INTO ".$DBPrefix."winners VALUES
								         (NULL,'$Auction[id]','$Seller[id]', '$row[bidder]', $row[bid],'.$NOW.',0)";
								$res_ = @mysql_query($query);
								/**
								* Update column transaction in table ".$DBPrefix."counters
								*/
								$counterbid = mysql_query("UPDATE ".$DBPrefix."counters SET transactions=(transactions+1)");
							}
							if (!$row = mysql_fetch_array($res)) {
								break;
							}
						} while (($items_count > 0) && $res);

						$report_text .= $MSG_643 . " " . print_money($WINNING_BID);
						printLog($report_text);
					}
				} else {
					errorLogSQL();
				}
			}
		}
		printLogL ("mail to seller: " . $Seller["email"], 1);
		$i_title = $Auction["title"];

		$year = substr($Auction['ends'], 0, 4);
		$month = substr($Auction['ends'], 4, 2);
		$day = substr($Auction['ends'], 6, 2);
		$hours = substr($Auction['ends'], 8, 2);
		$minutes = substr($Auction['ends'], 10, 2);
		$ends_string = $month . " " . $day . " " . $year . " " . $hours . ":" . $minutes;

		// // =============== added by Gian for automatic relisting feature
		// // Modified for XL 2.0 to relist only if invoicing is enabled
		if ($Auction['relist'] > 0 && ($Auction['relist'] - $Auction['relisted']) > 0) {
			/**
			* NOTE: Auctomatic relisting
			*/
			$_BIDSNUM = @mysql_num_rows(@mysql_query("SELECT id FROM ".$DBPrefix."bids WHERE auction='" . $Auction['id'] . "'"));

			if ($_BIDSNUM == 0 || ($_BIDSNUM > 0 && $Auction['reserve_price'] > 0 && !$winner_present)) {
				// // Calculate start and end time
				$_STARTS = $NOW;
				$_ENDS = $TIME + $Auction['duration'] * 24 * 60 * 60;
				$_ENDS = date("YmdHis", $_ENDS);

				$close = mysql_query("DELETE ".$DBPrefix."bids
				                     where auction='$Auction[id]'");
				$close = mysql_query("DELETE ".$DBPrefix."proxybid
				                     where itemid='$Auction[id]'");
				$close = mysql_query("UPDATE ".$DBPrefix."auctions SET
				                     starts='$_STARTS',
				                     ends='$_ENDS',
				                     current_bid=0,
				                     num_bids=0,
				                     relisted=relisted+1
				                     where id='$Auction[id]'");
			} else {
				// // Close auction
				$query = "UPDATE ".$DBPrefix."auctions SET closed='1',
				         starts='".$Auction[starts]."',
				         ends='".$Auction[ends]."',
				         sold=CASE sold WHEN 's' THEN 'y' ELSE sold END
				         WHERE
				         id=\"$Auction[id]\"";
				if (!mysql_query($query))
					errorLogSQL();
				printLogL($query, 1);
			}
		} else {
			// // Close auction
			$query = "UPDATE ".$DBPrefix."auctions SET closed='1',
			         starts='".$Auction[starts]."',
			         ends='".$Auction[ends]."',
			         sold=CASE sold WHEN 's' THEN 'y' ELSE sold END
			         WHERE
			         id=\"$Auction[id]\"";
			if (!mysql_query($query))
				errorLogSQL();
			printLogL($query, 1);
		}

		// //======================================================
		// WINNER PRESENT FEES NEED TO BE INSERTED
		// //======================================================
		if ($winner_present) {
			include $include_path.'endauction_winner.inc.php';
			if (count($WINNERS_NICK) > 0) {
				while (list($k, $v) = each($WINNERS_NICK)) {
					$Winner['name'] = $WINNERS_NAME[$k];
					$Winner['email'] = $WINNERS_EMAIL[$k];
					$Winner['nick'] = $WINNERS_NICK[$k];
					$Winner['quantity'] = $WINNERS_QUANT[$k];
					$Winner['wanted'] = $WINNERS_BIDQUANT[$k];
					// print $Winner['quantity']." - ".$Winner['wanted']."<BR>";
					// // ######################################################
					// // Send mail to the buyer
					include $include_path.'endauction_youwin.inc.php';
				}
			}
			elseif (is_array($Winner)) {
				// // ######################################################
				// // Send mail to the buyer
				include $include_path.'endauction_youwin_nodutch.inc.php';
			}
		}
		if (!$winner_present) {
			// // ######################################################
			// // Send mail to the seller if no winner
			if($Seller['endemailmode']!='cum'){
				include $include_path.'endauction_nowinner.inc.php';
			}else{
				#// Save in the database to send later
				@mysql_query("INSERT INTO ".$DBPrefix."pendingnotif VALUES (
								NULL,
								".$Auction['id'].",
								".$Seller['id'].",
								'',
								'".serialize($Auction)."',
								'".serialize($Seller)."',
								'".date("Ymd")."')");
			}
		}
	}
	foreach($categories as $cat_id=>$category) {
		if($category['updated']) {
			$query = "UPDATE ".$DBPrefix."categories SET
			         counter=$category[counter],
			         sub_counter=$category[sub_counter]
			         WHERE cat_id=$cat_id";
			$res = mysql_query($query);
			$category['updated']=false;
		}
	}
}

/**
* "remove" old auctions (archive them)
*/
printLog("\n");
printLog("++++++ Archiving old auctions");

$expireAuction = 60 * 60 * 24 * $SETTINGS['archiveafter']; // time of auction expiration (in seconds)
$expiredTime = date ("YmdHis", $TIME - $expireAuction);

$query = "SELECT * FROM ".$DBPrefix."auctions WHERE ends<='$expiredTime'";

printLog($query);
$result = mysql_query($query);
if ($result) {
	$num = mysql_num_rows($result);
	printLog($num . " auctions to archive");
	if ($num > 0) {
		$resultCLOSEDAUCTIONS = $result;
		while ($row = mysql_fetch_array($resultCLOSEDAUCTIONS, MYSQL_ASSOC)) {
			$AuctionInfo = $row;
			printLogL("Processing auction: " . $AuctionInfo['id'], 0);

			/**
			* ? this auction
			*/
			$query = "DELETE FROM ".$DBPrefix."auctions WHERE id='" . $AuctionInfo['id'] . "'";
			if (!mysql_query($query))
				errorLogSQL();

			/**
			* delete bids for this auction
			*/
			$query = "SELECT * FROM ".$DBPrefix."bids WHERE auction='" . $AuctionInfo['id'] . "'";
			$result = mysql_query($query);
			if ($result) {
				$num = mysql_num_rows($result);
				if ($num > 0) {
					printLogL ($num . " bids for this auction to delete", 1);
					$resultBIDS = $result;
					while ($row = mysql_fetch_array($resultBIDS, MYSQL_ASSOC)) {
						/**
						* archive this bid
						*/
						$query = "delete from ".$DBPrefix."bids where auction='" . $row['auction'] . "'";
						$res = mysql_query($query);
						if (!$res)
							errorLogSQL();
					}
				}
			} else
				errorLogSQL();
			// // #################################################################################################
			// // Gian - Added setp 14 2002
			// // Delete proxybid entries
			@mysql_query("delete from ".$DBPrefix."proxybid WHERE itemid=".$AuctionInfo['id']);
			// // Delete counter entries
			@mysql_query("delete from ".$DBPrefix."auccounter WHERE auction_id=".$AuctionInfo['id']);
			// // Delete variants entries
			// // Pictures gallery
			if (file_exists($image_upload_path . "$AuctionInfo[id]")) {
				if ($dir = @opendir($image_upload_path .$AuctionInfo['id'])) {
					while ($file = readdir($dir)) {
						if ($file != "." && $file != "..") {
							@unlink($image_upload_path .$AuctionInfo['id']."/" . $file);
						}
					}
					closedir($dir);

					@rmdir($image_upload_path .$AuctionInfo['id']);
				}
			}
			// // Picture
			@unlink($image_upload_path . $AuctionInfo['pict_url']);
		}
	}
}
else {
	errorLogSQL();
}
// ***** control if there are some suspended auction and see if now user can pay fee ****///
if ($SETTINGS['feetype'] == "prepay") {
	$auctione = mysql_query("SELECT * FROM ".$DBPrefix."auctions WHERE ends<='$NOW' AND closed='-1'");
	while ($auction_result = mysql_fetch_array($auctione)) {
		// echo  $auction_result["user"];
		/**
		* ********************************************** retrieve seller info ************************************
		*/
		$query = "SELECT * FROM ".$DBPrefix."users WHERE id='" . $auction_result["user"] . "'";
		printLogL($query, 1);
		$result = mysql_query ($query);
		if ($result) {
			if (mysql_num_rows($result) > 0) {
				mysql_data_seek ($result, 0);
				$Seller = mysql_fetch_array($result);
			} else
				$Seller = array();
		} else
			errorLogSQL();

		/**
		* -***************************************** retrieve buyer info ***************************************
		*/
		$query = "SELECT * FROM ".$DBPrefix."bids WHERE auction='" . $auction_result['id'] . "' ORDER BY bid DESC";
		printLogL($query, 1);
		$result = mysql_query ($query);
		if ($result) {
			if (mysql_num_rows($result) > 0 and ($auction_result['current_bid'] > $auction_result['reserve_price'])) {
				$decrem = mysql_num_rows($result);
				mysql_data_seek($result, 0);
				$WinnerBid = mysql_fetch_array($result);
				$winner_present = true;

				/**
				* get winner info
				*/
				$query = "SELECT * FROM ".$DBPrefix."users WHERE id='" . $WinnerBid['bidder'] . "'";
				$result = mysql_query ($query);
				if ($result) {
					if (mysql_num_rows($result) > 0) {
						mysql_data_seek ($result, 0);
						$Winner = mysql_fetch_array($result);
					} else
						$Winner = array ();
				} else
					errorLogSQL();
			}
		}

		$balance = true;
		$finalfee = 0;
		/**
		* *********************************get the fee*******************************************
		*/
		// // Mail seller
		include $include_path.'endauction_winner.inc.php';
		if ($winner_present) {
			printLogL ("mail to winner: " . $Winner["email"], 1);
			include $include_path.'endauction_youwin.inc.php';
		}
	}
}
/*
* Purging thumbnails cache and not more used images
*/
if(!file_exists($image_upload_path."cache"))
	mkdir($image_upload_path."cache",0777);
if(!file_exists($image_upload_path."cache/purge"))
	touch($image_upload_path."cache/purge");
$purgecachetime=filectime($image_upload_path."cache/purge");
if((time()-$purgecachetime)>86400) {
	$dir=$image_upload_path."cache";
	if ($dh = opendir($dir)) {
		while (($file = readdir($dh)) !== false) {
			if($file!="purge" && !is_dir("$dir/$file") && (time()-filectime("$dir/$file"))>86400)
				unlink("$dir/$file");
		}
		closedir($dh);
	}
	// starting all site images purge
	$imgarray[]=$SETTINGS['logo'];
	$imgarray[]=$SETTINGS['background'];
	$result = mysql_query("SELECT pict_url from ".$DBPrefix."auctions where photo_uploaded='1'");
	while($row=mysql_fetch_array($result, MYSQL_NUM))
		$imgarray[]=$row[0];
	$result = mysql_query("SELECT id from ".$DBPrefix."auctions");
	$imgdir=array();
	while($row=mysql_fetch_array($result, MYSQL_NUM)) {
		if(is_dir($uploaded_path.$row[0]))
			$imgdir[]=$row[0];
	}
	//Ordinary images purge
	$dir=$image_upload_path;
	if ($dh = opendir($dir)) {
		while (($file = readdir($dh)) !== false) {
			if($file!="purge" &&
			        !is_dir($dir.$file) &&
			        (time()-filectime($dir.$file))>86400 &&
			        !in_array($file,$imgarray))
				unlink($dir.$file);
		}
		closedir($dh);
	}
	//galleries dirs and files purge
	if (is_array($imgdir) && ($dh = opendir($dir))) {
		while (($file = readdir($dh)) !== false) {
			if($file!="banners" &&
			        $file!=".." &&
			        $file!="." &&
			        $file!="CVS" &&
			        is_dir("$dir.$file") &&
			        (time()-filectime($dir.$file))>86400 &&
			        !in_array($file,$imgdir))
				$ddel=$dir.$file;
			if ($ddh = @opendir($ddel)) {
				while (($fdel = readdir($ddh)) !== false) {
					if(!is_dir("$ddel/$fdel"))
						unlink("$ddel/$fdel");
				}
				closedir($ddh);
				rmdir($ddel);
			}
		}
		closedir($dh);
	}
	//Banners purge
	$result = mysql_query("SELECT name from ".$DBPrefix."banners");
	while($row=mysql_fetch_array($result, MYSQL_NUM)) {
		$imgarray[]="banners/".$result[0];
	}
	$dir=$image_upload_path."banners/";
	if(is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if($file!="purge" &&
				        !is_dir($dir.$file) &&
				        (time()-filectime($dir.$file))>86400 &&
				        !in_array("banners/".$file,$imgarray))
					unlink($dir.$file);
			}
			closedir($dh);
		}
	}
	@touch($image_upload_path."cache/purge");
}

#// Handle Wanted Items
@mysql_query("UPDATE ".$DBPrefix."wanted SET closed='1' WHERE ends <='$NOW'");
$expireAuction = 60 * 60 * 24 * $SETTINGS['archiveafter']; // time of auction expiration (in seconds)
$expiredTime = date ("YmdHis", $TIME - $expireAuction);
@mysql_query("DELETE FROM ".$DBPrefix."wanted WHERE ends<='$expiredTime'");

// // Update counters
include $include_path."updatecounters.inc.php";

// finish cron script
printLog ("=========================== ENDING CRON: ". date("F d, Y H:i:s"));
closeLogFile();
?>
