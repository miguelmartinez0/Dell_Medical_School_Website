<?php
//FORM TO ALLOW ADMIN TO CREATE A NEW PROFILE FOR ANY Role
//THIS IS THE ONLY WAY THAT A PROFILE CAN BE CREATED THAT ISNT STUDENT ROLE (ROLE 5)
//THIS DATA IS POSTED TO STUDENT_create_profile_functionality TO PUT THE DATA IN THE DATABASE
require 'DMS_general_functions.php';
$role_id_array=array("1");
require "DMS_authenticate.php";
$user_id = $_SESSION['user_id'];
require "admin_header.html";
?>

				<!-- Header -->
				<div class="w3-container" style="margin-top:40px" id="showcase">
					<h1 class="w3-jumbo">
						<b>Roles Table</b>
					</h1>

					<hr style="width:100%;border:5px solid #BF5700" align="left" class="w3-round">
				</div>



				<div class="w3-container" id="application" style="margin-top:10px"></div>


					<body>
					
					
<?php
	if(isset($_GET['error']))
	{
		if ($_GET['error']=="1")
		{
			echo "<font color=#ff0000;>*The passwords you entered do not match</font>";
		}
		elseif ($_GET['error']=="2")
		{
			echo "<font color=#ff0000;>*This user already exists in our system</font>";
		}
	}
?>

						<form name="apply_form" action = "STUDENT_create_profile_functionality.php" method= "post">
							<tr>
								<td><p>EID</p></td>
							</tr>
							<tr>
								<td><input type="text" name="username" required></td>
							</tr>

							<!--text box for students middle name-->
							<tr>
								<td>Password</td>
							</tr>
							<tr>
								<td><input type="text" name="password" size="20" maxlength="30" required/></td>
							</tr>

							<!--text box for students middle name-->
							<tr>
								<td>Re-enter Password</td>
							</tr>
							<tr>
								<td><input type="text" name="password_2" size="20" maxlength="30" required/></td>
							</tr>

							<!--get all role names to populate dropdown-->
							<?php
							//dms_general_functions line 101)
							$roles= get_all_roles()
							?>

							<!--specify program application is for & # of unique questions -->
							<tr>
								<td><p>Role</p></td>
							</tr>
							<tr>
								<td>
									<select name="role_id" required>
										<?php foreach($roles as $role): ?>
											<option value="<?= $role['role_id']; ?>"><?= $role['role_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>

			<!--submit button. Will post info.-->
			<td colspan="1" style="text-align: center; float: center;"><input type="submit" value="Submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"/> </td>



						</form>
			</body>
