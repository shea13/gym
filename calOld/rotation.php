<?php ini_set("memory_limit","1512M"); ini_set("max_execution_time","21600");
session_start();
$_SESSION["cpt"] = 0;
 function redimensionner($dossier, $img_url,$largeur)
 {
 // Déterminer l'extension à partir du nom de fichier
 $extension = substr( $img_url, -3 );
 // Afin de simplifier les comparaisons, on met tout en minuscule
 $extension = strtolower( $extension );
 $nvdossier = str_replace("photos","retaille", $dossier);
 if(!is_dir($nvdossier))
 {
     mkdir($nvdossier,0777);
 }
 $img_url = $dossier."/".$img_url;
 switch ( $extension ) {

 case "jpg":
 case "jpeg": //pour le cas où l'extension est "jpeg"
 $src_im = imagecreatefromjpeg( $img_url );
 break;

 case "gif":
 $src_im = imagecreatefromgif( $img_url );
 break;

 case "png":
 $src_im = imagecreatefrompng( $img_url );
 break;

 default:
 echo "<br>L'image $img_url n'est pas dans un format reconnu. Extensions autorisées : jpg/jpeg, gif, png";
 return false;
 break;
 }

ImageAlphaBlending($src_im, true);
imagesavealpha($src_im, true);
 // Récupère les dimensions de l'image
 $size = GetImageSize($img_url);
 $src_w = $size[0];
 $src_h = $size[1];

 // Taille de votre image
 $dst_w = $largeur;

 // Contraint le rééchantillonage à une largeur fixe et maintient le ratio de l'image
 $dst_h = round(($dst_w / $src_w) * $src_h);
 $dst_im = ImageCreateTrueColor($dst_w,$dst_h);

 // ImageCopyResampled copie et rééchantillonne l'image originale
 ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
 
ImageAlphaBlending($dst_im, true);
imagesavealpha($dst_im, true);
$noir    = imagecolorallocate($dst_im, 251, 230, 247); //On réalloue du noir, l'image ayant été modifiée.
//imagecolortransparent($dst_im, $noir); //Le noir devient transparent
 $_SESSION["cpt"] ++;
 // ImageJpeg génère l'image dans la sortie standard (c.à.d le navigateur)
 $nvnom = "cal".$_SESSION["cpt"] ;
 //$nvnom = str_ireplace("jpg","png" ,$nvnom);
 //$nvnom = str_ireplace("jpeg","png" ,$nvnom);
 $_SESSION["nom"]= "retaille/".$nvnom;
 imagejpeg($dst_im, $nvdossier."/".$nvnom.".jpg");
 imagepng($dst_im, $nvdossier."/".$nvnom.".png");
 // print '<br><img src="images/gymnastique_fos'.$_SESSION["cpt"].'.jpg" alt="" /> ';

 imagedestroy($dst_im);
 imagedestroy($src_im);
 }


function rotation($img,$degres)
{
if(file_exists($img))
{
$image = getimagesize($img);

// Déterminer l'extension à partir du nom de fichier
 $image_type = substr( $img, -3 );
 // Afin de simplifier les comparaisons, on met tout en minuscule
 $image_type = strtolower( $image_type );
 
// création de l'image selon son extension (type) :
if(strpos($image["mime"],"gif") == true) $source = imagecreatefromgif($img);
elseif(strpos($image["mime"],"jpeg") == true) $source = imagecreatefromjpeg($img);
elseif(strpos($image["mime"],"jpg") == true) $source = imagecreatefromjpeg($img);
elseif(strpos($image["mime"],"png") == true) $source = imagecreatefrompng($img);

$noir    = imagecolorallocate($source, 251, 230, 247); 

//rotation de l'image
$rotation = imagerotate($source,$degres,$noir) or die("Erreur lors de la rotation de ".$source);

//Le -1 permet de remplir les zones vides avec du transparent
$noir    = imagecolorallocate($rotation, 251, 230, 247); //On réalloue du noir, l'image ayant été modifiée.
//imagecolortransparent($rotation, $noir); //Le noir devient transparent


// sauvegarde de l'image (selon son type :
$nvnom = str_replace("gymnastique","gymnastique_fos", $img);
if(strpos($image["mime"],"gif") == true) imagegif($rotation,$nvnom);
elseif(strpos($image["mime"],"jpeg") == true) imagejpeg($rotation,$nvnom);
elseif(strpos($image["mime"],"jpg") == true) imagejpeg($rotation,$nvnom);
elseif(strpos($image["mime"],"png") == true) imagepng($rotation,$nvnom);
 imagedestroy($source);
}
}
$array = array(0,5,10,15,20,-5,-15,-20);
$nomphoto = 'IMG_0959.JPG';
$chemin = "/web/gym/cal/photos";
$Dir= opendir($chemin);
while($DraftDirectoryElement = readdir($Dir))
{
	if($DraftDirectoryElement{0}!= ".") 
	{
		if(is_dir($chemin."/".$DraftDirectoryElement))
		{
			print "<br>$chemin/$DraftDirectoryElement est un dossier";flush();
			$DirDansDossier= opendir($chemin."/".$DraftDirectoryElement);
			while($DraftDirectoryElementDansDossier = readdir($DirDansDossier))
		    {
		        if($DraftDirectoryElementDansDossier{0}!= ".") 
		        {
		            redimensionner($chemin."/".$DraftDirectoryElement, $DraftDirectoryElementDansDossier,600);
		        }
		    }
		
		}
		else
		{print "<br>$chemin/$DraftDirectoryElement n est PAS un dossier";flush();
			if(substr(strtolower($DraftDirectoryElement),-3)=="jpg")
			{
		
				redimensionner($chemin, $DraftDirectoryElement,600);
				//$degre = $array[rand(0,7)];
				//rotation($_SESSION["nom"].".jpg",$degre);
			}
		}
	}
}
closedir($Dir);
//exemple d'utilisation :
//redimensionner($nomphoto,600);
//rotation($_SESSION["nom"],'10');



?>