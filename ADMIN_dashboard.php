<?php
//LISTS ALL APPLICATIONS THAT ARE CURRENTLY OPEN
//THIS IS THE PAGE THE ADMIN IS BROUGHT TO ON LOGIN
//USES ADMIN_dashboard_functionality TO PULL THE INFORMATION THAT WILL BE DISPLAYED ON THIS PAGE
	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
?>
<?php
	require 'ADMIN_dashboard_functionality.php';
	//this will display a message when a user is redirected to this page after completing an action
	if (isset($_GET['message']))
	{
		if ($_GET['message']=="0"){
			echo '<script language="javascript">';
			echo 'alert("The new program has been created successfully")';
			echo '</script>';
		}
		elseif ($_GET['message']=="1"){
			echo '<script language="javascript">';
			echo 'alert("The new application has been created successfully")';
			echo '</script>';
		}
		elseif ($_GET['message']=="2"){
			echo '<script language="javascript">';
			echo 'alert("The new user profile has been created successfully")';
			echo '</script>';
		}
		elseif ($_GET['message']=="6"){
			echo '<script language="javascript">';
			echo 'alert("The password was successfully changed")';
			echo '</script>';
		}
	}
?>
				<!-- Header -->
				<div class="w3-container" style="margin-top:40px" id="showcase">
					<h1 class="w3-jumbo">
						<b>Welcome to the Admin Dashboard</b>
					</h1>

					<hr style="width:100%;border:5px solid #BF5700" align="left" class="w3-round">
				</div>



				<div class="w3-container" id="application" style="margin-top:10px"></div>




				<!-- Table for all open applications -->
				<table class="data-table">
					<caption class="title">All Open Applications</caption>
					<thead>
						<tr>
							<th>ID</th>
							<th>Program Name</th>
							<th>Term</th>
							<th>Year</th>
							<th>Applicants</th>

						</tr>
					</thead>

					<tbody>

					<?php
						$query=get_application_info();

						require 'DMS_db.php';

						//if the query fails show an error
						if (!$query)
						{
							//TODO
							die ('SQL Error: ' . mysqli_error($dbc));

							//die("There was an error");
						}

						while ($row=$query->fetch(PDO::FETCH_ASSOC))
						{
							$id = $row['application_id'];

							$name_of_program=get_program($row['program_id']);

							//get the table name for this application
							$name_of_table= $id."_".str_replace(' ', '_', $name_of_program)."_".$row['term']."_".$row['year'];

							//get a count of all applicants in the table

							$application=count_applicants($name_of_table);

							//Display application info
							echo "<td> <a href='ADMIN_view_application_information.php?id= $id '>" .$row['application_id'] . "</a> </td>";

							echo '
								<td>'.$name_of_program.'</td>
								<td>'.$row['term'].'</td>
								<td>'.$row['year'].'</td>
								<td>'.$application['number_of_applicants'].'</td>
								</tr>';

						}
					?>
					</tbody>
				</table>
			</body>
		</html>
