<?php
//DISPLAYS ALL STUDENTS WHO HAVE BOTH BEEN ACCEPTED AND WHO HAVE ACCEPTED THEIR OFFER
//DISPLAYS SPECIFIC INFORMATION, BUT CAN VIEW MORE INFORMATION ON THE STUDENT BY CLICKING USER_ID AND BEING LINKED TO HR_view_student
//ALSO SEES WHAT PROGRAM STUDENT IS A PART OF AND CAN CLICK TO BE LINKED TO HR_program_description
//ALSO CAN CANGE CERTAIN FIELDS SUCH AS BACKGROUND CHECK BY EXECUTING THROUGH HR_background_check
	require 'DMS_general_functions.php';
	$role_id_array=array("3","1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];

	if ($_SESSION['role']=='1')
	{
		require "admin_header.html";
	}
	elseif($_SESSION['role']=='3')
	{
		require "HR_header.html";
	}?>

<?php
if (isset($_GET['message']))
	{

		if ($_GET['message']=="6"){
			echo '<script language="javascript">';
			echo 'alert("The password was successfully changed")';
			echo '</script>';
		}
	}
?>
<div class="zoomed">
<!-- Header -->
<div class="w3-container" style="margin-top:40px;" id="showcase">
	<h1 class="w3-jumbo">
	<?php if ($_SESSION['role']=='3'): ?>
		<b>Human Resources Dashboard</b>
	<?php else: ?>
		<b>All Accepted Students
	<?php endif; ?>
	</h1>

	<hr style="min-width:100%;border:5px solid #BF5700" class="w3-round">
	<br>
	<b> </b>
</div>


<body>

	<!--search bar-->
	<form name="search" method= "get">
		<tr>
			<td><input id='search' type='text' name='search_criteria' size='20' placeholder="Search" style="width: 50%;"/></td>
		</tr>
	</form>

	<!--<details>


	<summary><b>Sort By</b></summary>
	<p>
	<form name="sort" method= "get">
		<tr>
			<td><input type="radio" name="sort" value="user_id">ID<br></td>
		</tr>
		<tr>
			<td><input type="radio" name="sort" value="GPA ASC">GPA Ascending<br></td>
		</tr>
		<tr>
			<td><input type="radio" name="sort" value="GPA DESC">GPA Descending<br></td>
		</tr>
		<input type="hidden" name="select_application" value="<?php //echo $_GET['select_application']?>"/>

		<td><input id='sort' type='submit' style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" value='Search'/></td>

	</form>
	</p>
</details>-->
<br>

	<!--drop-down menu for filters-->
	<details>
	<summary><b>Filter</b></summary>
	<p>
	<form name="filter" method= "get">
			<!--checkbox buttons for student's classification-->
				<tr>
					<!--Page Break-->
					<td><br></td>
					<td>Classification</td>
				</tr>
				<tr class="blankrow">
					<td><br></td>
				<tr class="blankrow">
					<td><br></td>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" classification='1st year' " >&nbsp; 1st Year<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" classification='2nd year' ">&nbsp; 2nd Year<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" classification='3rd year' ">&nbsp; 3rd Year<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" classification='4th year' ">&nbsp; 4th Year<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" classification='5th year' ">&nbsp; 5th Year<br></td>
				</tr>

				<tr>
					<!--Page Break-->
					<td><br></td>
					<td>Type of Student</td>
				</tr>
				<tr class="blankrow">
					<td><br></td>
				<tr class="blankrow">
					<td><br></td>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" student_type='Undergraduate' " >&nbsp; Undergraduate<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" student_type='Graduate' ">&nbsp; Graduate<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" student_type='PhD' ">&nbsp; PhD<br></td>
				</tr>
				<tr>
					<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" student_type='Other' ">&nbsp; Other<br></td>
				</tr>
		<!--checkbox buttons for if student is eligible to work in US/employed at UT-->
		<tr>
			<td><br></td>
			<td>Work eligibility</td>
		</tr>
		<tr class="blankrow">
		<td><br></td>
		<tr class="blankrow">
			<td><br></td>
		</tr>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" employment='UT' " >&nbsp; Currently employed at UT<br></td>
		</tr>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" employment='eligible' ">&nbsp; Eligible to work in the US with no restrictions<br></td>
		</tr>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" employment='none' ">&nbsp; None of the above<br></td>
		</tr>
		<!--checkbox buttons for if they have worked at dell med school before-->
		<tr>
			<td><br></td>
			<td>Previously worked at Dell Medical School?</td>
		</tr>
		<tr class="blankrow">
		<td><br></td>
		<tr class="blankrow">
		<td><br></td>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" worked_at_dms='1' ">&nbsp; Yes<br></td>
		</tr>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" worked_at_dms='0' ">&nbsp; No<br></td>
		</tr>
		<!--checkbox buttons for if they have volunteered at seton before-->
		<tr>
			<td><br></td>
			<td>Previously volunteered at Seton Hospital?</td>
		</tr>
		<tr class="blankrow">
		<td><br></td>
		<tr class="blankrow">
		<td><br></td>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" volunteered_at_seton='1' " >&nbsp;Yes<br></td>
		</tr>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" volunteered_at_seton='0' ">&nbsp; No<br></td>
		</tr>

		<tr>
			<td><br></td>
			<td>Current?</td>
		</tr>
		<tr class="blankrow">
		<td><br></td>
		<tr class="blankrow">
		<td><br></td>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" working_for_dms='1' " >&nbsp;Yes<br></td>
		</tr>
		<tr>
			<td><input type="checkbox" style="zoom:0.75;" name="filter_criteria[]" value=" working_for_dms='0' ">&nbsp; No<br></td>
		</tr>

		<!--break-->
		<tr>
			<td><br></td>
		</tr>
		<!--displays all applicants who match all of the given criteria-->
		<tr>
			<td><b><input type="radio" name="and_or" value="AND" required>&nbsp; Search for records containing all criteria<br></b></td>
		</tr>
		<!--displays all applicants who match at least one of the given criteria-->
		<tr>
			<td><b><input type="radio" name="and_or" value="OR">&nbsp; Search for records containing at least one criteria<br></b></td>
		</tr>
		<!--submit filter decision-->
		<td><input id='submit' type='submit' style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" value='Search'/></td>
	</form>
	</p>
	</details>

	<?php

	require"HR_functionality.php";


	if(isset($_GET['search_criteria'])&&  $_GET['search_criteria']!="")
	{
		//call search_criteria function
		$query=search($_GET['search_criteria']);
	}

	//if user is filtering
	elseif(isset($_GET['filter_criteria']))
	{

			$query=filter($_GET['filter_criteria'], $_GET['and_or']); //call filter_criteria function
	}

	else
	{
		$query=view_all();
	}
	?>


	<form action='HR_background_check.php' method='post'>

	<!--Displays all of the students who have been accepted, unless given specific criteria -->
	<table class="data-table">
	<div class="zoomed">
	<caption class="title">Students Accepted by DMS</caption>
		<thead>
			<tr>
				<th>Current?</th>
				<th>EID</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Classification</th>
				<th>Student Type</th>
				<th>Credit Hours</th>
				<th>GPA</th>
				<th>Hours Working</th>
				<th>Hourly Rate</th>
				<th>Biographical Data Form</th>
				<th>I-9 Form</th>
				<th>Seton Forms</th>
				<?php if ($_SESSION['role']=='3'){ echo "<th>Background Check</th>"; } ?>
				<!--<th>Working for DMS?</th>-->
				<th>Program</th>
				<th>Position Type</th>


			</tr>
		</thead>

		<tbody>
<?php
		//this will run the user-created query and return all applicants that came out of that query
		require 'DMS_db.php';

		while ($row=$query->fetch(PDO::FETCH_ASSOC))
		{
			$id = $row['user_id'];
			$application_id = $row['application_id'];

			/* $review=get_review_entry($id);
			if(isset($review['application_id']))
			{
				//Calls get_program function from DMS_general_functions.php
				//$name_of_program =get_program_from_app_id($review['application_id']);
				$program_id=get_program_id_from_app_id($review['application_id']);
				$name_of_program =get_program($program_id);

			}
			else
			{
				$name_of_program="";
				$program_id="";
			} */


			if (isset($row['program_id']))
			{
				$name_of_program= get_program($row['program_id']);
				$program_id=$row['program_id'];

			}
			else
			{
				$name_of_program="";
				$program_id="";
			}

			$sql = "SELECT * FROM applications WHERE application_id=$application_id";
			$query2= $dbc->query($sql);
			$application=$query2->fetch();



			$bio_data_form = $row['bio_data_form'];
			if($bio_data_form == 1)
			{
				$checked_bio = 1;
				$check_bio = 'checked=';
			}
			else
			{
				$checked_bio = 0;
				$check_bio = '';
			}

			$i9 = $row['i9'];
			if($i9 == 1)
			{
				$checked_i9 = 1;
				$check_i9 = 'checked=';
			}
			else
			{
				$checked_i9 = 0;
				$check_i9 = '';
			}

			$seton_forms = $row['seton_forms'];
			if($seton_forms == 1)
			{
				$checked_seton = 1;
				$check_seton= 'checked=';
			}
			else
			{
				$checked_seton = 0;
				$check_seton = '';
			}


			$id = "'".$row['user_id']."'";
			$id_2=$row['user_id'];

			if ($_SESSION['role']=='1')
			{
				$disabled='disabled';
			}
			else
			{
				$disabled='';
			}


			//display all student info in the table

			if($row['working_for_dms']=='1')
			{
				echo "<td>&#10004;</td>";
			}
			else
			{
				echo "<td></td>";
			}
			echo "<td> <a href='HR_view_student.php?id=$id_2'>" .$row['user_id'] . "</a> </td>";
			echo "

				<td>".$row["first_name"]."</td>
				<td>".$row["middle_name"]."</td>
				<td>".$row["last_name"]."</td>
				<td>".$row["email"]."</td>
				<td>".$row["classification"]."</td>
				<td>".$row["student_type"]."</td>
				<td>".$row["credit_hours"]."</td>
				<td>".$row["GPA"]."</td>
				<td>".$row["hours_working_week"]." hours</td>
				<td>$".$row["hourly_rate"]."/hr</td>
				<td><input type='checkbox' name='bio_data_form_list[]' value=$id id=$id $disabled <?php if ($checked_bio == 1) { echo ".$check_bio."; } ?></td>
				<td><input type='checkbox' name='i9_list[]' value=$id id=$id $disabled <?php if ($checked_i9 == 1) { echo ".$check_i9."; } ?></td>
				<td><input type='checkbox' name='seton_forms_list[]' value=$id id=$id $disabled <?php if ($checked_seton == 1) { echo ".$check_seton."; } ?></td>";

			//call function select_student from DMS_HR.php
			//to pull the value of the background_check field in table student_info
			$x = select_student($id);

			if ($_SESSION['role']=='3')
			{
			if ($x['background_check']=="2") //if background_check = 2 (Fail) in the db, show the correct selected value
			{
				echo '<td><select name="background_check_list[]" '.$disabled.'>
					<option value="background_check = 0 WHERE user_id='.$id.'">N/A</option>
					<option value="background_check = 1 WHERE user_id='.$id.'">Pass</option>
					<option value="background_check = 2 WHERE user_id='.$id.'" selected="selected">Fail</option>
					</select></td>';
			}
			elseif ($x['background_check']=="1") //if background_check = 1 (Pass) in the db, show the correct selected value
			{
				echo'<td><select name="background_check_list[]" '.$disabled.'>
					<option value="background_check = 0 WHERE user_id='.$id.'">N/A</option>
					<option value="background_check = 1 WHERE user_id='.$id.'" selected="selected">Pass</option>
					<option value="background_check = 2 WHERE user_id='.$id.'">Fail</option>
					</select></td>';
			}
			else
			{ //if background_check = 0 (N/A) in the db, show the correct selected value
				echo '<td><select name="background_check_list[]"'.$disabled.'>
					<option value="background_check = 0 WHERE user_id='.$id.'"selected="selected">N/A</option>
					<option value="background_check = 1 WHERE user_id='.$id.'">Pass</option>
					<option value="background_check = 2 WHERE user_id='.$id.'">Fail</option>
					</select></td>';
			}
			}

			//echo "<td></td>"
			echo "<td> <a href='HR_program_description.php?application_id= $application_id & program_id= $program_id '>" .$name_of_program . "</a> </td>";
			echo "<td>". $application['position_type']. "</td></tr>";

		}

?>
		</tbody>
	</table>

	<?php if ($_SESSION['role']=='2'): ?>
		<tr><td><br></td>

				<td><input type='submit' name= "save" value='Save Changes' onclick="return confirm('Are you sure you want to SAVE changes?')"style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"></td>
		<tr>
		<?php  endif; ?>

	<?php if ($_SESSION['role']=='3'): ?>
		<tr><td><br></td>

				<td><input type='submit' name= "save" value='Save Changes' onclick="return confirm('Are you sure you want to SAVE changes?')"style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"></td>
		<tr>
		<?php  endif; ?>

		</form>
</div>

</body>
</html>
