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
include "header.php";
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="8" height="296" bgcolor="#FFFFFF">
        <tr>
          <td height="292" valign="top">
            <p>&nbsp;</p>
            <p><?php print $MSG_1025; ?>
              </b></font></p>
            <table width="91%" border="0" cellspacing="0" cellpadding="6" align="center">
              <tr>
                <td align="center" height="44"><b><?php print $MSG_1024; ?></b></font></td>
              </tr>
            </table>
            <table width="85%" border="0" cellspacing="0" cellpadding="0" align="center" height="42">
              <tr>
                <td"height="51" align="center"><A HREF="<?=$SETTINGS['siteurl']?>"><?=$MSG_30_0185?></A></td>
              </tr>
            </table>
            <p>&nbsp;</p><p>
            </p>
          </td>
        </tr>
      </table>

</td>
  </tr>
</table>
<?include "footer.php";?>
