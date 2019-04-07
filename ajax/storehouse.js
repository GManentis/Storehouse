function dateFix()
{
	var day;
	for ( var x = 1 ; x < 32 ; x ++)
	{
		if( x >= 1 && x < 10)
		{
			day += "<option value=0" + x + ">" + "0" + x + "</option>";
		}
		else
		{
			day += "<option value=" + x + ">" + x + "</option>";
		}
	}
	document.getElementById("day").innerHTML = day;
	
	var month;
	for ( var y = 1 ; y < 13 ; y ++)
	{
		if( y >= 1 && y < 10)
		{
			month += "<option value=0" + y + ">" + "0" + y + "</option>";
		}
		else
		{
			month += "<option value=" + y + ">" + y + "</option>";
		}
	}
	document.getElementById("month").innerHTML = month;
	
	var year;
	for ( var z = 1970 ; z < 2037 ; z ++)
	{
		
			year += "<option value=" + z + ">" + z + "</option>";
		
	}
	document.getElementById("year").innerHTML = year;
}



function Submit()
{
	var z = document.getElementsByClassName("store");
	var k = z.length;
	var stats = 0;
	
	
	for(var i = 0 ; i < k; i++)
	{
		if( z[i].value != "" || z[i].value > 0 )
		{
			stats = stats + 1;
		}
		
	}
	
	var year = document.getElementById("year").value;
	var month = document.getElementById("month").value;
	var day = document.getElementById("day").value;
	
	var date = year + "-" + month + "-" + day;
	
	
	
	
	if ( stats == 5 )
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
		
		var Product = new Order(z[0].value , z[1].value , z[2].value , z[3].value , date ,z[4].value);
		
		var pre = JSON.stringify(Product);
		var sento = encodeURIComponent(pre);


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
					document.getElementById("result").innerHTML = strOut;
					document.getElementById("type").value = "";
					document.getElementById("brand").value = "";
					document.getElementById("weight").value = "";
					document.getElementById("quantity").value = "";
					document.getElementById("place").value = "";
				
				}
			}
		
			xmlhttp.open("POST", "ajax/StoreData.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
			xmlhttp.send("send="+sento);
		}
		catch(err)
		{
			alert(err);
		}
	}
	else
	{
		document.getElementById("error").innerHTML = "Please pay more attention while filling the form,Thank you";
	}
	
}

function autoFill()
{
	
	var type = document.getElementById("type").value;
	
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
					if(strOut != "")
					{
						document.getElementById("type").value = strOut;
					}
				}
			}
		
			xmlhttp.open("POST", "ajax/AutoFill.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
			xmlhttp.send("type="+type);
		}
		catch(err)
		{
			alert(err);
		}
}


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
	
	


