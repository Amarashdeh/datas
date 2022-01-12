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

    include "includes/config.inc.php";
?>
<HTML>
<HEAD>
<SCRIPT Language=Javascript>
function window_open(pagina,titulo,ancho,largo,x,y){

  var Ventana= 'toolbar=0,location=0,directories=0,scrollbars=0,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+ancho+',height='+largo;
  open(pagina,titulo,Ventana);

}
</SCRIPT>

<BODY>
<?php
    if(is_array($UPLOADED_PICTURES))
    {
  ?>


      <TABLE><TR>
  <?php
       while(list($k,$v) = each($UPLOADED_PICTURES))
       {
			$k = htmlspecialchars($k);
			$v = addslashes(str_replace('..','',$v));
			$TMP = GetImageSize($uploaded_path.$GALLERY_DIR."/".$v);
			$WIDTH = (int)$TMP[0];
			$HEIGHT = (int)$TMP[1];		   
    ?>
           <TD><A HREF="javascript:window_open('view_gallery.php?img=<?=$k?>','perview',<?=$WIDTH?>,<?=$HEIGHT?>,0,0)"><IMG SRC="<?=$uploaded_path.$GALLERY_DIR.'/'.$v?>" BORDER=0 HEIGHT=100 HSPACE=10></TD>
    <?php
       }
    ?>
    </TR></TABLE>
    <?php
    }

?>
</BODY>
</HTML>