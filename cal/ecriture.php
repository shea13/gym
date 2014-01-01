 <?php
/*  plante sur e-clicking a decommenter si en local
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors','On');
 if(empty($_GET["mois"])) {
     die(" mois n'est pas rempli");
 }
 
 */

function redimensionner ($img_url, $largeur)
{
	$erreur = "";
    // Déterminer l'extension à  partir du nom de fichier
    $extension = substr($img_url, - 3);
    // Afin de simplifier les comparaisons, on met tout en minuscule
    $extension = strtolower($extension);
    
    switch ($extension)
    {
        case "jpg":
        case "jpeg": //pour le cas oÃ¹l'extension est "jpeg"
            $src_im = imagecreatefromjpeg($img_url);
            break;
        case "gif":
            $src_im = imagecreatefromgif($img_url);
            break;
        case "png":
            $src_im = imagecreatefrompng($img_url);
            break;
        default:
            $erreur =  "<br>L'image $img_url n'est pas dans un format reconnu. Extensions autorisées : jpg/jpeg, gif, png";
            return false;
            break;
    }
    ImageAlphaBlending($src_im, true);
    imagesavealpha($src_im, true);
    // Récupà¨re les dimensions de l'image
    $size = GetImageSize($img_url);
    $src_w = $size[0];
    $src_h = $size[1];
    // Taille de votre image
    $dst_w = $largeur;
    // Contraint le rééchantillonage à  une largeur fixe et maintient le ratio de l'image
    $dst_h = round(($dst_w / $src_w) * $src_h);
    $dst_im = ImageCreateTrueColor($dst_w, $dst_h);
    // ImageCopyResampled copie et rééchantillonne l'image originale
    ImageCopyResampled($dst_im, $src_im, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    ImageAlphaBlending($dst_im, true);
    imagesavealpha($dst_im, true);
    $noir = imagecolorallocate($dst_im, 251, 230, 247); //On réalloue du noir, l'image ayant été modifiée.
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
$Fnm = $cheminPourArriverJusquauCal . "cal2.php";
$td = '<!-- td -->'; //debut de ligne
$img = '<!-- img -->'; // separateur d'image
$text1 = '<img src="<?php echo $cheminPourArriverJusquauCal;?>carre.jpg"<?php echo $dimImg;?> />';
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
$text2 = '<img src="/cal/retaille/<?php print str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . "/cal" . ($cpt++)?>.jpg"<?php echo $dimImg;?> />';
$arrayFichierLu = array($cheminPourArriverJusquauCal . "cal.php" => $cheminPourArriverJusquauCal . "cal2.php", $cheminPourArriverJusquauCal . "cal2.php" => $cheminPourArriverJusquauCal . "cal.php");
if (isset($_GET["qui"]))
{
    $Fnm = $cheminPourArriverJusquauCal . $_GET["qui"];
}
$change = false;
if (isset($_GET["change"]))
{
    $change = (int) $_GET["change"];
    $td = '<!-- td' . $change . ' -->'; //debut de ligne
}
$onredirigeVers = $cheminPourArriverJusquauCal . $_GET["qui"] . "?mois=" . $_GET["mois"] . "&LeCompteur=" . $_GET["LeCompteur"];
print "<br/>Changement voulu pour " . $change . " dans le fichier " . $_GET["qui"] . "?mois=" . $_GET["mois"] . "&LeCompteur=" . $_GET["LeCompteur"];
if (! $fp = fopen($_SERVER["DOCUMENT_ROOT"] . $arrayFichierLu[$Fnm], "r"))
{
    "<br> erreur de lecture du fichier ($Fnm) => " . $_SERVER["DOCUMENT_ROOT"] . $arrayFichierLu[$Fnm] . " <br>";
    exit();
}
//lecture du fichier
while (! feof($fp))
{ //on parcourt toutes les lignes
    $ligne = fgets($fp, 4096);
    if ($change)
    { // on veut changer un td
        if (preg_match("/" . $td . "/", $ligne))
        {
            print "<br><br> on a trouve " . htmlentities($td) . " dans <br>" . htmlentities($ligne) . "<br>";
            if (strpos($ligne, $text1) !== false)
            {
                $ligne = str_replace($text1, $text2, $ligne);
                print "<br>  on a trouve text1 =><br>" . htmlentities($text1) . " <br>On va le changer en =><br>" . htmlentities($text2) . " ";
            }
            elseif (strpos($ligne, $text2) !== false)
            {
                $ligne = str_replace($text2, $text1, $ligne);
                print "<br> on a trouve text2 =><br>" . htmlentities($text2) . " <br>On  va le changer en =><br>" . htmlentities($text1) . " ";
            }
            else
            {
                print "<br> ni " . htmlentities($text1) . " <br> ni" . htmlentities($text2) . " trouve ";
            }
        }
    }
    $page .= $ligne; // lecture du contenu de la ligne
}
//print "<br><br>".htmlentities($page);
fclose($fp);
$fp = fopen($_SERVER["DOCUMENT_ROOT"] . $Fnm, "w+"); //lecture du fichier
fputs($fp, $page);
fclose($fp);
?>
<script language="javascript" type="text/javascript">

 window.opener.location='<?php
print $onredirigeVers;
?>';
 parent.close();
 </script>



