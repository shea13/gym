<?php ini_set("memory_limit","1512M"); ini_set("max_execution_time","21600");
session_start();
$_SESSION["cpt"] = 0;

$chemin = "/web/gym/2011/telethon";
$Dir= opendir($chemin);
function num($string)
{
	$chaine = "";
	for($i=0;$i<strlen($string); $i++)
	{
		if(is_numeric($string[$i]))
		{
			$chaine .=$string[$i];
		}
	}
	
	return (int) $chaine;
}
$aide="";
$cpt = 1;
$array = array();
$replace = "#######";
$a =1;
while($DraftDirectoryElement = readdir($Dir))
{
    if(($DraftDirectoryElement[0]!=".")&&(is_file($chemin."/".$DraftDirectoryElement)))
	{
	    print "<br> on renomme ".$chemin."/".$DraftDirectoryElement." en ".str_replace("chalenge", "challenge",$chemin."/".$DraftDirectoryElement);
	   // rename($chemin."/".$DraftDirectoryElement, str_replace("chalenge", "challenge",$chemin."/".$DraftDirectoryElement));
	    rename($chemin."/".$DraftDirectoryElement, str_replace("chalenge", "challenge",$chemin."/CGFTelethon2011_".($a++).".jpg"));
		
	   
	}
}
closedir($Dir);



//print str_replace("\n","<br/>",htmlentities($aide));

?>