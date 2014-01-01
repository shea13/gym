<div class="divGris">
  <div class="menuGeneral"><a href="/">Index</a></div>
  <div class="menuGeneral trait"></div>
  <div class="menuGeneral"><a href="/cours.php">Cours</a></div>
  <div class="menuGeneral trait"></div>
  <div class="menuGeneral"><a href="/galerie.php">Galeries</a></div>
  <div class="menuGeneral trait"></div>
  <div class="menuGeneral"><a href="/tarifs.php">Tarifs</a></div>
  <div class="menuGeneral trait"></div>
  <div class="menuGeneral"><a href="/contact.php">Contact</a></div>
  <div class="menuGeneral trait"></div>
  <div class="menuGeneral"><a href="bonnesVolonters.php">Rejoignez nous</a></div>
  <div class="menuGeneral trait"></div>
  <div class="menuGeneral"><a href="joggingClub.php">Le survetement du club</a></div>
  <div class="menuGeneral trait"></div>
  
</div>
<br/><br/>
<?php
include_once($_SERVER['DOCUMENT_ROOT']."/inc/tag.php");
$tg = new tag();
print $tg->tagFacebookIframe;
?>	

