<?php
//DISPLAYS INFORMATION ON A CURRENT APPLICATION SO THE HR CAN REVIEW AND APPROVE TO BE OPENED BY THE ADMIN
	require 'DMS_general_functions.php';
	$role_id_array=array("3","1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
?>
<?php  	if ($_SESSION['role']=='1')
	{
		require "admin_header.html";
	}
	elseif($_SESSION['role']=='3')
	{
		require "HR_header.html";
	}
?>

				<!-- Header -->
				<div class="w3-container" id="showcase">
					<h1 class="w3-jumbo">
						<b>Application Information</b>
					</h1>

					<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
				</div>
				<div class="w3-container" id="application" style="margin-top:10px"></div>
<?php

	require 'DMS_db.php';

	$program_id = $_GET['program_id'];
	$application_id = $_GET['application_id'];



	$sql = "SELECT * FROM programs WHERE program_id=$program_id";
	$query= $dbc->query($sql);
	$program=$query->fetch();

	if (!$query)
	{
		die ('SQL Error: ' . mysqli_error($dbc));
	}

	$sql = "SELECT * FROM applications WHERE application_id=$application_id";
	$query2= $dbc->query($sql);
	$application=$query2->fetch();

	if (!$query2)
	{
		die ('SQL Error: ' . mysqli_error($dbc));
	}

?>
<html>
<body>

	<!--<h1>Applications</h1>-->
	<table class="data-table2">
		<tr><thead>
			<th>Program Name</th>
			<td><?php echo $program['name_of_program'] ?></td>
		</tr>
		<tr>
			<th>Term</th>
			<td><?php echo $application['term'] ?></td>
		</tr>
		<tr>
			<th>Year</th>
			<td><?php echo $application['year'] ?></td>
		</tr>
		<tr>
			<th>Position Type</th>
			<td><?php echo $application['position_type'] ?></td>
		</tr>
		<tr>
			<th>Position Title</th>
			<td><?php echo $application['position_title'] ?></td>
		</tr>
		<tr>
			<th>Supervisor First Name</th>
			<td><?php echo $application['supervisor_first_name'] ?></td>
		</tr>
		<tr>
			<th>Supervisor Middle Name</th>
			<td><?php echo $application['supervisor_middle_name'] ?></td>
		</tr>
		<tr>
			<th>Supervisor Last Name</th>
			<td><?php echo $application['supervisor_last_name'] ?></td>
		</tr>
		<tr>
			<th>Assignment Length</th>
			<td><?php echo $application['assignment_length'] ?></td>
		</tr>
		<tr>
			<th>Start Date</th>
			<td><?php echo $application['start_date'] ?></td>
		</tr>
		<tr>
			<th>End Date</th>
			<td><?php echo $application['end_date'] ?></td>
		</tr>
		<tr>
			<th>Renew</th>
			<td><?php echo $application['renew'] ?></td>
		</tr>
		<tr>
			<th>Student Type</th>
			<td><?php echo $application['student_type'] ?></td>
		</tr>
		<tr>
			<th>IT equipment</th>
			<td><?php echo $application['it_equipment'] ?></td>
		</tr>
		<tr>
			<th>Work Location</th>
			<td><?php echo $application['work_location'] ?></td>
		</tr>
		<tr>
			<th>Max Hours Per Week</th>
			<td><?php echo $application['hours_per_week'] ?></td>
		</tr>
		<tr>
			<th>Max Hourly Rate</th>
			<td><?php echo $application['hourly_rate'] ?></td>
		</tr><tr>
			<th>Program description</th>
			<td><?php echo $program['program_description'] ?></td>
		</tr>

		</tbody>
		</table>

		<td><br></br></td>
		<td><br></br></td>
		<td><br></br></td>
		<td><br></br></td>
		<td><br></br></td>
		<td><br></br></td>
		<td><br></br></td>
</body>
</html>
