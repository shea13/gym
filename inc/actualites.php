<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/fuckMagicQuote.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");


$d = 0;
$nbpage = $nArticlesParPage = 10;
if(!empty($_REQUEST["d"])){$d = (int)$_REQUEST["d"];}
if(!empty($_REQUEST["nbpage"])){$nbpage = (int)$_REQUEST["nbpage"];}
if($nbpage>20){$nbpage = 20;}
$dLimit = $d*$nbpage;
$limit=" LIMIT ".$dLimit.", ".$nbpage;
$articleIndex = "";
$articleAutre = "";
if(!$orderBy) { $orderBy = '';}
$limitByDate = " AND  dateDebutEvenement>  CURDATE()- INTERVAL 40 DAY "; 
if(("/archives.php" == $_SERVER["SCRIPT_NAME"])||("archives.php" == $_SERVER["SCRIPT_NAME"]))
{
    $limit = "";
	$limitByDate = "";
}
$isIndex = false;
if(("/index.php" == $_SERVER["SCRIPT_NAME"])||("index.php" == $_SERVER["SCRIPT_NAME"]))
{
    $isIndex = true;
}

$aResult = parametres::queryDb("SELECT SQL_CALC_FOUND_ROWS * from articles WHERE etat!=-1 ".$limitByDate." ORDER BY ".$orderBy." dateDebutEvenement DESC, indice DESC  $limit ");

$aResult2 = parametres::queryDb("SELECT FOUND_ROWS() as nb");

$result2 = $aResult2["Result"];
$row2=mysql_fetch_object($result2);
$nbtotal = $row2->nb;
$result = $aResult["Result"];
$cpt=0;

while($row=mysql_fetch_object($result))
{
    //print "<br><br> texte:<br> ".htmlentities($row->texte)."<br>";
    $articlePlusGros = $isIndex;
        $mktime = time()-10000;
        if("" != $row->dateDebutEvenement)
        {
            list ($an, $mois, $jour) = explode("-",$row->dateDebutEvenement);
            $mktime = mktime(0,0,0, $mois, $jour, $an);
        }
	    
	    if(($mktime < time()) && ($cpt>2))
	    {
	        $isIndex = false;//sur l'index on affiche les 2 premiers articles en gros si la date est dépasséer
	    }
  
    $article = new article($row->dateDebutEvenement, $row->dateFinEvenement, $row->titre, $row->texte, "", $row->lieu, $row->indice);
    $article->loadArticle();
    
    if($isIndex)
    {
        $articleIndex .= $article->articleComplet($isIndex, true);
    }
    else
    {
        $articleAutre .= $article->articleComplet($isIndex, true);
    }
    
       
   $cpt++;
}

$nbDePagesTotals = (int) ($nbtotal/$nArticlesParPage); // on affiche 7 article par page
if($nbDePagesTotals<$nbtotal/$nArticlesParPage) {$nbDePagesTotals++;} // si ($pageTotal<$nbtotal/7) c'est qu'il y a plus que 7 articles sur la dernière page, donc il faut une page en plus pour toutes les afficher
if(!empty($articleIndex))
{
    echo 
    "
    <table>
    	".$articleIndex."
   </table>
   ";
}
?>
<ul class="ulActualite">
<?php echo $articleAutre; ?>
</ul>
<?php
// partie qui sert aux update par ajax
if(isset($_POST["ajax"]))
{
	if(1==(int)$_POST["ajax"])
	{//separateur plus nombre de pages
		echo "#&#&#&#&#".($d+1)."/".$nbDePagesTotals;
	}
}
?>
