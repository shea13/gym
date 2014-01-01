<?php ini_set("memory_limit","1512M"); ini_set("max_execution_time","21600");
session_start();
$_SESSION["cpt"] = 0;

$chemin = "/web/gym/2011/fos/gym";
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
while($DraftDirectoryElement = readdir($Dir))
{
	if($DraftDirectoryElement[0]!=".")
	{
		
	    $liens = '<a href="/2011/rognac/'.$DraftDirectoryElement.'"> <img title="Tremplins de bronze et d\'argent  Photo '.$replace.'"
alt="Tremplins de bronze et d\'argent."
src="/2011/rognac/'.$DraftDirectoryElement.'"/> </a>
	';
	    $array[num($DraftDirectoryElement)] = $liens;
	   // $aide.=$liens;
	}

}
closedir($Dir);

$arraytrie = ksort($array);
$cpt =1;
foreach($array as $key => $value)
{
	print str_replace("\n","<br/>",htmlentities(str_replace($replace,$cpt++,$value)));
}

//print str_replace("\n","<br/>",htmlentities($aide));

?>