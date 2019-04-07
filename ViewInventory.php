<?php

	try 
	{
		$CONNPDO = new PDO("sqlite:litehouse.db");
		$CONNPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	} 
	catch (PDOException $e) 
	{
		$CONNPDO = null;
	}
	if ($CONNPDO != null) 
	{
		$option = "<select style='width:700px;' class='form-control' id='brand' style='text-align:center;'><option value=''>-</option>";
		$brand = "";
		$getdata_PRST = $CONNPDO->prepare("SELECT DISTINCT brand FROM storehouse ");
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		
		while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
		{
		  $brand = $getdata_RSLT["brand"];	
		  $option .= "<option  value=\"$brand\">".$brand."</option>"; 
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
<script type="text/javascript" src="jquery-3.3.1.js"></script>
<script type="text/javascript" src="ajax/storehouse.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="jquery-ui-1.12.1/jquery-ui.min.css">
<script type="text/javascript" src="jquery-ui-1.12.1/external/jquery/jquery.js"></script>
<script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<center>
<h3 style="color:red;">Καλωσορίσατε στην αναζήτηση προϊόντος</h3>
<hr>
<p>Τα κριτήρια αναζήτησης είναι δύο,όνομα και μάρκα.Μπορείτε να κάνετε την αναζήτηση σας σύμφωνα με το 
κριτήριο της επιλογής ή και με βάση τα δύο κριτήρια μαζί. Αν δεν επιθυμείτε κάποια συνθήκη αναζήτησης παρακαλώ
πατήσετε απευθείας search.Ευχαριστούμε!!</p>
<hr>
<div class="container">
<span style="float:left; width:120px; height:200px; border:1px solid gray; word-wrap:break-word; padding:10px; ">
<b><i>Actions:</i></b>
<hr>
<a href="AddInventory.php">Add Inventory</a>
<br>&#8902;<br>
<a href="ViewInventory.php">View Inventory</a>
<br>&#8902;<br>
<a href="AlterInventory.php">Alter Inventory</a>
<br><br>
</span>
<span>
Bάση το όνομα:<br><input id="type" style="width:700px;" type="text" class='form-control' style='text-align:center;'>
<br>
<br>
Bάση μάρκα του προϊόντος:<br><?php echo $option ?>
<br>
<br>
<button class="btn btn-primary" onclick="Search(1)">Search Now!</button>
<br>
<hr>
</span>
</div>
<div class='container'>
<span id="results"></span>
</div>
</body>
</html>