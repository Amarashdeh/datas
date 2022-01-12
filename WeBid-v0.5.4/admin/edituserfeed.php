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
if($_POST && strstr(basename($_SERVER['HTTP_REFERER']),basename($_SERVER['PHP_SELF']))) {
    $sql="UPDATE ".$DBPrefix."feedbacks SET 
          rate='".$_POST['aTPL_rate']."', 
          feedback=\"".$_POST['TPL_feedback']."\",
          feedbackdate=feedbackdate
          WHERE id='".$_POST['id']."'";
    $res=mysql_query ($sql);
    if ($res){
        #// Update user's record
        $query = "SELECT SUM(rate) as FSUM,count(feedback) as FNUM FROM ".$DBPrefix."feedbacks
                  WHERE rated_user_id='".$_POST['user']."'";
        $res = mysql_query($query);
        if(!$res) {
            print "Error: $query<BR>".mysql_error();
            exit;
        } else {
            $SUM = mysql_result($res,0,"FSUM");
            $NUM = mysql_result($res,0,"FNUM");
            
            @mysql_query("UPDATE ".$DBPrefix."users SET rate_sum=$SUM, rate_num=$NUM,reg_date=reg_date WHERE id='".$_POST['user']."'");
        }
        $TPL_errmsg=$MSG_183;
    }
    else{
        $TPL_errmsg=$ERR_065;
    }
}

$sql="SELECT * FROM ".$DBPrefix."feedbacks WHERE id='".$_REQUEST['id']."' ORDER by feedbackdate DESC";
$res=mysql_query ($sql);
$i=0;
while ($arrfeed=mysql_fetch_array($res)) {
    $rater=$arrfeed[rater_user_nick];
    $feedback=substr($arrfeed[feedback], 0, 50);
    $feed_text=strip_tags($arrfeed[feedback]);
    $rate=$arrfeed[rate];
    $user=$arrfeed[rated_user_id];
}
$sel="selected";
for ($i = 1 ; $i <= 5 ; $i++){
    if ($i == $rate){
        $selected=$sel.$i;
        $$selected="checked";
    }
}
$sql="SELECT nick FROM ".$DBPrefix."users WHERE id='$user'";
$res=mysql_query ($sql);
while ($usr=mysql_fetch_array($res)) {
    $rated=$usr["nick"];
}

?>
<HTML>
<HEAD>
<link rel='stylesheet' type='text/css' href='style.css' />
<SCRIPT Language="JavaScript">

function SubmitForm(){
    document.addfeedback.submit();
}

function ResetForm(){
    document.addfeedback.reset();
}
//-->
</script>
</HEAD>
<BODY>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/bac_barint.gif"><table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr> 
          <td width="30"><img src="images/i_con.gif" ></td>
          <td class=white><?=$MSG_25_0018?>&nbsp;&gt;&gt;&nbsp;<?=$MSG_5032?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
    <tr> 
    <td align="center" valign="middle"> 
<TABLE WIDTH="100%" BGCOLOR="#FFFFFF" BORDER=0 CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD class=title align=center><BR>
        <BR>
        <?php print $MSG_222; ?><BR>
        <?php
            echo $TPL_errmsg;
        ?>
         <BR>
        <FORM name=addfeedback action="edituserfeed.php?id=<?=$id?>" method="POST">
          <TABLE width="80%" CELLSPACING="0" CELLPADDING="4" BORDER="0">
            <tr>
              <td COLSPAN=2>
              <?php echo "<B>$rater $MSG__0167 $rated</B>"; ?>
              </td>
            </tr>
            <tr>
              <td ALIGN=RIGHT> <B><?php print $MSG_503; ?>:</B> </td>
              <td><INPUT type=radio name=aTPL_rate value=1 <?=$selected1?>>
                <IMG SRC="../images/positive.gif" BORDER=0 ALT="Positive">
                <INPUT type=radio name=aTPL_rate value=0 <?=$selected2?>>
                <IMG SRC="../images/neutral.gif" BORDER=0 ALT="Neutral">
                <INPUT type=radio name=aTPL_rate value=-1 <?=$selected3?>>
                <IMG SRC="../images/negative.gif" ALT="Negative">
              </td>
            </tr>
            <tr>
              <td ALIGN=RIGHT valign="top"> <B>Comment:</B> </td>
              <td><TEXTAREA NAME="TPL_feedback" ROWS="10" COLS="50"><?php echo $feed_text; ?></TEXTAREA></td>
            </tr>
            <tr>
              <td COLSPAN=2 align="center">
                <INPUT TYPE="hidden" NAME="user" VALUE=<?=$user?>>
                <INPUT TYPE="submit" NAME="" value="<?=$MSG_530?>">
                <INPUT TYPE="reset" NAME="">
              </td>
            </tr>
            <tr>
              <td colspan=2 align="center"> <A HREF="userfeedback.php?id=<?=$user?>">
                <?=$MSG_222?>
                </A>  </td>
            </tr>
          </TABLE>
          <INPUT type="hidden" name="send" value="1">
        </FORM>
    </TD>
  </TR>
</TABLE>
</BODY>
</HTML>