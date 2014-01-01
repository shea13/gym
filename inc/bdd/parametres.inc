<?php 
class parametres
{
	static public function RootDirectory()
	{
	   return "/web/gym";
	}
    static private function dbServer()
	{
		return $db_server = 'localhost';
	}
	
	static private function dbName()
	{
		return $db_name =  'clubgymn_1';
	}
	
	static private function dbUser()
	{
		//return $db_user = 'clubgymn_1';
		return $db_user = 'clubgymn_write';
		//return $db_user = 'clubgymn_write2';
	}
	
	static private function dbPassword()
	{
		//return $db_password = 'ry§69t23rr3'; // user clubgymn_1
		return $db_password = 'r69x5KTtmY';  // user clubgymn_write
		//return $db_password = 'ehrkk&)45';  // user clubgymn_write2
		
	}	
	
	static public function connectDb($dataBase = "")
	{// connection à la bdd
	
		if(empty($dataBase)) { $dataBase= parametres::dbName();}
		
		$db_connection = mysql_connect(parametres::dbServer(), parametres::dbUser(), parametres::dbPassword()) or die('Erreur SQL ! : '.mysql_error());  ;
		
		if($db_connection)
		{
		    	mysql_select_db($dataBase, $db_connection)  or print mysql_error();
				$_SESSION["connectId"] = $db_connection;
		}
		else 
		{
		    return false;
		}
		mysql_select_db($dataBase, $db_connection);
		return $_SESSION["connectId"];
	}
		
	static public function closeDb($id ="")
	{//deconnexion  bdd
		mysql_close($id);
	}
	
	static public function queryDb($queryString)
	{
	  
		if(empty($queryString))
		{
		   return false;
		}
		parametres::connectDb();
	    $clean = $queryString;
		$fail = false; 
		// We don't use UNION in SMF, at least so far.  But it's useful for injections.
		if (strpos($clean, 'union') !== false && preg_match('~(^|[^a-z])union($|[^[a-z])~s', $clean) != 0)
			$fail = true;
		// Comments?  We don't use comments in our queries, we leave 'em outside!
		elseif (strpos($clean, '/*') > 2 || strpos($clean, '--') !== false )
			$fail = true;
		// Trying to change passwords, slow us down, or something?
		elseif (strpos($clean, 'sleep') !== false && preg_match('~(^|[^a-z])sleep($|[^[a-z])~s', $clean) != 0)
			$fail = true;
		elseif (strpos($clean, 'benchmark') !== false && preg_match('~(^|[^a-z])benchmark($|[^[a-z])~s', $clean) != 0)
			$fail = true;
		elseif (strpos($clean, 'drop') !== false && preg_match('~(^|[^a-z])drop($|[^[a-z])~s', $clean) != 0)
			$fail = true;
			
		if($fail)
		{
			return false;
		}	
			
		if(!$result = mysql_query($queryString)) { return false;  }
		if($_SERVER['SCRIPT_NAME']=="/modifierOuPas.php") {			
		}	
		$arrayResult = array();
		$arrayResult["Result"] = $result; 
		$arrayResult["countRows"] = false;
		$arrayResult["ORows"] = false;
		if ((strpos(strtolower($clean), 'insert ')  !== false) || (strpos(strtolower($clean), 'delete ')  !== false) || (strpos(strtolower($clean), 'update ')  !== false))
		{
			$arrayResult["countRows"] = mysql_affected_rows();
		}
		else
		{
			$arrayResult["countRows"] = mysql_num_rows($result); 
		}
		
		
			
		return $arrayResult;
	}	
}

?>
