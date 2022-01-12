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

include $prefix."includes/useragent.inc.php";
include $prefix."includes/domains.inc.php";

#// Retrieve stats settings
$query = "SELECT * FROM ".$DBPrefix."statssettings";
$res_ = @mysql_query($query);
if(!$res_) {
    print "Error: $query<BR>".mysql_error();
    exit;
} else {
    $STATSSETTINGS = mysql_fetch_array($res_);
}

if($STATSSETTINGS['activate'] == 'y') {
    #// -> Users accesses ################################################
    if($STATSSETTINGS['accesses'] == 'y') {
        #// Did the month change? --
        $query = "SELECT month from ".$DBPrefix."currentaccesses LIMIT 1";
        $__r = mysql_query($query);
        if(!$__r) {
            print "Error: $query<BR>".mysql_error();
            exit;
        }
        if(mysql_num_rows($__r) > 0 && @mysql_result($__r,0,"month") != date("m")) {
            #// Archive current stats
            $query = "SELECT month,year,SUM(pageviews) as PG, SUM(uniquevisitors) as UN, SUM(usersessions) as SE FROM ".$DBPrefix."currentaccesses
                      GROUP BY month";
            $_res = mysql_query($query);
            if(!$_res) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
            $TMP = mysql_fetch_array($_res);
            $query = "INSERT INTO ".$DBPrefix."accesseshistoric
                      VALUES(
                      '".$TMP['month']."',
                      '".$TMP['year']."',
                      ".$TMP['PG'].",
                      ".$TMP['UN'].",
                      ".$TMP['SE'].")";
            $res = @mysql_query($query);
            if(!$res) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
            $query = "DELETE FROM ".$DBPrefix."currentaccesses";
            $res = @mysql_query($query);
            if(!$res) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
        }
        
        #// check cookies and session vars --
        if(isset($_SESSION['USER_STATS_SESSION'])) {
            #//
            $UPDATESESSION = FALSE;
        } else {
            $USER_STATS_SESSION = time();
            $_SESSION["USER_STATS_SESSION"]=$USER_STATS_SESSION;
            
            $UPDATESESSION = TRUE;
        }
        
        #// check cookies and session vars --
        $Cookie = $SETTINGS['cookiesprefix']."uniqueuser";
        if(isset($HTTP_COOKIE_VARS[$Cookie])) {
            #//
            $UPDATECOOKIE = FALSE;
        } else {
            #// Get left seconds to the end of the month
            $exp = GetLeftSeconds();
            SetCookie("$Cookie",time(),time()+$exp);
            
            $UPDATECOOKIE = TRUE;
        }
        
        #// Update the database #####################
        $THISDAY     = date("d");
        $THISMONTH     = date("m");
        $THISYEAR     = date("Y");
        
        $R = mysql_query("SELECT day,month FROM ".$DBPrefix."currentaccesses WHERE day='$THISDAY' AND month='$THISMONTH'");
        if(mysql_num_rows($R) == 0) {
            $query = "INSERT INTO ".$DBPrefix."currentaccesses VALUES(
                      '$THISDAY',
                      '$THISMONTH',
                      '$THISYEAR',
                      0,0,0)";
            $res_ = mysql_query($query);
            
            if(!$res_) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
        }
        
        #//
        $query = "UPDATE ".$DBPrefix."currentaccesses SET
                  pageviews=pageviews+1";
        if($UPDATESESSION) {
            $query .= ",usersessions=usersessions+1";
        }
        if($UPDATECOOKIE) {
            $query .= ", uniquevisitors= uniquevisitors+1";
        }
        $query .= " WHERE day='$THISDAY' AND month='$THISMONTH' AND year='$THISYEAR'";
        $re_ = mysql_query($query);
        if(!$re_) {
            print "Error: $query<BR>".mysql_error();
            exit;
        }
        
        #// -- End users accesses
    }
    
    #// --
    
    #// Get user's agent and platform
    $TMP = GetBrowserPlatoform($HTTP_USER_AGENT);
    
    $BROWSER = $TMP[0];
    $PLATFORM = $TMP[1];
    
    
    #// -> Browsers, platforms ################################################
    if($STATSSETTINGS['browsers'] == 'y') {
        #// Update the database #####################
        $THISDAY     = date("d");
        $THISMONTH     = date("m");
        $R = mysql_query("SELECT month FROM ".$DBPrefix."currentbrowsers WHERE month='$THISMONTH' AND year='$THISYEAR' AND browser='$BROWSER'");
        if(mysql_num_rows($R) == 0) {
            $query = "INSERT INTO ".$DBPrefix."currentbrowsers VALUES(
                         '$THISMONTH',
                         '$THISYEAR',
                         '$BROWSER',0)";
            $res_ = @mysql_query($query);
            if(!$res_) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
        }
        
        #//
        $query = "UPDATE ".$DBPrefix."currentbrowsers SET
                     counter=counter+1
                     WHERE browser='$BROWSER' AND month='$THISMONTH' AND year='$THISYEAR'";
        $re_ = @mysql_query($query);
        if(!$re_) {
            print "Error: $query<BR>".mysql_error();
            exit;
        }
    }
    #// -- End browsers stats
    
    #// -> platforms ################################################
    if($STATSSETTINGS['browsers'] == 'y') {
        #// Update the database #####################
        $THISDAY     = date("d");
        $THISMONTH     = date("m");
        $R = mysql_query("SELECT month FROM ".$DBPrefix."currentplatforms WHERE month='$THISMONTH' AND year='$THISYEAR' AND platform='$PLATFORM'");
        if(mysql_num_rows($R) == 0) {
            $query = "INSERT INTO ".$DBPrefix."currentplatforms VALUES(
                         '$THISMONTH',
                         '$THISYEAR',
                         '$PLATFORM',0)";
            $res_ = @mysql_query($query);
            if(!$res_) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
        }
        
        #//
        $query = "UPDATE ".$DBPrefix."currentplatforms SET
                     counter=counter+1
                     WHERE platform='$PLATFORM' AND month='$THISMONTH' AND year='$THISYEAR'";
        $re_ = @mysql_query($query);
        if(!$re_) {
            print "Error: $query<BR>".mysql_error();
            exit;
        }
    }
    #// -- End platforms stats
    
    
    
    #// --
    
    #// Domains -----
    if($STATSSETTINGS['domains'] == 'y') {
        #// Resolve omain
        if($_SERVER['REMOTE_ADDR'] || $_ENV['REMOTE_ADDR']){
            if($_SERVER['REMOTE_ADDR']){
                $T = explode(".",gethostbyaddr($_SERVER['REMOTE_ADDR']));
            }else{
                $T = explode(".",gethostbyaddr($_ENV['REMOTE_ADDR']));
            }
        }else{
            //# Creates a fake variable if REMOTE_ADDR variable is unreadable
            //# cause some it is unavailable in some servers
            $_SERVER['REMOTE_ADDR'] = "127.0.0.1";
            $T = explode(".",gethostbyaddr($_SERVER['REMOTE_ADDR']));
        }
        $DOMAIN = $TT[count($T) - 1];
        if(!isset($DOMAINS[$DOMAIN]))
        $RESOLVEDDOMAIN = "?";
        else
        $RESOLVEDDOMAIN = $DOMAIN;
        
        #// Update the database #####################
        $THISDAY     = date("d");
        $THISMONTH     = date("m");
        $R = mysql_query("SELECT month FROM ".$DBPrefix."currentdomains WHERE month='$THISMONTH' AND year='$THISYEAR' AND domain='$RESOLVEDDOMAIN'");
        if(mysql_num_rows($R) == 0) {
            $query = "INSERT INTO ".$DBPrefix."currentdomains VALUES(
                     '$THISMONTH',
                     '$THISYEAR',
                     '$RESOLVEDDOMAIN',0)";
            $res_ = @mysql_query($query);
            if(!$res_) {
                print "Error: $query<BR>".mysql_error();
                exit;
            }
        }
        
        #//
        $query = "UPDATE ".$DBPrefix."currentdomains SET
                     counter=counter+1
                     WHERE domain='$RESOLVEDDOMAIN' AND month='$THISMONTH' AND year='$THISYEAR'";
        $re_ = @mysql_query($query);
        if(!$re_) {
            print "Error: $query<BR>".mysql_error();
            exit;
        }
    }
}

?>