<?php
if(!defined("INCLUDED")) exit("Access denied");
/***********************************************************************
* Don't edit the code below unless you really know what you are doing  *
************************************************************************/
if(!function_exists(phpa_include)){
  function phpa_include($fileto) {
    global $SETTINGS,$prefix;
    if (!isset($SETTINGS['theme']) || empty($SETTINGS['theme'])) $SETTINGS['theme']='default';
    if((strstr($_SERVER['PHP_SELF'],"browse.php") || strstr($_SERVER['PHP_SELF'],"item.php")
      || strstr($_SERVER['PHP_SELF'],"browse_wanted.php") || strstr($_SERVER['PHP_SELF'],"wantedad.php")) && $fileto=='style.css'){ 
      $filename=$SETTINGS['siteurl']."themes/".$SETTINGS['theme']."/".$fileto;
    }else{
      $filename="themes/".$SETTINGS['theme']."/".$fileto;
      if (!file_exists($filename)) {
        if (!file_exists($P."themes/default/".$fileto)) {
          exit("Missing template: themes/default/".$fileto);
        } else {
          $filename=$P."themes/default/".$fileto;
        }
      }
    }
    return $filename;
  }
}

if(!function_exists(phpa_uploaded)){
  function phpa_uploaded($useprefix=true) {
    global $SETTINGS,$prefix;
    if (!isset($SETTINGS['theme']) || empty($SETTINGS['theme'])) $SETTINGS['theme']='default';
    $dirname="themes/".$SETTINGS['theme'];
    if (!is_dir($prefix.$dirname)) {
      if (!is_dir($prefix."themes/default")) {
        $dirname="uploaded";
      } else {
        $dirname="themes/default";
      }
    }
    return ($useprefix ? $prefix : "").$dirname."/";
  }
}

if(!function_exists(setsspan)){
  function setsspan($astring,$astyle) {
    return '<SPAN style="'.$astyle.'">'.$astring."</SPAN>";
  }
}

if(!function_exists(getUrlParams)){
  function getUrlParams($sep){
    $params = $_SERVER["PATH_INFO"];
    $params = substr($params,1);
    $params = explode(chr(47),$params);
  
    $tArr = Array();
    for($i=0; $i<count($params); $i++){
      if(trim($params[$i]) != ""){
        $temp = explode($sep, $params[$i]);
        if(trim($temp[1]) != "")
          $tArr[$temp[0]] = $temp[1];
      }
    }
    return $tArr;
  }
}

//--
$password_file = $include_path."passwd.inc.php";
include($password_file);

//-- Database connection
if(!mysql_connect($DbHost,$DbUser,$DbPassword)) {
  $NOTCONNECTED = TRUE;
}
if(!mysql_select_db($DbDatabase)) {
  $NOTCONNECTED = TRUE;
}
//do some checks
$result = mysql_query("SHOW TABLES FROM ".$DbDatabase) or die(mysql_error());
$exists = false;
while($row = mysql_fetch_array($result)) {
  if($row[0] == $DBPrefix."settings") {
    $exists = true;
    break;
  }
}
if(!$exists)
	echo '<script type="text/javascript">window.location = "./install/install.php";</script>';
	 
if(is_dir($main_path.'install')){ echo "please delete the install directory"; exit; }

if(!strpos($_SERVER['argv'][0],"sendinvoices_cron.php") && !strpos($_SERVER['argv'][0],"cron.php") && !strpos($_SERVER['argv'][0],"sendinvoices_cron.php") && !strpos($_SERVER['argv'][0],"cron.php"))
  session_start();

#// RETRIEVE SETTINGS AND CREATE SESSION VARIABLES FOR THEM
include $include_path."fonts.inc.php";

$query = "select * from ".$DBPrefix."settings";
$RES = @mysql_query($query);
if($RES) {
  $SETTINGS = mysql_fetch_array($RES);
  #// Retrieve fonts and colors settings
  $query = "SELECT * FROM ".$DBPrefix."fontsandcolors";
  $R__ = mysql_query($query);
  if($R__) {
    $FONTSANDCOLORS = mysql_fetch_array($R__);
    while(list($k,$v) = each($FONTSANDCOLORS)) {
      $SETTINGS[$k] = $v;
    }
  }
}
$_SESSION["SETTINGS"]=$SETTINGS;

if(!isset($prefix)) $prefix="";

include($include_path."currency.inc.php");
include($include_path."errors.inc.php");
#// Gian - sept 12 2002
include($include_path."https.inc.php");

?>
