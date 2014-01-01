<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<?php 
if(strpos($_SERVER["REQUEST_URI"],"cal.php")!==false) {$ecrit="cal2.php";} else {$ecrit="cal.php";}
if(isset($_GET["mois"]))
{
    $moisEncours = (int)$_GET["mois"];
} 
else
{
    $moisEncours = (int)date("m");
}

if(isset($_GET["an"]))
{
    $anEnCours = (int)$_GET["an"];
} 
else
{
    $anEnCours = (int)date("Y");
}
$mktime = mktime(0,0,0,$moisEncours, 1, $anEnCours);
$mois = array("","Janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
$nbJourDsLeMois = array(0,31, 28+(date("L",$mktime)), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

$jour = date("N", $mktime); 
$x = ($jour-1)*-1;


$blanc="&nbsp;&nbsp;";
$blanc2chiffres="&nbsp;&nbsp;&nbsp;&nbsp;";
if(empty($_SESSION["leCompteur"]))
{
$_SESSION["leCompteur"]=1;
}

if(isset($_GET["leCompteur"]))
{
$_SESSION["leCompteur"]=$_GET["leCompteur"];
}
$cpt= $_SESSION["leCompteur"];

$fond="1";
$fondImg = "0";
$fondOui = '';
$fondNon = 'checked';
if(empty($_GET["fond"]))
{
    $fond=$_GET["fond"];
}

if("1"==$fond)
{
    $fondOui = 'checked';
    $fondNon = '';
    $fondImg = "0";
}
else
{
    $fondImg = "1";
}
$url = $_SERVER["SCRIPT_URI"].$_GET["qui"]."?mois=".$_GET["mois"]."&LeCompteur=".$_GET["LeCompteur"];


?> 
<title><?php print $mois[$moisEncours]." ".$anEnCours;?></title>
  <script type="text/javascript">
var fond=1;
function change(Id)
{
	
	cal=window.open("ecriture.php?qui=<?php print $ecrit; ?>&change="+Id+"&mois=<?php print $moisEncours;?>&fond="+fond+"&LeCompteur=<?php print $cpt;?>", "pop","width=300, height=300, toolbars=no, scrollbars=yes, menubars=no, status=no");
	cal.focus();
}

</script>
 <style>
body{
	font-family:fantasy; font-size:12px
}
td {
	filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;
}
	table { 
  	padding:10px; margin:10px;font-size:12px; text-align:center; vertical-align: middle; width:900px
}
.blocOpaque { /* Astuce de création d'un bloc à 60% opaque à l'image de fond */
  filter:Alpha(opacity=2);-moz-opacity:0.2;opacity: 0.2; width:680px; height:453px;
float:left; position:absolute; top: 135px; left: 80px; z-index:1000;
}
 
  	.divImg1 {float:left; position:relative; top: -23px; left: -6px; z-index:0; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1; padding:3px;}
	.divImg2 {float:left; position:relative; top: -23px; left: 0px; z-index:-4px; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1; padding:3px;}
	.divChiffre1{float:left; position:relative; top: -18px; left:8px; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	.divChiffre1Img1{float:left; position:relative; top: 1px; left:8px; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	.divChiffre2Img1{float:left; position:relative; top: 1px; left:8px; z-index:1; filter:Alpha(opacity=100);-moz-opacity:1;opacity: 1;}
	.tdCaption {font-size:12px; font-weight:bold; text-align:left; vertical-align:center; background-color:#663333; color:#FFFFFF}
  </style>
</head>

<body >

<?php 
$espace = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$dimTd =' width="120" height="80"';
$dimImg =' width="120" height="80"';
?>
<table  width="200" border="0"  style="position:relative;" cellpadding="1" cellspacing="15" >

 <tr>
    <th colspan="7" scope="col"  style="font-size:12px; font-weight:bold; text-align:left; height: 40px; vertical-align:center;  background-color:#663333; color:#FFFFFF">&nbsp;&nbsp;&nbsp;Lundi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $espace;?>Mardi&nbsp;&nbsp;<?php print $espace;?>&nbsp;&nbsp;Mercredi<?php print $espace;?>Jeudi<?php print $espace;?>&nbsp;Vendredi<?php print $espace;?>Samedi<?php print $espace;?>Dimanche</th>
  </tr>
  <tr>
<!-- td1 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(1)"><div class="<?php if((1+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((1+$x)>0) print (1+$x); else {print $blanc;}?></div><div class="<?php if((1+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td2 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(2)"><div class="<?php if((2+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((2+$x)>0) print (2+$x); else {print $blanc;}?></div>  <div class="<?php if((2+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td3 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(3)"><div class="<?php if((3+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((3+$x)>0) print (3+$x); else {print $blanc;}?></div><div class="<?php if((3+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td4 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(4)"><div class="<?php if((4+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((4+$x)>0) print (4+$x); else {print $blanc;}?></div><div class="<?php if((4+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td5 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(5)"><div class="<?php if((5+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((5+$x)>0) print (5+$x); else {print $blanc;}?></div><div class="<?php if((5+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td6 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(6)"><div class="<?php if((6+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((6+$x)>0) print (6+$x); else {print $blanc;}?></div><div class="<?php if((6+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td7 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(7)"><div class="<?php if((7+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((7+$x)>0) print (7+$x); else {print $blanc;}?></div><div class="<?php if((7+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
  </tr>
  <tr>
<!-- td8 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(8)"><div class="<?php if((8+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((8+$x)>0) print (8+$x); else {print $blanc;}?></div><div class="<?php if((8+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td9 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(9)"><div class="<?php if((9+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((9+$x)>0) print (9+$x); else {print $blanc;}?></div> <div class="<?php if((9+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td10 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(10)"><div class="<?php if((10+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((10+$x)>0) print (10+$x); else {print $blanc;}?></div><div class="<?php if((10+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td11 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(11)"><div class="<?php if((11+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((11+$x)>0) print (11+$x); else {print $blanc;}?></div><div class="<?php if((11+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td12 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(12)"><div class="<?php if((12+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((12+$x)>0) print (12+$x); else {print $blanc;}?></div><div class="<?php if((12+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td13 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(13)"><div class="<?php if((13+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((13+$x)>0) print (13+$x); else {print $blanc;}?></div><div class="<?php if((13+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td14 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(14)"><div class="<?php if((14+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((14+$x)>0) print (14+$x); else {print $blanc;}?></div><div class="<?php if((14+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
  </tr>
 
  <tr>
<!-- td15 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(15)"><div class="<?php if((15+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((15+$x)>0) print (15+$x); else {print $blanc;}?></div><div class="<?php if((15+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td16 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(16)"><div class="<?php if((16+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((16+$x)>0) print (16+$x); else {print $blanc;}?></div> <div class="<?php if((16+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td17 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(17)"><div class="<?php if((17+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((17+$x)>0) print (17+$x); else {print $blanc;}?></div><div class="<?php if((17+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td18 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(18)"><div class="<?php if((18+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((18+$x)>0) print (18+$x); else {print $blanc;}?></div><div class="<?php if((18+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td19 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(19)"><div class="<?php if((19+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((19+$x)>0) print (19+$x); else {print $blanc;}?></div><div class="<?php if((19+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td20 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(20)"><div class="<?php if((20+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((20+$x)>0) print (20+$x); else {print $blanc;}?></div><div class="<?php if((20+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td21 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(21)"><div class="<?php if((21+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((21+$x)>0) print (21+$x); else {print $blanc;}?></div><div class="<?php if((21+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
  </tr>
  <tr>
<!-- td22 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(22)"><div class="<?php if((22+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((22+$x)>0) print (22+$x); else {print $blanc;}?></div><div class="<?php if((22+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td23 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(23)"><div class="<?php if((23+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((23+$x)>0) print (23+$x); else {print $blanc;}?></div> <div class="<?php if((23+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td24 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(24)"><div class="<?php if((24+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((24+$x)>0) print (24+$x); else {print $blanc;}?></div><div class="<?php if((24+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td25 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(25)"><div class="<?php if((25+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if((25+$x)>0) print (25+$x); else {print $blanc;}?></div><div class="<?php if((25+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td26 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(26)"><div class="<?php if((26+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((26+$x)>0)&&((26+$x)<=$nbJourDsLeMois[$moisEncours])) print (26+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((26+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td27 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(27)"><div class="<?php if((27+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((27+$x)>0)&&((27+$x)<=$nbJourDsLeMois[$moisEncours])) print (27+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((27+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td28 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(28)"><div class="<?php if((28+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((28+$x)>0)&&((28+$x)<=$nbJourDsLeMois[$moisEncours])) print (28+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((28+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

  </tr>
  <tr>
<!-- td29 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(29)"><div class="<?php if((29+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((29+$x)>0)&&((29+$x)<=$nbJourDsLeMois[$moisEncours])) print (29+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((29+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td30 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(30)"><div class="<?php if((30+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((30+$x)>0)&&((30+$x)<=$nbJourDsLeMois[$moisEncours])) print (30+$x); else {print $blanc2chiffres;}?></div> <div class="<?php if((30+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td31 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(31)"><div class="<?php if((31+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((31+$x)>0)&&((31+$x)<=$nbJourDsLeMois[$moisEncours])) print (31+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((31+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td32 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(32)"><div class="<?php if((32+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((32+$x)>0)&&((32+$x)<=$nbJourDsLeMois[$moisEncours])) print (32+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((32+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td33 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(33)"><div class="<?php if((33+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((33+$x)>0)&&((33+$x)<=$nbJourDsLeMois[$moisEncours])) print (33+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((33+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td34 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(34)"><div class="<?php if((34+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((34+$x)>0)&&((34+$x)<=$nbJourDsLeMois[$moisEncours])) print (34+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((34+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td35 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(35)"><div class="<?php if((35+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((35+$x)>0)&&((35+$x)<=$nbJourDsLeMois[$moisEncours])) print (35+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((35+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
  </tr>
<?php if((36+$x)>$nbJourDsLeMois[$moisEncours]) { print '<!--';}?>  
  <tr>
<!-- td36 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(36)"><div class="<?php if((36+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((36+$x)>0)&&((36+$x)<=$nbJourDsLeMois[$moisEncours])) print (36+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((36+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td37 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(37)"><div class="<?php if((37+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((37+$x)>0)&&((37+$x)<=$nbJourDsLeMois[$moisEncours])) print (37+$x); else {print $blanc2chiffres;}?></div> <div class="<?php if((37+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td38 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(38)"><div class="<?php if((38+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((38+$x)>0)&&((38+$x)<=$nbJourDsLeMois[$moisEncours])) print (38+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((38+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td39 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(39)"><div class="<?php if((39+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((39+$x)>0)&&((39+$x)<=$nbJourDsLeMois[$moisEncours])) print (39+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((39+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td40 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(40)"><div class="<?php if((40+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((40+$x)>0)&&((40+$x)<=$nbJourDsLeMois[$moisEncours])) print (40+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((40+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

<!-- td41 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(41)"><div class="<?php if((41+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((41+$x)>0)&&((41+$x)<=$nbJourDsLeMois[$moisEncours])) print (41+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((41+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>
<!-- td42 -->    <td<?php echo $dimTd;?> ondblclick="javascript:change(42)"><div class="<?php if((42+$x)<=9) {print "divChiffre1Img1";} else {print "divChiffre2Img1";}?>"><?php if(((42+$x)>0)&&((42+$x)<=$nbJourDsLeMois[$moisEncours])) print (42+$x); else {print $blanc2chiffres;}?></div><div class="<?php if((42+$x)<=9) {print "divImg1";} else {print "divImg2";}?>"><!-- img --><img src="carre.jpg"<?php echo $dimImg;?> /><!-- img --></div></td>

  </tr>
<?php //if((36+$x)>$nbJourDsLeMois[$moisEncours]) { print '-->';}?>  
</table>
<br/>
<div style="position:relative; left:850px; top:-55px; font-size: 20px;  font-weight: bold;"><?php print $mois[$moisEncours]." ".$anEnCours;?></div>
<br/>
<div style="position:relative; left:850px; top:-55px; font-size: 20px;  font-weight: bold;">
Mettre le fond: 

<input type="radio" name="lefond" id="lefondoui" onclick="javascript:fond=1; document.location.href='<?php print $url?>&fond=1'" <?php print $fondOui; ?>/> oui 
<input type="radio" name="lefond" id="lefondnon" onclick="javascript:fond=1; document.location.href='<?php print $url?>&fond=0'" <?php print $fondNon; ?>/> non 
</div>
<?php
if("1"==$fond)
{
	print '
<img src="/cal/photos/'.str_pad($moisEncours, 2, "0", STR_PAD_LEFT).'/grand.jpg" class ="blocOpaque" ondblclick="javascript:document.location.href=\''.$url.'&fond='.$fondImg.'\';" />
';
}
?>
 

</body>
</html>
<?php
/*
FONCTION A TESTER POUR CAPTURE D ECRAN AVEC IE
$browser = new COM("InternetExplorer.Application");
$handle = $browser->HWND;
$browser->Visible = true;
$im = imagegrabwindow($handle);
$browser->Quit();
imagepng($im, "iesnap.png");
imagedestroy($im);*/
?>

