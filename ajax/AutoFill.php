<?php

if($_POST["type"] != "")
{
	$response = "";
	$type = $_POST["type"]."%";

	$hostname_DB = "127.0.0.1";
	$database_DB = "storehouse";
	$username_DB = "root";
	$password_DB = "";
		
	try 
	{
		$CONNPDO = new PDO("mysql:host=".$hostname_DB.";dbname=".$database_DB.";charset=UTF8", $username_DB, $password_DB, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 3));	
	} 
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if ($CONNPDO != null) 
	{
	    $getdata_PRST = $CONNPDO->prepare("SELECT type FROM storehouse WHERE type LIKE :type ORDER BY id LIMIT 1");
	    $getdata_PRST ->bindValue(":type",$type);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		$count= $getdata_PRST->rowCount();
		
		if($count != 0)
		{	
			while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$response = $getdata_RSLT["type"];
				
			}
		
			echo $response;
		}
		
	}
	else
	{
		echo "No connection to db";
	}
		
}
?>