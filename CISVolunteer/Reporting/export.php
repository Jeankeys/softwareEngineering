<?php
session_start();

$db_sever = mysql_connect('localhost', 'root','');

mysql_select_db('users');

$data = array(
		array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25),
		array("firstname" => "Amanda", "lastname" => "Miller", "age" => 18),
		array("firstname" => "James", "lastname" => "Brown", "age" => 31),
		array("firstname" => "Patricia", "lastname" => "Williams", "age" => 7),
		array("firstname" => "Michael", "lastname" => "Davis", "age" => 43),
		array("firstname" => "Sarah", "lastname" => "Miller", "age" => 24),
		array("firstname" => "Patrick", "lastname" => "Miller", "age" => 27)
);

$gcid = $_SESSION['querygcid'];

$query = "select fname, lname, email, timein, timeout, professor, class_name, other, volunteer_type, volunteer.gcid
			from volunteer, volunteerhours where volunteer.gcid = '$gcid' and volunteer.gcid=volunteerhours.gcid";
$result = mysql_query($query);

$finalarray = array();

while($values = mysql_fetch_assoc($result))
{
	array_push($finalarray, $values);
}

	
function cleanData(&$str)
{
	$str = preg_replace("/\t/", "\\t", $str);
	$str = preg_replace("/\r?\n/", "\\n", $str);
	if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	
}
	$filename = "CIS_report_" . date('Ymd') . ".xls";
	
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
	
	$flag = false;
	foreach($finalarray as $row) 
	{
		if(!$flag) 
		{
			// display field/column names as first row
			echo implode("\t", array_keys($row)) . "\r\n";
			$flag = true;
		}
		array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\r\n";
	}
	
	exit;
?>