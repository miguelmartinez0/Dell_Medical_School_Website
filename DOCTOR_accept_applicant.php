<?php
//THIS FILE TAKES INPUT AS THE ID OF STUDENTS INDICATED TO BE ACCEPTED AND CHANGES 
//THEIR STATUS TO ACCEPTED
require 'DMS_general_functions.php';
$role_id_array=array("2","4");
	require "DMS_authenticate.php";
require 'DMS_db.php';


//if the user_id is set, get all student info
if( isset($_GET['id']))
{
	$user_id = $_GET['id'];
	
	$sql = "SELECT * from student_info WHERE user_id='$user_id'";
	
	$query= $dbc->query($sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	
	$row = $query->fetch(PDO::FETCH_ASSOC);
	
	
}


if( isset($_POST['new_accepted_by_DMS']))
{	//update the accepted student's status to "accepted"
	
	$new_accepted_by_DMS = $_POST['new_accepted_by_DMS'];
	$user_id = $_POST['user_id'];
	$application_id = $_POST['application_id'];
	
	//$sql = "UPDATE review SET accepted_by_dms = '".$new_accepted_by_DMS."' WHERE user_id ='".$user_id."' AND application_id ='".$application_id."'";
	//$sql = "UPDATE review SET accepted_by_dms = 0 WHERE user_id =10 AND application_id=15;
	$sql = "UPDATE review SET accepted_by_dms = $new_accepted_by_DMS WHERE user_id =$user_id";

	
	//$query= $dbc->query($sql);
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	
	//if the sql statement does not work, display an error
	if (!$stmt) {
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	//confirmation message that the student was accepted
	else{
		echo 'The student has successfully been accepted';
	}
	
}


//<?php echo $row[accepted_by_DMS]; 

?>