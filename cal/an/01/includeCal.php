<?php session_start();
$cheminPourArriverJusquauCal="/cal/";

if(isset($_GET["mois"]))
{
    $moisEncours = (int)$_GET["mois"];
} 
else
{
    $moisEncours = (int)date("m");
}

$expected = "/cal/an/".str_pad($moisEncours, 2, "0", STR_PAD_LEFT)."/cal.php";
$expected2 = "/cal/an/".str_pad($moisEncours, 2, "0", STR_PAD_LEFT)."/cal2.php";


if(($expected != $_SERVER["SCRIPT_NAME"]) && ($expected2 != $_SERVER["SCRIPT_NAME"])) {


    print "<br>  on veut changer pour  <a href=\"".$expected."?".$_SERVER["QUERY_STRING"]."\">
    			".$expected."?".$_SERVER["QUERY_STRING"]." Mais on y arrive pas
    	  </a>";

	
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" media="all" href="../css/calStyl.css" />
<?php
if(isset($_GET["an"]))
{
    $anEnCours = (int)$_GET["an"];
} 
else
{
    $anEnCours = (int)date("Y");
}
$mktime = mktime(0,0,0,$moisEncours, 1, $anEnCours);
$mois = array("","Janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
$nbJourDsLeMois = array(0,31, 28+(date("L",$mktime)), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

$jour = date("N", $mktime); 
$x = ($jour-1)*-1;


$blanc="&nbsp;&nbsp;";
$blanc2chiffres="&nbsp;&nbsp;&nbsp;&nbsp;";

//sert a rien pas supprimer pour pas casser retaille dans ecriture.php
$_SESSION["leCompteur"]=1;


if(empty($_SESSION["leCompteurDimage"]))
{
	$_SESSION["leCompteurDimage"]=1;
}

if(isset($_GET["leCompteur"]))
{
$_SESSION["leCompteur"]=$_GET["leCompteur"];
}
$cpt= $_SESSION["leCompteur"];

$fond="1";
$fondImg = "0";
$fondOui = '';
$fondNon = 'checked';
if(empty($_GET["fond"]))
{
    $fond=$_GET["fond"];
}

if("1"==$fond)
{
    $fondOui = 'checked';
    $fondNon = '';
    $fondImg = "0";
}
else
{
    $fondImg = "1";
}
$url = $_SERVER["SCRIPT_URI"].$_GET["qui"]."?mois=".$_GET["mois"]."&LeCompteur=".$_GET["LeCompteur"];
$retailleJeTeDis="";
if(!empty($_GET["retailleJeTeDis"])){
	$retailleJeTeDis = "&retailleJeTeDis=".$_GET["retailleJeTeDis"]; 
}

?> 
<title><?php print $mois[$moisEncours]." ".$anEnCours;?></title>
  <script type="text/javascript">
var fond=1;
function change(Id)
{
	
	cal=window.open("<?php print $cheminPourArriverJusquauCal; ?>ecriture.php?qui=cal.php&change="+Id+"&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis;?>", "pop","width=300, height=300, toolbars=no, scrollbars=yes, menubars=no, status=no");
	cal.focus();
}

</script>

</head>

<body >

<?php 
$espace = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$dimTd =' width="120" height="80"';

$dimImg =' width="120" height="80"';

$dimImgPortrait = ' width="80" height="120"';
//$arrayPhotoOuCarre = array();

//on inclut le tableau qui dis false si carre.jpg true si photo
include_once 'jourAvecPhotos.php';
//tableau des td (contenant le code source des td
$arrayTd = array();
$arrayTdPrint = "";

for ($iTd=1;$iTd<43;$iTd++){
	
	if(!$arrayPhotoOuCarre[$iTd]) {
		//c'est un carre
		print "<br> c'est un carre";
		$arrayTdPrint = '<!-- td'.$iTd.' -->    <td'.$dimTd.' ondblclick="javascript:change('.$iTd.')"><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .='divChiffre1Img1';} else {$arrayTdPrint  .='divChiffre2Img1';} $arrayTdPrint  .='">'; if((($iTd+$x)>0)&&(($iTd+$x)<=$nbJourDsLeMois[$moisEncours])) $arrayTdPrint  .=($iTd+$x); else {$arrayTdPrint  .= $blanc2chiffres;} $arrayTdPrint  .='</div><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .='divImg1';} else {$arrayTdPrint  .='divImg2';} $arrayTdPrint  .='"><!-- img --><img src="'.$cheminPourArriverJusquauCal.'carre.jpg"'.$dimImg.' /><!-- img --></div></td>';
	} else {
		// c'est une photo
		print "<br> c'est une photo";
		$laDimImage = printDim($cpt, $dimImg,str_pad($moisEncours, 2, "0", STR_PAD_LEFT), $dimImgPortrait);// portrait ou paysage on change les dim de l'image en fonction
		$arrayTdPrint = '<!-- td'.$iTd.' -->    <td'.$dimTd.' ondblclick="javascript:change('.$iTd.')"><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .='divChiffre1Img1';} else {$arrayTdPrint  .='divChiffre2Img1';} $arrayTdPrint  .='">'; if((($iTd+$x)>0)&&(($iTd+$x)<=$nbJourDsLeMois[$moisEncours])) $arrayTdPrint  .=($iTd+$x); else {$arrayTdPrint  .= $blanc2chiffres;} $arrayTdPrint  .='</div><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .='divImg1';} else {$arrayTdPrint  .='divImg2';} $arrayTdPrint  .='"><!-- img --><img src="/cal/retaille/'. str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . '/cal' . ($cpt++).'.jpg"'.$laDimImage.' /><!-- img --></div></td>';
		$_SESSION["leCompteurDimage"] = $cpt;
	}
	$arrayTd[$iTd] = $arrayTdPrint;
}


function printDim($leCpt, $leDimImg, $leMoisEnCours, $leDimImgPortrait){
	$leChemin = "http://".$_SERVER['SERVER_NAME'].":8888/cal/retaille/".str_pad($leMoisEnCours, 2, "0", STR_PAD_LEFT) . "/cal" . $leCpt .".jpg";
	list($width, $height, $type, $attr) = getimagesize($leChemin);
	$value = $leDimImg;
	if($height>$width){
		
		$value =  $leDimImgPortrait;
	}
	return $value;
}


?>
<table  width="200" border="0"  style="position:relative;" cellpadding="1" cellspacing="15" >

 <tr>
    <th colspan="7" scope="col"  style="font-size:12px; font-weight:bold; text-align:left; height: 40px; vertical-align:center;  background-color:#663333; color:#FFFFFF">&nbsp;&nbsp;&nbsp;Lundi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $espace;?>Mardi&nbsp;&nbsp;<?php print $espace;?>&nbsp;&nbsp;Mercredi<?php print $espace;?>Jeudi<?php print $espace;?>&nbsp;Vendredi<?php print $espace;?>Samedi<?php print $espace;?>Dimanche</th>
  </tr>
  <?php 
  for ($iTd=0;$iTd<43;$iTd++){
  	if(($iTd-1) % 7 == 0 && $iTd != 0) {
  		if($iTd == 1){
  			print "\n<tr><!-- $iTd -->";
  		}
  		else if($iTd != 36){
  			print"\n</tr>\n<tr><!-- $iTd -->";
  		} else {
  			print "\n</tr>".'<tr id="derniereLigne" '; if((36+$x)>$nbJourDsLeMois[$moisEncours]) { print 'style="display:none"';} print'  >';
  		}
  	}
  	print "\n".$arrayTd[$iTd];
  }
  ?>
	</tr>  
</table>
<br/>
<div style="position:relative; left:850px; top:-55px; font-size: 20px;  font-weight: bold;"><?php print $mois[$moisEncours]." ".$anEnCours;?></div>
<br/>
<div style="position:relative; left:850px; top:-55px; font-size: 20px;  font-weight: bold;">
Mettre le fond: 

<input type="radio" name="lefond" id="lefondoui" onclick="javascript:fond=1; document.location.href='<?php print $url?>&fond=1'" <?php print $fondOui; ?>/> oui 
<input type="radio" name="lefond" id="lefondnon" onclick="javascript:fond=1; document.location.href='<?php print $url?>&fond=0'" <?php print $fondNon; ?>/> non 
</div>
<?php
if("1"==$fond)
{
	print '
<img src="/cal/photos/'.str_pad($moisEncours, 2, "0", STR_PAD_LEFT).'/grand.jpg" class ="blocOpaque" ondblclick="javascript:document.location.href=\''.$url.'&fond='.$fondImg.'\';" />
';
}
?>
 
<bR /><br />
<?php
    //affichage des liens vers les mois suivants
	for($i=1; $i<=12;$i++)
	{
	        if($moisEncours!=$i) {
				print "<a href='/cal/an/".str_pad($i, 2, "0", STR_PAD_LEFT)."/cal.php?".str_replace("mois=".$moisEncours, "mois=".$i, $_SERVER["QUERY_STRING"])."'>";
			}			
			print 	str_pad($i, 2, "0", STR_PAD_LEFT);
			if($moisEncours!=$i) {
				print "</a>";
			}	
			print "&nbsp;&nbsp;&nbsp;";
			if($i!=12){
			    print "/";
			}
			
	}
?>
</body>
</html>
<?php
/*
FONCTION A TESTER POUR CAPTURE D ECRAN AVEC IE
$browser = new COM("InternetExplorer.Application");
$handle = $browser->HWND;
$browser->Visible = true;
$im = imagegrabwindow($handle);
$browser->Quit();
imagepng($im, "iesnap.png");
imagedestroy($im);*/
?>

