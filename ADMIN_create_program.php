<?php
//FORM TO ALLOW USER TO CREATE A NEW PROGRAM
//INFO POSTED TO ADMIN_create_program_functionality TO ADD IT TO THE DATABASE
	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
?>
				<!-- Header -->
				<div class="w3-container" id="showcase">
					<h1 class="w3-jumbo">
						<b>Create a New Program</b>
					</h1>

					<!-- Secondary Text -->
					<hr style="align:left;width:800px;border:5px solid #BF5700" align="left" class="w3-round">
					<br>
					<b>Please enter the name of the program and the following information: </b>
					<br>
					<br>
				</div>

				<div class="w3-container" id="application">

					<body>
						<form name="apply_form" action = "ADMIN_create_program_functionality.php" method= "post">

							<table>

								<!--text box for name of program-->
								<!--This will become the name of the program's application table?-->
								<tr>
									<td><p>Name of Program</p></td>
								</tr>
								<tr>
									<td><input type="text" name="name_of_program" size="64" pattern="^([a-zA-Z0-9_\s\-]*)$" required/></td>
								</tr>

								<!--text box for program description-->
								<tr>
									<td><p>Program Description (if applicable)</p></td>
								</tr>
								<tr class="blankrow">
									<td><br></td>
								<tr>
								<tr>
									<td><input type="text" name="program_description" size="40"
								</tr>
							</table>

								<!--submit button. Will post info.-->
								<td colspan="1"> <input type="submit" value="Submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" name="submit"/> </td>
					</body>
</html>
