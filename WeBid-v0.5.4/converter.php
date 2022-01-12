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
include "./includes/config.inc.php";
include $include_path."converter.inc.php";

$CURRENCIES=CurrenciesList();

if($_POST['action'] == "convert") {
	#// Convert
	$CONVERTED = ConvertCurrency($_POST["from"], $_POST["to"],$_POST["amount"] );
}
foreach($_GET as $k=>$v){
  $var = $k;
  $$var = $v; 
}

?>
<html>
<head>
<title>
<?=$SETTINGS['sitename']?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include $include_path."styles.inc.php";?>
<link rel='stylesheet' type='text/css' href='<?=phpa_include("style.css")?>' />
</head>
<body>
<div id="content">
    <div class="container">
        <div class="titTable2">
            ::: CURRENCY CONVERTER :::
        </div>
        <div class="table3">
            <form name="form1" method="post" action="">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <?php
                    if($_POST['action'] == "convert") {
					?>
                    <tr valign="TOP">
                        <th colspan="3">
                            <?=number_format(doubleval($_POST['amount']),4,'.',',')?>
                            <?=$_POST['from']?>
                            =
                            <?=number_format($CONVERTED,4,'.',',')?>
                            <?=htmlspecialchars($_POST['to'])?>
                        </th>
                    </tr>
                    <?php
                    } else {
					?>
                    <tr valign="TOP">
                        <td colspan="3" align=CENTER>&nbsp;</td>
                    </tr>
                    <?php
                    }
					?>
                    <tr valign="TOP">
                        <td width="22%">Convert<br>
                            <input type="text" name="amount" size="5" value=<?=$AMOUNT?> />
                        </td>
                        <td width="39%">of this currency<br>
                            <select name="from">
                                <?php
                                foreach($CURRENCIES as $k=>$v) {
                                	print "<option value=\"$k\"";
                                	if($k == $SETTINGS['currency']) {
                                		print " selected=true";
                                	} elseif($_POST['from'] == $k) {
                                		print " selected=true";
                                	}
                                	print ">$k $v</option>\n";
                                }
								?>
                            </select>
                        </td>
                        <td width="39%">into this currency<br>
                            <select name="to">
                                <?php
                                foreach($CURRENCIES as $k=>$v) {
                                	print "<option value=\"$k\"";
                                	if($_POST['to'] == $k)
                                		print " selected=true";
                                	print ">$k $v</option>\n";
                                }
								?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div style="text-align:center">
                    <input type="hidden" name="action" value="convert" />
                    <input type="submit" name="Submit" value="<?=$MSG_25_0176?>" />
                </div>
            </form>
        </div>
        <div style="text-align:center">
            <input type="submit" value="Close" onClick="javascript:window.close()" />
        </div>
		<br>
    </div>
</div>
</body>
</html>
