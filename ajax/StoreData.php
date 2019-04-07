<?php
if(isset($_POST["send"]))
{
	$delivery = $_POST["send"];
	$decode = urldecode ( $delivery );
	$product = json_decode($decode,true);
	
	$type = $product["type"];
	$brand = $product["brand"];
	$weight = $product["weight"];
	$quantity = $product["quantity"];
	$exdate = $product["exdate"];
	$place = $product["place"];
	
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
	  $getdata_PRST = $CONNPDO->prepare("SELECT * FROM storehouse WHERE type=:type AND brand = :brand AND weight = :weight AND quantity = :quantity AND exp_date = :exp_date AND place = :place");
	  $getdata_PRST ->bindValue(":type",$type);
	  $getdata_PRST ->bindValue(":brand",$brand);
	  $getdata_PRST ->bindValue(":weight",$weight);
	  $getdata_PRST ->bindValue(":quantity",$quantity);
	  $getdata_PRST ->bindValue(":exp_date",$exdate);
	  $getdata_PRST ->bindValue(":place",$place);
	  $getdata_PRST->execute() or die($CONNPDO->errorInfo());
	  
	  $count = $getdata_PRST->rowCount();
	  
		  if( $count == 0 )
		  {
			  $adddata_PRST = $CONNPDO->prepare("INSERT INTO storehouse(type, brand, weight, quantity, exp_date, place) VALUES (:type,:brand,:weight,:quantity,:exp_date,:place)");
			  $adddata_PRST ->bindValue(":type",$type);
			  $adddata_PRST ->bindValue(":brand",$brand);
			  $adddata_PRST ->bindValue(":weight",$weight);
			  $adddata_PRST ->bindValue(":quantity",$quantity);
			  $adddata_PRST ->bindValue(":exp_date",$exdate);
			  $adddata_PRST ->bindValue(":place",$place);
			  $adddata_PRST->execute() or die($CONNPDO->errorInfo());
			  
			  echo "A new entry has been added to the database!Click <a href='ViewInventory.php'>Here</a> for check renew inventory status!";
		  }
		  else
		  {
			  $getdata_PRST = $CONNPDO->prepare("SELECT quantity FROM storehouse WHERE type=:type AND brand = :brand AND weight = :weight AND quantity = :quantity AND exp_date = :exp_date AND place = :place LIMIT 1");
			  $getdata_PRST ->bindValue(":type",$type);
			  $getdata_PRST ->bindValue(":brand",$brand);
			  $getdata_PRST ->bindValue(":weight",$weight);
			  $getdata_PRST ->bindValue(":quantity",$quantity);
			  $getdata_PRST ->bindValue(":exp_date",$exdate);
			  $getdata_PRST ->bindValue(":place",$place);
			  $getdata_PRST->execute() or die($CONNPDO->errorInfo());
			  
			  while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					$lastQn = $getdata_RSLT["quantity"];
				}
			
			$newQuantity = $quantity + $lastQn;
			
			$updata_PRST = $CONNPDO->prepare("UPDATE storehouse SET quantity = :quantity WHERE type=:type AND brand = :brand AND weight = :weight AND exp_date = :exp_date AND place = :place");
			$updata_PRST ->bindValue(":type",$type);
			$updata_PRST ->bindValue(":brand",$brand);
			$updata_PRST ->bindValue(":weight",$weight);
			$updata_PRST ->bindValue(":quantity",$newQuantity);
			$updata_PRST ->bindValue(":exp_date",$exdate);
			$updata_PRST ->bindValue(":place",$place);
			$updata_PRST->execute() or die($CONNPDO->errorInfo());
			
			echo "An already inserted product has been updated!Click <a href='ViewInventory.php'>Here</a> for check renew inventory status!";
			
		  }
	}
	else
	{
		echo "no db connection";
	}

}
else
{
	echo "An error has occured";
}	
	  
?>