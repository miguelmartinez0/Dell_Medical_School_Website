<?php
//WHEN THE DOCTOR CHANGED THE REVIEW STATUS OF A USER FROM COMPETITIVE, NONCOMPETITIVE, N/A- THIS EXECUTED ON THE GIVEN LIST OF STUDENTS
//THIS INFORMATION COMES FROM DOCTOR_DASHBOARD
require "DMS_general_functions.php";
$role_id_array=array("2","4");
require "DMS_authenticate.php";
$user_id = $_SESSION['user_id'];


//require file containing db string
require 'DMS_db.php';

	if (isset($_POST['save']))
	{
  	  # Save-button was clicked
		$review= $_POST['application_review_list'];
		
		foreach($review as $value)
		{
			require 'DMS_db.php';

			$sql="UPDATE review SET $value AND application_id=".$_POST['application_id'];
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
		
		}
	}
	
	if(isset($_POST['save_potential']))
	{
		require 'DMS_db.php';
		$review= $_POST['potential_approve_array'];
		$select_application=$_POST['application_id'];
		
		foreach($review as $value)
		{
			$sql="UPDATE review SET approved=1 WHERE user_id= '$value' AND application_id=$select_application";
			
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
		}
		
		header("Location: DOCTOR_potential_student_table.php?select_application=$select_application");
		die();
	}
	/* elseif (isset($_POST['accept']))
	{
		# Accept-button was clicked
		$accept= $_POST['application_accept_list'];
		$accept_list=implode(',',$accept);
	
		//check if student is already accepted in the database
		$stmt = $dbc->query("SELECT * FROM student_info WHERE accepted_by_dms= '1' AND user_id IN ($accept_list)");
		$x = $stmt->fetch();

		//if the student is already accepted, redirect back to the DOCTOR_dashboard.php page along with an indication that there was an error
		if (count($x['user_id'])>0)
		{
			$select_application_id=$_POST['select_application'];
			header("Location: DOCTOR_dashboard.php?error='1'&select_application=$select_application_id");
			die();
		}
		foreach($accept as $value)
		{
			require 'DMS_db.php';

			$sql="UPDATE student_info SET accepted_by_dms = 1 WHERE user_id= $value";
			echo $sql;
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
		}
	} */
	//error handling
	if (!$stmt)
	{
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	else
	{
		$select_application_id=$_POST['select_application'];
		header("Location: DOCTOR_dashboard.php?select_application=$select_application_id");
		die();
	}
?>
