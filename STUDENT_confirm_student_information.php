<?php
//PAGE FOR STUDENT TO SEE THEIR CURRENT STUDENT INFORMATION AND EITHER CONFIRM OR EDIT IT BEFORE PROCEEDING TO STUDENT_select_program_apply
//THIS ALWAYS DISPLAYS BEFORE A STUDENT CAN SELECT WHICH PROGRAM THEY WILL APPLY TO
	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";
	$user_id=$_SESSION['user_id'];
	require "STUDENT_header.html";
?>
		<link type="text/css" rel="stylesheet" href="DMS_Stylesheet.css" media="all" />
<table class='data-table2'>

  		<!-- Header -->
<div class="w3-container" style="margin-top:50px; font-familt:benton sans;" id="showcase">
	<h1 class="w3-jumbo">
		<b>Confirm</b>
	</h1>

	<hr style="min-width:100%;border:5px solid #BF5700" align="left" class="w3-round">

<br>
</div>

<?php

	require "DMS_db.php";

	$statement = $dbc->prepare("SELECT * FROM student_info WHERE user_id = :user_id");
	$statement->execute(array(':user_id' => $user_id));
	$row = $statement->fetch();

		/* $stmt = $dbc->query("SELECT * FROM student_info WHERE user_id = $user_id");
		$row = $stmt->fetch(); */

	$availability_array=explode(',',$row['availability']);
	$first_name=$row['first_name'];
	$middle_name=$row['middle_name'];
	$last_name=$row['last_name'];
	$address=$row['address'];
	$city=$row['city'];
	$state=$row['state'];
	$zip_code=$row['zip_code'];
	$phone=$row['phone'];
	$email=$row['email'];
	$employment=$row['employment'];
	$student_type=$row['student_type'];
	$classification=$row['classification'];
	$degree_type=$row['degree_type'];
	$major=$row['major'];
	$major_2=$row['major_2'];
	$GPA=$row['GPA'];
	$credit_hours=$row['credit_hours'];
	if ($row['worked_at_dms']=="0")
	{
		$worked_at_dms="No";
	}
	else
	{
		$worked_at_dms="Yes";
	}
	if($row['volunteered_at_seton']=="0")
	{
		$volunteered_at_seton="No";
	}
	else
	{
		$volunteered_at_seton="Yes";
	}
	if($row['car']=="0")
	{
		$car="No";
	}
	else
	{
			$car="Yes";
	}
	$bilingual=$row['bilingual'];
	$semester_commitment=$row['semester_commitment'];
	$other_programs=$row['other_programs'];

		echo "Before you apply, please confirm your profile information";

		echo "<tr><thead><th>First Name </th><td>$first_name</td></tr>";
		echo "<tr><th>Middle Name</th> <td>$middle_name</td></tr>";
		echo "<tr><th>Last Name</th> <td>$last_name</td></tr>";
		echo "<tr><th>Address</th> <td>$address</td></tr>";
		echo "<tr><th>City</th> <td>$city</td></tr>";
		echo "<tr><th>State</th> <td>$state</td></tr>";
		echo "<tr><th>Zip</th> <td>$zip_code</td></tr>";
		echo "<tr><th>Phone</th> <td>$phone</td></tr>";
		echo "<tr><th>Employment</th> <td>$employment</td></tr>";
		echo "<tr><th>Type of student</th> <td>$student_type</td></tr>";
		echo "<tr><th>Classification</th> <td>$classification</td></tr>";
		echo "<tr><th>degree type</th> <td>$degree_type</td></tr>";
		echo "<tr><th>Major</th> <td>$major</td></tr>";
		echo "<tr><th>2nd Major</th> <td>$major_2</td></tr>";
		echo "<tr><th>GPA</th> <td>$GPA</td></tr>";
		echo "<tr><th>Credit Hours Enrollment</th> <td>$credit_hours</td></tr>";
		echo "<tr><th>Have you worked at DMS before?</th> <td>$worked_at_dms</td></tr>";
		echo "<tr><th>Have you volunteered at Seton before?</th> <td>$volunteered_at_seton</td></tr>";
		echo "<tr><th>Do you own a car?</th> <td>$car</td></tr>";
		echo "<tr><th>Fluent in the following language(s):</th> <td>$bilingual</td></tr>";
		echo "<tr><th>How many semesters are you willing to commit?</th> <td>$semester_commitment</td></tr><br>";
		echo "<tr><th>DMS Programs you have already applied to:</th> <td>$other_programs</td></tr><br>";
	?>

			<table class="data-table">
			<br>
					<caption class="title">What is your availability for the upcoming semester?</caption>
					<thead>
						<tr>




			<!--create column names-->

				<th></th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>


				</tr>
					</thead>

					<tbody>




			<!--input checkboxes and row names-->
			<tr>
				<td>8:00am-8:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M8am" id="M8am" <?php if (in_array("M8am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T8am" id="T8am" <?php if (in_array("T8am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W8am" id="W8am" <?php if (in_array("W8am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH8am" id="TH8am" <?php if (in_array("TH8am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F8am" id="F8am" <?php if (in_array("F8am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>8:30am-9:00am</td>
				<td><input type="checkbox" name="availability_list[]" value="M8:30am" id="M8:30am" <?php if (in_array("M8:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T8:30am" id="T8:30am" <?php if (in_array("T8:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W8:30am" id="W8:30am" <?php if (in_array("W8:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH8:30am" id="TH8:30am" <?php if (in_array("TH8:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F8:30am" id="F8:30am" <?php if (in_array("F8:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>9:00am-9:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M9am" id="M9am" <?php if (in_array("M9am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T9am" id="T9am" <?php if (in_array("T9am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W9am" id="W9am" <?php if (in_array("W9am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH9am" id="TH9am" <?php if (in_array("TH9am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F9am" id="F9am" <?php if (in_array("F9am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>9:30am-10:00am</td>
				<td><input type="checkbox" name="availability_list[]" value="M9:30am" id="M9:30am" <?php if (in_array("M9:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T9:30am" id="T9:30am" <?php if (in_array("T9:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W9:30am" id="W9:30am" <?php if (in_array("W9:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH9:30am" id="TH9:30am" <?php if (in_array("TH9:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F9:30am" id="F9:30am" <?php if (in_array("F9:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>10am-10:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M10am" id="M10am" <?php if (in_array("M10am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T10am" id="T10am" <?php if (in_array("T10am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W10am" id="W10am" <?php if (in_array("W10am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH10am" id="TH10am" <?php if (in_array("TH10am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F10am" id="F10am" <?php if (in_array("F10am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>10:30am-11:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M10:30am" id="M10:30am" <?php if (in_array("M10:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T10:30am" id="T10:30am" <?php if (in_array("T10:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W10:30am" id="W10:30am" <?php if (in_array("W10:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH10:30am" id="TH10:30am" <?php if (in_array("TH10:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F10:30am" id="F10:30am" <?php if (in_array("F10:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>11:00am-11:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M11am" id="M11am" <?php if (in_array("M11am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T11am" id="T11am" <?php if (in_array("T11am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W11am" id="W11am" <?php if (in_array("W11am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH11am" id="TH11am" <?php if (in_array("TH11am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F11am" id="F11am" <?php if (in_array("F11am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>11:30pm-12:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M11:30am" id="M11:30am" <?php if (in_array("M11:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T11:30am" id="T11:30am" <?php if (in_array("T11:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W11:30am" id="W11:30am" <?php if (in_array("W11:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH11:30am" id="TH11:30am" <?php if (in_array("TH11:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F11:30am" id="F11:30am" <?php if (in_array("F11:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>12:00pm-12:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M12am" id="M12am" <?php if (in_array("M12am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T12am" id="T12am" <?php if (in_array("T12am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W12am" id="W12am" <?php if (in_array("W12am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH12am" id="TH12am" <?php if (in_array("TH12am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F12am" id="F12am" <?php if (in_array("F12am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>12:30pm-1:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M12:30pm" id="M12:30pm" <?php if (in_array("M12:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T12:30pm" id="T12:30pm" <?php if (in_array("T12:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W12:30pm" id="W12:30pm" <?php if (in_array("W12:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH12:30pm" id="TH12:30pm" <?php if (in_array("TH12:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F12:30pm" id="F12:30pm" <?php if (in_array("F12:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>1:00pm-1:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M1pm" id="M1pm" <?php if (in_array("M1pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="Tpm" id="T1pm" <?php if (in_array("T1pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W1pm" id="W1pm" <?php if (in_array("W1pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH1pm" id="TH1pm" <?php if (in_array("TH1pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F1pm" id="F1pm" <?php if (in_array("F1pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>1:30pm-2:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M1:30pm" id="M1:30pm" <?php if (in_array("M1:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T1:30pm" id="T1:30pm" <?php if (in_array("M1:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W1:30pm" id="W1:30pm" <?php if (in_array("M1:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH1:30pm" id="TH1:30pm" <?php if (in_array("M1:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F1:30pm" id="F1:30pm" <?php if (in_array("M1:30am",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>2:00pm-2:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M2pm" id="M2pm" <?php if (in_array("M2pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T2pm" id="T2pm" <?php if (in_array("T2pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W2pm" id="W2pm" <?php if (in_array("W2pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH2pm" id="TH2pm" <?php if (in_array("TH2pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F2pm" id="F2pm" <?php if (in_array("F2pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>2:30pm-3:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M2:30pm" id="M2:30pm" <?php if (in_array("M2:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T2:30pm" id="T2:30pm" <?php if (in_array("M2:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W2:30pm" id="W2:30pm" <?php if (in_array("M2:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH2:30pm" id="TH2:30pm" <?php if (in_array("M2:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F2:30pm" id="F2:30pm" <?php if (in_array("M2:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>3:00pm-3:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M3pm" id="M3pm" <?php if (in_array("M3pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T3pm" id="T3pm" <?php if (in_array("T3pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W3pm" id="W3pm" <?php if (in_array("W3pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH3pm" id="TH3pm" <?php if (in_array("TH3pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F3pm" id="F3pm" <?php if (in_array("F3pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>3:30pm-4:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M3:30pm" id="M3:30pm" <?php if (in_array("F3:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T3:30pm" id="T3:30pm" <?php if (in_array("F3:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W3:30pm" id="W3:30pm" <?php if (in_array("F3:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH3:30pm" id="TH3:30pm" <?php if (in_array("F3:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F3:30pm" id="F3:30pm" <?php if (in_array("F3:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>4:00pm-4:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M4pm" id="M4pm" <?php if (in_array("M4pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T4pm" id="T4pm"<?php if (in_array("T4pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W4pm" id="W4pm"<?php if (in_array("W4pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH4pm" id="TH4pm" <?php if (in_array("TH4pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F4pm" id="F4pm" <?php if (in_array("F4pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td>4:30pm-5:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M4:30pm" id="M4:30pm" <?php if (in_array("M4:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="T4:30pm" id="T4:30pm" <?php if (in_array("M4:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="W4:30pm" id="W4:30pm" <?php if (in_array("M4:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="TH4:30pm" id="TH4:30pm" <?php if (in_array("M4:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
				<td><input type="checkbox" name="availability_list[]" value="F4:30pm" id="F4:30pm" <?php if (in_array("M4:30pm",$availability_array))echo 'checked="checked"'?>disabled></td>
			</tr>

			<tr>
				<td><br></td>
			</tr>

			<tr>
				<td><input type="checkbox" name="availability_list[]" value="NA" <?php if (in_array("NA",$availability_array))echo 'checked="checked"'?>disabled> Unknown</td>
			</tr>


			</tbody>


		</table>






		<form action="STUDENT_edit_profile_information.php" method="get">

			<input type="submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" value="Edit"/>
		</form>

		<form action="STUDENT_select_program_apply.php" method="get">

			<input type="submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" value="Confirm"/>
		</form>
