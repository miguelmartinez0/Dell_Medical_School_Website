<?php
//STUDENT CAN EDIT THEIR INFORMATION ON student_info TABLE
//THIS DISPLAYS CURRENT INFO AN ALLOWS STUDENT TO CHANGE IT
//EXECUTED THROUGH STUDENT_edit_profile_information_connect
	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";
	require "DMS_db.php";
	require "STUDENT_header.html";
	$user_id=$_SESSION['user_id'];


		/*
		$statement = $dbc->prepare("SELECT * FROM student_info WHERE user_id = :user_id");
		$statement->execute(array(':user_id' => $user_id));
		$row = $statement->fetch(); */

		$stmt = $dbc->query("SELECT * FROM student_info WHERE user_id = '".$user_id."'");
		$row = $stmt->fetch();

		$availability_array=explode(',',$row['availability'])



?>
<link type="text/css" rel="stylesheet" href="DMS_Stylesheet.css" media="all" />
<table class='data-table'>

  <!-- Header -->
<div class="w3-container" style="margin-top:40px" id="showcase">
	<h1 class="w3-jumbo">
		<b>Edit Profile Information</b>
	</h1>


	<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
	<br>
	<b>Edit any information you would like to link to all applications.</b>
	<br>
	<br>
</div>

<div class="w3-container" id="application" style="margin-top:10px">

