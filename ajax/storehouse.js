$(document).ready(function()
{
	$("#date").datepicker();
	
	
	$("#submit").click(function()
	{
		var z = $(".store").map(function() 
		{
		   return $(this).val();
		}).get();
		
		var k = z.length;
		var stats = 0;
	
	
		for(var i = 0 ; i < k; i++)
		{
			if( z[i] != "" || z[i] > 0 )
			{
				stats = stats + 1;
			}
			
		}
		
		if( stats == 6 )
		{
			function Order(type,brand,weight,quantity,exdate,place)
			{
				this.type = type;
				this.brand = brand;
				this.weight = weight;
				this.quantity = quantity;
				this.exdate = exdate;
				this.place = place;
			
			}
		
		var Product = new Order(z[0] , z[1] , z[2] , z[3] , z[4] ,z[5]);
		
		var pre = JSON.stringify(Product);
		var sento = encodeURIComponent(pre);
		
		
		$.ajax({
			type: "POST",
			url: "ajax/StoreData.php" ,
			data: {send:sento},
			/*contentType: "application/json; charset=utf-8",*/
			/*dataType: "json",*/
			success: function(data)
			{
				$("#result").html(data);
				$("#type").val("");
				$("#brand").val("");
				$("#weight").val("");
				$("#quantity").val("");
				$("#place").val("");
				$("#date").val("");
			}
		});
	  }
	  else
	  {
		  $("#error").text("Please pay more attention while filling the form,Thank you");
	  }
			
	});

	
	$.ajax({
			type: "POST",
			url: "ajax/AutoFill.php" ,
			data: {},
			success: function(data)
			{
				$("#inventory").html(data);
				
			}
		});
		
		
		$("#change").click(function()
		{
			var id = $("#id").val();
			var quan = $("#quan").val();
			var loc = $("#loc").val();
				
				
				$.ajax({
				type: "POST",
				url: "ajax/AlterStats.php" ,
				data: {id:id, quantity:quan, locatio:loc},
				success: function(data)
				{
					$("#inventory").html(data);
					
				}
			});
		
		});
	
	
	
});

var z = 0;

function Search(x)
{
	var type = document.getElementById("type").value;
	var brand = document.getElementById("brand").value;
	
	try 
		{				
			var xmlhttp;

			if (window.XMLHttpRequest) 
			{
				xmlhttp = new XMLHttpRequest();
			} 
			else 
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
			}
		
			xmlhttp.onreadystatechange = function() 
			{			
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					var strOut;			
					strOut = xmlhttp.responseText;
					document.getElementById("results").innerHTML = strOut;
				}
			}
		
			xmlhttp.open("POST", "ajax/FetchData.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
			xmlhttp.send("page="+x+"&type="+type+"&brand="+brand);
		}
		catch(err)
		{
			alert(err);
		}
	
}

function Delete(x)
{	
	try 
		{				
			var xmlhttp;

			if (window.XMLHttpRequest) 
			{
				xmlhttp = new XMLHttpRequest();
			} 
			else 
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
			}
		
			xmlhttp.onreadystatechange = function() 
			{			
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					var strOut;			
					strOut = xmlhttp.responseText;
					document.getElementById("inventory").innerHTML = strOut;
				}
			}
		
			xmlhttp.open("POST", "ajax/RemoveEntry.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
			xmlhttp.send("id="+x);
		}
		catch(err)
		{
			alert(err);
		}
	
}

function DoubleClick1(x)
{ 
	
		var val = document.getElementById(x).innerHTML;
		var w = x;
		document.getElementById(x).innerHTML = "<input class='form-control' onkeydown='if(event.keyCode==13) changeQuan("+ w +");' type='number' id='" + w + "' value='" +val+"' >";
		document.getElementById(x).id = "";
	
}

function DoubleClick2(x)
{ 
	
		var val = document.getElementById(x).innerHTML;
		var elementum = document.getElementById(x).id;
		var w = elementum;
		document.getElementById(x).innerHTML = "<input class='form-control' onkeydown='if(event.keyCode==13)changeLoc(\"" + w + "\")' type=\"text\" id= \""+w+"\" value='"+val+"' >";
		document.getElementById(x).id = "";
	
}


function changeQuan(x)
{
	var elem = document.getElementById(x);
	var id = elem.id;
	
	
	var quantity = elem.value;
	
	try {				
		var xmlhttp;

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
			// most browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		xmlhttp.onreadystatechange = function() 
		{			
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var strOut;			
				strOut = xmlhttp.responseText;
				document.getElementById("inventory").onunload = function(){ chatbox.scrollTo(0,0); }
				document.getElementById("inventory").innerHTML = strOut;
			}
		}
		xmlhttp.open("POST", "ajax/ChangeQuantity.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp.send("id="+id+"&quantity="+quantity);
	}
	catch(err) {
		alert(err);
	}
}

function changeLoc(x)
{
	var id = document.getElementById(x).id;
	var locatio = document.getElementById(x).value;
	
	
	
	try 
	{				
		var xmlhttp;

		if (window.XMLHttpRequest) 
		{
			xmlhttp = new XMLHttpRequest();
			// most browsers
		} 
		else 
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		xmlhttp.onreadystatechange = function() 
		{			
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var strOut;			
				strOut = xmlhttp.responseText;
				document.getElementById("inventory").onunload = function(){ chatbox.scrollTo(0,0); }
				document.getElementById("inventory").innerHTML = strOut;
			}
		}
		xmlhttp.open("POST", "ajax/ChangeLocation.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp.send("id="+id+"&location="+locatio);
	}
	catch(err)
	{
		alert(err);
	}
}



	
	


