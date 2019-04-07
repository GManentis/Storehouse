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
<h3 style="color:red;">Καλωσορίσατε στην διαχείρηση προϊόντων</h3>
<hr>
<p>Εδώ μπορείτε να τροποποιήσετε η θέση και τη ποσότητα των προιόντων καθώς και να αφαιρέσετε ότι θεώρειτε περιττό.</p>
<p>Για να τροποποιήσετε τα προιόντα παρακαλώ εισάγετε στη <a href="#seto">φόρμα εδώ</a> και εισάγετε: </p>
<p>1.Τον κωδικό προιόντος το οποίο θέλετε να τροποποιήσετε  -  2.Τη νέα ποσότητα αυτού  -  3.Τη νέα του τοποθεσία</P>
<hr>
<div class="container">
<span>
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
<span id="inventory" style="float:right;overflow-y:auto;overflow-x:auto; width:800px;height:500px;"></span>
</div>
<br><hr><br>
<center>
<div class="container" style="width:400px;height:300px;" id="seto">
<h4 style="color:red">Αλλαγή καταστασης αποθήκης</h4>
Id:<input type="text" id="id" class='form-control' style='text-align:center;'>
<br>
New Quantity:<input type="number" class='form-control' style='text-align:center;' id="quan">
<br>
New Location:<input type="text" class='form-control' style='text-align:center;' id="loc">
<br>
<button id="change" class="btn btn-primary">Set New Parameters!</button>
</div>
</centeR>
<br><br><br>
</body>
</html>