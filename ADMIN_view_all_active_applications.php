<?php
//PAGE FOR ADMIN TO VIEW ALL APPLICATIONS THAT ARE EITHER CLOSED OR OPEN, BUT NOT ARCHIVED
	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
?>
				<!-- Header -->
				<div class="w3-container" id="showcase">
					<h1 class="w3-jumbo">
						<b>All Active Applications (Closed and Open)</b>
					</h1>

					<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
				</div>
				<div class="w3-container" id="application" style="margin-top:10px"></div>
<?php
	require 'DMS_db.php';
	$sql = 'SELECT application_id, term, year, number_unique_questions, list_unique_questions, program_id, application_closed
	FROM applications WHERE archived="FALSE" ORDER BY application_id DESC';


	$query= $dbc->query($sql);;
	if (!$query)
	{
	die ('SQL Error: ' . mysqli_error($dbc));
	}
?>
<html>
<body>

<form action='ADMIN_change_application_status_connect.php' method='get'>
	<!--<h1>Applications</h1>-->
	<table class="data-table">
		<thead>
			<tr>
				<th> </th>
				<th>ID</th>
				<th>Program Name</th>
				<th>Term</th>
				<th>Year</th>
				<th>Applicants</th>
				<th>Open?</th>
			</tr>
		</thead>

		<tbody>

<?php
require 'DOCTOR_functionality.php';

				while ($row=$query->fetch(PDO::FETCH_ASSOC))
					{
						$id = $row['application_id'];

						if ($row['application_closed']==0)
						{
							$application_closed="Yes";
						}
						else
						{
							$application_closed="No";
						}

						$program_id = $row['program_id'];
						$name_of_program= get_program_name($program_id);

						//get the table name for this application
						$name_of_table= $id."_".str_replace(' ', '_', $name_of_program)."_".$row['term']."_".$row['year'];

						//get a count of all applicants in the table
						$sql="SELECT COUNT(*) as number_of_applicants from $name_of_table";
						$stmt=$dbc->prepare($sql);
						$stmt->execute();
						$application=$stmt->fetch();

						echo'
							<td><input type="checkbox" name="application_list[]" value='.$id.' id='.$id.'></td>';
						echo "
							<td> <a href='ADMIN_view_application_information.php?id= $id '>" .$row['application_id'] . "</a> </td>";

						echo '
							<td>'.$name_of_program.'</td>
							<td>'.$row['term'].'</td>
							<td>'.$row['year'].'</td>
							<td>'.$application['number_of_applicants'].'</td>
							<td>'.$application_closed.'</td>
							</tr>';

					}

?>

	</tbody>
	</table>
	<tr><td><br></td>
	<td><input type='submit' name='action' value='Close' style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"></td>
	<td><input type='submit' name='action' value='Archive' style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"></td>
	<tr>
</form>
</body>
</html>
