<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors','On');
// on retourne l'heure immédiate de Greenwitc
sleep(0.1);
$cheminPourArriverJusquauCal = "/cal/";

if (isset ( $_GET["mois"] )) {
	$moisEncours = ( int ) $_GET ["mois"];
} else {
	$moisEncours = ( int ) date ( "m" );
}
$montreLaDerniereLigne = "";
if (isset ( $_GET["montreLaDerniereLigne"] )) {
	$montreLaDerniereLigne = "&montreLaDerniereLigne=1";
}
$ajouteXLigneGet = "";
$ajouteXLignes= 0;
if ("" != $_GET["ajouteXLigne"]) {
	
	$ajouteXLignes = ( int ) $_GET ["ajouteXLigne"];
	$ajouteXLigneGet = "&ajouteXLigne=". $ajouteXLignes;
} 
$nom = '/cal/an/'.str_pad ( $moisEncours, 2, "0", STR_PAD_LEFT ).'/jourAvecPhotos.php';
require $_SERVER['DOCUMENT_ROOT'].$nom;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- pour les navigateurs HTTP/1.0 --> <meta http-equiv="pragma" content="no-cache" />
<!-- pour les navigateurs HTTP/1.1 --> <meta http-equiv="cache-control" content="no-cache" /> 

<link rel="stylesheet" type="text/css" media="all" href="../css/calStyl.css" />
<?php

if (isset ( $_GET ["an"] )) {
	$anEnCours = ( int ) $_GET ["an"];
} else {
	$anEnCours = ( int ) date ( "Y" );
}
$mktime = mktime ( 0, 0, 0, $moisEncours, 1, $anEnCours );
$mois = array (
		"",
		"Janvier",
		"fevrier",
		"mars",
		"avril",
		"mai",
		"juin",
		"juillet",
		"aout",
		"septembre",
		"octobre",
		"novembre",
		"decembre" 
);
$nbJourDsLeMois = array (
		0,
		31,
		28 + (date ( "L", $mktime )),
		31,
		30,
		31,
		30,
		31,
		31,
		30,
		31,
		30,
		31 
);

$jour = date ( "N", $mktime );
$x = ($jour - 1) * - 1;

$blanc = "&nbsp;&nbsp;";
$blanc2chiffres = "&nbsp;&nbsp;&nbsp;&nbsp;";

$_SESSION ["leCompteur"] = 1; //Sert a rien mias laisse pour etre sur de ne pas casser retaille dans ecriture.php
$cpt = 1;


$_SESSION["leCompteurDimage"] = 1;

$fond = 0;
$fondImg = "0";
$fondOui = '';
$fondNon = 'checked';
if (!empty ( $_GET ["fond"] )) {
	$fond = $_GET ["fond"];
}

if ("1" == $fond) {
	$fondOui = 'checked';
	$fondNon = '';
	$fondImg = "0";
} else {
	$fondImg = "1";
}
$retailleJeTeDis = "";
if (! empty ( $_GET ["retailleJeTeDis"] )) {
	$retailleJeTeDis = "&retailleJeTeDis=" . $_GET ["retailleJeTeDis"];
}
$pixelFond = "width:900px; height:540px";
if ($_GET ["grand"] == "1") {
	$retailleJeTeDis .= "&grand=1";
	$pixelFond = "width:1060px; height:660px";
}

$url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"].'?' . $_GET ["qui"] . "&mois=" . $_GET ["mois"] . "&LeCompteur=" . $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;


?> 
<title><?php print $mois[$moisEncours]." ".$anEnCours;?></title>
<script type="text/javascript">
var fond=<?php print $fond;?>;
function change(Id)

{	
	cal=window.open("<?php print $cheminPourArriverJusquauCal; ?>ecriture.php?qui=cal.php&change="+Id+"&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>", "pop","width=300, height=300, toolbars=no, scrollbars=yes, menubars=no, status=no");
	cal.focus();
}
function changeTout()
{	
	cal=window.open("<?php print $cheminPourArriverJusquauCal; ?>ecriture.php?qui=cal.php&tout=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>", "pop","width=300, height=300, toolbars=no, scrollbars=yes, menubars=no, status=no");
	cal.focus();
}

function videTout()
{	
	cal=window.open("<?php print $cheminPourArriverJusquauCal; ?>ecriture.php?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>", "pop","width=300, height=300, toolbars=no, scrollbars=yes, menubars=no, status=no");
	cal.focus();
}

