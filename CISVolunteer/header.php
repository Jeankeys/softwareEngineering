

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php require_once 'dbconnection.php';

session_start();

date_default_timezone_set("America/New_York");

function headerfun()
{
	echo<<<_END
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
		<script src="volunteerScript.js"></script>
	</head>	
	<body bgcolor="">
	<script src='volunteerScript.js' type="text/javascript"></script>
	<img src="Images/CIS.jpg" alt="" name="Logo" width="500" height="144" id="Logo"/><br>
	
	 <div id="TabbedPanels1" class="TabbedPanels" style="margin:10px;">
  		<ul class="TabbedPanelsTabGroup">
  			<li class="TabbedPanelsTab" tabindex="0" style="width:100px;height:30px;font-size:16px;text-align:center"><strong>Volunteer</strong></li>
    		<li class="TabbedPanelsTab" tabindex="0"  style="width:100px;height:30px;font-size:16px;text-align:center;"><strong>Admin</strong></li>
  		</ul>
  	<div class="TabbedPanelsContentGroup" style="border-style:none;"> 
_END;
	
}

function adminHeader()
{
	echo<<<_END
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
	
	<body bgcolor="">
	<img src="Images/CIS.jpg" alt="" name="Logo" width="500" height="144" id="Logo"/><br>
	
	 <div id="TabbedPanels1" class="TabbedPanels" style="margin:10px;">
  		<ul class="TabbedPanelsTabGroup">
  			<li class="TabbedPanelsTab" tabindex="0" style="width:100px;height:30px;font-size:16px;text-align:center"><strong>Admin</strong></li>
    		<li class="TabbedPanelsTab" tabindex="0"  style="width:100px;height:30px;font-size:16px;text-align:center;"><strong>Report</strong></li>
    		<li class="TabbedPanelsTab" tabindex="0" style="width:100px;height:30px;font-size:16px;text-align:center"><strong>Edit Tables</strong></li>
  		</ul>
  	<div class="TabbedPanelsContentGroup" style="border-style:none;">
_END;
}

function footerfun()
{
	echo<<<_END
	</div>
	</div>
		<script type="text/javascript">
		var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
		</script>
    	<script src='volunteerScript.js' />			
	</body>
	</html>
_END;
}

function adminForm()
{
	echo<<<_END
	<div class="TabbedPanelsContent" style="height:500px;width:100%;">
	Admin Login<br><br>
   	<form id="admin" action="adminLogin.php" method="post">
    <strong>
    Username: <input name="username" type="text"/>
    <br><br>
    Password: <input name="password" type="password" style="position:relative;left:5px;"/>
    </strong>
    <br><br>
    <input id="submit" name="Submit" type="submit" value="Login" style="position:relative;left:190px;" />
    </form>
    </div>
_END;
}

function volunteerForm()
{
	echo<<<_END
	<div class="TabbedPanelsContent" style="height:500px;width:100%;">
     
     <!-- <strong style="color:red;">Error! Please swipe your card again!</strong> -->
		<p> Please swipe your bobcat card or enter your GCID</p>
    	<p> Be sure to click on the text box before swiping your card</p>
			<form name="swipe" method="post" action="volunteerLogin.php">
				<input id="pid" name="pidn" type="text" />
				<input name="Submit" type="submit" value="Login"/>
			</form>
	<script>document.getElementById("pid").focus()</script>
	
    </div>
_END;
}

function timeLogged($gcid)
{
	$maxquery = "select max(id) from volunteerhours where gcid = '$gcid'";
	 
	$resultcheck = mysql_query($maxquery);
	if(!$resultcheck) die ("Access failed ".mysql_error());
	 
	$maxrow = mysql_fetch_row($resultcheck);
	 
	$startquery = "select timein from volunteerhours where gcid = '$gcid' and id = '$maxrow[0]'";
	 
	$startcheck = mysql_query($startquery);
	if(!$startcheck) die ("Access failed ".mysql_error());
	 
	$starttime = mysql_fetch_row($startcheck);
	 
	$endquery = "select timeout from volunteerhours where gcid = '$gcid' and id = '$maxrow[0]'";
	
	$endresult = mysql_query($endquery);
	if(!$endresult) die ("Access failed ".mysql_error());
	
	$endtime = mysql_fetch_row($endresult);
	 
	$datequery = "select timediff('$endtime[0]', '$starttime[0]')";
	 
	$datecheck = mysql_query($datequery);
	if(!$datecheck) die ("Access failed ".mysql_error());
	 
	echo "<p>The elapsed time was ".mysql_fetch_row($datecheck)[0]."</p>";
	 
	//returns to the sign in screen after 5 seconds
	$_SESSION['pidn'] = null;
	echo "<script>setTimeout(function() { window.location.href = 'index.php';}, 5000)</script>";
}

function checkLogin($user, $pass)
{
	$query = "SELECT email, password, firstName FROM admin WHERE email='$user' AND password=password('$pass');";
	
	$result = mysql_query($query);
	if(!$result) die ("Access failed ".mysql_error());
	
	$row = mysql_fetch_row($result);
	
	if($row[0] == $user)
	{
		$_SESSION['name'] = $row[2];
		return true;
	}
	else
		return false;
}
?>

<!-- <script>
valid = false;
user = document.getElementById("username");
pass = document.getElementById("password");

idSubmit = document.getElementById("submit");

if(window.XMLHttpRequest)
{ xmlhttp = new XMLHttpRequest(); }
else
{ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }

xmlhttp.onreadystatechange = function() {
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
		isValid = xmlhttp.responseText;
	}
}

xmlhttp.open("GET", "verifyLogin.php?q="+user+"?k="+pass, true);
xmlhttp.send();

function valid()
{
	if(isValid == "true")
		return true;
	else
		return false;
}
</script> -->

