<?php session_start();
print $_SERVER["SERVER_NAME"];
include("inc/bdd/parametresProd.inc");
include("inc/technical/article.inc");

$d = 0;
$nbapge = 7;
if(!$orderBy) { $orderBy = '';}
if(!empty($_GET["d"])){$d = (int)$_GET["d"];}
if(!empty($_GET["nbapge"])){$nbapge = (int)$_GET["nbapge"];}
if($nbapge>20){$nbapge = 20;}
$req=$req ." LIMIT ".$d.",".$nbapge;

$aResult = parametres::queryDb("SELECT SQL_CALC_FOUND_ROWS * from articles WHERE etat!=-1 ORDER BY ".$orderBy." dateDebutEvenement DESC, indice DESC LIMIT 7");
$aResult2 = parametres::queryDb("SELECT FOUND_ROWS() as nb");

$result2 = $aResult2["Result"];
$row2=mysql_fetch_object($result2);
$nbtotal = $row2->nb;
$result = $aResult["Result"];
$cpt=0;

print "<ul>";
while($row=mysql_fetch_object($result))
{
    $article = new article($row->dateDebutEvenement, $row->dateFintEvenement, $row->titre, $row->texte, $row->lieu);
    print $cpt++.$article->articleComplet();
}
print "</ul>";
?>