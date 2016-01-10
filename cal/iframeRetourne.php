<?php session_start();
// Content type
header('Content-type: image/jpeg');
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors','On');
if(empty($_GET["mois"])) {
     die(" mois n'est pas rempli");
}
$photoCliquee = 0; 
if(isset($_GET["laPhotoCliquee"])){
 	$photoCliquee = (int)$_GET["laPhotoCliquee"];
}
$cheminPourArriverJusquauCal = "/cal/an/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT) . "/";
$dirPhoto = "retaille/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT) . "/cal" . $photoCliquee . ".jpg";
// Fichier et degrés de rotation

$degrees = 90;
// Chargement
$source = imagecreatefromjpeg($dirPhoto);

// Rotation
$rotate = imagerotate($source, $degrees, 0);

// Affichage
imagejpeg($rotate, $dirPhoto);

// Libération de la mémoire
imagedestroy($source);
imagedestroy($rotate);

if(isset($_GET["change"])){
 	$change = (int)$_GET["change"];
}


if(isset($_GET["tout"])){
 	$tout = true;
}
 
if(isset($_GET["vide"])){
 	 $vide = true;
}

$montreLaDerniereLigne = "";
if (isset ( $_GET ["montreLaDerniereLigne"] )) {
	$montreLaDerniereLigne = "&montreLaDerniereLigne=1";
}
$ajouteXLigneGet = "";
$ajouteXLignes= 0;
if (isset ( $_GET ["ajouteXLigne"] )) {
	$ajouteXLignes = ( int ) $_GET ["ajouteXLignes"];
	$ajouteXLigneGet = "&ajouteXLigne=". $_GET ["ajouteXLigne"];
}
$parametresSuite = $montreLaDerniereLigne.$ajouteXLigneGet;
if ($_GET ["grand"] == "1") {
	$parametresSuite .= "&grand=1";
}
$onredirigeVers = $cheminPourArriverJusquauCal . $_GET["qui"] . "?mois=" . $_GET["mois"] . "&leCompteur=" . $_GET["leCompteur"]."&retourne=1".$parametresSuite;

print "laphotocliquee " . $photoCliquee;
print "<br> =>".$dirPhoto;




?>
<script language="javascript" type="text/javascript">

 window.opener.location='<?php
print $onredirigeVers."&tp=".time();
?>';
// parent.close();
 </script>