function montreCache()
{	
<?php $montreLaDerniereLigne="&montreLaDerniereLigne=1";?>
	window.location="http://<?php print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>";

}



function cacheCache()
{	
<?php $montreLaDerniereLigne="";?>
	window.location="http://<?php print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>";

}

function ajouteLigne()
{	
<?php $ajouteXLigneGet="&ajouteXLigne=".($ajouteXLignes+1);?>
	window.location="http://<?php print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>";
}

function supprimerLigne()
{	
<?php 
$ajouteXLigneGet="";
if($ajouteXLignes-1>=0) {$ajouteXLigneGet="&ajouteXLigne=".($ajouteXLignes-1);}
?>
	window.location="http://<?php print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>";

}

function aggrandit()
{	
<?php
if (isset ( $_GET ["grand"] )) {
	if ($_GET ["grand"] == "0") {
		$retailleJeTeDis = str_replace ( "grand=0", "grand=1", $retailleJeTeDis );
	}
} else {
	$retailleJeTeDis .= "&grand=1";
}

?>
	window.location="http://<?php print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>";
}

function rapetisse()
{	
	<?php
	if (isset ( $_GET ["grand"] )) {
		if ($_GET ["grand"] == "1") {
			$retailleJeTeDis = str_replace ( "grand=1", "grand=0", $retailleJeTeDis );
		}
	}
	
	?>
	window.location="http://<?php print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>?qui=cal.php&vide=1&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt.$retailleJeTeDis.$montreLaDerniereLigne.$ajouteXLigneGet;?>";
}

</script>
<style>
.blocOpaque { /* Astuce de cr�ation d'un bloc � 60% opaque � l'image de fond */
  filter:Alpha(opacity=2);-moz-opacity:0.1;opacity: 0.1; <?php echo $pixelFond;?>;
float:left; position:absolute; top: 135px; left: 80px; z-index:1000;
}

<?php

$espaceGrand = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$espacePetit = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

$pixelTablePetit = "900px";
$pixelTableGrand = "1200px";
$pixelTable = $pixelTablePetit;

$left2Petit = "8px";
$left2Grand = "20px";
$left2 = $left2Petit;

$left1Petit = "8px";
$left1Grand = "12px";
$left1 = $left1Petit;

//quand on veut petit $espace = $espacePetit; +  width:900px dans style table
//quand on veut grand $espace = $espaceGrand; +  width:1200px dans style table


//TODO beurk chabger cte mer.e
$labelSemainePetit = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lundi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$espacePetit."Mardi&nbsp;&nbsp;".$espacePetit."&nbsp;&nbsp;Mercredi"
		.$espacePetit."Jeudi".$espacePetit."&nbsp;Vendredi".$espacePetit."Samedi".$espacePetit."Dimanche";

//TODO beurk chabger cte mer.e
$labelSemaineGrand = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lundi&nbsp;&nbsp;".
		$espaceGrand."Mardi".$espacePetit."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mercredi".
		$espacePetit."&nbsp;&nbsp;&nbsp;&nbsp;Jeudi".$espacePetit."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendredi"
				.$espacePetit."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Samedi"
				.$espacePetit."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dimanche";
	
$labelSemaine = $labelSemainePetit;
				

if($_GET["grand"] == 1) {

	$pixelTable = $pixelTableGrand;
	$labelSemaine = $labelSemaineGrand;
	$left2 = $left2Grand;
	$left1 = $left1Grand;
}

