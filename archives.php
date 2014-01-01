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
      <h2 >Actualité de votre club de gym</h2>
      <table>
        <tr>
          <td> Dimanche 13 mars: nos jeunes gymnastes participaient à la compétition départementale à Gardanne. Nous pouvons féliciter nos poussines DG1 qui ont à nouveau terminé 1ère !!!<br/>
            Bravo aussi aux autres filles qui ont souvent fini au pied du podium mais ont donné une belle énergie et n'ont pas démérité. </td>
          <td><a href="images/benjamine1ereaGardannesHD.jpg"><img src="images/benjamine1ereaGardannes.jpg" alt="bravo !!!" width="64" height="96" border="0" /></a></td>
        </tr>
      </table>
      <p>
        <?php 
		include("inc/actualites.php");
		?>
      </p>
      </div>
    </div>
    <div id="divDeDroite">
      <?php $pasDactualite = true; include("divr.php");?>
    </div>
    <br class="clearBoth" />
    <?php  
include("inc/footer.php");
?>
  </div>
</div>
</body>
</html>
