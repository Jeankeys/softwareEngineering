<?php

require_once 'header.php';

headerfun();

$gcid = $_POST['gcid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pnum = $_POST['pnum'];
$vtype = $_POST['vtype'];
$class = $_POST['class'];
$prof = $_POST['prof'];
$other = $_POST['other'];

if($class == "")
	$class = "None";
if($prof == "")
	$prof = "None";
if($other == "")
	$other = "None";

$_SESSION['gcid'] = $gcid;

$query = "SELECT gcid FROM volunteer WHERE gcid='$gcid'";

$result = mysql_query($query);

if(!$result) die ("Access failed ".mysql_error());

$row = mysql_fetch_row($result);

if($row[0] == $gcid)
{
	$_SESSION['login'] = 1;
	
	$querycheck = "select loginstatus from volunteerhours where gcid='$gcid' and loginstatus = 0";
	
	$resultcheck = mysql_query($querycheck);
	if(!$resultcheck) die ("Access failed ".mysql_error());
	
	$row = mysql_fetch_array($resultcheck, MYSQL_NUM);
	
	if($row == null)
	{//Sign in
		
		$_SESSION['signin'] = 1;
		$query2 = 	"INSERT INTO volunteerhours(gcid, professor, class_name, other, volunteer_type)
		VALUES ('$gcid','$prof','$class','$other','$vtype')";
	
		$result2 = mysql_query($query2);
		if(!$result2) die ("Access failed ".mysql_error());
	}
	
	else
	{//Sign out
		
		$_SESSION['signin'] = 0;
		$queryupdate = "update volunteerhours set timeout = CURRENT_TIMESTAMP, loginstatus = 1 where gcid = '$gcid' and loginstatus = 0";
		
		$resultupdate = mysql_query($queryupdate);
		if(!$resultupdate) die ("Access failed ".mysql_error());
		
	}
	
}
else
{
	$_SESSION['login'] = 1;
	
	$_SESSION['signin'] = 1;
	
	$p = $_SESSION['pidn'];
	
	$query1 = "INSERT INTO volunteer(fname, lname, email, phone, gcid, pidn) 
				VALUES ('$fname','$lname','$email','$pnum','$gcid', '$p')";
	
	$result1 = mysql_query($query1);
	if(!$result1) die ("Access failed ".mysql_error());
	
	$query2 = 	"INSERT INTO volunteerhours(gcid, professor, class_name, other, volunteer_type) 
				VALUES ('$gcid','$prof','$class','$other','$vtype')";
	
	$result2 = mysql_query($query2);
	if(!$result2) die ("Access failed ".mysql_error());
}

$date = date_create();

echo "<div class='TabbedPanelsContent' style='height:400px;width:100%;'>";

if($_SESSION['login'] == 1)
{
	if($_SESSION['signin'] == 1)
	{
		echo "<p>Sign in successful!";
		echo "<br>";
		echo "Your sign in time is: ".date_format($date, 'F j, Y, g:i a') . "\n</p>";
		 
		//Returns to the sign in screen after 5 seconds
		$_SESSION['pidn'] = null;
		echo "<script>setTimeout(function() { window.location.href = 'index.php';}, 5000)</script>";
	}
	else if($_SESSION['signin'] == 0)
	{
		echo "<p>Sign out successful!";
		echo "<br>";
		echo "Your sign out time is: ".date_format($date, 'F j, Y, g:i a') . "\n</p>";
		 
		timeLogged($gcid);
	}
}

echo "</div>";

adminForm();

footerfun();
?> 
