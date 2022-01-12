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

require('../includes/config.inc.php');
include "loggedin.inc.php";
#//
$id = $_REQUEST[id];
if($_POST['action'] == "insert" && strstr(basename($_SERVER[HTTP_REFERER]), basename($_SERVER['PHP_SELF']))) {
	#// Data integrity
	if(empty($_FILES['bannerfile']) || empty($_POST['url'])) {
		$ERR = $ERR_047;
	} else {
		#// Handle upload
		if(!file_exists($image_upload_path."banners")) {
			umask();
			mkdir($image_upload_path."banners",0777);
		}
		if(!file_exists($image_upload_path."banners/$id")) {
			umask();
			mkdir($image_upload_path."banners/$id",0777);
		}
		
		$TARGET = $image_upload_path."banners/$id/".$_FILES['bannerfile']['name'];
		if(file_exists($TARGET)) {
			$ERR = $MSG__0047;
		} else {
			$INFO = GetImageSize($_FILES['bannerfile']['tmp_name']);
			if($INFO[2] < 0 && $INFO[2] > 4) {
				$ERR = $MSG__0048;
			} else {
				$WIDTH = $INFO[0];
				$HEIGHT = $INFO[1];
				
				switch($INFO[2]) {
					case '1':
					$FILETYPE = 'gif';
					break;
					case '2':
					$FILETYPE = 'jpg';
					break;
					case '3':
					$FILETYPE = 'png';
					break;
					case '13':
					$FILETYPE = 'swf';
					break;
				}
				if(!empty($_FILES['bannerfile']['tmp_name']) && $_FILES['bannerfile']['tmp_name'] != "none") {
					move_uploaded_file($_FILES['bannerfile']['tmp_name'],$TARGET);
					chmod($TARGET,0666);
				}
				
				#// Update database
				$query = "INSERT INTO ".$DBPrefix."banners
							  VALUES (
							  NULL,
							  '".addslashes($_FILES['bannerfile']['name'])."',
							  '$FILETYPE',
							  0,
							  0,
							  '".$_POST['url']."',
							  '".$_POST['sponsortext']."',
							  '".$_POST['alt']."',
							  ".intval($_POST['purchased']).",
							  $WIDTH,
							  $HEIGHT,
							  $id)";
				$res = @mysql_query($query);
				if(!$res) {
					print "Error: $query<BR>".mysql_error();
					exit;
				} else {
					$ID = mysql_insert_id();
					
					#// Handle filters
					if(is_array($_POST['categories'])) {
						while(list($k,$v) = each($_POST['categories'])) {
							$query = "INSERT INTO ".$DBPrefix."bannerscategories VALUES ($ID,$v)";
							@mysql_query($query);
							if(!$res) {
								print "$query<BR>".mysql_error();
								exit;
							}
						}
					}
					if(!empty($_POST['keywords'])) {
						$KEYWORDS = explode("\n",$_POST['keywords']);
						
						while(list($k,$v) = each($KEYWORDS)) {
							if(!empty($v)) {
								$query = "INSERT INTO ".$DBPrefix."bannerskeywords VALUES ($ID,'".chop($v)."')";
								@mysql_query($query);
								if(!$res) {
									print "$query<BR>".mysql_error();
									exit;
								}
							}
						}
					}
					Header("Location: userbanners.php?id=$id");
					exit;
				}
			}
		}
	}
}


#// Retrieve user's information
$query = "SELECT * FROM ".$DBPrefix."bannersusers WHERE id=$id";
$res_ = @mysql_query($query);
if(!$res_)
{
	print "$query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res_) > 0)
{
	$USER = mysql_fetch_array($res_);
}

#// REtrieve user's banners
$query = "SELECT * FROM ".$DBPrefix."banners WHERE user=".$USER['id'];
$res = @mysql_query($query);
if(!$res)
{
	print "$query<BR>".mysql_error();
	exit;
}
elseif(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_array($res))
	{
		$BANNERS[] = $row;
	}
}


// -------------------------------------- category
$T=	"<SELECT NAME=\"categories[]\" ROWS=12 MULTIPLE>\n";
$result = mysql_query("SELECT * FROM ".$DBPrefix."categories_plain");
if($result)
{
	while($row=mysql_fetch_array($result))
	{
		$T.= "<OPTION VALUE=".$row['cat_id'];
		if(@in_array($row['cat_id'], $_POST['categories'])) $T .= " SELECTED";
		$T .= ">".$row['cat_name']."</OPTION>\n";
	}
}
$T.="</SELECT>\n";
$TPL_categories_list = $T;

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language=Javascript>
function window_open(pagina,titulo,ancho,largo,x,y){
	var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
	open(pagina,titulo,Ventana);
}
</SCRIPT>
</HEAD>
<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#666666" alink="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr>
          <td width="30"><img src="images/i_ban.gif" ></td>
          <td class=white>
            <?=$MSG_25_0011?>
