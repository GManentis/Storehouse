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
<body onload="dateFix()">
<center>
<div class="container">
<h3 style="color:red;">Καταχώρηση Στοιχείων</h3>
<hr>
<p>Καλωσορίσατε στην καταχώρηση στοιχείων.Παρακαλώ συμπληρώστε τη φόρμα για καταχώρηση προϊόντος</p>
<p style="color:red;">Σημείωση: Ολα τα στοιχεια πρέπει να συμπληρωθούν για μια έγκυρη είσοδο</p>
<hr>
<table>
<tr><td>Type:</td><td><input class="store form-control" id="type" type="text" style="width:300px;"></td></tr>
<tr><td>Brand:</td><td><input class="store form-control" id="brand" type="text" style="width:300px;"></td></tr>
<tr><td>Package Weight:</td><td><input class="store form-control" id="weight" type="number" style="width:300px;"></td></tr>
<tr><td>Quantity:</td><td><input class="store form-control" id="quantity" type="number" style="width:300px;"></td></tr>
<tr><td>Expiration Date:</td><td><select id="year" style="width:117px;" ></select>-<select id="month" style="width:87px;"></select>-<select id="day" style="width:86px;"></select></td></tr>
<tr><td>Place:</td><td><input class="store form-control" id="place" type="text" style="width:300px;"></td></tr>
</table>
<br>
<button class="btn btn-primary" onclick="Submit()">Submit</button>
<br>
<hr>
<br>
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