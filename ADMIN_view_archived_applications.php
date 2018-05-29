<?php
//ADMIN CAN VIEW ALL APPLICATIONS THAT ARE MARKED AS ARCHIVED
//ADMIN CAN DELETE ANY APPLICATION IN THE LIST THROUGH THIS PAGE
//THIS WILL BE EXECUTED THROUGH ADMIN_delete_applications_functionality
	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
?>
				<!-- Header -->
				<div class="w3-container" style="margin-top:40px" id="showcase">
					<h1 class="w3-jumbo">
						<b>All Archived Applications</b>
					</h1>
					<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
				</div>
				<div class="w3-container" id="application" style="margin-top:10px"></div>
<?php

require 'DMS_db.php';

$sql = 'SELECT application_id, term, year, number_unique_questions, list_unique_questions, program_id, application_closed
		FROM applications WHERE archived="TRUE" ORDER BY application_id DESC';

//$query = mysqli_query($dbc, $sql); //what's the error

$query= $dbc->query($sql);;

if (!$query) {
	die ('SQL Error: ' . mysqli_error($dbc));
}
?>
<html>
<body>

<form action='ADMIN_delete_applications_functionality.php' method='post' onsubmit="return confirm('Are you sure you want to delete the selected tables? If you do, all applicant data will be lost and CANNOT be recovered');">
	<!--<h1>Applications</h1>-->
	<tr><td><br></td>
	<td><input type='submit' value='Delete' style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"></td>
	<td><b>**Note that clicking delete will PERMANENTLY delete the selected tables along with all applications </b></td>
	<tr>
	<br><br>
	<table class="data-table">
		<thead>
			<tr>
				<th> </th>
				<th>ID</th>
				<th>Program Name</th>
				<th>Term</th>
				<th>Year</th>
				<th>Applicants</th>

			</tr>
		</thead>

		<tbody>
		<?php
		//while ($row = mysqli_fetch_array($query))

		while ($row=$query->fetch(PDO::FETCH_ASSOC))
		{
				$id = $row['application_id'];




				$sql="SELECT name_of_program FROM programs WHERE program_id=$row[program_id]";
				$stmt=$dbc->prepare($sql);
				$stmt->execute();

				$program = $stmt->fetch();
				$name_of_program=$program['name_of_program'];

				//get the table name for this application
				$name_of_table= $id."_".str_replace(' ', '_', $name_of_program)."_".$row['term']."_".$row['year'];

				//get a count of all applicants in the table
				$sql="SELECT COUNT(*) as number_of_applicants from $name_of_table";
				$stmt=$dbc->prepare($sql);
				$stmt->execute();
				$application=$stmt->fetch();



				echo'<td><input type="checkbox" name="application_delete_list[]" value='.$id.' id='.$id.'></td>';
				echo "<td> <a href='ADMIN_view_application_information.php?id=$id '>" .$row['application_id'] . "</a> </td>";

				echo '
						<td>'.$name_of_program.'</td>
						<td>'.$row['term'].'</td>
						<td>'.$row['year'].'</td>
						<td>'.$application['number_of_applicants'].'</td>


					</tr>';


		}?>
		

		</tbody>
		
			

	</table>

</form>
</body>
</html>
