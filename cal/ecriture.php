 <?php session_start();

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors','On');
 if(empty($_GET["mois"])) {
     die(" mois n'est pas rempli");
 }
 


function redimensionner ($img_url, $largeur)
{
	$erreur = "";
    // D�terminer l'extension � partir du nom de fichier
    $extension = substr($img_url, - 3);
    // Afin de simplifier les comparaisons, on met tout en minuscule
    $extension = strtolower($extension);
    
    switch ($extension)
    {
        case "jpg":
        case "jpeg": //pour le cas oùl'extension est "jpeg"
            $src_im = imagecreatefromjpeg($img_url);
            break;
        case "gif":
            $src_im = imagecreatefromgif($img_url);
            break;
        case "png":
            $src_im = imagecreatefrompng($img_url);
            break;
        default:
            $erreur =  "<br>L'image $img_url n'est pas dans un format reconnu. Extensions autoris�es : jpg/jpeg, gif, png";
            return false;
            break;
    }
    ImageAlphaBlending($src_im, true);
    imagesavealpha($src_im, true);
    // R�cup�re les dimensions de l'image
    $size = GetImageSize($img_url);
    $src_w = $size[0];
    $src_h = $size[1];
    // Taille de votre image
    $dst_w = $largeur;
    // Contraint le r��chantillonage � une largeur fixe et maintient le ratio de l'image
    $dst_h = round(($dst_w / $src_w) * $src_h);
    $dst_im = ImageCreateTrueColor($dst_w, $dst_h);
    // ImageCopyResampled copie et r��chantillonne l'image originale
    ImageCopyResampled($dst_im, $src_im, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    ImageAlphaBlending($dst_im, true);
    imagesavealpha($dst_im, true);
    $noir = imagecolorallocate($dst_im, 251, 230, 247); //On r�alloue du noir, l'image ayant �t� modifi�e.
    //imagecolortransparent($dst_im, $noir); //Le noir devient transparent

    imagejpeg($dst_im, $img_url);
    //Pour creer les imemes images en PNG decommenter ci dessous
    // imagepng($dst_im, $img_url);

    imagedestroy($dst_im);
    imagedestroy($src_im);
}

if (empty($_GET["mois"]))
{
    die(" mois n'est pas rempli");
}
$cheminPourArriverJusquauCal = "/cal/an/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT) . "/";

if ((!is_file("retaille/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT) . "/cal" . ($a = $_GET["leCompteur"] + 1))) ||(!empty($_GET["retailleJeTeDis"])))
{
    $cheminDir = "retaille/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT);
    $Dir = opendir("retaille/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT));
    while ($DraftDirectoryElementDansDossier = readdir($Dir))
    {
        if ($DraftDirectoryElementDansDossier{0} != ".")
        {
            if (((! preg_match("/cal/", substr($DraftDirectoryElementDansDossier, 0, 3))) && (preg_match("/.jpg/", strtolower($DraftDirectoryElementDansDossier)) || preg_match("/.jpeg/", strtolower($DraftDirectoryElementDansDossier)))) ||(!empty($_GET["retailleJeTeDis"])))
            {
                rename($cheminDir . "/" . $DraftDirectoryElementDansDossier, $cheminDir . "/cal" . $a . ".jpg");
                redimensionner($cheminDir . "/cal" . $a . ".jpg", 600);
                $a ++;
            }
        }
    }
}


$change = false;
$tout = false;
$vide = false;

$photoCliquee = 0;
if(isset($_GET["change"])){
 	$change = (int)$_GET["change"];
}

if(isset($_GET["laPhotoCliquee"])){
 	$photoCliquee = (int)$_GET["laPhotoCliquee"];
}

function renameParceQuonSupprime($id){
	  print "<br> dans le fonction";
	  $dernierePhoto = "";
	if($id) {  
	 $b=1;
	 $leDernierId = false;
	 $cheminDir = "retaille/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT);
		$Dir = opendir("retaille/" . str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT));
		//je cherche la derniere photo
		while ($DraftDirectoryElementDansDossier = readdir($Dir))
		{
			if ($DraftDirectoryElementDansDossier{0} != ".")
			{
				if (((preg_match("/.jpg/", strtolower($DraftDirectoryElementDansDossier)) || preg_match("/.jpeg/", strtolower($DraftDirectoryElementDansDossier)))))
				{
					$leDernierId = $b;
					$b++;
				}
			}
		}

		//on renomme les photos, celle cliqué doit passer en dernier
		rename($cheminDir . "/cal" . $id . ".jpg", $cheminDir . "/cal" . $id . "Temp.jpg");
		print "<br>on veut renommer " .$cheminDir . "/cal" . $id . ".jpg" . " par " . $cheminDir . "/cal" . $id . "Temp.jpg";
		for($i=($id+1); $i<$b;$i++) {
			rename($cheminDir . "/cal" . $i . ".jpg", $cheminDir . "/cal" . ($i-1) . ".jpg");
			print "<br>on veut renommer " .$cheminDir . "/cal" . $i . ".jpg" . " par " . $cheminDir . "/cal" . ($i-1) . ".jpg";
		}
		rename($cheminDir . "/cal" . $id . "Temp.jpg", $cheminDir . "/cal" . ($leDernierId) . ".jpg");
    }
    print "<br> la derniere photo '". $dernierePhoto."'".$id;
}


 
if(isset($_GET["tout"])){
 	$tout = true;
 	$_SESSION ["leCompteurDimage"] = 1;
}
 
if(isset($_GET["vide"])){
 	 $vide = true;
 	 $_SESSION ["leCompteurDimage"] = 1;
}

$montreLaDerniereLigne = "";
if (isset ( $_GET ["montreLaDerniereLigne"] )) {
	$montreLaDerniereLigne = "&montreLaDerniereLigne=1";
}
$ajouteXLigneGet = "";
$ajouteXLignes= 0;
if (isset ( $_GET ["ajouteXLigne"] )) {
	$ajouteXLignes = ( int ) $_GET ["ajouteXLigne"];
	$ajouteXLigneGet = "&ajouteXLigne=". $_GET ["ajouteXLigne"];
}
$parametresSuite = $montreLaDerniereLigne.$ajouteXLigneGet;
if ($_GET ["grand"] == "1") {
	$parametresSuite .= "&grand=1";
}
$onredirigeVers = $cheminPourArriverJusquauCal . $_GET["qui"] . "?mois=" . $_GET["mois"] . "&leCompteur=" . $_GET["leCompteur"].$parametresSuite;
print "<br/>Changement voulu pour " . $change . " dans le fichier " . $_GET["qui"] . "?mois=" . $_GET["mois"] . "&leCompteur=" . $_GET["leCompteur"].$parametresSuite;

$Fnm = $_SERVER["DOCUMENT_ROOT"] .  $cheminPourArriverJusquauCal . "jourAvecPhotos.php";
if (! $fp = fopen($Fnm, "r"))
{
    "<br> erreur de lecture du fichier ($Fnm) <br>";
    exit();
}

$ilYaUnePhoto = ' = true;';
$ilNYaPasUnePhoto = ' = false;';
$nouvelleLigne = "";

print "<br><br> seession ".$_SESSION["leCompteurDimage"];
$ajouterUnLigneInFile = '$ajouterUneLigne=';
//lecture du fichier
while (! feof($fp))
{ // on parcourt toutes les lignes
		$ligne = fgets ( $fp, 4096 );      
		if ($change) { // on veut changer une photo
			$onCherche = '$arrayPhotoOuCarre[' . $change . ']';
			$nouvelleLigne = $onCherche . $ilYaUnePhoto;
			if (strpos ( $ligne, $onCherche ) !== false) {
				print "<br><br> on a trouve " . $onCherche . " dans =>" . htmlentities ( $ligne ) . "<br>";
				if (strpos ( $ligne, $ilYaUnePhoto ) !== false) {
					print "<br> il y avait une photo <br>";
					$nouvelleLigne = $onCherche . $ilNYaPasUnePhoto;
					renameParceQuonSupprime($photoCliquee);
				} else {
					print "<br> il y avait PAS de photo <br>";
					$limage = "http://" . $_SERVER['HTTP_HOST'] . "/cal/retaille/" . str_pad ( $_GET ["mois"], 2, "0", STR_PAD_LEFT ) . "/cal" . $_SESSION ["leCompteurDimage"] . ".jpg";
					if (! getimagesize ( $limage )) {
						$nouvelleLigne = $onCherche . $ilNYaPasUnePhoto;
						print '<script language="javascript" type="text/javascript">
    						alert("' . $limage . ' N existe PAS !!!");
    						</script>';
					}/* else {
					 print '<script language="javascript" type="text/javascript">
    						alert("' . $limage . ' EXISTE !!!");
    						</script>';
					}*/
				}
				$ligne = $nouvelleLigne . "\n";
			} elseif (strpos ( $ligne, $ajouterUnLigneInFile ) !== false) {       
               $ligne = $ajouterUnLigneInFile.$ajouteXLignes.";\n";  
            }
		} elseif ($tout) {	
			
			$onCherche = '$arrayPhotoOuCarre';
			if (strpos ( $ligne, $onCherche ) !== false) {
				
				if(preg_match('|arrayPhotoOuCarre\[([0-9]*)|', $ligne, $matches)) {
					if(isset($matches[1])) {
						$numeroPhoto = $matches[1];
					}
				}
				$limage = "http://" . $_SERVER['HTTP_HOST'] . "/cal/retaille/" . str_pad ( $_GET ["mois"], 2, "0", STR_PAD_LEFT ) . "/cal" . $numeroPhoto . ".jpg";
				if (getimagesize ( $limage )) {
					$ligne = str_replace($ilNYaPasUnePhoto, $ilYaUnePhoto, $ligne);
					$_SESSION ["leCompteurDimage"]++;
				} else {
					$ligne = str_replace($ilYaUnePhoto, $ilNYaPasUnePhoto, $ligne);
				}
			}
		} elseif ($vide) {			
			$onCherche = '$arrayPhotoOuCarre';
			if (strpos ( $ligne, $onCherche ) !== false) {
					$ligne = str_replace($ilYaUnePhoto, $ilNYaPasUnePhoto, $ligne);								
			}
		} elseif (strpos ( $ligne, $ajouterUnLigneInFile ) !== false) {       
               $ligne = $ajouterUnLigneInFile.$ajouteXLignes.";\n";  
        }
		$page .= $ligne; // lecture du contenu de la ligne
	}
	

//print "<br><br>".htmlentities($page);
fclose($fp);
$fp = fopen($Fnm, "w+"); //lecture du fichier
fputs($fp, $page);
fclose($fp);


	include $Fnm;
	$_SESSION["arrayPhotoOuCarre"] = $arrayPhotoOuCarre;
?>
<script language="javascript" type="text/javascript">

 window.opener.location='<?php
print $onredirigeVers."&tp=".time();
?>';
parent.close();
</script>





