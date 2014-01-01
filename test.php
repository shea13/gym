<?
include($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
include($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");

$aResult = parametres::queryDb("SELECT  * from articles WHERE etat!=-1  ORDER BY dateDebutEvenement DESC, indice DESC LIMIT 1");
print "test 1 '" .$aResult."'";
echo "<br>get_magic_quotes_runtime : " . get_magic_quotes_runtime() . "<br>" ;
echo "get_magic_quotes_gpc : " . get_magic_quotes_gpc() . "<br>" ;
ini_set("magic_quotes_gpc", 0) ;
ini_set("magic_quotes_runtime", 0) ;
echo "get_magic_quotes_runtime : " . get_magic_quotes_runtime() . "<br>" ;
echo "get_magic_quotes_gpc : " . get_magic_quotes_gpc() . "<br>" ;
print_r($_GET);
?>