?>
body{
	font-family:fantasy; font-size:12px
}
td {
	filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;
}


 
  	.divImg1 {float:left; position:relative; top: -23px; left: -6px; z-index:0; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1; padding:3px;}
	.divImg2 {float:left; position:relative; top: -23px; left: 0px; z-index:-4px; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1; padding:3px;}
	.divChiffre1{float:left; position:relative; top: -18px; left:<?php echo $left1?>; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	.divChiffre1Img1{float:left; position:relative; top: 1px; left:<?php echo $left1?>; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	.divChiffre2Img1{float:left; position:relative; top: 1px; left:<?php echo $left2?>; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	.tdCaption {font-size:12px; font-weight:bold; text-align:left; vertical-align:center; background-color:#663333; color:#FFFFFF}
	
	.divImg3 {float:left; position:relative; top: -12px;   left: 10px; z-index:-4px; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1; padding:3px;}
	.divChiffre3Img1{float:left;  position:relative; top: -8px; left:28px; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	
	

table { 
  	padding:10px; margin:10px;font-size:12px; text-align:center; vertical-align: middle; width:<?php echo $pixelTable;?>
}
</style>
</head>

<body>

<?php
$dimTd = ' width="120" height="80"';
$dimImg = ' width="120" height="80"';
$dimImgPortrait = ' width="80" height="120"';

/*
 $dimTd = ' width="140" height="93"';
 $dimImg = ' width="140" height="93"';
 $dimImgPortrait = ' width="93" height="140"';

 $dimTd = ' width="120" height="80"';
 $dimImg = ' width="120" height="80"';
 $dimImgPortrait = ' width="80" height="120"';
 
 $dimTd = ' width="160" height="106"';
 $dimImg = ' width="160" height="106"';
 $dimImgPortrait = ' width="106" height="160"';
 */

// tableau des td (contenant le code source des td
$arrayTd = array ();
$arrayTdPrint = "";
$trVideParceQuilYAUnPortraitDansLaPremiereLigne = "";


$nombreDeCase = 43 + ($ajouteXLignes * 7);

$tempClassDiv2Chiffre = "divChiffre2Img1";
$tempClassDivImg2 = "divImg2";
$tempClassDiv1Chiffre = "divChiffre1Img1";
$tempClassDivImg1 = "divImg1"
		;
$classDiv2Chiffre = "divChiffre2Img1";
$classDivImg2 = "divImg2";
$classDiv1Chiffre = "divChiffre1Img1";
$classDivImg1 = "divImg1";

for ($iTd=1;$iTd<$nombreDeCase;$iTd++){
	
	if(!$arrayPhotoOuCarre[$iTd]) {
		//c'est un carre
		//debug : print "<br>c'st un carre".gmdate("D, d M Y H:i:s");
		$arrayTdPrint = '<!-- td'.$iTd.' -->    <td'.$dimTd.' ondblclick="javascript:change('.$iTd.')"><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .=$classDiv1Chiffre;} else {$arrayTdPrint  .=$classDiv2Chiffre;} $arrayTdPrint  .='">'; if((($iTd+$x)>0)&&(($iTd+$x)<=$nbJourDsLeMois[$moisEncours])) $arrayTdPrint  .=($iTd+$x); else {$arrayTdPrint  .= $blanc2chiffres;} $arrayTdPrint  .='</div><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .=$classDivImg1;} else {$arrayTdPrint  .=$classDivImg2;} $arrayTdPrint  .='"><!-- img --><img src="'.$cheminPourArriverJusquauCal.'carre.jpg"'.$dimImg.' /><!-- img --></div></td>';
	} else {
		// c'est une photo
		//debug : print "<br>c'st un PHOTO".gmdate("D, d M Y H:i:s");
		$laDimImage = printDim($cpt, $dimImg,str_pad($moisEncours, 2, "0", STR_PAD_LEFT), $dimImgPortrait);// portrait ou paysage on change les dim de l'image en fonction
		if($laDimImage == $dimImgPortrait){
			$classDiv2Chiffre = "divChiffre3Img1";
			$classDivImg2 = "divImg3";
			$classDiv1Chiffre = "divChiffre3Img1";
			$classDivImg1 = "divImg3";	
		}
		
		$arrayTdPrint = '<!-- td'.$iTd.' -->    <td'.$dimTd.' ondblclick="javascript:change('.$iTd.')"><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .=$classDiv1Chiffre;} else {$arrayTdPrint  .=$classDiv2Chiffre;} $arrayTdPrint  .='">'; if((($iTd+$x)>0)&&(($iTd+$x)<=$nbJourDsLeMois[$moisEncours])) $arrayTdPrint  .=($iTd+$x); else {$arrayTdPrint  .= $blanc2chiffres;} $arrayTdPrint  .='</div><div class="'; if(($iTd+$x)<=9) {$arrayTdPrint  .=$classDivImg1;} else {$arrayTdPrint  .=$classDivImg2;} $arrayTdPrint  .='"><!-- img --><img src="/cal/retaille/'. str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . '/cal' . ($cpt++).'.jpg"'.$laDimImage.' /><!-- img --></div></td>';
		if(($laDimImage == $dimImgPortrait) &&($iTd<8)){
			$trVideParceQuilYAUnPortraitDansLaPremiereLigne = '<tr>
				<td colspan="7">&nbsp;</td>
			</tr>';
		}
		$_SESSION["leCompteurDimage"] = $cpt;
	}
	$arrayTd[$iTd] = $arrayTdPrint;
	$classDiv2Chiffre = $tempClassDiv2Chiffre;
	$classDivImg2 = $tempClassDivImg2;
	$classDiv1Chiffre = $tempClassDiv1Chiffre;
	$classDivImg1 = $tempClassDivImg1;
}
$trVideParceQuilYAUnPortraitDansLaPremiereLigne = '<tr>
				<td colspan="7">&nbsp;</td>
			</tr>';

function printDim($leCpt, $leDimImg, $leMoisEnCours, $leDimImgPortrait) {
	
	$leChemin = "http://" . $_SERVER['HTTP_HOST'] . "/cal/retaille/" . str_pad ( $leMoisEnCours, 2, "0", STR_PAD_LEFT ) . "/cal" . $leCpt . ".jpg";
	list ( $width, $height, $type, $attr ) = getimagesize ( $leChemin );
	$value = $leDimImg;
	if ($height > $width) {
		$value = $leDimImgPortrait;
	}
	return $value;
}
?>
<table width="200" border="0" style="position: relative;"
		cellpadding="1" cellspacing="15">

		<tr>
			<th colspan="7" scope="col"
				style="font-size: 12px; font-weight: bold; text-align: left; height: 40px; vertical-align: center; background-color: #663333; color: #FFFFFF"><?php print $labelSemaine;?></th>
		</tr>
  <?php
 		print $trVideParceQuilYAUnPortraitDansLaPremiereLigne;
		for($iTd = 0; $iTd < $nombreDeCase; $iTd ++) {
			if (($iTd - 1) % 7 == 0 && $iTd != 0) {
				if ($iTd == 1) {
					print "\n<tr><!-- $iTd -->";
				} else if ($iTd != 36) {
					print "\n</tr>\n<tr><!-- $iTd -->";
				} else {
					print "\n</tr>" . '<tr id="derniereLigne" ';
					if (((36 + $x) > $nbJourDsLeMois [$moisEncours]) && !$montreLaDerniereLigne){
						print 'style="display:none"';
					}
					print '  >';
				}
			}
			print "\n" . $arrayTd [$iTd];
		}
		?>
	</tr>
	</table>
	<br />
	<div
		style="position: relative; left: 850px; top: -55px; font-size: 20px; font-weight: bold;"><?php print $mois[$moisEncours]." ".$anEnCours;?></div>
	<br />
	<div
		style="position: relative; left: 850px; top: -55px; font-size: 20px; font-weight: bold;">
		Mettre le fond: <input type="radio" name="lefond" id="lefondoui"
			onclick="javascript:fond=1; document.location.href='<?php print $url?>&fond=1'"
			<?php print $fondOui; ?> /> oui <input type="radio" name="lefond"
			id="lefondnon"
			onclick="javascript:fond=1; document.location.href='<?php print $url?>&fond=0'"
			<?php print $fondNon; ?> /> non
	</div>
<?php
if ("1" == $fond) {
	print '
<img src="/cal/photos/' . str_pad ( $moisEncours, 2, "0", STR_PAD_LEFT ) . '/grand.jpg" class ="blocOpaque" ondblclick="javascript:document.location.href=\'' . $url . '&fond=' . $fondImg . '\';" />
';
}
?>
 
<bR />
	<br />
<?php
// affichage des liens vers les mois suivants
for($ii = 1; $ii <= 12; $ii ++) {
	if ($moisEncours != $ii) {
		print "<a href='/cal/an/" . str_pad ( $ii, 2, "0", STR_PAD_LEFT ) . "/cal.php?" . str_replace ( "mois=" . $moisEncours, "mois=" . $ii, $_SERVER ["QUERY_STRING"] ) . "'>";
	}
	print str_pad ( $ii, 2, "0", STR_PAD_LEFT );
	if ($moisEncours != $ii) {
		print "</a>";
	}
	print "&nbsp;&nbsp;&nbsp;";
	if ($ii != 12) {
		print "/";
	}
}
?>
<br/>
<input type="button" value="mettre toutes les photos" onclick="javascript:changeTout()">
<input type="button" value="effacer toutes les photos" onclick="javascript:videTout()">
<br/>
<input type="button" value="Montrer la ligne cachée" onclick="javascript:montreCache()"><input type="button" value="cacher la ligne cachée" onclick="javascript:cacheCache()">
<br/>
<input type="button" value="Ajouter une ligne" onclick="javascript:ajouteLigne()">
<input type="button" value="Supprimer une ligne" onclick="javascript:supprimerLigne()">
<br/>
<input type="button" value="Mettre plus grand" onclick="javascript:aggrandit()">
<input type="button" value="Mettre plus petit" onclick="javascript:rapetisse()">
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

