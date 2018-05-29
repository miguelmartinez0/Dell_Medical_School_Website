<?php
//FORM FOR ADMIN TO CHANGE THE PASSWORD OF ANY USER
//ADMIN MUST ENTER EID AND THEN ENTER THE NEW PASSWORD TWICE
//WILL POST DATA TO DMS_change_password_connect.php
	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
?>

<?php
	if (isset($_GET['message']))
	{
		if ($_GET['message']=="0"){
			echo '<script language="javascript">';
			echo 'alert("Error: The user does not exist in the database")';
			echo '</script>';
		}
		elseif ($_GET['message']=="1"){
			echo '<script language="javascript">';
			echo 'alert("Error: The passwords do not match")';
			echo '</script>';
		}
		elseif ($_GET['message']=="2"){
			echo '<script language="javascript">';
			echo 'alert("The password was successfully changed")';
			echo '</script>';
		}
	}
?>
				<!-- Header -->
				<div class="w3-container" style="margin-top:40px" id="showcase">
					<h1 class="w3-jumbo">
						<b>Change User Password</b>
					</h1>

					<hr style="width:100%;border:5px solid #BF5700" align="left" class="w3-round">
				</div>



				<div class="w3-container" id="application" style="margin-top:10px"></div>


					<body>
						<form name="change_password_form" action = "DMS_change_password_connect.php" method= "post">
							<tr>
								<td><p>EID</p></td>
							</tr>
							<tr>
								<td><input type="text" name="id" required></td>
							</tr>


							<!--text box for students middle name-->
						<tr>
							<td>New Password</td>
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

							<td><input type='submit' value='Change Password' style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" onclick="return confirm('Are you sure you want to change this user's role?')"></td>
						</form>
