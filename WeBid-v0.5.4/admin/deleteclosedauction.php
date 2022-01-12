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

include "../includes/config.inc.php";
include "loggedin.inc.php";
include $include_path."countries.inc.php";

$username = $name;

print "**".$_SESSION['RETURN_LIST'];

//-- Data check
if(!$id) {
	$URL = $_SESSION["RETURN_LIST"];
	unset($_SESSION["RETURN_LIST"]);
	header("Location: $URL");
	exit;
}

if($action && strstr(basename($HTTP_REFERER),basename($PHP_SELF))) {
	if(!$ERR) {
		//-- Get category
		$query = "select category,photo_uploaded,pict_url from ".$DBPrefix."auctions where id='$id'";
		$res__ = mysql_query($query);
		if(!$res__) {
			print $ERR_001." $query<BR>".mysql_error();
			exit;
		} else {
			$cat_id = mysql_result($res__,0,"category");
			$photo_uploaded = mysql_result($res__,0,"photo_uploaded");
			$pict_url = mysql_result($res__,0,"pict_url");
		}
		
		//-- delete auction
		$sql="delete from ".$DBPrefix."auctions WHERE id='$id'";
		$res=mysql_query ($sql);
		
		//-- Update counters
		$query = mysql_query("update ".$DBPrefix."counters set auctions=(auctions-1)");
		
		//-- delete bids
		$query = "SELECT count(auction) as BIDS from ".$DBPrefix."bids WHERE auction='$id'";
		$res = mysql_query($query);
		if(!$res) {
			print "ERROR: $query<BR>".mysql_error();
			exit;
		}
		if(mysql_num_rows($res) > 0) {
			$BIDS = mysql_result($res,0,"BIDS");
			$sql="delete from ".$DBPrefix."bids WHERE auction='$id'";
			$res=mysql_query ($sql);
			
			#// Delete entries from the proxybid table
			$sql="delete from ".$DBPrefix."proxybid WHERE itemid='$id'";
			$res=mysql_query ($sql);
		} else {
			$BIDS = 0;
		}
		
		#// Delete file in counters
		@unlink("../counter/$id.txt");
		
		//-- Update counters
		$query = mysql_query("update ".$DBPrefix."bids set bids=(bids-$BIDS)");
		
		// update "categories" table - for counters
		$root_cat = $cat_id;
		do {
			// update counter for this category
			$query = "SELECT * FROM ".$DBPrefix."categories WHERE cat_id=\"$cat_id\"";
			$result = mysql_query($query);
			
			if($result)	{
				if (mysql_num_rows($result)>0) {
					$R_parent_id = mysql_result($result,0,"parent_id");
					$R_cat_id = mysql_result($result,0,"cat_id");
					$R_counter = intval(mysql_result($result,0,"counter"));
					$R_sub_counter = intval(mysql_result($result,0,"sub_counter"));
					
					$R_sub_counter--;
					if ( $cat_id == $root_cat )
					--$R_counter;
					
					if($R_counter < 0) $R_counter = 0;
					if($R_sub_counter < 0) $R_sub_counter = 0;
					
					$query = "UPDATE ".$DBPrefix."categories SET counter='$R_counter', sub_counter='$R_sub_counter' WHERE cat_id=\"$cat_id\"";
					@mysql_query($query);
					
					$cat_id = $R_parent_id;
				}
			}
		} while ($cat_id!=0);
		
		#// ##############################################################################################
		#// Delete any image for this auction (uploaded picture and pictures gallery)
		
		#// Pictures gallery
		if(file_exists($image_upload_path."$id")) {
			if($dir = @opendir($image_upload_path."$id")) {
				while($file = readdir($dir)) {
					if($file != "." && $file != "..") {
						@unlink($image_upload_path."$id/".$file);
					}
				}
				closedir($dir);
				@rmdir($image_upload_path."$id");
			}
		}
		
		#// Uploaded picture
		if($photo_uploaded)	{
			@unlink($image_upload_path.$pict_url);
		}
		
		#// Delete Invited Users List and Black Lists associated with this auction ---------------------------s
		$URL = $_SESSION["RETURN_LIST"];
		unset($_SESSION["RETURN_LIST"]);	
		Header("location:  $URL?offset=$offset");
	}
}