&nbsp;&gt;&gt;&nbsp;
            <?=$MSG__0008?>
            </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR="#FFFFFF">
        <TR>
          <TD><CENTER>
            <BR>
            <FORM NAME=conf ACTION=<?=basename($_SERVER[PHP_SELF])?> METHOD=POST ENCTYPE="multipart/form-data">
              <TABLE WIDTH="90%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#0083D7">
                <TR>
                  <TD ALIGN=CENTER class=title><?php print $MSG__0024; ?></TD>
                </TR>
                <TR>
                  <TD><TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#FFFFFF">
                      <?php
                      if(!empty($ERR)) {
					  ?>
                      <TR>
                        <TD COLSPAN="4" ALIGN=CENTER BGCOLOR=yellow><B>
                          <?=$ERR?>
                           </B></TD>
                      </TR>
                      <?php
                      }
					  ?>
                      <TR VALIGN="TOP">
                        <TD COLSPAN="4" ALIGN=CENTER> <A HREF=managebanners.php>
                          <?=$MSG_270?>
                          </A> </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#FFFFFF">
                        <TD COLSPAN="4" HEIGHT="22"><TABLE WIDTH="95%" BORDER="0" CELLSPACING="1" CELLPADDING="4" ALIGN="CENTER" BGCOLOR="#999900">
                            <TR BGCOLOR="#FFFF33">
                              <TD WIDTH="6%" BGCOLOR="#EEEECC">
                                <?=$MSG_5180?>
                                 </TD>
                              <TD WIDTH="90%" BGCOLOR="#EEEECC"> <B>
                                <?=$USER['name']?>
                                </B>  </TD>
                              <TD ROWSPAN="3" WIDTH="4%" BGCOLOR="#FFFFFF"><A HREF=editbannersuser.php?id=<?=$id?>><IMG BORDER=0 ALT="Edit user's data" SRC="images/tool.gif" WIDTH="24" HEIGHT="20"></a> </TD>
                            </TR>
                            <TR BGCOLOR="#FFFF33">
                              <TD WIDTH="6%" BGCOLOR="#EEEECC">
                                <?=$MSG__0022?>
                                 </TD>
                              <TD WIDTH="90%" BGCOLOR="#EEEECC"> <B>
                                <?=$USER['company']?>
                                </B>  </TD>
                            </TR>
                            <TR BGCOLOR="#FFFF33">
                              <TD WIDTH="6%" BGCOLOR="#EEEECC">
                                <?=$MSG_303?>
                                 </TD>
                              <TD WIDTH="90%" BGCOLOR="#EEEECC"> <B><A HREF="<?=$USER['email']?>">
                                <?=$USER['email']?>
                                </A></B>  </TD>
                            </TR>
                          </TABLE></TD>
                      </TR>
                      <TR VALIGN="TOP">
                        <TD COLSPAN="4" HEIGHT="22">&nbsp;</TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#999999">
                        <TD COLSPAN="4" HEIGHT="22" class=title>
                          <?=$MSG__0043?>
                          </TD>
                      </TR>
                      <TR>
                        <TD colspan=4>
                        <?php
                        if(is_array($BANNERS)) {
                        	$BG = "#eeeeee";
                        	while(list($k,$v) = each($BANNERS)) {
                        		if($BG == "#eeeeee")
                        		$BG = "#dddddd";
                        		else
                        		$BG = "#eeeeee";
		  				?>
                          <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#aaaaaa">
                            <TR>
                              <TD><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 ALIGN=CENTER WIDTH=100% BGCOLOR=<?=$BG?>>
                                  <TR VALIGN="TOP" BGCOLOR="#FFFFFF">
                                    <TD HEIGHT="22" COLSPAN="7" ALIGN=CENTER>
                                    <?php
                                    if($v['type'] == 'swf') {
									?>
                                      <OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="<?=$v['width']?>" HEIGHT="<?=$v['height']?>">
                                        <PARAM NAME=movie VALUE="<?='../'.$uploaded_path.'banners/'.$id.'/'.$v['name']?>">
                                        <PARAM NAME=quality VALUE=high>
                                        <EMBED SRC="<?='../'.$uploaded_path.'banners/'.$id.'/'.$v['name']?>" QUALITY=high PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" WIDTH="468" HEIGHT="60"> </EMBED>
                                      </OBJECT>
                                    <?php
                                    } else {
									?>
                                      <A TARGET=_blank HREF=<?=$v['url']?>><IMG BORDER=0 ALT="<?=$v['alt']?>" SRC="<?='../'.$uploaded_path.'banners/'.$id.'/'.$v['name']?>"></A>
                                    <?php
                                    }
									?>
                                      <BR>
                                      <A TARGET=_blank HREF=<?=$v['url']?>>
                                      <?=$v['sponsortext']?>
                                      </A> </TD>
                                  </TR>
                                  <TR VALIGN="TOP" BGCOLOR="#eeeeee">
                                    <TD WIDTH="29%" HEIGHT="22">
                                      <?=$MSG__0050?>&nbsp;<B><A HREF=<?=$v['url']?> target=_BLANK>
                                      <?=$v['url']?>
                                      </a></B>  </TD>
                                    <TD HEIGHT="22" WIDTH="13%">
                                      <?=$MSG__0049?>&nbsp;<B>
                                      <?=$v['views']?>
                                      </B>  </TD>
                                    <TD HEIGHT="22" WIDTH="15%">
                                      <?=$MSG__0051?>&nbsp;<B>
                                      <?=$v['clicks']?>
                                      </B>  </TD>
                                    <TD HEIGHT="22" WIDTH="25%">
                                      <?=$MSG__0045?>&nbsp;<B>
                                      <?=$v['purchased']?>
                                      </B>  </TD>
                                    <TD HEIGHT="22" WIDTH="9%"> <A HREF="javascript:window_open('viewfilters.php?banner=<?=$v['id']?>','Viewfilters',400,500,30,30)">
                                      <?=$MSG__0052?>
                                      </a>  </TD>
                                    <TD HEIGHT="22" VALIGN=MIDDLE ALIGN=CENTER WIDTH="5%" BGCOLOR="#FFFFFF"><A HREF="editbanner.php?banner=<?=$v['id']?>"><IMG SRC="images/tool.gif" WIDTH="24" HEIGHT="20" BORDER="0"></A></TD>
                                    <TD HEIGHT="22" VALIGN=MIDDLE ALIGN=CENTER WIDTH="4%" BGCOLOR="#FFFFFF"><A HREF="deletebanner.php?banner=<?=$v['id']?>&user=<?=$v['user']?>&name=<?=$v['name']?>"><IMG SRC="images/trash.png" WIDTH="18" HEIGHT="26" BORDER="0"></A></TD>
                                  </TR>
                                </TABLE></TD>
                            </TR>
                          </TABLE>
                          <BR>
                        <?php
                        	}
                        }
		  				?>
                        </TD>
                      </TR>
                      <TR>
                        <TD COLSPAN="4"></TD>
                      </TR>
                    </TABLE></TD>
                </TR>
              </TABLE>
              <TABLE WIDTH="90%" BORDER="0" CELLSPACING="0" CELLPADDING="1" BGCOLOR="#296FAB">
                <TR>
                  <TD><TABLE WIDTH=100% CELLPADDING=2 ALIGN="CENTER" BGCOLOR="#CED6E1">
                      <TR VALIGN="TOP" BGCOLOR="#A8C8E2">
                        <TD COLSPAN="2" HEIGHT="22">
                          <?=$MSG__0041?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG__0029?>
                           </TD>
                        <TD WIDTH="492"><INPUT TYPE="file" NAME="bannerfile" SIZE=40>
                          
                          <?=$MSG__0042?>
                           <BR>
                          
                          <?=$MSG__0036?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG__0030?>
                           </TD>
                        <TD WIDTH="492"><INPUT TYPE="text" NAME="url" SIZE="45" VALUE="<?=$_POST['url']?>">
                          
                          <?=$MSG__0042?>
                           <BR>
                          
                          <?=$MSG__0037?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG__0031?>
                           </TD>
                        <TD WIDTH="492"><INPUT TYPE="text" NAME="sponsortext" SIZE="45" VALUE="<?=$_POST['sponsortext']?>">
                          <BR>
                          
                          <?=$MSG__0038?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG__0032?>
                           </TD>
                        <TD WIDTH="492"><INPUT TYPE="text" NAME="alt" SIZE="45" VALUE="<?=$_POST['alt']?>">
                          <BR>
                          
                          <?=$MSG__0038?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG__0045?>
                           </TD>
                        <TD WIDTH="492"><INPUT TYPE="text" NAME="purchased" SIZE="8" VALUE="<?=$_POST['purchased']?>">
                          <BR>
                          
                          <?=$MSG__0046?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#CADCDF">
                        <TD COLSPAN="2">
                          <?=$MSG__0033?>
                          <BR>
                          <?=$MSG__0039?>
                           </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG_276?>
                           </TD>
                        <TD WIDTH="492"><?=$TPL_categories_list?>
                        </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">
                          <?=$MSG__0035?>
                           </TD>
                        <TD WIDTH="492">
                        <TEXTAREA NAME="keywords" COLS="45" ROWS="8"><?=$_POST['keywords']?></TEXTAREA>
                        </TD>
                      </TR>
                      <TR VALIGN="TOP" BGCOLOR="#DEE9EB">
                        <TD WIDTH="140">&nbsp;</TD>
                        <TD WIDTH="492"><INPUT TYPE="hidden" NAME="action" VALUE="insert">
                          <INPUT TYPE="hidden" NAME="id" VALUE="<?=$id?>">
                          <INPUT TYPE="submit" NAME="Submit2" VALUE="<?=$MSG__0040?>">
                        </TD>
                      </TR>
                      <TR>
                        <TD COLSPAN="2"></TD>
                      </TR>
                    </TABLE></TD>
                </TR>
              </TABLE>
            </FORM></CENTER></TD>
        </TR>
      </TABLE></TD>
  </TR>
</TABLE>
</BODY>
</HTML>
