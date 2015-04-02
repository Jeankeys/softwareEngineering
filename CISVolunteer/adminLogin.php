<script src="Reporting/showVolunteer.js"></script>

<?php
require_once 'header.php';

adminHeader();

$username = $_POST['username'];
$password = $_POST['password'];

$name = $_SESSION['name'];

$gcid = $_SESSION['querygcid'];

$limit = 0;

if(checkLogin($username, $password) == 1)
{
	echo<<<_END
	<div class="TabbedPanelsContent" style="height:500px;width:100%;">
	
	Welcome $name!
		<form name="logout" method="post" action="index.php">
		<input name = "submit" type="submit" id="button" value="Logout"/>
	</form>

	</div>
	
	
	<div class="TabbedPanelsContent" style="height:500px;width:100%;">
		<form method="post">
			<input type="radio" name="option" value="gcid" checked>GCID
			<input type="radio" name="option" value="other">other
		</form>
			
		Enter a GCID 
	     
			<input name="gcid" onkeyup='showVolunteer(this.value)'><br><br>
			<!-- Date From: <input name="datefrom">
			Date To: <input name="dateto"><br>
			Professor: <input name="prof">
			Class: <input name="class"><br>
			Volunteer Type: <input name="volunteertype"><br>
		<form>
			<input name="submit" type="submit" value="Submit"/> -->
		 </form>
		<button type="button" onclick="self.location.href = './Reporting/export.php';">Export</button>
			<br><br>
		<div id="text">  </div>
		
		
	</div>
	    
	<div class="TabbedPanelsContent" style="height:500px;width:100%;">
	     
	</div>
_END;
}
else
{
	//echo "Invalid username or password";
	
	//adminForm();
}

footerfun();

?>