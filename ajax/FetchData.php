<?php
if($_POST["page"] != "" && $_POST["type"] != "" && $_POST["brand"] != "")
{
	$sType = $_POST["type"];
	$sBrand = $_POST["brand"];

	try 
	{
		$CONNPDO = new PDO("sqlite:../litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	} 
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if( $CONNPDO != null)
	{	
		(int)$page = $_POST["page"]; 
		
		if($page == 1)
		{
			(int)$page = 0;		
		}
		else
		{
			
		(int)$page = ($page*7 - 7) ;
			
		}
		
		(int)$to = 7 ; 
	  	
		$response = "<table class='table table-striped'><tr><th>Type</th><th>Brand</th><th>Weight</th><th>Quantity</th><th>ExpirationDate</td><th>Place</th></tr>";
		
		$getdata_PRST = $CONNPDO->prepare("SELECT * FROM storehouse WHERE type = :type AND brand = :brand ORDER BY id  LIMIT :from , 7 ");
		$getdata_PRST->bindValue(":type", $sType, SQLITE3_TEXT);
		$getdata_PRST->bindValue(":brand", $sBrand, SQLITE3_TEXT);
		$getdata_PRST->bindValue(":from", $page, SQLITE3_INTEGER);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$type = $getdata_RSLT["type"];
			$brand = $getdata_RSLT["brand"];
			$weight = $getdata_RSLT["weight"];
			$quantity = $getdata_RSLT["quantity"];
			$exDate = $getdata_RSLT["exp_date"];
			$place = $getdata_RSLT["place"];
			
			$now = time();
			$expire = strtotime($exDate);
			
			$criteria = ceil(($expire - $now)/2592000);
			
			
			if ($criteria < 30)
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td style='color:red;'>$exDate</td><td>$place</td></tr>";
			}
			else
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td>$exDate</td><td>$place</td></tr>";
			}
			
		}
		$response .= "</table>" ; 
		
		$getdata_PRST = $CONNPDO->prepare("SELECT COUNT(id) AS Number FROM storehouse WHERE type = :type AND brand = :brand   ");
		$getdata_PRST->bindValue(":type", $sType, SQLITE3_TEXT);
		$getdata_PRST->bindValue(":brand", $sBrand, SQLITE3_TEXT);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$sNumber = $getdata_RSLT["Number"];
		}
		
		$sNumber2 = ($sNumber / 7 );
		
		if(is_int($sNumber2))
		{
			$sNumber3 = $sNumber2;
		}
		else
		{
			$sNumber3 = floor($sNumber2) + 1;
		}
		$response .="<br><br><br>";
		
		
		for($x = 1 ; $x <= $sNumber3 ; $x++)
		{
			if($x != $page)
			{
			  $response .= "<a href='#' class='btn btn-primary' onclick= \"Search($x);\" >$x</a>&nbsp;";
			
			}
			else
			{
			  $response .= "<a class='btn btn-primary' href='#' style=\"background-color:red;color:pink;cursor:pointer;\"  onclick= \"Search($x);\" >$x</a>&nbsp;";
			}
			
		}

	$response .= "</center>";
		
	
	 echo $response;
    }
	else
	{
		echo "Connection error";
	}

}
elseif($_POST["page"] != "" && $_POST["type"] == "" && $_POST["brand"] != "")
{
	
	$sBrand = $_POST["brand"];
	
	try 
	{
		$CONNPDO = new PDO("sqlite:../litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
	}
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if( $CONNPDO != null)
	{	
		(int)$page = $_POST["page"]; 
		
		if($page == 1)
		{
			(int)$page = 0;		
		}
		else
		{
			
		(int)$page = ($page*7 - 7) ;
			
		}
		
		(int)$to = 7 ; 
	  	
		$response = "<table class='table table-striped'><tr><th>Type</th><th>Brand</th><th>Weight</th><th>Quantity</th><th>ExpirationDate</td><th>Place</th></tr>";
		
		$getdata_PRST = $CONNPDO->prepare("SELECT * FROM storehouse WHERE  brand = :brand ORDER BY id  LIMIT :from , 7 ");
		$getdata_PRST->bindValue(":brand", $sBrand, SQLITE3_TEXT);
		$getdata_PRST->bindValue(":from", $page, SQLITE3_INTEGER);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$type = $getdata_RSLT["type"];
			$brand = $getdata_RSLT["brand"];
			$weight = $getdata_RSLT["weight"];
			$quantity = $getdata_RSLT["quantity"];
			$exDate = $getdata_RSLT["exp_date"];
			$place = $getdata_RSLT["place"];
			
			$now = time();
			$expire = strtotime($exDate);
			
			$criteria = ceil(($expire - $now)/2592000);
			
			if ($criteria < 30)
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td style='color:red;'>$exDate</td><td>$place</td></tr>";
			}
			else
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td>$exDate</td><td>$place</td></tr>";
			}
			
		}
		$response .= "</table>" ; 
		
		$getdata_PRST = $CONNPDO->prepare("SELECT COUNT(id) AS Number FROM storehouse WHERE brand = :brand   ");
		$getdata_PRST->bindValue(":brand", $sBrand, SQLITE3_TEXT);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$sNumber = $getdata_RSLT["Number"];
		}
		
		$sNumber2 = ($sNumber / 7 );
		
		if(is_int($sNumber2))
		{
			$sNumber3 = $sNumber2;
		}
		else
		{
			$sNumber3 = floor($sNumber2) + 1;
		}
		$response .="<br><br><br>";
		
		
		for($x = 1 ; $x <= $sNumber3 ; $x++)
		{
			if($x != $page)
			{
			  $response .= "<a href='#' class='btn btn-primary' onclick= \"Search($x);\" >$x</a>&nbsp;";
			
			}
			else
			{
			  $response .= "<a href='#' class='btn btn-primary' style=\"background-color:red;color:pink;cursor:pointer;\"  onclick= \"Search($x);\" >$x</a>&nbsp;";
			}
			
		}

	$response .= "</center>";
		
	
	 echo $response;
    }
	else
	{
		echo "Connection error";
	}

}
elseif($_POST["page"] != "" && $_POST["type"] != "" && $_POST["brand"] == "")
{
	$sType = $_POST["type"];

	

	try 
	{
		$CONNPDO = new PDO("sqlite:../litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if( $CONNPDO != null)
	{	
		(int)$page = $_POST["page"]; 
		
		if($page == 1)
		{
			(int)$page = 0;		
		}
		else
		{
			
		(int)$page = ($page*7 - 7) ;
		//last paer	
		}
		
		(int)$to = 7 ; 
	  	
		$response = "<table class='table table-striped'><tr><th>Type</th><th>Brand</th><th>Weight</th><th>Quantity</th><th>ExpirationDate</td><th>Place</th></tr>";
		
		$getdata_PRST = $CONNPDO->prepare("SELECT * FROM storehouse WHERE type = :type ORDER BY id  LIMIT :from , 7 ");
		$getdata_PRST->bindValue(":type", $sType, SQLITE3_TEXT);
		$getdata_PRST->bindValue(":from", $page, SQLITE3_INTEGER);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$type = $getdata_RSLT["type"];
			$brand = $getdata_RSLT["brand"];
			$weight = $getdata_RSLT["weight"];
			$quantity = $getdata_RSLT["quantity"];
			$exDate = $getdata_RSLT["exp_date"];
			$place = $getdata_RSLT["place"];
			
			$now = time();
			$your_date = strtotime($exDate);
			
			$expire = $your_date - $now;
			
			$criteria = round($expire / (60 * 60 * 24));
			
			if ($criteria < 30)
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td style='color:red;'>$exDate</td><td>$place</td></tr>";
			}
			else
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td>$exDate</td><td>$place</td></tr>";
			}
			
		}
		$response .= "</table>" ; 
		
		$getdata_PRST = $CONNPDO->prepare("SELECT COUNT(id) AS Number FROM storehouse WHERE type = :type   ");
		$getdata_PRST->bindValue(":type", $sType,SQLITE3_TEXT);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$sNumber = $getdata_RSLT["Number"];
		}
		
		$sNumber2 = ($sNumber / 7 );
		
		if(is_int($sNumber2))
		{
			$sNumber3 = $sNumber2;
		}
		else
		{
			$sNumber3 = floor($sNumber2) + 1;
		}
		$response .="<br><br><br>";
		
		
		for($x = 1 ; $x <= $sNumber3 ; $x++)
		{
			if($x != $page)
			{
			  $response .= "<a href='#' class='btn btn-primary'  onclick= \"Search($x);\" >$x</a>&nbsp;";
			
			}
			else
			{
			  $response .= "<a href='#' class='btn btn-primary' style=\"background-color:red;color:pink;cursor:pointer;\"  onclick= \"Search($x);\" >$x</a>&nbsp;";
			}
			
		}

		$response .= "</center>";
		
	
	 echo $response;
    }
	else
	{
		echo "Connection error";
	}

}
else
{

	try 
	{
		$CONNPDO = new PDO("sqlite:../litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	} 
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if( $CONNPDO != null)
	{	
		(int)$page = $_POST["page"]; 
		
		if($page == 1)
		{
			(int)$page = 0;		
		}
		else
		{
			
		(int)$page = ($page*7 - 7) ;
			
		}
		
		(int)$to = 7 ; 
	  	
		$response = "<table class='table table-striped'><tr><th>Type</th><th>Brand</th><th>Weight</th><th>Quantity</th><th>ExpirationDate</td><th>Place</th></tr>";
		
		$getdata_PRST = $CONNPDO->prepare("SELECT * FROM storehouse ORDER BY id  LIMIT :from , 7 ");
		$getdata_PRST->bindValue(":from", $page, SQLITE3_INTEGER);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$type = $getdata_RSLT["type"];
			$brand = $getdata_RSLT["brand"];
			$weight = $getdata_RSLT["weight"];
			$quantity = $getdata_RSLT["quantity"];
			$exDate = $getdata_RSLT["exp_date"];
			$place = $getdata_RSLT["place"];
			
			$now = time();
			$your_date = strtotime($exDate);
			
			$expire = ($your_date - $now);
			
			$criteria = round($expire / (60 * 60 * 24));
			
			if($criteria > 30)
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td>$exDate</td><td>$place</td></tr>";
			}
			else
			{
				$response .= "<tr><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td style='color:red;'>$exDate</td><td>$place</td></tr>";
			}
			
		}
		$response .= "</table>" ; 
		
		$getdata_PRST = $CONNPDO->prepare("SELECT COUNT(id) AS Number FROM storehouse");
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			$sNumber = $getdata_RSLT["Number"];
		}
		
		$sNumber2 = ($sNumber / 7 );
		
		if(is_int($sNumber2))
		{
			$sNumber3 = $sNumber2;
		}
		else
		{
			$sNumber3 = floor($sNumber2) + 1;
		}
		$response .="<br><br><br>";
		
		
		for($x = 1 ; $x <= $sNumber3 ; $x++)
		{
			if($x != $page)
			{
			  $response .= "<a href='#' class='btn btn-primary' onclick= \"Search($x);\" >$x</a>&nbsp;";
			
			}
			else
			{
			  $response .= "<a href='#' class='btn btn-primary' style=\"background-color:red;color:pink;cursor:pointer;\"  onclick= \"Search($x);\" >$x</a>&nbsp;";
			}
			
		}

	$response .= "</center>";
		
	
	 echo $response;
    }
	else
	{
		echo "Connection error";
	}

}
?>