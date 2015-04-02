/**
 * 
 */
function showVolunteer(str)
{	
	if(str === "Academic")
	{
		document.getElementById("class").style.display = "table-cell";
		document.getElementById("prof").style.display = "table-cell";
		document.getElementById("other").style.display = "none";
	}
	else if (str === "Intern")
	{
		document.getElementById("class").style.display = "none";
		document.getElementById("prof").style.display = "table-cell";
		document.getElementById("other").style.display = "none";
	}
	else if (str === "Other")
	{
		document.getElementById("class").style.display = "none";
		document.getElementById("prof").style.display = "none";
		document.getElementById("other").style.display = "table-cell";
	}
	else
	{
		document.getElementById("class").style.display = "none";
		document.getElementById("prof").style.display = "none";
		document.getElementById("other").style.display = "none";
	}	
}