<body>

		<head>
			<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
		</head>

        <form action="STUDENT_edit_profile_information_connect.php" method="post">


            First Name
            <input type="text" name="first_name" value="<?php echo $row ['first_name']; ?> " size=10>
            Middle Name
            <input type="text" name="middle_name" value="<?php echo $row ['middle_name']; ?> " size=10>
            Last Name
            <input type="text" name="last_name" value="<?php echo $row ['last_name']; ?>" size=17>
			Street Address
            <input type="text" name="address" value="<?php echo $row ['address']; ?> " size=10>
			City
            <input type="text" name="city" value="<?php echo $row ['city']; ?> " size=10>

			State
					<select name="state" required>
					<option value="AL" <?php if($row['state'] == "AL") echo 'selected="selected"'?>>Alabama</option>
					<option value="AK" <?php if($row['state'] == "AK") echo 'selected="selected"'?>>Alaska</option>
					<option value="AZ"<?php if($row['state'] == "AZ") echo 'selected="selected"'?>>Arizona</option>
					<option value="AR"<?php if($row['state'] == "AR") echo 'selected="selected"'?>>Arkansas</option>
					<option value="CA"<?php if($row['state'] == "CA") echo 'selected="selected"'?>>California</option>
					<option value="CO"<?php if($row['state'] == "CO") echo 'selected="selected"'?>>Colorado</option>
					<option value="CT"<?php if($row['state'] == "CT") echo 'selected="selected"'?>>Connecticut</option>
					<option value="DE"<?php if($row['state'] == "DE") echo 'selected="selected"'?>>Delaware</option>
					<option value="DC"<?php if($row['state'] == "DC") echo 'selected="selected"'?>>District Of Columbia</option>
					<option value="FL"<?php if($row['state'] == "FL") echo 'selected="selected"'?>>Florida</option>
					<option value="GA"<?php if($row['state'] == "GA") echo 'selected="selected"'?>>Georgia</option>
					<option value="HI"<?php if($row['state'] == "HI") echo 'selected="selected"'?>>Hawaii</option>
					<option value="ID"<?php if($row['state'] == "ID") echo 'selected="selected"'?>>Idaho</option>
					<option value="IL"<?php if($row['state'] == "IL") echo 'selected="selected"'?>>Illinois</option>
					<option value="IN"<?php if($row['state'] == "IN") echo 'selected="selected"'?>>Indiana</option>
					<option value="IA"<?php if($row['state'] == "IA") echo 'selected="selected"'?>>Iowa</option>
					<option value="KS"<?php if($row['state'] == "KS") echo 'selected="selected"'?>>Kansas</option>
					<option value="KY"<?php if($row['state'] == "KY") echo 'selected="selected"'?>>Kentucky</option>
					<option value="LA"<?php if($row['state'] == "LA") echo 'selected="selected"'?>>Louisiana</option>
					<option value="ME"<?php if($row['state'] == "ME") echo 'selected="selected"'?>>Maine</option>
					<option value="MD"<?php if($row['state'] == "MD") echo 'selected="selected"'?>>Maryland</option>
					<option value="MA"<?php if($row['state'] == "MA") echo 'selected="selected"'?>>Massachusetts</option>
					<option value="MI"<?php if($row['state'] == "MI") echo 'selected="selected"'?>>Michigan</option>
					<option value="MN"<?php if($row['state'] == "MN") echo 'selected="selected"'?>>Minnesota</option>
					<option value="MS"<?php if($row['state'] == "MS") echo 'selected="selected"'?>>Mississippi</option>
					<option value="MO"<?php if($row['state'] == "MO") echo 'selected="selected"'?>>Missouri</option>
					<option value="MT"<?php if($row['state'] == "MT") echo 'selected="selected"'?>>Montana</option>
					<option value="NE"<?php if($row['state'] == "NE") echo 'selected="selected"'?>>Nebraska</option>
					<option value="NV"<?php if($row['state'] == "NV") echo 'selected="selected"'?>>Nevada</option>
					<option value="NH"<?php if($row['state'] == "NH") echo 'selected="selected"'?>>New Hampshire</option>
					<option value="NJ"<?php if($row['state'] == "NJ") echo 'selected="selected"'?>>New Jersey</option>
					<option value="NM"<?php if($row['state'] == "NM") echo 'selected="selected"'?>>New Mexico</option>
					<option value="NY"<?php if($row['state'] == "NY") echo 'selected="selected"'?>>New York</option>
					<option value="NC"<?php if($row['state'] == "NC") echo 'selected="selected"'?>>North Carolina</option>
					<option value="ND"<?php if($row['state'] == "ND") echo 'selected="selected"'?>>North Dakota</option>
					<option value="OH"<?php if($row['state'] == "OH") echo 'selected="selected"'?>>Ohio</option>
					<option value="OK"<?php if($row['state'] == "OK") echo 'selected="selected"'?>>Oklahoma</option>
					<option value="OR"<?php if($row['state'] == "OR") echo 'selected="selected"'?>>Oregon</option>
					<option value="PA"<?php if($row['state'] == "PA") echo 'selected="selected"'?>>Pennsylvania</option>
					<option value="RI"<?php if($row['state'] == "RI") echo 'selected="selected"'?>>Rhode Island</option>
					<option value="SC"<?php if($row['state'] == "SC") echo 'selected="selected"'?>>South Carolina</option>
					<option value="SD"<?php if($row['state'] == "SD") echo 'selected="selected"'?>>South Dakota</option>
					<option value="TN"<?php if($row['state'] == "TN") echo 'selected="selected"'?>>Tennessee</option>
					<option value="TX"<?php if($row['state'] == "TX") echo 'selected="selected"'?>>Texas</option>
					<option value="UT"<?php if($row['state'] == "UT") echo 'selected="selected"'?>>Utah</option>
					<option value="VT"<?php if($row['state'] == "VT") echo 'selected="selected"'?>>Vermont</option>
					<option value="VA"<?php if($row['state'] == "VA") echo 'selected="selected"'?>>Virginia</option>
					<option value="WA"<?php if($row['state'] == "WA") echo 'selected="selected"'?>>Washington</option>
					<option value="WV"<?php if($row['state'] == "WV") echo 'selected="selected"'?>>West Virginia</option>
					<option value="WI"<?php if($row['state'] == "WI") echo 'selected="selected"'?>>Wisconsin</option>
					<option value="WY"<?php if($row['state'] == "WY") echo 'selected="selected"'?>>Wyoming</option>
				</select>


			Zip Code
            <input type="text" name="zip_code" value="<?php echo $row ['zip_code']; ?> " size=10>
			Phone Number
            <input type="text" name="phone" value="<?php echo $row ['phone']; ?> " size=10>
			Email
            <input type="text" name="email" value="<?php echo $row ['email']; ?> " size=10 >
			<!--radio buttons for if student is eligible to work in US/employed at UT-->

			Are you: <br><br>
			<input type="radio" name="employment" value="UT" <?php if($row['employment'] == "UT") echo 'checked="checked"'?> required>Currently employed at UT<br>
			<input type="radio" name="employment" value="eligible"<?php if($row['employment'] == "eligible") echo 'checked="checked"'?>>Eligible to work in the US with no restrictions<br>
			<input type="radio" name="employment" value="none"<?php if($row['employment'] == "none") echo 'checked="checked"'?>>None of the above<br>




			<br>
			<!--Radio buttons for student's classification-->
			What is your classification?
			<br><br>
			<input type="radio" name="classification" value="1st year" <?php if($row['classification'] == "1st year") echo 'checked="checked"'?> required>1st year<br>
			<input type="radio" name="classification" value="2nd year" <?php if($row['classification'] == "2nd year") echo 'checked="checked"'?>>2nd year<br>
			<input type="radio" name="classification" value="3rd year" <?php if($row['classification'] == "3rd year") echo 'checked="checked"'?>>3rd year<br>
			<input type="radio" name="classification" value="4th year" <?php if($row['classification'] == "4th year") echo 'checked="checked"'?>>4th year<br>
			<input type="radio" name="classification" value="5th year" <?php if($row['classification'] == "5th year") echo 'checked="checked"'?>>5th year<br>

			<br>
			What type of student are you?
			<br><br>
			<input type="radio" name="student_type" value="Undergraduate" <?php if($row['student_type'] == "Undergraduate") echo 'checked="checked"'?> required>Undergraduate<br>
			<input type="radio" name="student_type" value="Graduate" <?php if($row['student_type'] == "Graduate") echo 'checked="checked"'?>>Graduate<br>
			<input type="radio" name="student_type" value="PhD" <?php if($row['student_type'] == "PhD") echo 'checked="checked"'?>>PhD<br>
			<input type="radio" name="student_type" value="Other" <?php if($row['student_type'] == "Other") echo 'checked="checked"'?>>Other<br>




			Degree Type
            <input type="text" name="degree_type" value="<?php echo $row ['degree_type']; ?> " size=10>
			Major
            <input type="text" name="major" value="<?php echo $row ['major']; ?> " size=10>
			Second Major
            <input type="text" name="major_2" value="<?php echo $row ['major_2']; ?> " size=10>
			GPA
            <input type="text" name="GPA" value="<?php echo $row ['GPA']; ?> " size=10>
			Credit Hours Enrollment
            <input type="text" name="credit_hours" value="<?php echo $row ['credit_hours']; ?> " size=10>

			Have you previously worked at Dell Medical School?
			<br><br>
			<input type="radio" name="worked_at_dms" value="1" required <?php if($row['worked_at_dms'] == 1) echo 'checked="checked"'?>>Yes<br>
			<input type="radio" name="worked_at_dms" value="0" <?php if($row['worked_at_dms'] == 0) echo 'checked="checked"'?>>No<br>

			Have you previously volunteered at Seton Hospital?
			<br><br>
			<input type="radio" name="volunteered_at_seton" value="1" required <?php if($row['volunteered_at_seton'] == 1) echo 'checked="checked"'?>>Yes<br>
			<input type="radio" name="volunteered_at_seton" value="0" <?php if($row['volunteered_at_seton'] == 0) echo 'checked="checked"'?>>No<br>

			Do you own a car?
			<br><br>
			<input type="radio" name="car" value="1" required <?php if($row['car'] == 1) echo 'checked="checked"'?>>Yes<br>
			<input type="radio" name="car" value="0" <?php if($row['car'] == 0) echo 'checked="checked"'?>>No<br>

			Language(s)
            <input type="text" name="bilingual" value="<?php echo $row ['bilingual']; ?> " size=10>

			Semester Commitment
            <input type="text" name="semester_commitment" value="<?php echo $row ['semester_commitment']; ?> " size=10>

			DMS Program(s) already applied to
			<input type="text" name="other_programs" value= "<?php echo $row ['other_programs']; ?> " size=10>






			<table class="data-table">
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
				<td><input type="checkbox" name="availability_list[]" value="M8am" id="M8am" <?php if (in_array("M8am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T8am" id="T8am" <?php if (in_array("T8am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W8am" id="W8am" <?php if (in_array("W8am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH8am" id="TH8am" <?php if (in_array("TH8am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F8am" id="F8am" <?php if (in_array("F8am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>8:30am-9:00am</td>
				<td><input type="checkbox" name="availability_list[]" value="M8:30am" id="M8:30am" <?php if (in_array("M8:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T8:30am" id="T8:30am" <?php if (in_array("T8:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W8:30am" id="W8:30am" <?php if (in_array("W8:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH8:30am" id="TH8:30am" <?php if (in_array("TH8:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F8:30am" id="F8:30am" <?php if (in_array("F8:30pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>9:00am-9:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M9am" id="M9am" <?php if (in_array("M9am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T9am" id="T9am" <?php if (in_array("T9am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W9am" id="W9am" <?php if (in_array("W9am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH9am" id="TH9am" <?php if (in_array("TH9am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F9am" id="F9am" <?php if (in_array("F9am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>9:30am-10:00am</td>
				<td><input type="checkbox" name="availability_list[]" value="M9:30am" id="M9:30am" <?php if (in_array("M9:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T9:30am" id="T9:30am" <?php if (in_array("T9:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W9:30am" id="W9:30am" <?php if (in_array("W9:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH9:30am" id="TH9:30am" <?php if (in_array("TH9:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F9:30am" id="F9:30am" <?php if (in_array("F9:30am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>10am-10:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M10am" id="M10am" <?php if (in_array("M10am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T10am" id="T10am" <?php if (in_array("T10am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W10am" id="W10am" <?php if (in_array("W10am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH10am" id="TH10am" <?php if (in_array("TH10am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F10am" id="F10am" <?php if (in_array("F10am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>10:30am-11:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M10:30am" id="M10:30am" <?php if (in_array("M10:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T10:30am" id="T10:30am" <?php if (in_array("T10:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W10:30am" id="W10:30am" <?php if (in_array("W10:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH10:30am" id="TH10:30am" <?php if (in_array("TH10:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F10:30am" id="F10:30am" <?php if (in_array("F10:30am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>11:00am-11:30am</td>
				<td><input type="checkbox" name="availability_list[]" value="M11am" id="M11am" <?php if (in_array("M11am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T11am" id="T11am" <?php if (in_array("T11am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W11am" id="W11am" <?php if (in_array("W11am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH11am" id="TH11am" <?php if (in_array("TH11am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F11am" id="F11am" <?php if (in_array("F11am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>11:30pm-12:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M11:30am" id="M11:30am" <?php if (in_array("M11:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T11:30am" id="T11:30am" <?php if (in_array("T11:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W11:30am" id="W11:30am" <?php if (in_array("W11:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH11:30am" id="TH11:30am" <?php if (in_array("TH11:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F11:30am" id="F11:30am" <?php if (in_array("F11:30am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>12:00pm-12:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M12am" id="M12am" <?php if (in_array("M12am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T12am" id="T12am" <?php if (in_array("T12am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W12am" id="W12am" <?php if (in_array("W12am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH12am" id="TH12am" <?php if (in_array("TH12am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F12am" id="F12am" <?php if (in_array("F12am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>12:30pm-1:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M12:30pm" id="M12:30pm" <?php if (in_array("M12:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T12:30pm" id="T12:30pm" <?php if (in_array("T12:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W12:30pm" id="W12:30pm" <?php if (in_array("W12:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH12:30pm" id="TH12:30pm" <?php if (in_array("TH12:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F12:30pm" id="F12:30pm" <?php if (in_array("F12:30pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>1:00pm-1:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M1pm" id="M1pm" <?php if (in_array("M1pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="Tpm" id="T1pm" <?php if (in_array("T1pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W1pm" id="W1pm" <?php if (in_array("W1pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH1pm" id="TH1pm" <?php if (in_array("TH1pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F1pm" id="F1pm" <?php if (in_array("F1pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>1:30pm-2:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M1:30pm" id="M1:30pm" <?php if (in_array("M1:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T1:30pm" id="T1:30pm" <?php if (in_array("T1:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W1:30pm" id="W1:30pm" <?php if (in_array("W1:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH1:30pm" id="TH1:30pm" <?php if (in_array("TH1:30am",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F1:30pm" id="F1:30pm" <?php if (in_array("F1:30am",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>2:00pm-2:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M2pm" id="M2pm" <?php if (in_array("M2pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T2pm" id="T2pm" <?php if (in_array("T2pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W2pm" id="W2pm" <?php if (in_array("W2pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH2pm" id="TH2pm" <?php if (in_array("TH2pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F2pm" id="F2pm" <?php if (in_array("F2pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>2:30pm-3:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M2:30pm" id="M2:30pm" <?php if (in_array("M2:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T2:30pm" id="T2:30pm" <?php if (in_array("T2:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W2:30pm" id="W2:30pm" <?php if (in_array("W2:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH2:30pm" id="TH2:30pm" <?php if (in_array("TH2:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F2:30pm" id="F2:30pm" <?php if (in_array("F2:30pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>3:00pm-3:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M3pm" id="M3pm" <?php if (in_array("M3pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T3pm" id="T3pm" <?php if (in_array("T3pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W3pm" id="W3pm" <?php if (in_array("W3pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH3pm" id="TH3pm" <?php if (in_array("TH3pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F3pm" id="F3pm" <?php if (in_array("F3pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>3:30pm-4:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M3:30pm" id="M3:30pm" <?php if (in_array("M3:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T3:30pm" id="T3:30pm" <?php if (in_array("T3:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W3:30pm" id="W3:30pm" <?php if (in_array("W3:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH3:30pm" id="TH3:30pm" <?php if (in_array("TH3:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F3:30pm" id="F3:30pm" <?php if (in_array("F3:30pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>4:00pm-4:30pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M4pm" id="M4pm" <?php if (in_array("M4pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T4pm" id="T4pm"<?php if (in_array("T4pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W4pm" id="W4pm"<?php if (in_array("W4pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH4pm" id="TH4pm" <?php if (in_array("TH4pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F4pm" id="F4pm" <?php if (in_array("F4pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>

			<tr>
				<td>4:30pm-5:00pm</td>
				<td><input type="checkbox" name="availability_list[]" value="M4:30pm" id="M4:30pm" <?php if (in_array("M4:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="T4:30pm" id="T4:30pm" <?php if (in_array("T4:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="W4:30pm" id="W4:30pm" <?php if (in_array("W4:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="TH4:30pm" id="TH4:30pm" <?php if (in_array("TH4:30pm",$availability_array))echo 'checked="checked"'?>></td>
				<td><input type="checkbox" name="availability_list[]" value="F4:30pm" id="F4:30pm" <?php if (in_array("F4:30pm",$availability_array))echo 'checked="checked"'?>></td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td><input type="checkbox" name="availability_list[]" value="NA" <?php if (in_array("NA",$availability_array))echo 'checked="checked"'?>> Unknown</td>
			</tr>

		</tbody>

		</table>

			<br>


		<!--submit button. Will post info.-->
		<td colspan="1" style="text-align: center; float: center;"><input type="submit" name="submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" value="Update Profile Information"> </td>


		<!--break-->
		<p><br></p>


	</form>


	<!--JQuery used to ensure at least one checkbox is checked off for availability-->

	<script>

		//function will remove required tags from checkboxes as long as at least one box is checked off
		$(function(){

			var requiredCheckboxes = $(':checkbox[required]');

			requiredCheckboxes.change(function(){

				if(requiredCheckboxes.is(':checked')) {
					requiredCheckboxes.removeAttr('required');
				}

				else {
					requiredCheckboxes.attr('required', 'required');
				}
			});

		});

	</script>
</body>
</div>

</html>


        </form>

        </p>
    </body>
</html>
