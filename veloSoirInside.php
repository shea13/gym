<?php
$tabStation=array();


$tabStation["gambetta"]="http://www.levelo-mpm.fr/service/stationdetails/1245";
$tabStation["canebierre"]="http://www.levelo-mpm.fr/service/stationdetails/1264";
$tabStation["hautReforme"]="http://www.levelo-mpm.fr/service/stationdetails/1287";
$tabStation["monte"]="http://www.levelo-mpm.fr/service/stationdetails/1230";


function parse($ligne)
{
	global $tabParse;
	global $tabResult;
	global $cptParse;
	$debut="";
	$first = false;
	$tabParse[$cptParse] = array("key"=>"", "value"=>"");
	for($i=0; $i<strlen($ligne);$i++)
	{
		if(($ligne{$i}=="<")&&(!$first))
		{
			$first = true;
			if($debut=="")
			{
				$debut="-1";
			}
		}
		elseif(($ligne[$i]=="<")&&($first))
		{
			
			if($tabParse[$cptParse]["key"]=="available")
			{
			    $tabResult["available"]= $tabParse[$cptParse]["value"];
			}
			elseif($tabParse[$cptParse]["key"]=="free")
			{
			    $tabResult["free"]= $tabParse[$cptParse]["value"];
			}
			elseif($tabParse[$cptParse]["key"]=="total")
			{
			    $tabResult["total"]= $tabParse[$cptParse]["value"];
			}
			$cptParse++;
			return $tabParse;
		}
		elseif($ligne[$i]==">")
		{
			$valeur="-1";
			$debut="1";
		}
		elseif($debut=="-1")
		{
			$tabParse[$cptParse]["key"].=$ligne[$i];
		}
		elseif($valeur=="-1")
		{
			$tabParse[$cptParse]["value"].=$ligne[$i];
		}
	}
	$cptParse++;
}
?>
<table>
<?php
foreach($tabStation as $key => $value)
{
    if (!($fp = @fopen($value, "r"))) { return FALSE; }
    $tabParse= array();
    $tabResult= array();
    $cptParse=0;
    while ( $ligneXML = fgets($fp, 1024)) {
    	parse($ligneXML);
    }
    print "
    	  <tr>
                <td>$key </td> <td>=> </td><td><b>".$tabResult["free"]."</b> </td> <td>sur ".$tabResult["available"]."</td> <td> (".$tabResult["total"].") </td>
           </tr>
           ";
}


?>
</table>