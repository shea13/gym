 <? 
 $x=15;
 for($i=0;$i<4;$i++)
 {
 $def = '
  <tr>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div><div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div> <div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div><div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img  src="retaille/<?php print str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . "/cal" . ($cpt++)?>.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div><div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="retaille/<?php print str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . "/cal" . ($cpt++)?>.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div><div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div><div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="retaille/<?php print str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . "/cal" . ($cpt++)?>.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td'.($x).' -->    <td<?php echo $dimTd;?> ondblclick="javascript:change('.($x).')"><div class="<?php if(('.($x).'+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(('.($x).'+$x)>0) print ('.($x).'+$x); else {print $blanc;}?></div><div class="<?php if(('.($x++).'+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="retaille/<?php print str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . "/cal" . ($cpt++)?>.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
  </tr>';

   print  $def;
}
  
  ?>