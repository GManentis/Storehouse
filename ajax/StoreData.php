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
	
	
	try 
	{
		$CONNPDO = new PDO("sqlite:../litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	} 
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if ($CONNPDO != null) 
	{
	  $getdata_PRST = $CONNPDO->prepare("SELECT COUNT(id) AS number FROM storehouse WHERE type=:type AND brand = :brand AND weight = :weight AND quantity = :quantity AND exp_date = :exp_date AND place = :place");
	  $getdata_PRST ->bindValue(":type",$type,SQLITE3_TEXT);
	  $getdata_PRST ->bindValue(":brand",$brand,SQLITE3_TEXT);
	  $getdata_PRST ->bindValue(":weight",$weight,SQLITE3_INTEGER);
	  $getdata_PRST ->bindValue(":quantity",$quantity,SQLITE3_INTEGER);
	  $getdata_PRST ->bindValue(":exp_date",$exdate,SQLITE3_TEXT);
	  $getdata_PRST ->bindValue(":place",$place,SQLITE3_TEXT);
	  $getdata_PRST->execute() or die($CONNPDO->errorInfo());
	  
	 while($getdata_RSLT = $getdata_PRST -> fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
	 {
		 $count = $getdata_RSLT["number"];
	 }
	  
		  if( $count == 0 )
		  {
			  $adddata_PRST = $CONNPDO->prepare("INSERT INTO storehouse(type, brand, weight, quantity, exp_date, place) VALUES (:type,:brand,:weight,:quantity,:exp_date,:place)");
			  $adddata_PRST ->bindValue(":type",$type,SQLITE3_TEXT);
			  $adddata_PRST ->bindValue(":brand",$brand,SQLITE3_TEXT);
			  $adddata_PRST ->bindValue(":weight",$weight,SQLITE3_INTEGER);
			  $adddata_PRST ->bindValue(":quantity",$quantity,SQLITE3_INTEGER);
			  $adddata_PRST ->bindValue(":exp_date",$exdate,SQLITE3_TEXT);
			  $adddata_PRST ->bindValue(":place",$place,SQLITE3_TEXT);
			  $adddata_PRST->execute() or die($CONNPDO->errorInfo());
			  
			  echo "A new entry has been added to the database!Click <a href='ViewInventory.php'>Here</a> for check renew inventory status!";
		  }
		  else
		  {
			  $getdata_PRST = $CONNPDO->prepare("SELECT quantity FROM storehouse WHERE type=:type AND brand = :brand AND weight = :weight AND quantity = :quantity AND exp_date = :exp_date AND place = :place LIMIT 1");
			  $getdata_PRST ->bindValue(":type",$type,SQLITE3_TEXT);
			  $getdata_PRST ->bindValue(":brand",$brand,SQLITE3_TEXT);
			  $getdata_PRST ->bindValue(":weight",$weight,SQLITE3_INTEGER);
			  $getdata_PRST ->bindValue(":quantity",$quantity,SQLITE3_INTEGER);
			  $getdata_PRST ->bindValue(":exp_date",$exdate,SQLITE3_TEXT);
			  $getdata_PRST ->bindValue(":place",$place,SQLITE3_TEXT);
			  $getdata_PRST->execute() or die($CONNPDO->errorInfo());
			  
			  while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					$lastQn = $getdata_RSLT["quantity"];
				}
			
			$newQuantity = $quantity + $lastQn;
			
			$updata_PRST = $CONNPDO->prepare("UPDATE storehouse SET quantity = :quantity WHERE type=:type AND brand = :brand AND weight = :weight AND exp_date = :exp_date AND place = :place");
			$updata_PRST ->bindValue(":type",$type,SQLITE3_TEXT);
			$updata_PRST ->bindValue(":brand",$brand,SQLITE3_TEXT);
			$updata_PRST ->bindValue(":weight",$weight,SQLITE3_INTEGER);
			$updata_PRST ->bindValue(":quantity",$newQuantity,SQLITE3_INTEGER);
			$updata_PRST ->bindValue(":exp_date",$exdate,SQLITE3_TEXT);
			$updata_PRST ->bindValue(":place",$place,SQLITE3_TEXT);
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