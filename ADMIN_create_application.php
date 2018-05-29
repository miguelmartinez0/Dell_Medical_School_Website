<?php
//ADMIN USES THIS FORM TO CREATE A NEW Application WHICH IS CONNECTED TO AN ALREADY CREATED PROGRAM THROUGH A FOREIGN KEY
//POSTS TO ADMIN_create_application_functionality
	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
?>
<?php
	//this will display an error message if the user tries to create an application that already exists in the database
	if (isset($_GET['error']))
	{
		echo '<script language="javascript">';
		echo 'alert("The application already exists")';
		echo '</script>';
	}
?>
			<!-- Header -->
			<div class="w3-container" style="margin-top:40px" id="showcase">
				<h1 class="w3-jumbo">
					<b>Create a New Application</b>
				</h1>

				<!-- Instructions to create new program -->
				<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
				<br>
				<b>Please enter the following application information: </b>
				<br>
				<br>
			</div>


			<div class="w3-container" id="application">

				<body>
					<!--this form will post to DMS_connect in order to submit data to DB-->
					<form name="apply_form" action = "ADMIN_create_application_functionality.php" method= "post">

						<table>

							<!--get all program names to populate dropdown-->
							<?php
							//dms general functions(line 18)
							$programs= get_all_programs()
							?>
							<!--specify program application is for & # of unique questions -->
							<tr>
								<td>Program Name</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							</tr>
							<tr>
								<td>
									<select name="program_id" required>
										<?php foreach($programs as $program): ?>
											<option value="<?= $program['program_id']; ?>"><?= $program['name_of_program']; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>

							<!-- specify term and year for application -->
							<tr>
								<td>Application Term</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							</tr>
							<tr>
								<td>
									<select name="term" required>
										<option value="Fall">Fall</option>
										<option value="Spring">Spring</option>
										<option value="Summer">Summer</option>
										<option value="All_Year">All Year</option>
										<option value="School_Year">School Year</option>
									</select>
								</td>
							</tr>

							<tr>
								<td>Application Year</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							</tr>
							<tr>
								<td>
									<input type="text" placeholder="ex: 2017" name="year" maxlength="4" pattern="^[0-9]*$" required/>
								</td>
							</tr>

								<!--text box for number of questions to create-->
								<tr>
									<td>Enter the number of custom application questions</td>
								</tr>
								<tr class="blankrow">
									<td><br></td>
								</tr>
								<tr>
									<td><input type="text" name="number_unique_questions" id="number_unique_questions" size="20" maxlength="2" pattern="^[0-9]+$" required/></td>

								</tr>

							</table>

							<table id="unique_questions_table">

							</table>
							</tr>


							<tr>
								<td><br><td>
							</tr>
							<td><br><b>Please enter the following position information: </b></br><td>
							<tr>
								<td><br><td>
							</tr>

							<!--drop-down menu for postion_type-->
							<tr>
								<td>Position Type</td>
							</tr>
							<tr>
								<td><br><td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<!--populates the drop-down menu with different opttions-->
							<tr>
								<td><select name="position_type" required>
									<option value="Paid">Paid</option>
									<option value="Non-Paid">Non-Paid</option>
								</select></td>
							</tr>

							<!--text box for first name-->
							<tr class="blankrow">
								<td><br></td>
							<tr>
								<td>Position Title</td>
							</tr>
							<tr>
								<td><br><td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="position_title" size="20" maxlength="30" required/></td>
							</tr>


							<!--text box for first name-->
							<tr class="blankrow">
								<td><br></td>
							<tr>
								<td>Supervisor's First Name</td>
							</tr>
							<tr>
								<td><br><td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="supervisor_first_name" size="20" maxlength="30" required/></td>
							</tr>

							<!--text box for middle name-->
							<tr>
								<td>Supervisor's Middle Name (if applicable)</td>
							</tr>
							<tr>
								<td><br><td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="supervisor_middle_name" size="20" maxlength="30"/></td>
							</tr>

							<!--text box for last name-->
							<tr>
								<td>Supervisor's Last Name</td>
							</tr>
							<tr>
								<td><br><td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="supervisor_last_name" size="20" maxlength="30" required/></td>
							</tr>

							<!--text box for eid
							<tr>
								<td>Program Administrator EID</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="doctor_EID" size="20" maxlength="10" required/></td>
							</tr>-->

							<!--drop-down menu for assignment_length-->
							<tr>
								<td>Assignment Length</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<!--populates the drop-down menu with different opttions-->
							<tr>
								<td><select name="assignment_length" required>
									<option value="Semester">Semester</option>
									<option value="Summer">Summer</option>
									<option value="School">School Year</option>
									<option value="Other">Other</option>
								</select></td>
							</tr>

							<!--text boxes for dates-->
							<tr>
								<td>Start Date:</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="date" name="start_date" placeholder="mm/dd/yyyy" size="20" maxlength="30" required/></td>
							</tr>
							<!--text boxes for dates-->
							<tr>
								<td>End Date:</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="date" name="end_date" placeholder="mm/dd/yyyy" size="20" maxlength="30" required pattern="^\d{2}/\d{2}/\d{4}$"/></td>
							</tr>


							<!--drop-down menu to specify if the postions is renewable-->
							<tr>
								<td>Renewable position:</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><select name="renew" required>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select></td>
							</tr>


							<!--drop-down menu to specify the classification for which students need to be-->
							<tr>
								<td>Student Type:</td>
							<tr>
								<tr class="blankrow">
									<td><br></td>
								<tr>
							<tr>
								<td><select name="student_type" required>
									<option value="undergrad">Undergraduate</option>
									<option value="graduate">Graduate</option>
									<option value="other">Other</option>
								</select></td>
							</tr>

							<!--text box for IT Equipment-->
							<tr>
								<td>IT Equipment:</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="it_equipment" size="20" maxlength="30" required/></td>
							</tr>

							<!--text box for Work Location-->
							<tr>
								<td>Specify the Student's Work Location:</td>
							</tr>
							<tr>
								<td>(For students working remotely, specify the supervisor's work location.)</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="work_location" placeholder="ex. station #, seat #" size="20" maxlength="30" required/></td>
							</tr>

							<!--text box for Hours Per Week-->
							<tr>
								<td>Maximum expected Hours Per Week:</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="hours_per_week" placeholder="ex. 20" size="20" maxlength="30" pattern="[0-9]+(\.[0-9][0-9]?)?" required/></td>
							</tr>

							<!--text box for hourly rate-->
							<tr>
								<td>Maximum expected Hourly Rate:</td>
							</tr>
							<tr class="blankrow">
								<td><br></td>
							<tr>
							<tr>
								<td><input type="text" name="hourly_rate" placeholder="ex. 10" size="20" maxlength="30" pattern="[0-9]+(\.[0-9][0-9]?)?" required/></td>
							</tr>

						<!--submit button. Will post info.-->
						<td colspan="1" style="text-align: center; float: center;"><input type="submit" value="Submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" name="submit"/> </td>

					<script>

						$("#number_unique_questions").keyup(function(){
							var question_number = $("#number_unique_questions").val();

							$("#unique_questions_table").empty();
							$("#unique_questions_table").prepend("Enter the unique questions below");
							while (question_number>0){

								var text = $("<tr></tr>").html("<td><input type='text' name='list_unique_questions[]' id='unique_question' required/></td>");
								$("#unique_questions_table").append(text);

								question_number-=1;
							}

						});
					</script>
				</body>
</html>
