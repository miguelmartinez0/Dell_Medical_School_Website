<?php
//USER CAN SEE THE APPLICATION INFORMATION WHEN THIS APPLICATION WAS SELECTED THROUGH HR_DASHBOARD
//ONLY SEES INFORMATION THAT HR NEEDS TO SEE
//PULLS THIS INFORMATION USING DMS_general_functions
require "DMS_general_functions.php";
$role_id_array=array("3","1");
require "DMS_authenticate.php";
$user_id = $_SESSION['user_id'];
require "HR_header.html";
?>
 <!-- Header -->
<div class="w3-container" style="margin-top:40px; font-familt:benton sans;" id="showcase">
	<h1 class="w3-jumbo">
		<b>Application/Program Information</b>
	</h1>


	<hr style="min-width:100%;border:5px solid #BF5700" align="left" class="w3-round">
	<br>
	<b> </b>
	<br>
	<br>
</div>
</html>

<form action='DOCTOR_update_review.php' method='POST'>

<?php
	require 'DMS_db.php';

	// Get ID from the URL
	$id = $_GET['id'];

	$result = "SELECT * FROM applications WHERE application_id = '$id'";
	$query= $dbc->query($result);

	if (!$query)
	{
		die ('SQL Error: ' . mysqli_error($dbc));
	}

?>
<table width=100% table border>
<tr>

</tr>

<?php


	//while($row = mysqli_fetch_array($result))
	while ($row=$query->fetch(PDO::FETCH_ASSOC))
	{

		echo "<tr>";
		echo "<th>Application ID</th>";
		echo "<td>" . $row['application_id'] .  "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Term</th>";
		echo "<td>" . $row['term'] .  "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Year</th>";
		echo "<td>" . $row['year'] .  "</td>";
		echo "</tr>";

		$application_id = $row['application_id'];

		// select a specific program_id using application_id
		$sql="SELECT program_id FROM applications WHERE application_id=$application_id";
		$query_program = $dbc->query($sql);

		while ($row=$query_program->fetch(PDO::FETCH_ASSOC))
		{
			$program_id = $row['program_id'];
		}


		// select specific program info using program_id
		$sql="SELECT * FROM programs WHERE program_id=$program_id";
		$query_programinfo = $dbc->query($sql);

		while ($row=$query_programinfo->fetch(PDO::FETCH_ASSOC))
		{
			$name_of_program = $row['name_of_program'];
			$doctor_EID = $row['doctor_EID'];
			$position_type = $row['position_type'];
		}

		echo "<tr>";
		echo "<th>Program Name</th>";
		echo "<td>" . $name_of_program .  "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Doctor EID</th>";
		echo "<td>" . $doctor_EID .  "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<th>Position Type</th>";
		echo "<td>" . $position_type .  "</td>";
		echo "</tr>";

	}

?>
</table>


<td><br></td>
<td><br></td>
<td><br></td>
<td><br></td>
<td><br></td>
<td><br></td>
</form>
