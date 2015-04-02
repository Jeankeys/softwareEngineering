<style>
table 
{
	width:100%;
	border-collapse: collapse;
}

table, td, th
{
	border:1px solid black;
	padding: 5px;
}	

th 
{
	text-align:left;
}

</style>

<?php
require_once '../dbconnection.php';
require_once '../header.php';

$q = $_GET['q'];

$_SESSION['querygcid'] = $q;

$query = "select fname, lname, email, timein, timeout, professor, class_name, other, volunteer_type, volunteer.gcid 
			from volunteer, volunteerhours where volunteer.gcid = '$q' and volunteer.gcid=volunteerhours.gcid";
$result = mysql_query($query);


//$_SESSION['values'] = mysql_fetch_assoc($result);

echo"<table>
		<tr>
		<th>GCID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th> 
		<th>Time In</th>
		<th>Time Out</th>
		<th>Professor</th>
		<th>Class Name</th>
		<th>Other</th>
		<th>Volunteer Type</th>
		</tr>";
while($row = mysql_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['gcid'] . "</td>";
	echo "<td>" . $row['fname'] . "</td>";
	echo "<td>" . $row['lname'] . "</td>";
	echo "<td>" . $row['email'] . "</td>";
	echo "<td>" . $row['timein'] . "</td>";
	echo "<td>" . $row['timeout'] . "</td>";
	echo "<td>" . $row['professor'] . "</td>";
	echo "<td>" . $row['class_name'] . "</td>";
	echo "<td>" . $row['other'] . "</td>";
	echo "<td>" . $row['volunteer_type'] . "</td>";
	echo "</tr>";
}
echo "</table>";

mysql_close();
?>