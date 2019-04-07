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
<div class="container">
<h3 style="color:red;">Καταχώρηση Στοιχείων</h3>
<hr>
<p>Καλωσορίσατε στην καταχώρηση στοιχείων.Παρακαλώ συμπληρώστε τη φόρμα για καταχώρηση προϊόντος</p>
<p style="color:red;">Σημείωση: Ολα τα στοιχεια πρέπει να συμπληρωθούν για μια έγκυρη είσοδο</p>
<hr>
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
<table>
<tr><td>Type:</td><td><input class="store form-control" id="type" type="text" style="width:300px;"></td></tr>
<tr><td>Brand:</td><td><input class="store form-control" id="brand" type="text" style="width:300px;"></td></tr>
<tr><td>Package Weight:</td><td><input class="store form-control" id="weight" type="number" style="width:300px;"></td></tr>
<tr><td>Quantity:</td><td><input class="store form-control" id="quantity" type="number" style="width:300px;"></td></tr>
<tr><td>Expiration Date:</td><td><input class="store form-control" id="date" type="text" style="width:300px;"></td></tr>
<tr><td>Place:</td><td><input class="store form-control" id="place" type="text" style="width:300px;"></td></tr>
</table>
<br>
<button class="btn btn-primary" id="submit">Submit</button>
<br>
<hr>
<br>
</span>
</div>
<br>
<div class="container">
<span id="result"></span>
<br>
<span id="error" style="color:red;"></span>
</div>
</center>
</body>
</html>