<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/fuckMagicQuote.inc");
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
<title>CLUB GYMNIQUE FOSSEEN</title>
<meta name="Description" content="Site du club de gymnastique de Fos Sur Mer.">
<meta name="keywords" content="Gymnastique, GR, Gymnastique, Artistique, Rythmique, Aérobic, Hip Hop, Step, Modern dance">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript">
function etesVousSur(celuiLa)
{
	if(confirm("Etes-vous sure de vouloir supprimer cette actulité?"))
	{
		 document.location.href=celuiLa.href;
	}
	else
	{
		alert("Heureusement que j'ai demand� ;-)");
	}
}
</script>

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
      	<?php 
  	    
		$req = "select * FROM articles WHERE 1 AND etat=1  ORDER BY dateDebutEvenement DESC, indice DESC ";
        $aResult = parametres::queryDb($req);
		print $aResult;  
        $result = $aResult["Result"];
		print "<br/><br/><br/><br/> NOUVEAU : <a href=\"ecrire.php\"> CREER UN NOUVEAU </a><br/>";
		
		while($row= mysql_fetch_object($result))
		{
			$article = new article($row->dateDebutEvenement, $row->dateFinEvenement, $row->titre, $row->texte, $row->textePlus, $row->lieu, $row->indice);
			print "<br/><br/> MODIFIER : <a href=\"ecrire.php?modifier=".$row->indice."\">".$article->getTitre()." =>".substr($article->getTexte(),0, 100)."...</a><br/>";
			print " <font size='1'>&nbsp;&nbsp;&nbsp;SUPPRIMER : <a href=\"validCreationMajArticle.php?supprimer=".$row->indice."\" onclick='etesVousSur(this);return false'>".$article->getTitre()." =>".substr($article->getTexte(),0, 100)."...</a><br/></font>";
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

</body>
</html>