if(!$action) {
	
	$query = "select a.id, u.nick, a.title, a.starts, a.description,
		c.cat_name, d.description as duration, a.suspended, a.current_bid,
		a.quantity, a.reserve_price, a.location from ".$DBPrefix."auctions
		a, ".$DBPrefix."users u, ".$DBPrefix."categories c, ".$DBPrefix."durations d where u.id = a.user and
		c.cat_id = a.category and d.days = a.duration and a.id=\"$id\"";
	$result = mysql_query($query);
	if(!$result) {
		print "Database access error: abnormal termination".mysql_error();
		exit;
	}
	
	$id = mysql_result($result,0,"id");
	$title = mysql_result($result,0,"title");
	$nick = mysql_result($result,0,"nick");
	$tmp_date = mysql_result($result,0,"starts");
	$duration = mysql_result($result,0,"duration");
	$category = mysql_result($result,0,"cat_name");
	$description = mysql_result($result,0,"description");
	$suspended = mysql_result($result,0,"suspended");
	$current_bid = mysql_result($result,0,"current_bid");
	$quantity = mysql_result($result,0,"quantity");
	$reserve_price = mysql_result($result,0,"reserve_price");
	$country = mysql_result($result, 0, "location");
	
	$country_list="";
	while (list ($code, $descr) = each ($countries)) {
		$country_list .= "<option value=\"$descr\"";
		if ($descr == $country)	{
			$country_list .= " selected";
		}
		$country_list .= ">$descr</option>\n";
	};
	$day = substr($tmp_date,6,2);
	$month = substr($tmp_date,4,2);
	$year = substr($tmp_date,0,4);
	$date = "$day/$month/$year";
}

?>
<link rel='stylesheet' type='text/css' href='style.css' />
<BR>
<TABLE WIDTH="95%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#296FAB" ALIGN="CENTER">
	<TR>
		<TD ALIGN=CENTER class=title>
			<?php print $MSG_325; ?>
		</TD>
	</TR>
	<TR>
		<TD>
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="5" BGCOLOR="#FFFFFF">
				<TR>
					<TD>
						<TABLE WIDTH=100% CELPADDING=0 CELLSPACING=0 BORDER=0 BGCOLOR="#FFFFFF">
							<TR>
								<TD ALIGN=CENTER COLSPAN=5> <BR>
									<B> </B>  <BR>
								</TD>
							</TR>
							<TABLE WIDTH="700" BORDER="0" CELLPADDING="5">
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_312"; ?>
									</TD>
									<TD WIDTH="486">
										<?print $title; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_313"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $nick; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_314"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $date; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204"  VALIGN="top" ALIGN="right">
										<?php print "$MSG_315"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $duration; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204"  VALIGN="top" ALIGN="right">
										<?php print "$MSG_316"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $category; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_317"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $description; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_014"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $countries[$country]; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_318"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $current_bid; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_319"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $quantity; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_320"; ?>
									</TD>
									<TD WIDTH="486">
										<?php print $reserve_price; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204" VALIGN="top" ALIGN="right">
										<?php print "$MSG_300"; ?>
									</TD>
									<TD WIDTH="486">
										<?php
										if($suspended == 0)
										print "$MSG_029";
										else
										print "$MSG_030";
										
										?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204">&nbsp;</TD>
									<TD WIDTH="486">
										<?php print $MSG_326; ?>
									</TD>
								</TR>
								<TR>
									<TD WIDTH="204">&nbsp;</TD>
									<TD WIDTH="486">
										<FORM NAME=details ACTION="deleteauction.php" METHOD="POST">
											<INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $id; ?>">
											<INPUT TYPE="hidden" NAME="offset" VALUE="<?php echo $offset; ?>">
											<INPUT TYPE="hidden" NAME="action" VALUE="Delete">
											<INPUT TYPE="submit" NAME="act" VALUE="<?php print $MSG_008; ?>">
										</FORM>
									</TD>
							</TABLE>
						</TABLE>
					</TD>
				</TR>
			</TABLE>

		</TD>
	</TR>
	<TR>
		<TD BGCOLOR="#FFFFFF">
		</TD>
	</TR>
</TABLE>
<!-- Closing external table (header.php) -->
<?php include "./footer.php"; ?>
