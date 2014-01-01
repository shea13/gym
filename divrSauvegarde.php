<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div id="csright">
    
    <hr>
    <!-- fin recherche -->
    <hr>
    <img src="logo.png" width="61" height="57" />
    <div id="droit" class="liensDroit">
      <ul >
        <li> <img src="images/fos.gif" style="border: 0px none;" alt="Fos-sur-mer" title="Fos-sur-mer" height="15" width="15">&nbsp;&nbsp;<a href="http://www.fos-sur-mer.fr/-Actualite-.html" target="_blank">Actualites à Fos sur mer</a> </li>
        <li> <img src="images/contact.png" style="border: 0px none;" alt="contact" title="contact"  height="15" width="15"> &nbsp;&nbsp;<a href="contact.php">Contact</a></li>
        <li> <img src="images/liens.png" style="border: 0px none;" alt="" title=""  height="15" width="15" /> &nbsp;&nbsp;<a href="liens.php">Liens</a> </li>
      </ul>
  </div>
<hr>
    <hr>
    <div class="actualite">
      <div class="blanc"></div>
      <div><img src="images/droite.jpg" width="250"/></div>
      <div class="csclear"></div>
    </div>
    <hr>


	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript">
    jQuery.noConflict();
    var Sep = "#&#&#&#&#";
    var reg =new RegExp(Sep, "g");
    function actusSuivantes(Page)
    {
         pageEnParametre = pageEnCours + Page;
         if(Page<0) Page= 0;
           jQuery.ajax({
           type: "POST",
           url: "inc/actualites.php",
           data: "d="+Page+"&ajax=1",
           dataType: "html",
           success: function(data){
               var pos=data.indexOf(Sep);
               var pourLeDivActu = data;
               var pourLeDivPage = "1/1";
               if(-1!=pos)
               {
                   var TabRep=data.split(reg);
                   pourLeDivActu = TabRep[0];
                   pourLeDivPage = TabRep[1];
               }
               jQuery("#printActu").html(pourLeDivActu);
               jQuery("#numPage").html(pourLeDivPage);
           }
         });
    }
    </script>
  
    <div class="actualite">
     <?php if(!isset($pasDactualite)) {?> <h2 class="titreActualite">L'Agenda</h2> <?php }?>
      <div class="blanc"></div>
      <div>
      	<div id="printActu">
        <?php 
		$nbtotal = 1; 
		if(!isset($pasDactualite)) 
		{
			include("inc/actualites.php");
			if(!isset($d))
			{
			    $d=0;
			}
			$dPlus = $d+1;  // page suivante 
			$dMoins = $d-1; // page précédente 
			if($dMoins<0){ $dMoins = 0;} // si page suivante <0 c'est qu'on est au début (page 0)
			 
			$pageTotal = (int) ($nbtotal/7); // on affiche 7 article par page
			if($pageTotal<$nbtotal/7) {$pageTotal++;} // si ($pageTotal<$nbtotal/7) c'est qu'il y a plus que 7 articles sur la dernière page, donc il faut une page en plus pour toutes les afficher
			
			
		?>
          </div>
            <div class="pages">
             <div class="suivante"> <a href="#" onclick="javascript:actusSuivantes(-1); return false;"><img src="images/precedent.jpg" alt="pr&eacute;c&eacute;dent"></a>&nbsp;<span id="numPage"><?php echo $dPlus;?>/<?php echo $pageTotal;?></span>&nbsp;<a href="#" onclick="javascript:actusSuivantes(1); return false;"><img src="images/suivant.jpg" alt="suivant"></a> </div>
              <div class="csclear"></div>
            </div>
        <?php 
		}//   if(!isset($pasDactualite)) 
		?>
       
      <div class="csclear"></div>
      </div>
  </div>
    <div class="csclear"></div>
  </div>
  <script type="text/javascript">
	    var pageEnCours = <? echo (int)$dPlus; ?>;
	</script>