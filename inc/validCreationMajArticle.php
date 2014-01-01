<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/fuckMagicQuote.inc");
include($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
include($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
<title>CLUB GYMNIQUE FOSSEEN</title>
<meta name="Description" content="Site du club de gymnastique de Fos Sur Mer.">
<meta name="keywords" content="Gymnastique, GR, Gymnastique, Artistique, Rythmique, A�robic, Hip Hop, Step, Modern dance">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<link rel="stylesheet" type="text/css" media="all" href="css/style.css">
<body id="bodyHome" style="background: url('/images/fond.jpg') no-repeat scroll center top white;">
<div id="csall">
<?php include("menu.php");?>
  <div id="csleft">

    <hr>
    <div class="csclear"></div>
    <div id="imgGymMiddle">
      <div class="onlineeditor">
        <div><?php include("inc/imageEntete.php");?></div>
      </div>
    </div>
    <h1>Club Gymnique Fosséen</h1>
    <hr>
    <div id="lignesDiv">
      
      
      <hr>
      <div>
      <a href="/modifierOuPas.php">Liste des articles existants</a><br/><br/>
      	<?php header('Content-type: text/html; charset=UTF-8'); 
			include($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
			include($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");
			list($jour,$mois, $an) = explode("-",$_POST["dateDebut"]);
			$_POST["dateDebut"] = $an."-".$mois."-".$jour;
			list($jour,$mois, $an) = explode("-",$_POST["dateFin"]);
			$_POST["dateFin"] = $an."-".$mois."-".$jour;
			
			
			$leTitre = str_replace("<", "BALISE#OUVRANTE", utf8_decode($_POST["titre"]));
			$leTitre = str_replace(">", "BALISE#FERMANTE", $leTitre);
			$leTitre = htmlentities($leTitre);
			$leTitre = str_replace("BALISE#OUVRANTE", "<", $leTitre);
			$leTitre = str_replace("BALISE#FERMANTE", ">", $leTitre);
			
			$leTexte = str_replace("<", "BALISE#OUVRANTE", utf8_decode($_POST["texte"]));
			$leTexte = str_replace(">", "BALISE#FERMANTE", $leTexte);
			$leTexte = htmlentities($leTexte);
			$leTexte = str_replace("BALISE#OUVRANTE", "<", $leTexte);
			$leTexte = str_replace("BALISE#FERMANTE", ">", $leTexte);
			
			$leTextePlus = str_replace("<", "BALISE#OUVRANTE", utf8_decode($_POST["textePlus"]));
			$leTextePlus = str_replace(">", "BALISE#FERMANTE", $leTextePlus);
			$leTextePlus = htmlentities($leTextePlus);
			$leTextePlus = str_replace("BALISE#OUVRANTE", "<", $leTextePlus);
			$leTextePlus = str_replace("BALISE#FERMANTE", ">", $leTextePlus);
			
			$indice = (int) $_POST["type"];
			
			if($indice>0)
			{
				$aResult = parametres::queryDb("select * from articles WHERE indice = ".mysql_escape_string($indice)." LIMIT 1");
							
				if ($aResult["countRows"]>0)
				{die ("on update");
					$req = "UPDATE articles SET 
					`dateModification` = '".date("Y-m-d")."',
					`dateDebutEvenement` = '".mysql_escape_string($_POST["dateDebut"]) ."',
					`dateFinEvenement` = '".mysql_escape_string($_POST["dateFin"]) ."',
					`texte` = '".mysql_escape_string($leTexte) ."',
					`textePlus` = '".mysql_escape_string($leTextePlus) ."',
					`titre` = '".mysql_escape_string($leTitre) ."',
					`lieu` = '".mysql_escape_string($_POST["lieu"]) ."' 
					  WHERE indice =".mysql_escape_string($indice)." 
					LIMIT 1
								";
								
					$aResult2 = parametres::queryDb($req);
					print $aResult2["countRows"]. " &eacute;l&eacute;ment mis &agrave; jour ";
				}
				else
				{die ("on insert");
					$req ="INSERT INTO `clubgymn_smcf1`.`articles` 
					(
						`dateCreation`, 
						`dateModification`, 
						`dateDebutEvenement`, 
						`dateFinEvenement`, 
						`titre`, 
						`texte`, 
						`textePlus`, `
						lieu`, 
						`page`
					) 
					VALUES
					(
						'".mysql_escape_string($_POST["dateDebut"]) ."',
						 '".mysql_escape_string($_POST["dateFin"]) ."',
						'2011-03-31', 
						'2011-04-11',
						 '".mysql_escape_string($leTexte) ."',
						`textePlus` = '".mysql_escape_string($leTextePlus) ."',
						`titre` = '".mysql_escape_string($leTitre) ."',
						`lieu` = '".mysql_escape_string($_POST["lieu"]) ."' 
						 '0'
						);";
						
					  $aResult2 = parametres::queryDb($req);
					  print $aResult2["countRows"]. " &eacute;l&eacute;ment ins&eacute;r&eacute;";
				}
			}
			else
			{die ("on insert2");
				$req ="INSERT INTO `clubgymn_smcf1`.`articles` 
					(
						`dateCreation`, 
						`dateModification`, 
						`dateDebutEvenement`, 
						`dateFinEvenement`, 
						`titre`, 
						`texte`, 
						`textePlus`, `
						lieu`, 
						`page`
					) 
					VALUES
					(
						'".mysql_escape_string($_POST["dateDebut"]) ."',
						 '".mysql_escape_string($_POST["dateFin"]) ."',
						'2011-03-31', 
						'2011-04-11',
						 '".mysql_escape_string($leTexte) ."',
						`textePlus` = '".mysql_escape_string($leTextePlus) ."',
						`titre` = '".mysql_escape_string($leTitre) ."',
						`lieu` = '".mysql_escape_string($_POST["lieu"]) ."' 
						 '0'
						);";
						
						 $aResult2 = parametres::queryDb($req);
					  print $aResult2["countRows"]. " &eacute;l&eacute;ment ins&eacute;r&eacute;";
			}
			
			
			?>
      </div>
      
      <div class="csclear"></div>
    </div>
    
    <hr>
    
    
  </div>
  <hr>
  <?php $pasDactualite = true;  include("divr.php");?>
  <div class="csclear"></div>
</div>
<!-- fin csall -->
<hr>
<?php 
include("inc/footer.php");
?>
</body>
</html>
