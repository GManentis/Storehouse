<?php
if(isset($_POST["id"]))
{
	$id = $_POST["id"]; 
	
	try
	{
		$CONNPDO = new PDO("sqlite:../litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		$CONNPDO != null;
	}
	
	if($CONNPDO != null)
	{
		$getdata_PRST=$CONNPDO->prepare("DELETE FROM storehouse WHERE id=:id");
		$getdata_PRST->bindValue(":id",$id);
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		
		$getdata_PRST = $CONNPDO->prepare("SELECT * FROM storehouse ORDER BY id DESC");
		$getdata_PRST -> execute() or die($CONNPDO->errorInfo());
			
			$response = "<table class='table table-striped'><tr><th>ID</th><th>Type</th><th>Brand</th><th>Weight</th><th>Quantity</th><th>ExpirationDate</td><th>Place</th><th></th></tr>";
			
			while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
			{
				$id = $getdata_RSLT["id"];
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
				
				if ($criteria < 30)
				{
					$response .= "<tr><td>$id</td><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td style='color:red;'>$exDate</td><td>$place</td><td><button class='btn btn-danger' onclick='Delete($id)'>Remove</button></td></tr>";
				}
				else
				{
					$response .= "<tr><td>$id</td><td>$type</td><td>$brand</td><td>$weight</td><td>$quantity</td><td>$exDate</td><td>$place</td><td><button class='btn btn-danger' onclick='Delete($id)'>Remove</button></td></tr>";
				}	
			}
			$response .= "</table>" ; 
			echo $response;
		}
}
	




?>