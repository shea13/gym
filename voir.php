<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/fuckMagicQuote.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
<title>CLUB GYMNIQUE FOSSEEN - Gymnastique à Fos sur Mer</title>
<meta name="Description" content="Site du club de gymnastique de Fos Sur Mer.">
<meta name="keywords" content="Gymnastique, GR, Gymnastique, Artistique, Rythmique, Aérobic, Hip Hop, Step, Modern dance">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" media="all" href="css/styl.css" />
</head>
<body>
<div id ="grandContainer">
  <div id="logo"><img src="images/logoCGF.png"  style="float:left; "/></div>
  <div id="container">
    <div id="imgGymMiddle">
      <?php include("inc/imageEntete.php");?>
    </div>
    <?php include("menu.php");?>
    <div id="divDeGauche"> <br/>
      <br/>
      <div class="cadre gradient"> 		
       <br/>
        <ul style="font-size:18px">
		<?php 
        
        $aResult = parametres::queryDb("select * from articles WHERE indice ='".(int)mysql_escape_string($_GET["x"])."'AND etat=1 LIMIT 1");
        $result = $aResult["Result"];
		$row=mysql_fetch_object($result);
		
		$article = new article($row->dateDebutEvenement, $row->dateFinEvenement, $row->titre, $row->texte, $row->textePlus, $row->lieu, $row->indice);
		$article->loadArticle();
		print $article->articleComplet();
        ?>
		</ul>
      </div>
    </div>
    <div id="divDeDroite">
      <?php include("divr.php");?>
    </div>
    <br class="clearBoth" />
    <?php  
include("inc/footer.php");
?>
  </div>
</div>
</body>
</html>
