<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/fuckMagicQuote.inc");
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


<link rel="stylesheet" type="text/css" media="all" href="css/style.css">
<body id="bodyHome" style="background: url('/images/fond.jpg') no-repeat scroll center top white;">
<div id="csall">
  <div id="csleft">
    <div title="clug gymnique fosséen">
      <h1>&nbsp;</h1>
    </div>
        <?php include("menu.php");?>
    <hr>
    <div class="csclear"></div>
    <div id="imgGymMiddle">
      <div class="onlineeditor">
        <div><?php include("inc/imageEntete.php");?></div>
      </div>
    </div>
    <hr>
    <div id="lignesDiv">
      
      
      <hr>
      <div>
      	<a href="/modifierOuPas.php">Liste des articles existants</a><br/><br/>
      	<?php 
      	
  	    if(isset($_GET["modifier"]))
  	    {
  	        print "MODIFICATION D'UN ARTICLE EXISTANT";
  	    }
		include("inc/creationMajArticle.php");
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
