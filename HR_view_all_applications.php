<?php
//DISPLAYS A LIST OF ALL NON-ARCHIVED APPLICATIONS FOR THE USER TO VIEW
//CAN CLICK ON APPLICATION ID TO VIEW MORE DETAILED INFO- LINKS TO HR_program_description
	require "DMS_general_functions.php";
	$role_id_array=array("3");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "HR_header.html";
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
	$sql = 'SELECT *
	FROM applications LEFT JOIN programs ON applications.program_id=programs.program_id WHERE archived="FALSE" ORDER BY application_id DESC';


	$query= $dbc->query($sql);;
	if (!$query)
	{
	die ('SQL Error: ' . mysqli_error($dbc));
	}


?>
<html>
<body>

	<!--<h1>Applications</h1>-->
	<table class="data-table">
		<thead>
			<tr>


				<th>Program Name</th>
				<th>Term</th>
				<th>Year</th>
				<th>Questions</th>
				<th>Open?</th>
			</tr>
		</thead>

		<tbody>

<?php
require 'DOCTOR_functionality.php';

				while ($row=$query->fetch(PDO::FETCH_ASSOC))
					{
						$id = $row['application_id'];
						$program_id=$row['program_id'];

						$application_id = $row['application_id'];
						$list_unique_questions = $row['list_unique_questions'];
						$array_unique_questions=explode('(#!BREAK!#)', $list_unique_questions);
						$string_unique_questions=implode('<br>', $array_unique_questions);

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


						echo "
							<td> <a href='HR_program_description.php?application_id= $application_id & program_id= $program_id '>" .$name_of_program . "</a> </td>";

						echo '
							<td>'.$row['term'].'</td>
							<td>'.$row['year'].'</td>
							<td><font color="red">'.$string_unique_questions.'</td></div>
							<td>'.$application_closed.'</td>
							</tr>';

					}

?>

	</tbody>
	</table>


</body>
</html>
