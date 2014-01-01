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
        <h2 >Actualités de votre club de gym</h2>
        <br/>
        <br/>
        <?php
		$orderBy = " indice DESC, ";
		include("inc/actualites.php");
		?>
        <div class="actuIndex">
          <p><br/>
            <a href="archives.php" style="text-decoration:underline">Archives</a><br/>
            <br/>
          </p>
         <p><strong>CLUB GYMNIQUE FOSSEEN  </strong></p> 
          Le CLUB GYMNIQUE FOSSEEN c'est des animateurs compétents qui vous accueilleront avec le sourire dans leurs <a href="cours.php">cours</a> de :<br />
        <b><i>Renforcement Musculaire</i></b>, <b><i> <a href="gymnastique/lia.php">LIA</a>, Gymnastique
        Dynamique, Latino-Training, <a href="gymnastique/hip-hop.php">HIP-HOP</a>,  Step, Stretching, <a href="gymnastique/zumba.php">Zumba</a>, Gymnastique
        détente, <a href="gymnastique/gymnastique-rythmique.php">Gymnastique Rythmique</a>, </i></b><b><i><a href="gymnastique/gymnastique.php">Eveil Gymnique</a></i></b>, </i></b><b><i><a href="gymnastique/gymnastique.php">Ecole de Gym</a></i></b>, <b><i>Baby Hip.Hop</i></b>, <b><i>Modern’Dance</i></b> <b><i>, Gymnastique Parents-Bébé</i></b> <b><i>, <a href="gymnastique/house-dance.php">House-Dance</a></i></b><br />
          <p><strong>Infos pratiques : </strong></p>
           <p>Inscriptions &agrave; partir du 2 Septembre lors de la journ&eacute;e &laquo;sport en famille&raquo; et &agrave; partir du 3 septembre  aux heures de cours.</p>
                <p> A fournir     : </p>
                <p>Certificat m&eacute;dical obligatoire d&egrave;s le 1er cours (important: pas d'acc&egrave;s aux cours sans certificat m&eacute;dical)</p>
                <p> Bulletin d'adh&eacute;sion du club<br />
                  Droit &agrave; l'image pour les - 18 ans<br />
            R&egrave;glement (esp&egrave;ces/ch&egrave;ques/Ch&egrave;que attitude 13 du Conseil G&eacute;n&eacute;ral/AEVF/CE) </p>
        </div>
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
