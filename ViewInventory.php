<?php

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
		$option = "<select class='form-control' id='brand' style='text-align:center;'><option value=''>-</option>";
		$brand = "";
		$getdata_PRST = $CONNPDO->prepare("SELECT DISTINCT brand FROM storehouse ");
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		
		while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
		{
		  $brand = $getdata_RSLT["brand"];	
		  $option .= "<option value=\"$brand\">".$brand."</option>"; 
		}
		
		$option.= "</select>";
	
	}
	else
	{
		$option = "Error";
	}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="ajax/storehouse.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<h3 style="color:red;">Καλωσορίσατε στην αναζήτηση προϊόντος</h3>
<hr>
<p>Τα κριτήρια αναζήτησης είναι δύο,όνομα και μάρκα.Μπορείτε να κάνετε την αναζήτηση σας σύμφωνα με το 
κριτήριο της επιλογής ή και με βάση τα δύο κριτήρια μαζί. Αν δεν επιθυμείτε κάποια συνθήκη αναζήτησης παρακαλώ
πατήσετε απευθείας search.Ευχαριστούμε!!</p>
<a href="AddInventory.php">Click here to update inventory</a>
<hr>
<div class="container">
Bάση το όνομα:<br><input id="type" type="text" class='form-control' style='text-align:center;' onkeyup="autoFill()">
<br>
<br>
Bάση μάρκα του προϊόντος:<br><?php echo $option ?>
<br>
<br>
<button class="btn btn-primary" onclick="Search(1)">Search Now!</button>
<br>
<hr>
</div>
<div class='container'>
<span id="results"></span>
</div>
</body>
</html>