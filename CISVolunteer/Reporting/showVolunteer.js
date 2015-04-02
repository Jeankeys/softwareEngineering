/**
 * 
 */

function showVolunteer(str)
{
	if (str == "")
	{
		document.getElementById("text").innerHTML = "";
		return;
	}
	
	if(window.XMLHttpRequest)
	{ xmlhttp = new XMLHttpRequest(); }
	else
	{ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById("text").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET", "Reporting/showVolunteer.php?q="+str, true);
	xmlhttp.send();
}