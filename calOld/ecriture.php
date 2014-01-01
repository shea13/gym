 <?php 
 $Fnm = "cal2.php";
 $td = '<!-- td -->';//debut de ligne
 $img = '<!-- img -->';// separateur d'image
 $text1 =  '<img src="carre.jpg"<?php echo $dimImg;?> />';
 if(!is_file("retaille/".str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT) . "/cal" . ($a=$_GET["leCompteur"]+1)))
 {
 		$cheminDir ="retaille/".str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT);
 		$Dir= opendir("retaille/".str_pad($_GET["mois"], 2, "0", STR_PAD_LEFT));
		while($DraftDirectoryElementDansDossier = readdir($Dir))
		    {
		        if($DraftDirectoryElementDansDossier{0}!= ".") 
		        {
		           if( (!ereg("cal",substr($DraftDirectoryElementDansDossier,0,3))) && ( ereg(".jpg",strtolower($DraftDirectoryElementDansDossier)) ||  ereg(".jpeg",strtolower($DraftDirectoryElementDansDossier)))  )
				   {
				   		rename($cheminDir."/".$DraftDirectoryElementDansDossier , $cheminDir."/cal".$a.".jpg");
						$a++;
				   }
		        }
		    }
 }
 $text2 =  '<img src="retaille/<?php print str_pad($moisEncours, 2, "0", STR_PAD_LEFT) . "/cal" . ($cpt++)?>.jpg"<?php echo $dimImg;?> />';
 $arrayFichierLu = array("cal.php" => "cal2.php", "cal2.php" => "cal.php");
 if(isset($_GET["qui"]))
 {
 	$Fnm = $_GET["qui"];
 }

 $change = false;
 if(isset($_GET["change"]))
 {
 	$change = (int)$_GET["change"];
	 $td = '<!-- td'.$change.' -->';//debut de ligne
 }
 $onredirigeVers = $_GET["qui"]."?mois=".$_GET["mois"]."&LeCompteur=".$_GET["LeCompteur"];
print "<br/>Changement voulu pour ".$change." dans le fichier ".$_GET["qui"]."?mois=".$_GET["mois"]."&LeCompteur=".$_GET["LeCompteur"];
$fp = fopen( $arrayFichierLu[$Fnm],"r"); //lecture du fichier
while (!feof($fp)) { //on parcourt toutes les lignes
	$ligne =  fgets($fp, 4096);
	if($change)
	{// on veut changer un td
		if(ereg($td, $ligne))
		{ 
			if(strpos($ligne, $text1)!==false)
			{
				$ligne = str_replace($text1, $text2, $ligne);
				print"<br>  on a trouve text1 =><br>".htmlentities($text1)." <br>On va le changer en =><br>".htmlentities($text2)." ";
			}
			elseif(strpos($ligne, $text2)!==false)
			{
				$ligne = str_replace($text2, $text1, $ligne);
				print"<br> on a trouve text2 =><br>".htmlentities($text2)." <br>On  va le changer en =><br>".htmlentities($text1)." ";
			}
			else
			{
					print"<br> ni ".htmlentities($text1)." <br> ni".htmlentities($text2)." trouve ";
			}
		}
	}
	
  $page .= $ligne ; // lecture du contenu de la ligne
}
//print "<br><br>".htmlentities($page);
 fclose($fp);
 $fp = fopen($Fnm,"w+"); //lecture du fichier
 fputs($fp, $page);
 fclose($fp);
 chmod($Fnm,0666);
 

 ?> 
 <script language="javascript" type="text/javascript">
 window.opener.location='<?php print  $onredirigeVers;?>';
 parent.close();
 </script>
 
 
