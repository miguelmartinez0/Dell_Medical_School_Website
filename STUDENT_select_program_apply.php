<?php
//ALLOWS STUDENT TO CHOOSE WHICH APPLICATION THEY WILL APPLY TO
//ONLY CAN CHOOSE FROM OPEN AND NON-ARCHIVED APPLICATIONS TO APPLY TO
require "DMS_general_functions.php";
$role_id_array=array("5");
require "DMS_authenticate.php";
require "STUDENT_header.html";
?>
<?php


	//if an error is passed on redirect, display error message
	if (isset($_GET['error']))
	{
		//error message if student has already applied to the selected program
		if ($_GET['error']=="1")
		{
			echo '<script language="javascript">';
			echo 'alert("You have already applied to this program")';
			echo '</script>';
		}

		//error message if user is trying to resubmit their student info page and is redirected to the STUDENT_select_program_apply.php
		elseif($_GET['error']=="0")
		{
			echo '<script language="javascript">';
			echo 'alert("You have already submitted your Student Information. If you wish to edit your information, please click on the edit profile tab")';
			echo '</script>';

		}
	}


	//call function from DMS_general_functions to get a list of all applications
	$applications=get_all_applications_open();

	//get the user id that was passed through the url
	$user_id=$_SESSION['user_id'];

?>
  		<!-- Header -->
<div class="w3-container" style="margin-top:50px; font-familt:benton sans;" id="showcase">
	<h1 class="w3-jumbo">
		<b>Programs</b>
	</h1>

	<hr style="min-width:100%;border:5px solid #BF5700" align="left" class="w3-round">


	<br>
	<!--<b>Select which program you would like to apply to. </b>
	<hr />-->

	<small>**Students are allowed to submit up to a maximum of 2 different applications per semester and will be automatically disqualified by submitting more than 2 applications.</small>
	</div>
	<div class="w3-container" id="application" style="margin-top:10px">
	<body>

<!--Calls on the function to display all applications -->
	<form name="apply_form" action = "STUDENT_dynamic_application.php" method= "post">

	<br><br>

				<?php
				//Displays every application as a checkbox for the student to choose from
					foreach($applications as $application)
					{
						if ($application['application_closed']==0)
						{
							//call function from DMS_general_functions to get the name of the program associated with each applications
							$name_of_program = get_program($application['program_id']);

							//Displays the actual name of the application
							echo "<input type='radio' name='application_id' value=$application[application_id] required><b>$name_of_program</b><br>";
						}
					}
				?>


<!--Selects the application that the doctor has seleceted -->
<td colspan="1" style="text-align: center; float: center;"><input type="submit" value="Select Program" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" name="submit"/> </td>
</body>
