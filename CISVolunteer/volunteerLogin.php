<?php require_once 'header.php';

headerfun();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$pidn = $_POST['pidn'];

	if(strpos($pidn, 'E') !== false)
	{ 
		
    	volunteerForm();
    	
    	adminForm();
    	
    }
	else
	{
		if(strlen($pidn) > 9)
		{
			$query = "select gcid, fname, lname, email, phone from volunteer where pidn = '$pidn'";
		
			$_SESSION['pidn'] = $pidn;
		}
		else if (strlen($pidn) == 9)
		{
			$query = "select gcid, fname, lname, email, phone from volunteer where gcid = '$pidn'";
		}
		else
		{
			volunteerForm();
			adminForm();
		}
		
		$result = mysql_query($query);
		if(!$result) die ("Access failed ".mysql_error());
		
		$row = mysql_fetch_row($result);
		
echo<<<_END
	<div class="TabbedPanelsContent" style="height:500px;width:100%;">
	<form id="volunteer" action="loginSuccess.php" method="post">
     <table >
     	<tr>
     		<td>GCID:</td> 
     		<td><input name="gcid" type="text" value="$row[0]"/></td>
        </tr>
    	<tr>
    		<td>First Name: </td>
    		<td><input name="fname" type="text" value="$row[1]"/></td>
        </tr>
    	</tr>
    	<tr>
    		<td>Last Name: </td>
    		<td><input name="lname" type="text" value="$row[2]"/></td>
    	</tr>
    	<tr>
    		<td>Email: </td>
    		<td><input name="email" type="text" value="$row[3]"/></td>
    	</tr>
    	<tr>
    		<td>Phone Number:</td> 
    		<td><input name="pnum" type="int" value="$row[4]"/></td>
    	</tr>
		<tr>
    		<td></td>
            <td align="right">
            <input name="Submit" type="submit" value="Login"/>
            </td>
        </tr>
    </table>
    	
    <table style="position:relative;top:-175px;right:-400px;">
    	<tr>
    		<td>Volunteer Type: <select id ="type" name="vtype" onchange="showVolunteer(this.value)" style="width:150px;height:30px;">
     				<option>Volunteer</option>
        			<option>Academic</option> <!-- name and proffesor -->
        			<option>Intern</option> <!-- proffesor -->
        			<option>Student teacher</option>
        			<option>Pre-Education</option>
        			<option>Ameri-Corps</option>
        			<option>America Reads</option>
        			<option>Student Aid</option>
        			<option>Faculty</option>
        			<option>Staff</option>
        			<option>Parent</option>
	        		<option>Other</option>
	    		</select>
	    	</td>
    	</tr>
    	<tr id="class" style="display:none">
    		<td>Class: <input name="class" /></td>
    	</tr>
    	<tr id="prof" style="display:none">
    		<td>Professor: <input name="prof" /></td>
    	</tr>
    	<tr id="other" style="display:none">
    		<td>Other: <input name="other" /></td>	
    	</tr>	
    </table>
    </form>
    </div>
_END;
	
	adminForm();
	}
}
else 
{
	volunteerForm();
	
	adminForm();
}

footerfun();
?>


