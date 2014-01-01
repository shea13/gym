<?php header('Content-type: text/html; charset=UTF-8'); 
include_once($_SERVER["DOCUMENT_ROOT"]."/inc/fuckMagicQuote.inc");
include($_SERVER["DOCUMENT_ROOT"]."/inc/bdd/parametres.inc");
include($_SERVER["DOCUMENT_ROOT"]."/inc/technical/article.inc");
list($jour,$mois, $an) = explode("-",$_POST["dateDebut"]);
$_POST["dateDebut"] = $an."-".$mois."-".$jour;
list($jour,$mois, $an) = explode("-",$_POST["dateFin"]);
$_POST["dateFin"] = $an."-".$mois."-".$jour;

$article = new article($_POST["dateDebut"], $_POST["dateFin"], $_POST["titre"], $_POST["texte"], $_POST["textePlus"], $_POST["lieu"], "0");
$article->loadArticle();
print $article->articleComplet(true);
?>