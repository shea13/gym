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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="galleria/galleria-1.2.3.min.js"></script>
<style type="text/css">
<!--
.content {
	color:#777;
	font:12px/1.4 "helvetica neue", arial, sans-serif;
	width:620px;
	margin:20px auto;
}
.cred {
	margin-top:20px;
	font-size:11px;
}
/* This rule is read by Galleria to define the gallery height: */
#galleria {
	height:320px;
}
-->
</style>
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
      <div class="cadre gradient" style="font-size:12px">
        <div class="content">
          
        </div>
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
<script>

    // Load the classic theme
    Galleria.loadTheme('galleria.classic.js');
    
    // Initialize Galleria
    $('#galleria').galleria();

    </script>
</body>
</html>
